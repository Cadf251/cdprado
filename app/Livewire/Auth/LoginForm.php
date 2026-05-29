<?php

namespace App\Livewire\Auth;

use App\Services\LoginService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{
  public $email = '';
  public $password = '';
  public $errorMessage = '';

  protected $rules = [
    'email' => 'required|email',
    'password' => 'required|min:4',
  ];

  public function login(LoginService $service)
  {
    $this->validate();

    $user = $service->login($this->email, $this->password);

    if (!$user) {
      return $this->fail();
    }

    $this->redirect('/empresas');
  }

  private function fail(string $message = "E-mail ou senha incorretos.")
  {
    $this->errorMessage = $message;
  }

  public function render()
  {
    // dd(view()->exists('components.auth.⚡login-form'));

    return view('components.auth.⚡login-form');
  }
}