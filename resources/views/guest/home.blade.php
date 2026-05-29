@extends('layouts.guest')

@section("title", "Sites de Alta Performance para Negócios")
@section("description", "Desenvolvimento de sites sob medida com código limpo e foco em conversão. Transforme seus anúncios em resultados reais com tecnologia de ponta e carregamento rápido.")

@section("content")
  @include('partials._guest-hero', [
    "title" => "Sites de Alta Performance para Negócios que Exigem Autoridade",
    "description" => "Desenvolvemos sites e plataformas sob medida, com código limpo e carregamento instantâneo. A solução técnica definitiva para quem busca converter anúncios em resultados reais e posicionar sua marca no topo."
  ])

  <section class="section--center diferenciais">
    <h2 class="titulo w8 w-mobile-100">A <span class="destaque">diferença</span> entre um site comum e um site de alta performance.</h2>

    <div class="diferenciais__content grid-container--2x2">
      @foreach ($diferenciais as $diferencial)
        <div class="card card--digital">
          <i class="fa-solid fa-{{ $diferencial["icon"] }}"></i>
          <strong>{{ $diferencial['title'] }}</strong>
          <p>{{ $diferencial['content'] }}</p>
        </div>
      @endforeach
    </div>
  </section>

  <div class="angular-effect">
    {{-- Lets turn the portfólio into an independent section (a partial) to be used along other views  --}}
  
    <section class="section--center projetos" id="portfolio">
      <div class="text-container">
        <h3 class="titulo">Nossos Projetos</h3>
        <p class="descricao">Conheça alguns sites que desenvolvemos recentemente.</p>
      </div>

      @foreach ($portfolioItems as $item)
        {{ $item->render() }}       
      @endforeach
    </section>

    <section class="section--center extras">
      <div class="text-container w8 w-mobile-100">
        <h3 class="titulo">Personalizações extras</h3>
        <p>Seu site já vem com o essencial, mas podemos ir além com funcionalidades que impulsionam seu negócio. O painel básico para edição de textos já está incluso. Outras funcionalidades são opcionais e podem ser adicionadas sob demanda:</p>
      </div>
      <div class="grid-container--3xn">
        @foreach($extras as $extra)
          <div
            class="card card--widget"
            style="--bg: 
            url('{{ asset('images/widgets/back-grounds/' . $extra['bg']) }}')">

            <img
              src="{{ asset('images/widgets/icons/' . $extra['icon']) }}"
              alt="Widget Icon"
              class="widget__icon">
            
            <div class="text-container">
              <strong>{{ $extra['title'] }}</strong>
              <p>{{ $extra['description'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    <section class="investimentos">
      <h3 class="titulo titulo--2">Investimentos & Prazos</h3>

      <div class="investimentos__card">
        <strong>A partir de <span class="destaque-valor">R$700</span></strong>
        <p>O orçamento é calculado com base no tipo de site, quantidade de abas, integrações e animações.</p>
        <strong>Entrega entre <span class="destaque-valor">7d</span> a <span class="destaque-valor">30d</span></strong>
        <p>Até 7 dias para landing pages e 30 dias para um site institucional.</p>
      </div>

      <div class="section--center content">
        <h4 class="titulo">Garantias</h4>
        <div class="grid-container--3xn">
          @foreach ($garantias as $garantia)
            <div class="card card--garantia">
              <img src="{{ asset('images/' . $garantia['icon']) . '.webp' }}" alt="<?= $garantia['icon'] ?>">
              <strong>{{ $garantia['title'] }}</strong>
              <p>{{ $garantia['description'] ?? "" }} </p>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="section--center faq">
      <h4 class="titulo">Dúvidas frequentes</h4>
      
      <div class="duvidas-container w-mobile-100">
        @foreach ($faq as $pergunta)
          <div class="card card--solid js--faq-item" data-resposta="{{ $pergunta["resposta"] }}">
            <strong><span class="js--faq-controller">+</span> {{ $pergunta["pergunta"] }}</strong>
            <p></p>
          </div>
        @endforeach
      </div>
    </section>

    {{-- End Angular BG Effect --}}
  </div>
@endsection
