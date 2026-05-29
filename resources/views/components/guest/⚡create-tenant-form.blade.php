<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<x-ui.form
  wire:submit.prevent="save"
  action=""
  cta="Cadastrar">

  <x-ui.field
  label="Qual é o nome da empresa?"
  name="name"  
  wire:model="name"
  ></x-ui.field>
  <x-ui.field
  label="Qual é o email de cadastro?"
  name="email"
  wire:model="email"
  ></x-ui.field>
</x-ui.form>