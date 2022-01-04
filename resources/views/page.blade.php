@extends('layouts.app')

@section('content')
@include('partials.intro')
@while(have_posts()) @php(the_post())
{{ the_content() }}
@endwhile

@endsection

{{-- @extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @includeFirst(['partials.content-page', 'partials.content'])
  @endwhile
@endsection --}}