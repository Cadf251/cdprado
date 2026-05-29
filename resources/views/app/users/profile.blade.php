@extends("layouts.app")

@section("title", "Perfil")

@section("content")
<div class="task-header">
  <div class="tas-header__main">
    <h1 class="titulo titulo--2">Perfil | {{ $user->name ?? "" }}</h1>
  </div>
</div>

@livewire("app.user.edit")

@endsection