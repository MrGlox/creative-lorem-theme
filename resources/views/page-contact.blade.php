{{--
  Template Name: Contact
--}}

@extends('layouts.app')

@section('content')
<section class="section section--contact contact">
  <div class="container">
    <article class="contact__content">
      @include('partials.contact')
      <div class="contact__gradient js-gradient" data-direction="horizontal" data-opacity="0.33"></div>
      <div class="contact__gradient contact__gradient--second js-gradient" data-direction="vertical"
        data-opacity="0.08"></div>
      <div class="contact__metaball js-background"></div>
      <aside class="contact__form">
        @while(have_posts()) @php(the_post())
        {{ the_content() }}
        @endwhile
      </aside>
    </article>
  </div>
  @svg('images.svg.contact', ['class' => 'contact__background'])
</section>

@endsection