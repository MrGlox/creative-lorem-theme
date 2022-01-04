@extends('layouts.app')

@section('content')

@include('partials.intro')
@while(have_posts()) @php(the_post())
{{ the_content() }}
@endwhile

{{-- @while(have_posts()) @php(the_post())
  @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
@endwhile --}}
@endsection