@extends('layouts.auth')

@section('content')

<x-ui.form-wizard
  title="Bem vindo!"
  description="Aplicativo para clientes | Faça seu login"
  max-steps="1"
>
  Login form
</x-ui.form-wizard>

@endsection