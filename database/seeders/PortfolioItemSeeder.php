<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PortfolioItem::create([
            'name' => "saboia",
            'url' => "https://saboiaconstrucoes.com.br/",
            'title' => "Construções e Reformas em SP | Saboia Construções",
            'about' => "Site institucional one-page, feito para conversão por whatsapp. A maior dificuldade foi criar o layout de portfólio em formato de grades com fotos das contruções. Apuramos a base de fotografias do cliente e escolhemos as melhores para encaixar no site.",
            'relevance' => 10,
            'area_atuacao' => "Construção",
            'area_atuacao_slug' => 'construcao',
            'badges' => [
                "Site Institucional",
                "One-Page",
                "Portfólio interativo",
                "Conversão por whatsapp"
            ],
            'feedback' => null
        ]);

        PortfolioItem::create([
            "name" => "hailton-adv",
            "url" => "https://hribeiro.adv.br/",
            "title" => "HR Advocacia | Defesa Técnica e Estratégica em Direito Penal",
            "about" => "Site multi-page, de um escritório criminalista, com estética sóbria e imponente a uma infraestrutura técnica focada em conversão para campanhas do Google Ads. O projeto nasceu da restruturação do site antigo, ganhando um design totalmente novo e <b>133,33%</b> mais rápido no mobile.",
            "relevance" => 8,
            "area_atuacao" => "Direito",
            "area_atuacao_slug" => "direito",
            "badges" => [],
            "feedback" => null
        ]);

        PortfolioItem::create([
            "name" => "rocha-e-rocha",
            "url" => "https://rercorretagemdeseguros.com.br/",
            "title" => "Rocha & Rocha Corretora de Seguros",
            "about" => "Site e landing pages de cada produto integrados em uma ferramenta de organização de dados de cotação, fluxo de atendimentos e integração com CRM.",
            "relevance" => 9,
            "area_atuacao" => "Corretor de Seguros",
            "area_atuacao_slug" => "corretor-de-seguros",
            "badges" => [],
            "feedback" => null
        ]);

        PortfolioItem::create([
            "name" => "administradora",
            "url" => "https://vdadministradora.com.br/",
            "title" => "Vd Administradora | Administradora de Condomínio & Clube Camping",
            "about" => "Site one-page, com um tema mais claro e um design mais limpo que reforça o ônus da adminitração: a clareza de processos e a diminuição de riscos e burocracias. A estética clara e o design minimalista reforçam a percepção de uma gestão organizada e acessível.",
            "relevance" => 7,
            "area_atuacao" => "Administração Imobiliária",
            "area_atuacao_slug" => "administracao-imobiliaria",
            "badges" => [],
            "feedback" => null
        ]);
    }
}
