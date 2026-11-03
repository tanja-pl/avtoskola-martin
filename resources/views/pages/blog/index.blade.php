@extends('layouts.app')
@section('title', 'Блог — Автошкола Мартин')
@section('description', 'Статии од Автошкола Мартин: обука, испит, сообраќајни правила и совети за возачи.')
@section('nav', 'blog')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><span>Блог</span></div>
    <h1>Блог статии</h1>
    <p>Совети, новости и објаснувања од Автошкола Мартин — обука, испит и безбедност во сообраќајот.</p>
  </div>
</div>
<section>
  <div class="container">
    <div class="blog-filters" id="blogFilters">
      <a href="{{ route('blog') }}" class="blog-filter {{ $activeCategory ? '' : 'is-active' }}">Сите</a>
      @foreach ($categories as $key => $label)
        <a href="{{ route('blog', ['kategorija' => $key]) }}" class="blog-filter {{ $activeCategory === $key ? 'is-active' : '' }}">{{ $label }} <span>{{ $counts[$key] }}</span></a>
      @endforeach
    </div>
    <div class="blog-layout">
      <div>
        <div class="blog-feed">
          @forelse ($posts as $post)
            <article class="blog-row">
              <a href="{{ route('blog.show', $post['slug']) }}" class="blog-row-media">
                <img src="{{ asset($post['local']) }}" alt="{{ $post['title'] }}">
              </a>
              <div class="blog-row-body">
                <span class="blog-tag-inline">{{ $post['cats'][0] ?? 'Блог' }}</span>
                <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> {{ $post['date'] }}</span></div>
                <h2><a href="{{ route('blog.show', $post['slug']) }}">{{ $post['title'] }}</a></h2>
                <p>{{ $post['excerpt'] }}</p>
                <a href="{{ route('blog.show', $post['slug']) }}" class="btn btn-primary">Прочитај повеќе</a>
              </div>
            </article>
          @empty
            <p class="blog-empty">Нема статии во оваа категорија.</p>
          @endforelse
        </div>

        @if ($posts->total() > 0)
          <nav class="blog-pager" aria-label="Страници на блогот">
            @if ($posts->onFirstPage())
              <span class="blog-pager-nav is-disabled" aria-disabled="true">Претходна</span>
            @else
              <a class="blog-pager-nav" href="{{ $posts->previousPageUrl() }}" rel="prev">Претходна</a>
            @endif
            <div class="blog-pager-pages">
              @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                @if ($page === $posts->currentPage())
                  <span class="blog-pager-page is-current" aria-current="page">{{ $page }}</span>
                @else
                  <a class="blog-pager-page" href="{{ $url }}">{{ $page }}</a>
                @endif
              @endforeach
            </div>
            @if ($posts->hasMorePages())
              <a class="blog-pager-nav" href="{{ $posts->nextPageUrl() }}" rel="next">Следна</a>
            @else
              <span class="blog-pager-nav is-disabled" aria-disabled="true">Следна</span>
            @endif
          </nav>
        @endif
      </div>
      <aside class="blog-sidebar">
        <div class="sidebar-widget">
          <h4>Категории</h4>
          <ul class="sidebar-cat-list">
            @foreach ($categories as $key => $label)
              <li>
                <a href="{{ route('blog', ['kategorija' => $key]) }}" class="sidebar-cat-item {{ $activeCategory === $key ? 'is-active' : '' }}">
                  <span>{{ $label }}</span>
                  <span class="sidebar-cat-count">{{ $counts[$key] }}</span>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="sidebar-widget">
          <h4>Најнови статии</h4>
          @foreach ($recent as $post)
            <a class="recent-post" href="{{ route('blog.show', $post['slug']) }}">
              <div class="recent-thumb"><img src="{{ asset($post['local']) }}" alt="{{ $post['title'] }}"></div>
              <div class="recent-info"><h5>{{ $post['title'] }}</h5><span>{{ $post['date'] }}</span></div>
            </a>
          @endforeach
        </div>
        <div class="sidebar-widget sidebar-cta">
          <h4>Запишете се</h4>
          <p>Готови за возачка дозвола? Јавете се или пишете ни.</p>
          <a href="{{ route('contact') }}" class="btn btn-yellow" style="width:100%;justify-content:center;">Контактирај нè</a>
        </div>
      </aside>
    </div>
  </div>
</section>

<div class="cta-banner">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text">
        <h2>Спремни за возачка?</h2>
        <p>Запишете се во Автошкола Мартин — обука, теорија и поддршка пред испит.</p>
      </div>
      <div class="cta-actions">
        <a href="{{ route('contact') }}" class="btn btn-outline btn-lg"><i class="fa-solid fa-phone"></i> Контакт</a>
      </div>
    </div>
  </div>
</div>
@endsection
