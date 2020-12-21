<article @php post_class() @endphp>
  <header>
    <h2 class="entry-title text-lg font-bold"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
    <div class="text-gray-700 text-sm">
      @include('partials/entry-meta')
    </div>
  </header>
  <div class="entry-summary mt-3">
    {{-- @php the_excerpt() @endphp --}}
    {!! $custom_excerpt !!}
    <div class="flex justify-center mt-3">
      <a href="{{esc_url(get_the_permalink())}}" class="btn btn-gray btn-outline">Read &#8230;</a>
    </div>
  </div>
</article>