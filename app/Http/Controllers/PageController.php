<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function categories(): View
    {
        return view('pages.categories');
    }

    public function category(string $slug): View
    {
        $view = 'pages.categories.'.$slug;
        abort_unless(view()->exists($view), 404);

        return view($view);
    }

    public function team(): View
    {
        return view('pages.team');
    }

    public function etest(): View
    {
        return view('pages.etest');
    }

    public function videos(): View
    {
        return view('pages.videos');
    }
}
