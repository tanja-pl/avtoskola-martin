<?php

namespace Tests\Feature;

use App\Models\DailyCategoryStat;
use App\Models\DailySiteStat;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteAnalyticsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CarbonImmutable::setTestNow(CarbonImmutable::parse('2026-11-05 10:00:00', 'Europe/Skopje'));
    }

    protected function tearDown(): void
    {
        CarbonImmutable::setTestNow();

        parent::tearDown();
    }

    public function test_public_pages_are_counted_once_per_visitor_each_day(): void
    {
        $this->get('/')->assertOk()->assertSessionHas('analytics.visitor_day', '2026-11-05');
        $this->get('/')->assertOk();
        $this->get('/kategorii')->assertOk();

        $this->assertDatabaseCount('daily_category_stats', 0);
        $this->assertDatabaseHas('daily_site_stats', [
            'visited_on' => '2026-11-05',
            'page_views' => 3,
            'unique_visitors' => 1,
        ]);
    }

    public function test_category_pages_are_counted_only_when_opened(): void
    {
        $this->get('/b-kategorija')->assertOk();
        $this->get('/b-kategorija')->assertOk();
        $this->get('/c-kategorija')->assertOk();

        $this->assertDatabaseHas('daily_site_stats', [
            'visited_on' => '2026-11-05',
            'page_views' => 3,
            'unique_visitors' => 1,
        ]);
        $this->assertDatabaseHas('daily_category_stats', [
            'visited_on' => '2026-11-05',
            'category' => 'b-kategorija',
            'visits' => 2,
        ]);
        $this->assertDatabaseHas('daily_category_stats', [
            'visited_on' => '2026-11-05',
            'category' => 'c-kategorija',
            'visits' => 1,
        ]);
    }

    public function test_a_new_day_counts_the_same_browser_again(): void
    {
        $this->get('/')->assertOk();

        CarbonImmutable::setTestNow(CarbonImmutable::parse('2026-11-06 10:00:00', 'Europe/Skopje'));

        $this->get('/')->assertOk();

        $this->assertDatabaseHas('daily_site_stats', [
            'visited_on' => '2026-11-05',
            'unique_visitors' => 1,
            'page_views' => 1,
        ]);
        $this->assertDatabaseHas('daily_site_stats', [
            'visited_on' => '2026-11-06',
            'unique_visitors' => 1,
            'page_views' => 1,
        ]);
    }

    public function test_a_different_session_is_another_visitor(): void
    {
        $this->get('/')->assertOk();
        $this->flushSession();
        $this->get('/')->assertOk();

        $this->assertDatabaseHas('daily_site_stats', [
            'visited_on' => '2026-11-05',
            'page_views' => 2,
            'unique_visitors' => 2,
        ]);
    }

    public function test_signed_in_staff_are_not_counted(): void
    {
        $this->actingAs(User::factory()->create())->get('/b-kategorija')->assertOk();

        $this->assertDatabaseCount('daily_site_stats', 0);
        $this->assertDatabaseCount('daily_category_stats', 0);
    }

    public function test_login_missing_pages_bots_and_prefetches_are_ignored(): void
    {
        $this->get('/admin/login')->assertOk();
        $this->get('/nema-takva')->assertNotFound();
        $this->withHeader('User-Agent', 'Mozilla/5.0 (compatible; Googlebot/2.1)')
            ->get('/')
            ->assertOk();
        $this->flushHeaders();
        $this->withHeader('Sec-Purpose', 'prefetch')->get('/')->assertOk();

        $this->assertDatabaseCount('daily_site_stats', 0);
        $this->assertDatabaseCount('daily_category_stats', 0);
    }

    public function test_staff_can_review_visits_by_period_and_category(): void
    {
        $user = User::factory()->create();

        DailySiteStat::query()->create([
            'visited_on' => '2026-11-05',
            'page_views' => 10,
            'unique_visitors' => 4,
        ]);
        DailySiteStat::query()->create([
            'visited_on' => '2026-11-03',
            'page_views' => 5,
            'unique_visitors' => 2,
        ]);
        DailySiteStat::query()->create([
            'visited_on' => '2026-10-31',
            'page_views' => 8,
            'unique_visitors' => 9,
        ]);
        DailyCategoryStat::query()->create([
            'visited_on' => '2026-11-05',
            'category' => 'b-kategorija',
            'visits' => 6,
        ]);
        DailyCategoryStat::query()->create([
            'visited_on' => '2026-10-31',
            'category' => 'a-kategorija',
            'visits' => 2,
        ]);

        $this->get('/admin/analitika')->assertRedirect(route('admin.login'));

        $this->actingAs($user)->get('/admin/analitika')
            ->assertOk()
            ->assertSee('Аналитика')
            ->assertSee('Посети по ден')
            ->assertSee('Посети по категорија')
            ->assertSee('Дневна статистика')
            ->assertSee('Б автоматски')
            ->assertViewHas('cards', function (array $cards) {
                $cards = collect($cards)->keyBy('key');

                return $cards['today']['visitors'] === 4
                    && $cards['today']['views'] === 10
                    && $cards['week']['visitors'] === 6
                    && $cards['week']['views'] === 15
                    && $cards['month']['visitors'] === 6
                    && $cards['month']['views'] === 15
                    && $cards['period']['visitors'] === 15
                    && $cards['period']['views'] === 23;
            })
            ->assertViewHas('from', '2026-10-30')
            ->assertViewHas('to', '2026-11-05')
            ->assertViewHas('days', function (array $days) {
                return count($days) === 7
                    && $days[0]['date'] === '2026-10-30'
                    && $days[6]['date'] === '2026-11-05';
            })
            ->assertViewHas('categories', function (array $categories) {
                $categories = collect($categories)->keyBy('slug');

                return $categories['b-kategorija']['visits'] === 6
                    && $categories['a-kategorija']['visits'] === 2
                    && $categories['b-kategorija']['width'] === 100.0;
            });

        $this->actingAs($user)->get('/admin/analitika?from=2026-10-31&to=2026-10-31')
            ->assertOk()
            ->assertViewHas('cards', function (array $cards) {
                $cards = collect($cards)->keyBy('key');

                return $cards['today']['visitors'] === 4
                    && $cards['period']['visitors'] === 9
                    && $cards['period']['views'] === 8;
            })
            ->assertViewHas('days', function (array $days) {
                return count($days) === 1 && $days[0]['date'] === '2026-10-31' && $days[0]['categories'] === 2;
            })
            ->assertViewHas('categories', function (array $categories) {
                $categories = collect($categories)->keyBy('slug');

                return $categories['a-kategorija']['visits'] === 2
                    && $categories['b-kategorija']['visits'] === 0;
            });
    }

    public function test_analytics_rejects_an_impossible_or_too_long_range(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/admin/analitika')
            ->get('/admin/analitika?from=2026-11-05&to=2026-11-01')
            ->assertRedirect('/admin/analitika')
            ->assertSessionHasErrors('to');

        $this->actingAs($user)
            ->from('/admin/analitika')
            ->get('/admin/analitika?from=2020-01-01&to=2026-11-05')
            ->assertRedirect('/admin/analitika')
            ->assertSessionHasErrors('to');
    }
}
