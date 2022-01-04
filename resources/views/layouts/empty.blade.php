<!doctype html>
<html {!! get_language_attributes() !!}>
@include('partials.head')

<body @php(body_class())>
    @php(wp_body_open())
    @php(do_action('get_header'))
    <main class="wrap">
        @yield('content')
    </main>
    @php(do_action('get_footer'))
    @php(wp_footer())
</body>

</html>