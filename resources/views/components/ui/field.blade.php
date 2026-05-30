@props([
  'label' => '',
  'type' => 'text',
  'name' => '',
  'value' => '',
  'inputOnly' => false,
  'required' => true,
  'selectDefault' => true
])

@if($type === 'text' || $type==='email')
  <div class="form__campo">
    <label>{{ $label }}</label>
    <input
      class="input"
      type="{{ $type }}"
      name="{{ $name }}"
      value="{{ $value }}"

      @if ($required)
        required
      @endif

      @blur="validateField($el.closest('.form__campo'))"
      {{-- {{ $attributes->merge(['class' => $defaultClasses]) }} --}}
      >
  </div>

@elseif($type === 'textarea')
  <div class="form__campo">
    <label>{{ $label }}</label>
    <textarea
      class="input"
      name="{{ $name }}"
      rows="4"
      
      @if ($required)
        required
      @endif

      @blur="validateField($el.closest('.form__campo'))"
      {{-- {{ $attributes->merge(['class' => $defaultClasses]) }} --}}
      >
        {{ $value }}
      </textarea>
  </div>

@elseif($type === 'select')
  <div @class(['form__campo' => !$inputOnly])>
    @if(!$inputOnly)<label>{{ $label }}</label>@endif
    <select
      class="input"
      name="{{ $name }}"
      
      @blur="validateField($el.closest('.form__campo'))">
      
      @if($selectDefault)
        <option value="">Selecionar...</option>
      @endif

      {{ $slot }}
    </select>
  </div>

@elseif($type === 'radio')
  <div class="form__campo">
    <label>{{ $label }}</label>
    <div class="radio-group">
      {{ $slot }}
    </div>
  </div>

@elseif($type==='password')
  <div class="form__campo" x-data="{ show: false }">
    <label>{{ $label }}</label>

    <div class="password-toggle">
      <input
        class="input"
        :type="show ? 'text' : 'password'"
        name="{{ $name }}"
        value="{{ $value }}"
        
        @if ($required)
          required
        @endif
        >

        <i class="fa-solid"  @click="show = !show" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
    </div>
  </div>

@elseif($type === 'hidden')
  <input type="hidden" name="{{ $name }}" value="{{ $value }}" {{ $attributes }}>

@elseif($type === 'file')
  <div class="form__campo">
    <label class="input-file">
      {{ $label }}
      <input class="input" type="file" name="{{ $name }}" {{ $attributes }}>
    </label>
  </div>
@endif