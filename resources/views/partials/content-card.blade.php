@php
$color = get_fields()['overflow_color'];
@endphp

<article @php(post_class('masonry__card'))>
  <a class="masonry__card-link" href="{{ get_permalink() }}">
    <header class="masonry__card-header">
      <p class="masonry__card-category">@category</p>
      <h2 class="masonry__card-title">
        {!! $title !!}
      </h2>
    </header>
    <img class="masonry__card-media" src="@thumbnail(false)" />
    <div class="masonry__card-overlay js-overlay" data-color="{{ $color }}"></div>
  </a>
</article>