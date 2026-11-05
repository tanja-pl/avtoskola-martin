<?php

namespace App\Services;

use App\Models\DailyCategoryStat;
use App\Models\DailySiteStat;
use Carbon\CarbonImmutable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class SiteVisitRecorder
{
    public const VISITOR_DAY = 'analytics.visitor_day';

    public function date(): string
    {
        return CarbonImmutable::now($this->timezone())->toDateString();
    }

    public function categoryFrom(Request $request): ?string
    {
        if (! $request->routeIs('category')) {
            return null;
        }

        $slug = (string) $request->route('slug');

        return array_key_exists($slug, config('analytics.categories', [])) ? $slug : null;
    }

    /**
     * Persist one page view. A visitor is counted once per local day for this session.
     */
    public function record(Request $request): void
    {
        $date = $this->date();
        $newVisitor = $request->session()->get(self::VISITOR_DAY) !== $date;

        try {
            $this->store($date, $newVisitor, $this->categoryFrom($request));
        } catch (Throwable $e) {
            if (! $this->missingTable($e)) {
                report($e);
            }

            return;
        }

        if ($newVisitor) {
            $request->session()->put(self::VISITOR_DAY, $date);
            $request->session()->save();
        }
    }

    public function store(string $date, bool $newVisitor, ?string $category): void
    {
        DB::transaction(function () use ($date, $newVisitor, $category) {
            $this->bump((new DailySiteStat)->getTable(), ['visited_on' => $date], [
                'page_views' => 1,
                'unique_visitors' => $newVisitor ? 1 : 0,
            ]);

            if ($category !== null) {
                $this->bump((new DailyCategoryStat)->getTable(), [
                    'visited_on' => $date,
                    'category' => $category,
                ], [
                    'visits' => 1,
                ]);
            }
        });
    }

    /**
     * @param  array<string, int|string>  $keys
     * @param  array<string, int>  $amounts
     */
    private function bump(string $table, array $keys, array $amounts): void
    {
        $now = now();

        DB::table($table)->insertOrIgnore($keys + [
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $update = ['updated_at' => $now];

        foreach ($amounts as $column => $amount) {
            $amount = (int) $amount;

            if ($amount < 1 || ! preg_match('/^[a-z_]+$/', $column)) {
                continue;
            }

            $update[$column] = DB::raw($column.' + '.$amount);
        }

        DB::table($table)->where($keys)->update($update);
    }

    private function timezone(): string
    {
        return (string) config('analytics.timezone', 'Europe/Skopje');
    }

    private function missingTable(Throwable $e): bool
    {
        if (! $e instanceof QueryException) {
            return false;
        }

        return ($e->errorInfo[0] ?? null) === '42S02'
            || str_contains(strtolower($e->getMessage()), 'no such table');
    }
}
