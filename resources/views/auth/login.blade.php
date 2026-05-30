@extends('layouts.auth')

@section('content')
    <x-ui.form-wizard title="Faça seu login" description="Bem vindo | Aplicativo para clientes" cta='Entrar' max-steps="1" action="{{ route('auth.login') }}">

        <div class="form-step" data-step="1" :class="{ 'is-visible': currentStep === 1 }"> <x-ui.field label="E-mail?"
                type="email" name="email">
            </x-ui.field>

            <x-ui.field label="Senha?" name="password" type="password">
            </x-ui.field>

            <a class='link' href='/esqueci-senha'>Esqueci minha senha</a>
        </div>

    </x-ui.form-wizard>
@endsection
