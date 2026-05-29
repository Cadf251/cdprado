<?php

namespace App\Http\Controllers;

use App\Enums\ProjectSyncStatus;
use App\Models\Project;
use App\Models\ProjectContent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $user = Auth::user();

        $tenant = $user->currentTenant();

        $projects = $tenant->projects;

        return view("app.projects.list", [
            "items" => $projects
        ]);
    }

    public function indexContents(Project $project)
    {
        $contents = $project->contents;

        return view("app.projects.contents", [
            "project" => $project,
            "items" => $contents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view("app.projects.view", [
            "item" => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    public function editContent(Project $project, ProjectContent $project_content)
    {
        $url_base = rtrim($project->url, "/");

        $url_target = ltrim($project_content->entry_point);

        $url_final = $url_base . "/" . $url_target;

        $drafts = session()->get("cms_drafts.{$project->id}", []);

        // dd($drafts);

        try {
            /** @var \Illuminate\Http\Client\Response $response */
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $project->api_token, // O token que você definiu
                'Accept'        => 'application/json',
            ])->get($url_final);

            if ($response->successful()) {
                // Se ele devolver um JSON com { "html": "..." }, use o abaixo:
                $htmlData = $response->json('html');
            } else {
                $htmlData = "<h1>Erro {$response->status()}</h1><p>Não foi possível carregar o editor.</p>";
            }
        } catch (Exception $e) {
            $htmlData = "<h1>Falha de Conexão</h1><p>{$e->getMessage()}</p>";
        }

        return view("app.projects.editor", [
            "html" => $htmlData,
            "project" => $project,
            "drafts" => $drafts
        ]);
    }

    public function saveInput(Request $request, Project $project)
    {
        // Validação dos dados que o JS enviou
        $data = $request->validate([
            'identifier'     => 'required|string',
            'content' => 'present', // 'present' aceita strings vazias ou nulas
        ]);

        // Recupera rascunhos atuais
        $drafts = session()->get("cms_drafts.{$project->id}", []);

        // Atualiza/Adiciona a nova edição
        $drafts[$data['identifier']] = $data['content'];

        // Grava de volta na sessão
        session()->put("cms_drafts.{$project->id}", $drafts);

        return back()->with('success', 'Rascunho atualizado!');;
    }

    public function publish(Project $project)
    {
        // Pega o que está no banco e o que está na sessão
        $dbPayload = json_decode($project->payload, true) ?? [];
        $drafts = session()->get("cms_drafts.{$project->id}", []);

        if (empty($drafts)) {
            return back()->with('info', 'Nada novo para publicar.');
        }

        // Merge e Ordenação Alfabética
        $finalPayload = array_merge($dbPayload, $drafts);
        ksort($finalPayload);

        // Atualiza o banco de dados
        $project->update([
            'payload' => $finalPayload,
            'sync_status' => ProjectSyncStatus::PENDING,
            'last_sync_at' => now()
        ]);

        // Dispara o JSON para o site do cliente (O Entry Point que vamos criar)
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $project->api_token,
            ])->post($project->url . $project->sync_entry_point, $finalPayload);

            /** @var \Illuminate\Http\Client\Response $response */
            if ($response->successful()) {
                $project->update(['sync_status' => ProjectSyncStatus::SUCCESS]);
                session()->forget("cms_drafts.{$project->id}"); // Limpa a sessão após sucesso
                return back()->with('success', 'Site atualizado com sucesso!');
            }
        } catch (\Exception $e) {
            $project->update(['sync_status' => ProjectSyncStatus::FAILED]);
            return back()->with('error', 'Erro ao conectar com o site do cliente.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    public function updateStatus(Project $project)
    {
        // Lógica de inversão simples
        $newStatus = ($project->status->value === 'active') ? 'archived' : 'active';

        $project->update([
            'status' => $newStatus
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
