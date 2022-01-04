<section id="{{ 'column-entry-' . $block->block->id }}"
  class="section section--entry entry entry--column {{ $block->classes }}">
  <div class="container container--large">
    <article class="entry__container">
      <main class="entry__content">
        <h2 class="entry__title">
          @field('title')
        </h2>
        <div class="entry__text blur" data-offset="[12, 0]">
          @field('content')
        </div>
        <div class="entry__text">
          @field('content_highlight')
        </div>
      </main>
  </div>
</section>