<section id="{{ 'tabs-' . $block->block->id }}" class="section section--tabs tabs {{ $block->classes }}">
  <div class="container container--larger">
    <div class="tabs__container">
      <header class="tabs__header">
        <h2 class="tabs__title">
          @field('title')
        </h2>
        @hasfield('subtitle')
        <p class="tabs__title tabs__title--lower">
          @field('subtitle')
        </p>
        @endfield
      </header>
      @hasfield('tabs')
      <main class="tabs__main">
        <ul class="tabs__list">
          @foreach(get_field('tabs') as $tab)
          @if($loop->first)
          <li class="tabs__item">
            <header class="tabs__title tabs__title--sub tabs__title--active">
              {{ $tab["title"] }}
            </header>
            <main class="tabs__content tabs__content--active">
              {!! apply_filters('the_content', $tab["content"]) !!}
            </main>
          </li>
          @else
          <li class="tabs__item">
            <header class="tabs__title tabs__title--sub">
              {{ $tab["title"] }}
            </header>
            <main class="tabs__content">
              {!! apply_filters('the_content', $tab["content"]) !!}
            </main>
          </li>
          @endif
          @endforeach
        </ul>
      </main>
      @endfield
      @hasfield('link')
      <footer class="tabs__footer">
        <div class="tabs__footer-container">
          <span class="tabs__footer-label">
            @field('label')
          </span>
          <a class="tabs__button tabs__footer-button" href="@field('link', 'url')" target="@field('link', 'target')"
            rel="noopener noreferrer">
            @field('link', 'title')
          </a>
        </div>
      </footer>
      @endfield
      @svg('images.svg.pattern1', ['class' => 'tabs__pattern'])
      @svg('images.svg.circle', ['class' => 'tabs__circle'])
    </div>
</section>