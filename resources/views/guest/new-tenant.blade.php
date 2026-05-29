@extends('layouts.guest')

@section("content")
<div class="content content--center">
  <div class="text-container">
    <h1 class="titulo titulo--1">Cadastre sua empresa para o primeiro acesso</h1>
    <p>Basta preencher esse formulário e conferir o seu email.</p>
  </div>
  <div class="card--glass w8">
    @livewire("guest.create-tenant-form")
  </div>
</div>
@endsection