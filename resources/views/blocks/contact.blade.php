<section id="{{ 'contact-' . $block->block->id }}" class="section section--contact contact {{ $block->classes }}">
  <div class="container">
    <article class="contact__content">
      @svg('images.svg.contact', ['class' => 'contact__background'])
      <header class="contact__header">
        <h2 class="contact__title">@field('title')</h2>
      </header>
      <main class="contact__main blur">
        <ul class="contact__list">
          <li class="contact__item">
            <h3 class="contact__title contact__title--sub">@field('address_label')</h3>
            <div class="contact__text">@field('address_content')</div>
          </li>
          @fields('coords')
          <li class="contact__item contact__item--inline">
            <h3 class="contact__title contact__title--sub">@sub('subtitle')</h3>
            <div class="contact__text">@sub('content')</div>
          </li>
          @endfields
        </ul>
      </main>
    </article>
  </div>
</section>