<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<x-ui.form
  title="Bem-vindo!"
  action=""
  extraContent="<a class='link' href='/esqueci-senha'>Esqueci minha senha</a>"
  wire:submit.prevent="login"
>
  <x-ui.field
    label="Qual é o seu e-mail?"
    name="email"
    wire:model="email"
    >
  </x-ui.field>

  <x-ui.field
    label="Qual é a sua senha?"
    name="password"
    wire:model="password"
    >
  </x-ui.field>

</x-ui.form>