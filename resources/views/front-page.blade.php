@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post() @endphp
@include('partials.hero')
<div class="stack py-8 md:py-16 lg:py-20">

  <div class="container my-4 md:my-8 lg:my-10 copy">
    {!! the_content() !!}
  </div>

  <div class="my-4 md:my-8 lg:my-10">

    <div class="flex flex-wrap">
      <div class="w-full md:w-1/2">
        <div class="relative">
          <div class="absolute left-0 top-0 w-full h-full bg-gray-50 bg-opacity-50"></div>
          <div class="relative ml-container mr-container md:mr-0 px-4">


            <div class="py-8 md:px-8 max-w-sm md:ml-auto md:mr-0">
              <table>
                <tbody>

                  @foreach($links as $link)
                  <tr>
                    <td class="py-3 pr-3">
                      <span class="font-bold text-xl block mr-3">{!!$link['heading']!!}</span>
                    </td>
                    <td class="py-3 pl-3">
                      <a href="{{esc_url($link['url'])}}" class="btn btn-gray btn-outline"><span
                          class="px-5">{!!$link['title']!!}</span></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>


          </div>
        </div>
      </div>
      <div class="w-full md:w-1/2">
        <div class="mr-container ml-container md:ml-0 px-4">

          <div class="flex flex-wrap py-8 md:px-4 -my-3 -mx-2">
            <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 px-2 py-3">
              <span class="font-bold text-xl block">Hours</span>


              @include('partials.opening-hours')



            </div>
            <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 px-2 py-3">
              <div class="copy">{!!$home_widget!!}</div>
            </div>
          </div>
        </div>




      </div>
    </div>
  </div>



  <div class="container my-4 md:my-8 lg:my-10">
    <div class="grid gap-4 grid-cols-2 md:grid-cols-4">
      @foreach($home_posts as $home_post)
      <div class="stack">
        <article class="my-1">
          <header>
            <p class="font-bold">{{$home_post['title']}}</p>
          </header>
        </article>
        <div class="my-1">{!! $home_post['excerpt'] !!}</div>
        <div class="flex justify-center my-1">
          <a href="{{esc_url($home_post['permalink'])}}" class="btn btn-gray btn-outline">Read &#8230;</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>


  <div class="container my-4 md:my-8 lg:my-10" x-data="{}">
    <div class="grid gap-4 grid-cols-2 md:grid-cols-4">
      @foreach($home_gallery as $gallery_item)
      <div>
        <button type="button"
          class="block w-full cursor-pointer focus:outline-none focus:shadow-outline hover:shadow-lg transition duration-200"
          @click="$dispatch('img-modal', {  imgModalSrc: '{{wp_get_attachment_image_url($gallery_item,'full')}}' });">
          <div class="aspect-ratio" style="--aspect-ratio: 68%">
            {!! wp_get_attachment_image($gallery_item, 'gallery_thumb') !!}
          </div>
        </button>
      </div>
      @endforeach
    </div>
  </div>





</div>
@endwhile
@endsection

@section('footer')
<div x-data="galleryLightbox()">
  <template @img-modal.window="open(); imgModalSrc = $event.detail.imgModalSrc; " x-if="imgModal">

    <div
      class="modal admin-bar:top-admin fixed top-0 w-full left-0 h-full overflow-auto flex justify-center items-center bg-black bg-opacity-75 z-50"
      x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
      x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
      x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
      x-on:click.away="imgModalSrc = ''" x-ref="lightbox_modal">

      <div class="modal__container flex flex-col max-w-3xl max-h-full overflow-auto" aria-modal="true" tabIndex="-1"
        aria-labelledby="modal__header" aria-describedby="modal__body" @click.away="imgModal = ''">
        <button type="button" aria-label="Close" @click="imgModal = ''" x-ref="lightbox_modal_close"
          class="modal__close text-white absolute outline-none focus:outline-none focus:shadow-outline flex justify-center items-center w-8 h-8 right-0 top-0 mt-2 mr-3">
          <svg viewBox="0 0 24 24" focusable="false" class="w-4 h-4" aria-hidden="true">
            <path fill="currentColor"
              d="M.439,21.44a1.5,1.5,0,0,0,2.122,2.121L11.823,14.3a.25.25,0,0,1,.354,0l9.262,9.263a1.5,1.5,0,1,0,2.122-2.121L14.3,12.177a.25.25,0,0,1,0-.354l9.263-9.262A1.5,1.5,0,0,0,21.439.44L12.177,9.7a.25.25,0,0,1-.354,0L2.561.44A1.5,1.5,0,0,0,.439,2.561L9.7,11.823a.25.25,0,0,1,0,.354Z">
            </path>
          </svg>
        </button>
        <div class="modal__content mx-auto py-8 px-8">
          <header class="modal__header" id="modal__header"></header>
          <div class="modal__body" id="modal__body">

            <img :alt="imgModalSrc" class="object-contain h-1/2-screen" :src="imgModalSrc">

          </div>
        </div>
      </div>
    </div>


  </template>
</div>
@endsection