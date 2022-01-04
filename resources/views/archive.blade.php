@extends('layouts.app')

@section('content')
@include('partials.partners')
@while(have_posts()) @php(the_post())
{{ the_content() }}
@endwhile

@endsection