@extends('layouts.login')

@section("content")

<x-ui.form
  title="Crie sua nova senha"
  action=""
  extraContent="<a href='/login'>Voltar</a>"
>
  <x-ui.field
    label="Qual é a sua nova senha?"
    name="password">
  </x-ui.field>
</x-ui.form>

@endsection