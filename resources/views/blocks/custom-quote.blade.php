<section id="{{ 'quote-' . $block->block->id }}" class="section section--quote quote {{ $block->classes }}">
  <div class="container container--larger">
    <article class="quote__container">
      <main class="quote__content">
        <h2 class="quote__title">
          @field('title')
        </h2>
        <div class="quote__text">
          @field('content')
        </div>
      </main>
      @hasfield('quote')
      <aside class="quote__main">
        <svg viewBox="0 0 169 121" class="quote__icon quote__icon--left" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M97.071.5v71.892l23.952 47.957h35.097l-24.143-48.34H168.5V.5H97.071zM.5.5v71.892l23.952 47.957h35.097L35.406 72.01h36.523V.5H.5z"
            stroke="#00EFEB" fill="#00EFEB" fill-rule="evenodd" fill-opacity=".491" opacity=".373" />
        </svg>
        @field('quote')
        <svg viewBox="0 0 169 121" class="quote__icon quote__icon--right" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M97.071.5v71.892l23.952 47.957h35.097l-24.143-48.34H168.5V.5H97.071zM.5.5v71.892l23.952 47.957h35.097L35.406 72.01h36.523V.5H.5z"
            stroke="#00EFEB" fill="#00EFEB" fill-rule="evenodd" fill-opacity=".491" opacity=".373" />
        </svg>
      </aside>
      @endfield
  </div>
  <div class="quote__gradient js-gradient" data-direction="vertical" data-opacity="0.08"></div>
</section>