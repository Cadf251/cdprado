<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $diferenciais = [
            [
                "icon" => "gauge-high",
                "title" => "Rápido: Carregamento em Segundos",
                "content" => "Seu site carrega em menos de 2 segundos. Isso significa que seus clientes não esperam e você não perde vendas por lentidão."
            ],
            [
                "icon" => "lock",
                "title" => "Seguro: Protegido e Sem Surpresas",
                "content" => 'Construído para ser robusto e seguro, seu site estará protegido contra invasões e problemas, sem precisar de atualizações constantes que podem gerar custos ou quebras.'
            ],
            [
                "icon" => "sitemap",
                "title" => "Edição de conteúdo",
                "content" => "Disponibilizo um painel de edição de conteúdos internos, eliminando a necessidade indesejada de manutenção constante para editar coisas simples, como “editar um parágrafo”."
            ],
            [
                "icon" => "filter",
                "title" => "Converte Mais Clientes",
                "content" => "Um site bonito sem uma estratégia de escrita não vende. Unimos design de com uma narrativa desenhada para transformar o visitante em um lead qualificado."
            ]
        ];

        $extras = [
            [
                "icon" => "bot.webp",
                "bg" => "chat.webp",
                "title" => "Agente de IA",
                "description" => "Para atender clientes com chats personalizados."
            ],
            [
                "icon" => "gb.webp",
                "bg" => "google.avif",
                "title" => "Google meu Negócio",
                "description" => "Configuração completa para estar presente no Google."
            ],
            [
                "icon" => "blog.webp",
                "bg" => "blog-pic.webp",
                "title" => "Blog",
                "description" => "Para postagem de conteúdo relevante e geração de cliques orgânicos."
            ],
            [
                "icon" => "database.webp",
                "bg" => "database-pic.webp",
                "title" => "Banco de dados",
                "description" => "Armazena dados de leads, clientes, e qualquer dado útil."
            ],
            [
                "icon" => "bullseye.webp",
                "bg" => "crm.webp",
                "title" => "Integração CRMs",
                "description" => "Integração com qualquer CRM que ofereça suporte a requisições externas."
            ],
            [
                "icon" => "chart.webp",
                "bg" => "analytics.webp",
                "title" => "Integração Ferramentas de Marketing",
                "description" => "Google Analytics, Google Tag Manager, etc."
            ],
            [
                "icon" => "paper-plane.webp",
                "bg" => "whats.webp",
                "title" => "WhatsApp API",
                "description" => "Disparos de mensagens para uma lista de contatos."
            ],
            [
                "icon" => "envelope.webp",
                "bg" => "mailing.avif",
                "title" => "Emails personalizados",
                "description" => "Criação de e-mails profissionais + disparos para uma lista de contatos."
            ],
            [
                "icon" => "tools.webp",
                "bg" => "tools.webp",
                "title" => "Ferramentas, painéis e dashboards",
                "description" => "Implementação de painéis e softwares sob demanda"
            ]
        ];

        $garantias = [
            [
                "icon" => "drive",
                "title" => "Google Drive",
                "description" => "Backup de relatórios, modelos, testes de responsividade, manual de uso, documentos e criativos."
            ],
            [
                "icon" => "github",
                "title" => "Para desenvolvedores",
                "description" => "Backup do código fonte no GitHub para desenvolvedores, para que o site seja um ativo editável por qualquer profissional capacitado."
            ],
            [
                "icon" => "pagespeed",
                "title" => "Relatórios de performance",
                "description" => "Não só entregamos um site de alta performance, nós comprovamos o resultado com um teste de performance e anexando um relatório no projeto."
            ]
        ];

        $faq = [
            [
                "pergunta" => "Qual é o método de pagamento?",
                "resposta" => "O pagamento pode ser realizado via pix.",
            ],
            [
                "pergunta" => "Posso parcelar?",
                "resposta" => "Sim, é possível parcelar em até 3x no pix.",
            ],
            [
                "pergunta" => "E se eu não gostar do resultado?",
                "resposta" => "Nunca pulamos a etapa de aprovação de layout, portanto, só avançamos no desenvolvimento com a sua aprovação do layout, alterando até ficar bom para o seu gosto."
            ],
            [
                "pergunta" => "E se o site parar de funcionar",
                "resposta" => "Qualquer problema técnico em relação ao site deve ser tratado com contato direto conosco."
            ]
        ];

        $portfolioItems = PortfolioItem::mostRelevant()->get();

        return view('guest.home', compact('diferenciais', 'extras', 'garantias', 'faq', 'portfolioItems'));
    }
}
