@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post() @endphp
@include('partials.hero')
<div class="container py-8 md:py-16 lg:py-20">
  @include('partials.content-single-'.get_post_type())
</div>
@endwhile
@endsection