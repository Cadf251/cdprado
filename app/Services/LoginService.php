<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginService
{
  public function login(string $email, string $pass): ?User
  {
    if (!Auth::attempt(['email' => $email, 'password' => $pass])) {
      return null;
    }

    session()->regenerate();

    return Auth::user();
  }
}