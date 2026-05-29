@props([
  'secondary' => false,
  "href" => "",
  "icon" => null,
  'cta' => "Entre em contato"
])

<a class="button @if ($secondary) button--gray @endif" href="{{ $href }}">

  @if ($icon) 
    <i class='{{ $icon  }}'></i>
  @endif

  {{ $cta }}
</a>