<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SiteAnalytics;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function index(Request $request, SiteAnalytics $analytics): View
    {
        $filters = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ], [
            'from.date' => 'Почетниот датум не е валиден.',
            'to.date' => 'Крајниот датум не е валиден.',
            'to.after_or_equal' => 'Крајниот датум мора да биде ист или по почетниот.',
        ]);

        $timezone = (string) config('analytics.timezone', 'Europe/Skopje');
        $today = CarbonImmutable::now($timezone)->startOfDay();
        $to = isset($filters['to'])
            ? CarbonImmutable::parse($filters['to'], $timezone)->startOfDay()
            : $today;
        $from = isset($filters['from'])
            ? CarbonImmutable::parse($filters['from'], $timezone)->startOfDay()
            : $to->subDays(6);

        if ($from->greaterThan($to)) {
            throw ValidationException::withMessages([
                'to' => 'Крајниот датум мора да биде ист или по почетниот.',
            ]);
        }

        if ((int) $from->diffInDays($to) > 366) {
            throw ValidationException::withMessages([
                'to' => 'Изберете период од најмногу една година.',
            ]);
        }

        $report = $analytics->report($from->toDateString(), $to->toDateString());

        return view('admin.analytics.index', [
            ...$report,
            'from' => $from->toDateString(),
            'to' => $to->toDateString(),
            'hasFilters' => $request->filled('from') || $request->filled('to'),
        ]);
    }
}
