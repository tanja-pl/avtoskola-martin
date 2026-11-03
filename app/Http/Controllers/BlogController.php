<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class BlogController extends Controller
{
    /** @var array<string, string> */
    private const CATEGORIES = [
        'informator' => 'Сообраќаен информатор',
        'martin' => 'Автошкола Мартин',
        'situacii' => 'Сообраќајни ситуации',
        'zakon' => 'Законски одредби',
        'greshki' => 'Најчести грешки за време на полагање',
        'a-kat' => 'А и А2 категорија',
    ];

    public function index(Request $request): View|RedirectResponse
    {
        $all = collect(json_decode(
            file_get_contents(resource_path('data/blog-posts.json')),
            true
        ));

        $filter = $request->query('kategorija');
        $filter = is_string($filter) && array_key_exists($filter, self::CATEGORIES) ? $filter : null;

        $filtered = $filter
            ? $all->filter(fn (array $post) => in_array($filter, $post['keys'] ?? [], true))->values()
            : $all->values();

        $perPage = 4;
        $lastPage = max(1, (int) ceil($filtered->count() / $perPage));
        $page = max(1, (int) $request->query('page', 1));

        if ($page > $lastPage) {
            return redirect()->route('blog', array_filter([
                'kategorija' => $filter,
                'page' => $lastPage > 1 ? $lastPage : null,
            ]));
        }

        $posts = new LengthAwarePaginator(
            $filtered->forPage($page, $perPage)->values(),
            $filtered->count(),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->except('page'),
            ]
        );

        $counts = [];
        foreach (self::CATEGORIES as $key => $label) {
            $counts[$key] = $all->filter(fn (array $post) => in_array($key, $post['keys'] ?? [], true))->count();
        }

        return view('pages.blog.index', [
            'posts' => $posts,
            'categories' => self::CATEGORIES,
            'counts' => $counts,
            'activeCategory' => $filter,
            'recent' => $all->take(3),
        ]);
    }

    public function show(string $slug): View
    {
        $view = 'pages.blog.'.$slug;
        abort_unless(view()->exists($view), 404);

        return view($view);
    }
}
