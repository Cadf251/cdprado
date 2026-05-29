@props([
  'title' => null,
  'action' => '',
  'cta' => 'Enviar',
  'loading' => null,
  'hasFiles' => false,
  'extraContent' => null
])

<form 
  method="POST"
  class="form js--form-ajax"
  action="{{ $action }}"
  {!! $hasFiles ? 'enctype="multipart/form-data"' : '' !!}
  {{ $attributes }}
>
    @csrf

    @if($title)
      <h2 class="titulo titulo--2">{{ $title }}</h2>
    @endif

    {{ $slot }}

    @if($extraContent)
      {!! $extraContent !!}
    @endif
    
    @if ($errors->any())
      <div style="color: red;">
        {{-- Mostra apenas o primeiro erro que encontrar --}}
        {{ $errors->first() }} 
      </div>
    @endif

    <button 
      data-action='form:ajax-submit'
      class="small-btn small-btn--blue"
    >
      {{ $cta }}
      @if($loading)
        <span wire:loading.remove>{{ $cta }}</span>
        <span wire:loading>{{ $loading }}</span>
      @endif
    </button>
</form>