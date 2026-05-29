@extends("layouts.app")

@section("title", "Listar Projetos")

@section('content')
<div class="task-header">
  <div class="task-header__main">
    <h2 class="titulo titulo--2">Meus Projetos</h2>
  </div>

  <div class="task-header__buttons" x-data>
    <button 
      class="small-btn"
      @click="$dispatch('open-modal', 'view')">
      + Criar
    </button>
  </div>
</div>

@forelse($items as $item)
  <div class="card--object">
    <div class="card__header">
      <div class="card__header__info">
        <strong>{{ $item->name }}</strong>
        <p><a class="link" href="{{ $item->url }}" target="_blank">{{ $item->url }}</a></p>
      </div>
    </div>

    <div class="card__inline-items">
      <div class="small-badge small-badge--{{ $item->status->color() }}">{{$item->status->label()}}</div>
    </div>

    <div class="hamburguer"
      x-data="{ isOpen: false }">

      <div class="hamburguer__controller"
        @click="isOpen = !isOpen"
        >
        <i class="fa-solid fa-ellipsis-vertical"></i>
      </div>
      <div class="hamburguer__content"
        x-show="isOpen"
        :class="{ 'is-active': isOpen }"
        @click.outside="isOpen = false"
        x-cloak>

        <a href="projetos/{{ $item->id }}/conteudos" class="small-btn small-btn--blue"><i class="fa-solid fa-up-right-from-square"></i> Editar conteúdos</a>

        @if ($item->status->label() == 'Ativo')
          <a href="projetos/arquivar/{{ $item->id ?? 0 }}" class="small-btn small-btn--gray"><i class="fa-solid fa-box-archive"></i> Arquivar</a>
        @else
          <a href="projetos/ativar/{{ $item->id ?? 0 }}" class="small-btn small-btn--green"><i class="fa-solid fa-circle-plus"></i> Ativar</a>
        @endif
      </div>
    </div>
  </div>
@empty
  <p>Nenhum item cadastrado.</p>
@endforelse

@endsection