@extends('layouts.app')

@section('content')

@include('partials.hero')
@while(have_posts()) @php(the_post())
{{ the_content() }}
@endwhile

@endsection