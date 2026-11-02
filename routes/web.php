<?php

use App\Http\Controllers\Admin\ConversationController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

$categories = [
    'a-kategorija', 'a1-kategorija', 'a2-kategorija', 'am-kategorija',
    'b-kategorija', 'b-automatik', 'be-kategorija',
    'c-kategorija', 'ce-kategorija', 'd-kategorija',
];

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('admin.login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', fn () => redirect()->route('admin.conversations.index'))->name('admin.home');
    Route::post('/admin/logout', [LoginController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/razgovori', [ConversationController::class, 'index'])->name('admin.conversations.index');
    Route::get('/admin/razgovori/{conversation}', [ConversationController::class, 'show'])
        ->whereNumber('conversation')
        ->name('admin.conversations.show');
});

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/kategorii', [PageController::class, 'categories'])->name('categories');
Route::get('/tim', [PageController::class, 'team'])->name('team');
Route::get('/e-test', [PageController::class, 'etest'])->name('etest');
Route::get('/video', [PageController::class, 'videos'])->name('videos');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/kontakt', [ContactController::class, 'show'])->name('contact');
Route::post('/kontakt', [ContactController::class, 'store'])->middleware('throttle:8,60')->name('contact.store');
Route::redirect('/registracija', '/kontakt');
Route::get('/{slug}', [PageController::class, 'category'])
    ->whereIn('slug', $categories)
    ->name('category');

Route::redirect('/index.html', '/');
Route::redirect('/kategorii.html', '/kategorii');
Route::redirect('/tim.html', '/tim');
Route::redirect('/e-test.html', '/e-test');
Route::redirect('/video.html', '/video');
Route::redirect('/blog.html', '/blog');
Route::redirect('/kontakt.html', '/kontakt');
Route::redirect('/registracija.html', '/kontakt');
foreach ($categories as $slug) {
    Route::redirect('/'.$slug.'.html', '/'.$slug);
}
