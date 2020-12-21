@if(!empty($opening_hours))
<div x-data="{ open: {{$expanded ? 'true' : 'false'}} }">
  @if($opening_hours['today'])
  <div x-show="!open">
    <div class="flex items-center flex-wrap"><span class="text-gray-700 mr-3">Today:</span>
      <div>
        @foreach($opening_hours['today'] as $dayBlock)
        <div class="text-lg mb-1 last:mb-0">
          <time datetime="{{$dayBlock['open']}}">{{date('g:i a', strtotime($dayBlock['open']))}}</time> -
          <time datetime="{{$dayBlock['close']}}">{{date('g:i a', strtotime($dayBlock['close']))}}</time>
        </div>
        @endforeach
      </div>
    </div>
    <button class="btn btn-link btn-icon-right text-blue-800 hover:text-blue-900" @click="open=true"
      aria-label="Show opening hours">
      More
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.59 8.29498L12 12.875L7.41 8.29498L6 9.70498L12 15.705L18 9.70498L16.59 8.29498Z"
          fill="currentColor" />
      </svg>
    </button>
  </div>
  @endif

  <table x-show="open" x-cloak>
    <tbody>
      @foreach($opening_hours['days'] as $dayKey=>$blocks)

      <tr class="{{$opening_hours['todayKey']===$dayKey?'font-bold':''}}">
        <td class="pr-3 py-1 border-b border-solid border-gray-50">
          {{ucfirst($dayKey)}}
        </td>
        <td class="pl-3 py-1 border-b border-solid border-gray-50">
          @foreach($blocks as $dayBlock)
          <div class="text-lg">
            <time datetime="{{$dayBlock['open']}}">{{date('g:i a', strtotime($dayBlock['open']))}}</time>
            -
            <time datetime="{{$dayBlock['close']}}">{{date('g:i a', strtotime($dayBlock['close']))}}</time>
          </div>
          @endforeach
        </td>
      </tr>

      @endforeach
    </tbody>
  </table>
</div>
@endif