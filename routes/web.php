<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, "index"])->name("guest.home"); 

Route::view('/precos', 'guest.pricing');

Route::get("/blog", null)->name("blog.home");

Route::get("/politicas-de-privacidade")->name("guest.politicas");

Route::get('/orcamento')->name("guest.orcamento");

Route::middleware(['guest'])->group(function () {
    Route::view('/cadastrar-empresa', 'guest.new-tenant');
    Route::view('/login', 'auth.login')->name("auth.login");
    Route::view('/esqueci-senha', 'auth.forgot-password');
    Route::view('/criar-senha', 'auth.create-password');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'app.dashboard');
    Route::get('/perfil', [UserController::class, "authProfile"]);

    Route::get('/empresas', [TenantController::class, "index"]);
    Route::get('/empresas/selecionar/{id}', [TenantController::class, "select"]);

    Route::get("/projetos", [ProjectController::class, "index"]);
    Route::get("/projetos/{project}", [ProjectController::class, "show"]);

    Route::get('/projetos/{project}/conteudos/', [ProjectController::class, 'indexContents']);

    Route::get('/projetos/{project}/{project_content}/painel', [ProjectController::class, "editContent"]);

    Route::post("/projetos/{project}/{project_content}/painel", [ProjectController::class, "saveInput"]);

    Route::post("/projetos/{project}/publicar", [ProjectController::class, "publish"]);

    Route::get('/projetos/arquivar/{project}', [ProjectController::class, 'updateStatus']);
    Route::get('/projetos/ativar/{project}', [ProjectController::class, 'updateStatus']);

    Route::get('/get-view/{view}', function () {
        return "Hello World";
    });
});

Route::get('/logout', function (Request $request) {
    Auth::logout(); // Desloga o usuário no Guard atual

    $request->session()->invalidate(); // Destrói os dados da sessão
    $request->session()->regenerateToken(); // Gera um novo token CSRF por segurança

    return redirect('/login');
});
