<section id="{{ 'entry-' . $block->block->id }}" class="section section--entry entry {{ $block->classes }}">
  <div class="container">
    <article class="entry__container">
      <main class="entry__content blur" data-offset="[12, 0]">
        <h2 class="entry__title">
          @field('title')
        </h2>
        <div class="entry__text">
          @field('content')
          @hasfield('link')
          <a class="entry__link" href="@field('link', 'url')" target="@field('link', 'target')">
            @field('link', 'title')
          </a>
          @endfield
        </div>

      </main>
      @hasfield('image', 'url')
      <aside class="entry__media">
        <img class="js-image" data-src="@field('image', 'url')" alt="@field('image', 'alt')" />
      </aside>
      @endfield
  </div>
</section>