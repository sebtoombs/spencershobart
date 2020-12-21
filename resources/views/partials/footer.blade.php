<footer class="site-footer pb-3">

  <div class="flex flex-wrap">
    <div class="w-full md:w-2/3">
      <div class="relative">
        <div class="absolute bg-gray-50 left-0 top-0 w-full h-full bg-opacity-50"></div>
        <div class="relative ml-container mr-container md:mr-0 py-4 px-3">
          <p class="text-lg font-bold mb-3"><a id="opening-hours">Hours</a></p>
          @include('partials.opening-hours')
        </div>
      </div>
      <div class="ml-container mr-container md:mr-0 py-4 px-3">
        @php dynamic_sidebar('sidebar-footer') @endphp
      </div>
    </div>
    <div class="w-full md:w-1/3">
      <div class="ml-container md:ml-0 mr-container py-4 px-3">
        <p class="text-lg font-bold mb-1">Phone</p>
        <p class="mb-3"><a href="tel:0362430716" rel="noreferrer noopener">(03) 6243 0716</a></p>
        <p class="text-lg font-bold mb-1">Address</p>
        <p class="mb-3"><a href="https://goo.gl/maps/MXtTt4x5XGkG4XLdA" target="_blank" rel="noreferrer noopener">145a
            East Derwent
            Highway, Lindisfarne</a></p>
        <p class="text-lg font-bold mb-1">Email</p>
        <p class="mb=3"><a href="mailto:info@spencershobart.com.au">info@spencershobart.com.au</a></p>
      </div>
    </div>
  </div>
</footer>
<div class="site-credit border-t border-solid border-gray-50 py-4 text-sm text-gray-700">
  <div class="container">
    <div class="px-3">
      <p>Designed &amp; developed by <a href="https://www.kingsdesign.com.au/" target="_blank"
          class="underline">KingsDesign</a></p>
    </div>
  </div>
</div>