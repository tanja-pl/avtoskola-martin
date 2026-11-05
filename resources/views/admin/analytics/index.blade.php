@extends('admin.layout')

@section('title', 'Аналитика')

@section('content')
  <div class="page">
    <div class="page-head">
      <div>
        <h1>Аналитика</h1>
        <p>Посети на јавниот сајт, собрани по датум. Посетител се брои еднаш дневно. Освежувањето и најавен администратор не се бројат. Не се чуваат лични податоци.</p>
      </div>
    </div>

    <div class="stats cols-4">
      @foreach ($cards as $card)
        <div class="stat">
          <span>{{ $card['label'] }}</span>
          <strong title="Единствени посетители">{{ $card['visitors'] }}</strong>
          <small>{{ $card['views'] }} прегледи · {{ $card['hint'] }}</small>
        </div>
      @endforeach
    </div>

    <form class="filters" method="GET" action="{{ route('admin.analytics.index') }}" autocomplete="off">
      @if ($errors->any())
        <p class="form-error" role="alert">{{ $errors->first() }}</p>
      @endif
      <div class="filters-grid dates">
        <label>
          <span>Од датум</span>
          <input type="date" name="from" value="{{ old('from', request('from', $from)) }}">
        </label>
        <label>
          <span>До датум</span>
          <input type="date" name="to" value="{{ old('to', request('to', $to)) }}">
        </label>
      </div>
      <div class="filters-actions">
        <button type="submit" class="primary">Прикажи</button>
        @if ($hasFilters)
          <a class="text-btn" href="{{ route('admin.analytics.index') }}">Исчисти</a>
        @endif
      </div>
    </form>

    <div class="analytics-grid">
      <section class="panel" aria-labelledby="visits-heading">
        <h2 id="visits-heading">Посети по ден</h2>
        <p class="lede">Висината е број на посетители. Првите три картички се за денес, оваа недела и овој месец, без разлика на филтерот.</p>
        @if ($hasVisits)
          <p class="legend">
            <span><i></i> Посетители</span>
            @if (collect($days)->contains(fn ($day) => $day['is_today']))
              <span><i class="is-today"></i> Денес</span>
            @endif
          </p>
          <div class="chart-scroll">
            <div class="chart" aria-hidden="true">
              @foreach ($days as $day)
                <div @class(['chart-col', 'is-today' => $day['is_today']]) title="{{ $day['full'] }}: {{ $day['visitors'] }} посетители, {{ $day['views'] }} прегледи">
                  <span class="chart-value">{{ $day['visitors'] > 0 ? $day['visitors'] : '' }}</span>
                  <div class="chart-plot">
                    <div class="chart-bar" style="height: {{ $day['height'] }}%"></div>
                  </div>
                  <span class="chart-label">{{ $day['label'] }}</span>
                </div>
              @endforeach
            </div>
          </div>
        @else
          <p class="quiet-note">Нема посети во избраниот период.</p>
        @endif
      </section>

      <section class="panel" aria-labelledby="categories-heading">
        <h2 id="categories-heading">Посети по категорија</h2>
        <p class="lede">Се брои само кога ќе се отвори страницата на таа категорија.</p>
        @if ($hasVisits)
          <div class="hbar-list">
            @foreach ($categories as $category)
              <div class="hbar">
                @if (array_key_exists($category['slug'], config('analytics.categories', [])))
                  <a class="hbar-label" href="{{ route('category', $category['slug']) }}" target="_blank" rel="noopener">{{ $category['label'] }}</a>
                @else
                  <span class="hbar-label">{{ $category['label'] }}</span>
                @endif
                <div class="hbar-track" aria-hidden="true"><span style="width: {{ $category['width'] }}%"></span></div>
                <span class="hbar-value">{{ $category['visits'] }}</span>
              </div>
            @endforeach
          </div>
        @else
          <p class="quiet-note">Нема посети на категории во избраниот период.</p>
        @endif
      </section>
    </div>

    <section class="panel" aria-labelledby="daily-heading">
      <h2 id="daily-heading">Дневна статистика</h2>
      @if ($hasVisits)
        <div class="table-wrap">
          <table class="stat-table">
            <thead>
              <tr>
                <th scope="col">Датум</th>
                <th class="num" scope="col">Посетители</th>
                <th class="num" scope="col">Прегледи</th>
                <th class="num" scope="col">Категории</th>
              </tr>
            </thead>
            <tbody>
              @foreach (array_reverse($days) as $day)
                <tr @class(['is-today' => $day['is_today']])>
                  <td><time datetime="{{ $day['date'] }}">{{ $day['full'] }}</time></td>
                  <td class="num">{{ $day['visitors'] }}</td>
                  <td class="num">{{ $day['views'] }}</td>
                  <td class="num">{{ $day['categories'] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="quiet-note">Нема дневни податоци за избраниот период.</p>
      @endif
    </section>
  </div>
@endsection
