@if($site_notice)
<div id="site-notice" class="site-notice w-full bg-yellow-200  z-50 relative" data-id="{{esc_attr($site_notice['id'])}}"
  data-dismissible="{{$site_notice['dismissible']?'true':'false'}}" x-data="siteNotice()"
  :class="{ 'block': isOpen(), 'hidden':!isOpen() }" x-cloak x-ref="siteNotice" x-init="init()">

  @if($site_notice['dismissible'])
  <button aria-label="{{ esc_html_e('Dismiss site notice', 'spencershobart') }}" @click="dismiss()"
    class="site-notice-dismiss position absolute right-0 top-0 mr-2 mt-3 w-6 h-6 text-xl flex items-center justify-center">
    <svg class="icon" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
      width="1em" xmlns="http://www.w3.org/2000/svg">
      <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z">
      </path>
    </svg>
  </button>
  @endif

  <div class="p-3 mr-10">
    {!! $site_notice['content'] !!}
  </div>
</div>
@endif