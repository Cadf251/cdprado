@extends('layouts.middleware')

@section("content")
<div class="content content--center">
  <h3 class="titulo titulo--3">Em qual empresa deseja entrar hoje?</h3>

  @foreach($tenants as $tenant)
    <a class="card--main" href="empresas/selecionar/{{ $tenant->id }}">
      <div class="text-container">
        <strong>Empresa {{ $tenant->name }}</strong>
        <p>{{ $tenant->contact_email }}</p>
        <p>{{ $tenant->status_formated }}</p>
      </div>
      <p class="info">{{ $tenant->created_at }}</p>
    </a>
  @endforeach
</div>

@endsection