<section id="{{ 'cards-' . $block->block->id }}" class="section section--cards cards {{ $block->classes }}">
    <div class="container container--larger">
        <div class="cards__container">
            <header class="cards__header">
                <h2 class="cards__title">
                    @field('title')
                </h2>
                <p class="cards__title cards__title--lower">
                    @field('subtitle')
                </p>
            </header>
            @hasfield('cards')
            <main class="cards__main">
                <ul class="cards__list">
                    @fields('cards')
                    <li class="cards__item">
                        <img class="cards__item-image" src="@sub('image', 'url')" alt="@sub('image', 'alt')">
                        <div class="cards__item-overlay js-overlay" data-color="@sub('color')"></div>
                        @hassub('links')
                        <footer class="cards__item-footer">
                            <ul class="cards__item-list">
                                @fields('links')
                                <li class="cards__item-item">
                                    <a class="cards__item-link" href="@sub('link', 'url')"
                                        target="@field('link', 'target')">
                                        @svg('images.icons.' . strtolower(get_sub_field('social')), ['class' =>
                                        'cards__item-icon icon'])
                                    </a>
                                </li>
                                @endfields
                            </ul>
                        </footer>
                        @endsub
                    </li>
                    @endfields
                </ul>
            </main>
            @endfield
        </div>
</section>