{{--
  Template Name: Valeurs
--}}

@extends('layouts.app')

@section('content')
@include('partials.skills')
@while(have_posts()) @php(the_post())
{{ the_content() }}
@endwhile

@endsection