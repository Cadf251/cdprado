@props([
  'label' => '',
  'type' => 'text',
  'name' => '',
  'value' => '',
  'inputOnly' => false,
  'selectDefault' => true
])

@php
  // Classes padrão que você já usava
  $defaultClasses = 'input';
@endphp

@if($type === 'hidden')
  <input type="hidden" name="{{ $name }}" value="{{ $value }}" {{ $attributes }}>

@elseif($type === 'file')
  <div class="form__campo">
    <label class="input-file">
      {{ $label }}
      <input class="{{ $defaultClasses }}" type="file" name="{{ $name }}" {{ $attributes }}>
    </label>
  </div>

@elseif($type === 'select')
  <div @class(['form__campo' => !$inputOnly])>
    @if(!$inputOnly)<label>{{ $label }}</label>@endif
    <select name="{{ $name }}" {{ $attributes->merge(['class' => $defaultClasses]) }}>
      @if($selectDefault)
        <option value="">Selecionar...</option>
      @endif
      {{ $slot }} {{-- Aqui entram as <option> --}}
    </select>
  </div>

@elseif($type === 'textarea')
  <div class="form__campo">
    <label>{{ $label }}</label>
    <textarea name="{{ $name }}" rows="4" {{ $attributes->merge(['class' => $defaultClasses]) }}>{{ $value }}</textarea>
  </div>

@elseif($type === 'radio')
  <div class="form__campo">
    <label>{{ $label }}</label>
    <div class="radio-group">
      {{ $slot }}
    </div>
  </div>

@else
  <div class="form__campo">
    <label>{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes->merge(['class' => $defaultClasses]) }}>
  </div>
@endif