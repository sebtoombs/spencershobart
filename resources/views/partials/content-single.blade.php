<article @php post_class() @endphp>
  <header class="post-header text-sm text-gray-700 mb-8">
    @include('partials/entry-meta')
  </header>
  <div class="entry-content copy">
    @php the_content() @endphp
  </div>
</article>