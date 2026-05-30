@props([
  'title' => 'Diagnóstico de Projeto',
  'description' => 'Tempo médio: 1 minuto',
  'cta' => 'Finalizar',
  'action' => "",
  'type' => 'form', // 'form' ou 'action'
  'saveAllSteps' => true,
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
          <div class="w12" x-data="formWizard">
            <form {{ $attributes->merge(['class' => 'form js--form', 'method' => 'POST', 'action' => $action]) }}
              data-max="{{ $maxSteps }}"
              data-save-all-steps="{{ $saveAllSteps }}">

              <div class="barra" x-show="totalSteps > 1">
                <div class="progresso" 
                  :style="`width: ${progress}%`"
                  x-text="`${Math.round(progress)}%`"
                ></div>
              </div>

              {{ $slot }}

              <div class="button-wrapper">
                <button type="button" class="button button--gray"
                  @click="prev()"
                  :disabled="currentStep === 1"
                >Voltar</button>

                <button type="button" class="button"
                  x-text="currentStep === totalSteps ? '{{ $cta }}' : 'Avançar'"
                  @click="next()"
                >Avançar</button>
              </div>

              @csrf
            </form>
          </div>
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
