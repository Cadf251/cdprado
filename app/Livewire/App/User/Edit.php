<?php

namespace App\Livewire\App\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Edit extends Component
{
  use WithFileUploads;

  public $name;
  public $phone;
  public $email;
  public $image;

  // Esse é tipo o boot() do livewire
  public function mount()
  {
    $user = Auth::user();

    // Atualiza o form com os valores do auth user
    $this->name = $user->name;
    $this->email = $user->email;
    $this->phone = $user->phone;
    // Se passar o valor de imagem para o input, ele vai cair no if ($this->image) e dar o erro de validação pq o value n é uma imagem
    // $this->image = $user->image;
  }

  public function update()
  {
    $this->validate([
      'name' => 'required|min:3',
      'phone' => 'nullable',
    ]);

    Auth::user()->update([
      'name' => $this->name,
      'phone' => $this->phone,
    ]);

    if ($this->image) {
      $this->validate([
        'image' => 'image|max:1024', // 1MB Max
      ]);

      $user = Auth::user();

      $path = $this->image->store("avatars", "public");

      $user->update([
        "image" => $path
      ]);
    }

    session()->flash('success', 'Perfil atualizado!');
  }

  public function render()
  {
    return view('components.app.user.⚡edit');
  }
}
