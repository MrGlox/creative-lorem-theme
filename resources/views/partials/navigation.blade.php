@if ($navigation)
<ul class="menu__list">
    @foreach ($navigation as $item)
    <li
        class="menu__item {{ $item->children ? 'menu__item--has-children' : '' }} {{ $item->active ? 'menu__item--active' : '' }}">
        @if($item->url !== "#")
        <a class="menu__link" href="{{ $item->url }}">
            {{ $item->label }}
            @if ($item->children)
            @svg('images.icons.down', 'icon menu__item-icon')
            @endif
        </a>
        @else
        <span class="menu__span">
            {{ $item->label }}
            @if ($item->children)
            @svg('images.icons.down', 'icon menu__item-icon')
            @endif
        </span>
        @endif
        @if ($item->children)
        <div class="menu__list menu__list--sub">
            <ul class="menu__list-inner">
                @foreach ($item->children as $subitem)
                <li class="menu__item {{ $subitem->active ? 'menu__item--active' : '' }}">
                    @if($subitem->url !== "#")
                    <a class="menu__link" href="{{ $subitem->url }}">
                        @if(carbon_get_nav_menu_item_meta( $subitem->id, 'icon'))
                        <div class="menu__icon">
                            {!! file_get_contents( wp_get_attachment_image_src(
                            carbon_get_nav_menu_item_meta( $subitem->id,'icon'))[0]) !!}
                        </div>
                        @endif
                        {{ $subitem->label }}
                    </a>
                    @else
                    <span class="menu__span">
                        {{ $subitem->label }}
                    </span>
                    @endif
                    @if(!empty($subitem->children))
                    <div class="menu__list menu__list--second-sub">
                        <ul class="menu__list-inner">
                            @foreach ($subitem->children as $child)
                            <li class="menu__item {{ $child->active ? 'menu__item--active' : '' }}">
                                @if($child->url !== "#")
                                <a class="menu__link" href="{{ $child->url }}">
                                    {{ $child->label }}
                                </a>
                                @else
                                <span class="menu__span">
                                    {{ $child->label }}
                                </span>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </li>
    @endforeach
</ul>
@endif