<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('pages.blog.index');
    }

    public function show(string $slug): View
    {
        $view = 'pages.blog.'.$slug;
        abort_unless(view()->exists($view), 404);

        return view($view);
    }
}
