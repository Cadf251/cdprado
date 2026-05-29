<?php

namespace App\Services;

use App\Models\ProjectContent;
use Illuminate\Support\Facades\Http;

class ProjectService
{
  public function syncContent(ProjectContent $content)
  {
    $project = $content->project;

    $url = rtrim($project->url, '/') . '/app/api/put.php';

    /** @var \Illuminate\Http\Client\Response $response */
    $response = Http::asForm()->post($url, [
      'payload' => $content->payload
    ]);

    // 4. Se funcionar, atualizamos o status e a data no nosso banco
    if ($response->successful()) {
      $content->update([
        'sync_status' => 'success', // Mude para o seu Enum se tiver criado um
        'last_sync_at' => now()
      ]);
      return true;
    }

    // Se falhar, marcamos como erro
    $content->update(['sync_status' => 'failed']);
    return false;
  }
}
