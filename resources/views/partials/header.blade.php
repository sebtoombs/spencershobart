@include('partials.site-notice')
<header class="site-header absolute left-0 top-0 admin-bar:top-admin w-full z-40">
  <div class="container">
    <div class="flex items-center">
      <div class="{{is_front_page() ? 'lg:hidden' : ''}} w-24">
        {!! App\alt_custom_logo() !!}
      </div>
      @if(is_front_page())
      <div class="py-2 hidden lg:block w-40">
        {!! get_custom_logo( )!!}
      </div>
      @endif
      <nav class="nav-primary ml-auto hidden lg:block py-8">
        @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'container'=>false]) !!}
        @endif
      </nav>
      <div class="lg:hidden ml-auto">
        <div x-data>
          <button
            @click="$store.navigation.triggerEl = $event.currentTarget; $store.navigation.open = !$store.navigation.open;"
            class="bg-gray-500 inline-flex items-center justify-center p-2 text-gray-100 hover:text-gray-200 hover:bg-gray-600 focus:outline-none focus:shadow-outline transition duration-200">
            <span class="sr-only">Open main menu</span>
            <svg :class="{ 'hidden': $store.navigation.open, 'block': !$store.navigation.open }" class="h-6 w-6 block"
              x-description="Heroicon name: menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg :class="{ 'hidden': !$store.navigation.open, 'block': $store.navigation.open }" class="h-6 w-6 hidden"
              x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

  </div>
</header>