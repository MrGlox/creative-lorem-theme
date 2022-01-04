@php
$media = get_field('media');
$image = get_field('image');
@endphp

<section id="{{ 'graph-' . $block->block->id }}" class="section section--graph graph {{ $block->classes }}">
  <div class="container">
    <article class="graph__container">
      <main class="graph__content" data-offset="[12, 0]">
        <h2 class="graph__title">
          @field('title')
        </h2>
        <div class="graph__text">
          @field('content')
        </div>
        <div class="graph__gradient js-gradient" data-direction="vertical" data-opacity="0.33"></div>
      </main>
      <aside class="graph__aside">
        @if ($media)
        <div class="graph__media svg-player" data-src="{{ $media['url'] }}" alt="{{ $media['alt'] }}"></div>
        @else
        <div class="graph__image" data-src="{{ $image['url'] }}" alt="{{ $image['alt'] }}"></div>
        @endif
      </aside>
      @svg('images.svg.pattern1', ['class' => 'graph__pattern'])
    </article>
  </div>
</section>