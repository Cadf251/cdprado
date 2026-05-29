<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<x-ui.form
  action=""
  cta="Salvar"
  hasFiles="true"
  wire:submit.prevent="update"
>
  <x-ui.field
    label="Foto de perfil"
    name="image"
    wire:model.live="image"
    type="file"
    >
  </x-ui.field>

  <x-ui.field
    label="Nome"
    name="name"
    value=""
    wire:model="name"
    >
  </x-ui.field>

  <x-ui.field
    label="Celular"
    name="phone"
    wire:model="phone"
    >
  </x-ui.field>

  <x-ui.field
    label="E-mail"
    name="email"
    wire:model="email"
    >
  </x-ui.field>


</x-ui.form>