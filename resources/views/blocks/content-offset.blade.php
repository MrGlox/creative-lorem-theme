<section id="{{ 'offset-' . $block->block->id }}" class="section section--offset offset {{ $block->classes }}">
  <div class="container">
    <div class="offset__container">
      <header class="offset__header">
        <h2 class="offset__title">
          @field('title')
        </h2>
      </header>
      @hasfield('entries')
      <ul class="offset__entries">
        @fields('entries')
        <li class="offset__entry">
          @hassub('subtitle')
          <h3 class="offset__title offset__title--sub">@sub('subtitle')</h3>
          @endsub
          @hassub('content')
          <div class="offset__content">@sub('content')</div>
          @endsub
        </li>
        @endfields
      </ul>
      @endfield
      <div class="offset__gradient js-gradient" data-direction="vertical" data-opacity="0.33"></div>
      @svg('images.svg.pattern1', ['class' => 'offset__pattern'])
      @svg('images.svg.circle', ['class' => 'offset__circle'])
    </div>
</section>