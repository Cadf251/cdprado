@props([
  'title' => 'Diagnóstico de Projeto',
  'description' => 'Tempo médio: 1 minuto',
  'type' => 'form', // 'form' ou 'action'
  'maxSteps' => 1,
  'leadName' => null,
])

<main class="main main--utility">
  <div class="form-container">

    <div class="form-header">
      <h1 class="titulo titulo--1">{{ $title }}</h1>
      <p>{{ $description }}</p>
    </div>

    <div class="step-container">
      <div class="step-wrapper">

        @if ($type === 'form')
          <form {{ $attributes->merge(['class' => 'form js--form', 'method' => 'POST']) }}
            data-max="{{ $maxSteps }}">

            <div class="barra">
              <div class="progresso js--progresso"></div>
            </div>

            {{ $slot }}

            <div class="button-wrapper">
              <button type="button" class="button button--gray js--previous">Voltar</button>
              <button type="button" class="button js--next">Avançar</button>
            </div>
          </form>
        @else
          {{-- <div class="action-grid">
            <a href="https://wa.me/{{ config('services.whatsapp.number') }}?text={{ urlencode('Olá,' . ($leadName ? " sou o $leadName," : '') . ' finalizei meu formulário. Quero criar meu site para captar clientes') }}"
              class="button button--whatsapp" target="_blank" rel="noopener">
              Falar com um especialista agora
            </a>

            <a href="{{ config('services.instagram.link') }}" class="button button--gray" target="_blank"
              rel="noopener">
              Acompanhar novidades no Instagram
            </a>
          </div> --}}
        @endif

      </div>
    </div>
  </div>
</main>
