<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginService;
use App\Support\OperationResult;

class LoginController extends Controller
{
    //
    public function tryToLogin(Request $request, LoginService $service)
    {
        $result = new OperationResult();

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $service->login($validated["email"], $validated["password"]);

        if (!$user) {
            // failed
            $result->failed('E-mail ou senha inválidos.');
            return $result->toJsonResponse();
        }

        // Sucedded
        $result->redirect(route('empresas'));
        return $result->toJsonResponse();
    }
}
