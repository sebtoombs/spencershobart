@extends('layouts.app')

@section('content')
@include('partials.hero')

<div class="container py-8 md:py-16 lg:py-20">
  @if (!have_posts())
  <div class="alert alert-warning">
    {{ __('Sorry, no results were found.', 'sage') }}
  </div>
  {!! get_search_form(false) !!}
  @endif

  <div class="grid gap-4 grid-cols-2 md:grid-cols-4">
    @while (have_posts()) @php the_post() @endphp
    @include('partials.content-'.get_post_type())
    @endwhile
  </div>

  {!! get_the_posts_navigation() !!}
</div>
@endsection