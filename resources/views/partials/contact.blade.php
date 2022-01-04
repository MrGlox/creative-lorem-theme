<main class="contact__main">
  <header class="contact__header">
    @if(function_exists('yoast_breadcrumb'))
    {!! yoast_breadcrumb( '<p class="contact__breadcrumb breadcrumbs" id="breadcrumbs">','</p>' ) !!}
    @endif
    <h2 class="contact__title">@field('title')</h2>
  </header>
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
  @hasfield('socials')
  <div class="contact__footer">
    <ul class="contact__socials">
      @fields('socials')
      <li class="contact__socials-item">
        <a class="contact__socials-link" href="@sub('link', 'url')" target="_blank">
          {!! get_svg( 'images.icons.' . get_sub_field('icon'), ['icon', 'contact__socials-icon',
          'contact__socials-icon--' . get_sub_field('icon')]); !!}
        </a>
      </li>
      @endfields
    </ul>
  </div>
  @endfield
</main>