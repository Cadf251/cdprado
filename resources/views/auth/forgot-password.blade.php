@extends('layouts.login')

@section("content")

<x-ui.form
  title="Solicite uma nova senha"
  action=""
  extraContent="<a href='/login'>Voltar</a>"
>
  <x-ui.field
    label="Qual é o seu e-mail?"
    name="email">
  </x-ui.field>
</x-ui.form>

@endsection