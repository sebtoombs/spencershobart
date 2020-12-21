@extends('layouts.app')

@section('content')
@include('partials.hero')


<div class="container py-8 md:py-16 lg:py-20">
  <div class="alert alert-warning">
    {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
  </div>
</div>

@endsection