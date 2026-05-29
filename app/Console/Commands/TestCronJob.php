<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class TestCronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hora = now()->format('H:i:s');
        $data = now()->format('Y-m-d');
        
        // Buscando clima de Santo André (Exemplo usando HG Brasil ou OpenWeather)
        // Se não tiver API Key agora, ele usará o fallback "N/A"
        $response = Http::get("https://api.hgbrasil.com/weather?city_name=Santo%20Andre,SP");
        $temp = $response->json()['results']['temp'] ?? 'N/A';

        $conteudo = "Registro de: $data às $hora | Temperatura em Santo André: {$temp}°C";
        
        // Criando o arquivo na pasta 'storage/app/cron_tests'
        $nomeArquivo = "log_{$data}_" . now()->format('H-i') . ".txt";
        $path = "cron_tests" . DIRECTORY_SEPARATOR . "$nomeArquivo";
        $storage = Storage::disk('local')->put($path, $conteudo);

        $this->info("Log criado com sucesso: $storage | $nomeArquivo");

        $this->info("Caminho real: " . storage_path($path));
    }
}
