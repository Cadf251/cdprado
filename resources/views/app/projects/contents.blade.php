@extends("layouts.app")

@section("title", "Listar Conteúdos de Projeto")

@section('content')
<div class="task-header">
  {{-- <div class="task-header__main">
    <a href="/projetos/{{ $project->id }}">Voltar</a>
    <h2 class="titulo titulo--2">Páginas do Site | {{ $project->url }}</h2>
  </div> --}}

  <div class="content content--inline">
    <a href="/projetos" class="small-btn small-btn--blue"><i class="fa-solid fa-chevron-left"></i></a>
    <h2 class="titulo titulo--2">Páginas do Site | {{ $project->url }}</h2>
  </div>

  <div class="task-header__buttons" x-data>
    <button
      class="small-btn"
      @click="$dispatch('open-modal', 'view')">
      + Nova Página
    </button>
  </div>
</div>


@forelse($items as $item)
  <div class="card--object">
    <div class="card__header">
      <div class="card__header__info">
        <strong>Página {{ $item->name }}</strong>
        <p><a class="link" href="{{ $project->url . $item->view_link }}" target="_blank">{{ $project->url . $item->view_link }}</a></p>
      </div>
    </div>

    <div class="card__inline-items">
      <a href="/projetos/1/{{ $item->id }}/painel" target="_blank" class="small-btn small-btn--blue"><i class="fa-solid fa-up-right-from-square"></i> Abrir no painel</a>
    </div>
  </div>
@empty
  <p>Nenhum item cadastrado.</p>
@endforelse

@endsection
