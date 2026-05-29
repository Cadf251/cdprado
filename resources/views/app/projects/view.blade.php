@extends("layouts.app")

@section("title", "Visualizar Projeto")

@section('content')

<div class="task-header">
  <div class="content content--inline">
    <a href="projetos" class="small-btn small-btn--blue"><i class="fa-solid fa-chevron-left"></i></a>
    <h1 class="titulo titulo--1">{{ $item->name }}</h1>
  </div>
</div>

<div class="content">
  Api Token: {{ $item->api_token ?? "Não há um token" }}

  <div class="content content--inline">

  <p>
    <button class="small-btn small-btn--blue"><i class="fa-solid fa-pencil"></i> Editar conteúdos</button> 
  </p>

  @if ($item->status == 'active')
    <p>
      <button class="small-btn small-btn--gray"><i class="fa-solid fa-file-arrow-down"></i> Arquivar</button>
    </p>
  @else
    <p>
      <button class="small-btn small-btn--green"><i class="fa-solid fa-plus"></i> Ativar</button>
    </p>
  @endif
  </div>
</div>

@endsection