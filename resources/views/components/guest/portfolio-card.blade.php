<div class="project-view">

  {{-- Project View Cover  --}}
  <div class="project-view__cover">
    <img src="{{ asset($data["cover"]) }}" alt="Capa {{ $data['name'] }}">

    {{-- Fullscreen Toggle --}}
    @if ($data["fullscreen"])
      <div class="project-view__toggle js--device-full-screen">
        <i class="fa-solid fa-expand"></i> Ver em tela cheia
      </div>
    @endif
  </div>

  {{-- Project Info Card --}}
  <div class="project-view__info">

    {{-- Overflow Scroll Content --}}
    <div class="project-view__info__scroll">

      {{-- Favicon --}}
      @if ($data["favicon"])
        <div class="favicon">
          <img src="{{ asset($data["favicon"]) }}" alt="Favicon {{ $data["name"] }}">
        </div>
      @endif

      {{-- Link to | Title --}}
      <div class="text-container">
        <strong>{{ $data["title"] }}</strong>
        <a class="link" target="_blank"
          href="{{ $data["url"] }}">
          {{ $data["url"] }}
        </a>
      </div>

      {{-- About --}}
      <div class="text-container">
        <strong>Visão geral sobre o projeto</strong>
        <p>{{ $data["about"] }}</p>
      </div>
      
      {{-- Feedback --}}
      @if ($data['feedback'])
        <div class="text-container">
          <strong>Comentário do cliente</strong>
          <p>{{ $data["feedback"] }}</p>
        </div>
      @endif
    </div>
  </div>
</div>

{{-- FullScreen Mode --}}
@if ($data["fullscreen"])
  <div class="full-screen js--full-screen-container" data-project="{{ $data["name"] }}">
    <div class="view-container js--view-container">
      <div class="device-mockup" id="device">
        <div class="device-screen">
          <div id="screen-overlay"></div>
          <img src="" id="device-img"></img>
        </div>
      </div>

      <div class="device-toggles">
        @if ($data["mobile"])
          <button data-project="{{ $data["name"] }}" data-type="mobile" class="js--device-toggle"><i class="fa-solid fa-mobile"></i></button>
        @endif
        
        @if ($data["desktop"])
          <button data-project="{{ $data["name"] }}" data-type="desktop" class="js--device-toggle"><i class="fa-solid fa-display"></i></button>
        @endif

        <button class="js--device-full-screen">
          <i class="fa-solid fa-expand"></i>
        </button>
      </div>
    </div>
  </div>
@endif