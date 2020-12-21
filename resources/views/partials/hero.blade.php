@php $hero_classes = is_front_page( ) ? 'hero-front-page py-32 md:py-32 lg:py-48 xl:py-56' : 'py-32'; @endphp
<div class="spencers_hero {{$hero_classes}} pt-48 md:pt-48 relative bg-cover bg-center" @if($hero_background)
  style="background-image: url({{wp_get_attachment_image_url($hero_background[0], 'full')}});" @endif>
  <div class="absolute bg-gray-400 bg-opacity-25 w-full h-full left-0 top-0"></div>
  <div class="container">
    <div class="max-w-3xl mx-auto relative">
      <h1 class="text-white stack">
        <span class="font-sans font-bold text-5xl lg:text-6xl block my-1 lg:my-3 leading-tight">{!!
          $hero_title!!}</span>
        @if($hero_subtitle)
        <span class="font-serif text-5xl lg:text-6xl block my-1 lg:my-3 leading-tight">{!! $hero_subtitle
          !!}</span>
        @endif
      </h1>
      @if($hero_actions)
      <div class="stack md:is-inline mt-10 lg:mt-12">
        @foreach($hero_actions as $actionIndex=>$action)
        <a href="{{esc_url($action['url'])}}" target="{{esc_attr($action['target'])}}"
          class="btn {{$actionIndex===0?'btn-gray':'btn-white btn-outline'}} btn-lg lg:px-8 xl:px-12 my-3 md:my-0 sm:mx-3 md:mx-6">{!!
          $action['title'] !!}</a>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</div>