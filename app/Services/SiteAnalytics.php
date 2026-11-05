<?php

namespace App\Services;

use App\Models\DailyCategoryStat;
use App\Models\DailySiteStat;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;

class SiteAnalytics
{
    /**
     * @return array{
     *     cards: list<array{key: string, label: string, hint: string, visitors: int, views: int}>,
     *     days: list<array{date: string, label: string, full: string, visitors: int, views: int, categories: int, height: float, is_today: bool}>,
     *     categories: list<array{slug: string, label: string, visits: int, width: float}>,
     *     today: string,
     *     periodVisitors: int,
     *     periodViews: int,
     *     hasVisits: bool
     * }
     */
    public function report(string $from, string $to): array
    {
        $today = CarbonImmutable::now($this->timezone())->startOfDay();
        $todayKey = $today->toDateString();
        $weekStart = $today->startOfWeek(CarbonImmutable::MONDAY)->toDateString();
        $monthStart = $today->startOfMonth()->toDateString();

        $rows = $this->between(DailySiteStat::query(), min($from, $weekStart, $monthStart), max($to, $todayKey))->get();

        $byDate = [];

        foreach ($rows as $row) {
            $byDate[$row->visited_on->toDateString()] = [
                'visitors' => (int) $row->unique_visitors,
                'views' => (int) $row->page_views,
            ];
        }

        $categoryByDate = $this->categoryTotalsByDate($from, $to);
        $categoryVisits = $this->categoryVisits($from, $to);

        $period = $this->sumBetween($byDate, $from, $to);
        $days = $this->days($from, $to, $todayKey, $byDate, $categoryByDate);

        return [
            'cards' => [
                $this->card('today', 'Денес', $todayKey, $todayKey, $byDate),
                $this->card('week', 'Оваа недела', $weekStart, $todayKey, $byDate),
                $this->card('month', 'Овој месец', $monthStart, $todayKey, $byDate),
                [
                    'key' => 'period',
                    'label' => 'Избран период',
                    'hint' => $this->span($from, $to),
                    'visitors' => $period['visitors'],
                    'views' => $period['views'],
                ],
            ],
            'days' => $days,
            'categories' => $this->categories($categoryVisits),
            'today' => $todayKey,
            'periodVisitors' => $period['visitors'],
            'periodViews' => $period['views'],
            'hasVisits' => $period['views'] > 0,
        ];
    }

    /**
     * @param  array<string, array{visitors: int, views: int}>  $byDate
     * @return array{key: string, label: string, hint: string, visitors: int, views: int}
     */
    private function card(string $key, string $label, string $from, string $to, array $byDate): array
    {
        $totals = $this->sumBetween($byDate, $from, $to);

        return [
            'key' => $key,
            'label' => $label,
            'hint' => $this->span($from, $to),
            'visitors' => $totals['visitors'],
            'views' => $totals['views'],
        ];
    }

    /**
     * @param  array<string, array{visitors: int, views: int}>  $byDate
     * @return array{visitors: int, views: int}
     */
    private function sumBetween(array $byDate, string $from, string $to): array
    {
        $visitors = 0;
        $views = 0;

        foreach ($byDate as $date => $item) {
            if ($date < $from || $date > $to) {
                continue;
            }

            $visitors += $item['visitors'];
            $views += $item['views'];
        }

        return ['visitors' => $visitors, 'views' => $views];
    }

    /**
     * @param  array<string, array{visitors: int, views: int}>  $byDate
     * @param  array<string, int>  $categoryByDate
     * @return list<array{date: string, label: string, full: string, visitors: int, views: int, categories: int, height: float, is_today: bool}>
     */
    private function days(string $from, string $to, string $today, array $byDate, array $categoryByDate): array
    {
        $cursor = CarbonImmutable::parse($from);
        $end = CarbonImmutable::parse($to);
        $days = [];

        while ($cursor->lessThanOrEqualTo($end)) {
            $key = $cursor->toDateString();
            $days[] = [
                'date' => $key,
                'label' => $cursor->format('d.m'),
                'full' => $cursor->format('d.m.Y'),
                'visitors' => $byDate[$key]['visitors'] ?? 0,
                'views' => $byDate[$key]['views'] ?? 0,
                'categories' => $categoryByDate[$key] ?? 0,
                'height' => 0.0,
                'is_today' => $key === $today,
            ];
            $cursor = $cursor->addDay();
        }

        $peak = max(1, ...array_column($days, 'visitors'));

        foreach ($days as $index => $day) {
            $days[$index]['height'] = round($day['visitors'] / $peak * 100, 2);
        }

        return $days;
    }

    /**
     * @return array<string, int>
     */
    private function categoryTotalsByDate(string $from, string $to): array
    {
        $totals = [];

        $rows = $this->between(DailyCategoryStat::query(), $from, $to)
            ->selectRaw('visited_on, sum(visits) as visits')
            ->groupBy('visited_on')
            ->get();

        foreach ($rows as $row) {
            $key = $row->visited_on instanceof \DateTimeInterface
                ? CarbonImmutable::instance($row->visited_on)->toDateString()
                : (string) $row->visited_on;

            $totals[$key] = (int) $row->visits;
        }

        return $totals;
    }

    /**
     * @return array<string, int>
     */
    private function categoryVisits(string $from, string $to): array
    {
        $totals = [];

        $rows = $this->between(DailyCategoryStat::query(), $from, $to)
            ->selectRaw('category, sum(visits) as visits')
            ->groupBy('category')
            ->get();

        foreach ($rows as $row) {
            $totals[(string) $row->category] = (int) $row->visits;
        }

        return $totals;
    }

    /**
     * @param  array<string, int>  $visits
     * @return list<array{slug: string, label: string, visits: int, width: float}>
     */
    private function categories(array $visits): array
    {
        $defined = config('analytics.categories', []);
        $order = array_flip(array_keys($defined));
        $rows = [];

        foreach ($defined as $slug => $label) {
            $rows[] = [
                'slug' => $slug,
                'label' => $label,
                'visits' => $visits[$slug] ?? 0,
                'width' => 0.0,
            ];
        }

        foreach ($visits as $slug => $count) {
            if (array_key_exists($slug, $defined)) {
                continue;
            }

            $rows[] = [
                'slug' => $slug,
                'label' => $slug,
                'visits' => $count,
                'width' => 0.0,
            ];
        }

        usort($rows, function (array $a, array $b) use ($order) {
            if ($a['visits'] !== $b['visits']) {
                return $b['visits'] <=> $a['visits'];
            }

            return ($order[$a['slug']] ?? 100) <=> ($order[$b['slug']] ?? 100);
        });

        $peak = max(1, ...array_column($rows, 'visits'));

        foreach ($rows as $index => $row) {
            $rows[$index]['width'] = round($row['visits'] / $peak * 100, 2);
        }

        return $rows;
    }

    private function span(string $from, string $to): string
    {
        $start = CarbonImmutable::parse($from)->format('d.m.Y');
        $end = CarbonImmutable::parse($to)->format('d.m.Y');

        return $start === $end ? $start : $start.' – '.$end;
    }

    /**
     * @param  Builder<DailySiteStat>|Builder<DailyCategoryStat>  $query
     * @return Builder<DailySiteStat>|Builder<DailyCategoryStat>
     */
    private function between(Builder $query, string $from, string $to): Builder
    {
        $end = CarbonImmutable::parse($to)->addDay()->toDateString();

        return $query->where('visited_on', '>=', $from)->where('visited_on', '<', $end);
    }

    private function timezone(): string
    {
        return (string) config('analytics.timezone', 'Europe/Skopje');
    }
}
