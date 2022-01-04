@php
$fields = get_fields(get_queried_object_id());

$globalIndex = 0;
$customIndex = 0;
@endphp

@extends('layouts.app')

@section('content')

<section class="section section--partners partners">
    <div class="container">
        <article class="partners__content">
            @if(function_exists('yoast_breadcrumb'))
            {!! yoast_breadcrumb( '<p class="partners__title partners__title--sub breadcrumbs" id="breadcrumbs">','</p>'
            ) !!}
            @endif
            <main class="partners__main">
                <div class="partners__heading">
                    <h1 class="partners__title">{{ $fields['title'] }}</h1>
                    <div class="partners__text">{!! apply_filters('the_content', $fields['content']) !!}</div>
                </div>
            </main>
            @if($fields['companies'])
            <footer class="partners__footer">
                <ul class="partners__list">
                    @foreach($fields['companies'] as $item)
                    <li class="partners__item">
                        @if($item['link']['url'])
                        <a class="partners__link" href="{{ $item['link']['url'] }}"
                            target="{{ $item['link']['target'] }}" rel="noopener noreferrer">
                            <img src="{{ $item['logo']['url'] }}" alt="{{ $item['logo']['alt'] }}" />
                        </a>
                        @else
                        <div class="partners__container">
                            <img src="{{ $item['logo']['url'] }}" alt="{{ $item['logo']['alt'] }}" />
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </footer>
            @endif
            <div class="partners__background js-background"></div>
            <div class="partners__gradient js-gradient" data-direction="horizontal" data-opacity="0.33"></div>
        </article>
    </div>
</section>
<section class="section section--masonry masonry">
    <div class="container container--larger">
        <div class="masonry__container">
            @svg('images.svg.pattern1', ['class' => 'masonry__pattern'])
            <header class="masonry__header">
                <h2 class="masonry__title">
                    {{ $fields['archive_title'] }}
                </h2>
                @if($fields['archive_description'])
                <div class="masonry__text">
                    {!! apply_filters('the_content', $fields['archive_description']) !!}
                </div>
                @endif
            </header>

            <main class="masonry__main">
                @if (!have_posts())
                <x-alert type="warning">
                    {!! __('Sorry, no results were found.', 'sage') !!}
                </x-alert>

                {!! get_search_form(false) !!}
                @endif

                <div class="masonry__list">
                    @while(have_posts()) @php(the_post())
                    @includeFirst(['partials.content-' . get_post_type(), 'partials.content-card'])

                    @if($globalIndex % 3 === 0 && $fields['cards'][$customIndex])
                    <article class="masonry__card masonry__card--custom">
                        <div class="masonry__card-container" href="{{ get_permalink() }}">
                            <header class="masonry__card-header">
                                <p class="masonry__card-data">
                                    <span>{{ $fields['cards'][$customIndex]['pre_value'] }}</span>
                                    <span class="count-up">{{ $fields['cards'][$customIndex]['value'] }}</span>
                                    <span>{{ $fields['cards'][$customIndex]['post_value'] }}</span>
                                </p>
                                <p class="masonry__card-label">{{ $fields['cards'][$customIndex]['label'] }}</p>
                            </header>
                            <div class="masonry__card-overlay js-overlay"
                                data-color="{{ $fields['cards'][$customIndex]['color'] }}"></div>
                        </div>
                    </article>
                    @php($customIndex++)
                    @endif

                    @php($globalIndex++)
                    @endwhile
                </div>

                {!! get_the_posts_navigation() !!}
            </main>
            <div class="masonry__gradient js-gradient" data-direction="vertical" data-opacity="0.08"></div>
        </div>
    </div>
</section>
@endsection