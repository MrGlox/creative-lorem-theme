{{--
  Template Name: À propos
--}}

@extends('layouts.app')

@section('content')

@include('partials.intro')
@while(have_posts()) @php(the_post())
{{ the_content() }}
@endwhile

@endsection