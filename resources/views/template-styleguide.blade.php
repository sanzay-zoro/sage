{{--
  Template Name: StyleGuide Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    


    <div class="styleguide">

      Leadspace
    </div>



  @endwhile
@endsection
