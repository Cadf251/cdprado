<?php

namespace App\Support;

/**
 * Orquestra o resultado de uma operação e serializa instruções
 * para o frontend (AJAX, Livewire ou redirect tradicional).
 */
class OperationResult
{
    private array   $messages     = [];
    private int     $status       = self::STATUS_SUCCESS;
    private bool    $reported     = false;
    private ?string $redirect     = null;
    private array   $updates      = [];
    private bool    $closeOverlay = false;

    const STATUS_SUCCESS = 3;
    const STATUS_WARNING = 2;
    const STATUS_ERROR   = 1;

    // -------------------------------------------------------------------------
    // Estado
    // -------------------------------------------------------------------------

    public function warning(string $msg): void
    {
        $this->status = self::STATUS_WARNING;
        $this->addMessage($msg);
    }

    public function failed(string $msg): void
    {
        $this->status = self::STATUS_ERROR;
        $this->addMessage($msg);
    }

    public function addMessage(string $msg): void
    {
        $this->messages[] = $msg;
    }

    public function hadFailed(): bool
    {
        return $this->status === self::STATUS_ERROR;
    }

    public function hadSucceeded(): bool
    {
        return !$this->hadFailed();
    }

    // -------------------------------------------------------------------------
    // Mensagens
    // -------------------------------------------------------------------------

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function getMessagesAsHtml(): ?string
    {
        if (empty($this->messages)) return null;
        return implode('<br>', array_map('e', $this->messages));
    }

    public function getStatusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_ERROR   => '❌ Erro!',
            self::STATUS_WARNING => 'ℹ️ Atenção!',
            default              => '✅ Sucesso!',
        };
    }

    // -------------------------------------------------------------------------
    // Instruções de UI para o frontend
    // -------------------------------------------------------------------------

    /** Substitui o conteúdo de um elemento */
    public function setUpdate(string $target, string $html): void
    {
        $this->updates[] = ['type' => 'update', 'target' => $target, 'html' => $html];
    }

    /** Acrescenta HTML dentro de um container */
    public function setAppend(string $target, string $html): void
    {
        $this->updates[] = ['type' => 'append', 'target' => $target, 'html' => $html];
    }

    /** Remove um elemento do DOM */
    public function setRemove(string $target): void
    {
        $this->updates[] = ['type' => 'remove', 'target' => $target];
    }

    /** Abre/atualiza o overlay com HTML */
    public function setOverlay(string $html): void
    {
        $this->updates[] = ['type' => 'overlay', 'html' => $html];
    }

    public function closeOverlay(): void
    {
        $this->closeOverlay = true;
    }

    public function redirect(string $to): void
    {
        $this->redirect = $to;
    }

    // -------------------------------------------------------------------------
    // Instâncias salvas (para encadear serviços)
    // -------------------------------------------------------------------------

    private array $saved = [];

    public function saveInstance(string $key, mixed $value): void
    {
        $this->saved[$key] = $value;
    }

    public function getInstance(string $key): mixed
    {
        return $this->saved[$key] ?? null;
    }

    // -------------------------------------------------------------------------
    // Serialização
    // -------------------------------------------------------------------------

    /**
     * Para respostas AJAX (fetch / axios).
     */
    public function toAjax(): array
    {
        $response = [
            'success'       => $this->hadSucceeded(),
            'redirect'      => $this->redirect,
            'close_overlay' => $this->closeOverlay,
        ];

        if (!$this->reported) {
            $response['alert']    = $this->getStatusLabel();
            $response['messages'] = $this->getMessagesAsHtml();
        }

        if (!empty($this->updates)) {
            $response['updates'] = $this->updates;
        }

        return $response;
    }

    /**
     * Para respostas de API pura (sem instruções de UI).
     */
    public function toApi(): array
    {
        return [
            'success'  => $this->hadSucceeded(),
            'messages' => $this->getMessages(),
        ];
    }

    /**
     * Reporta o alerta para a sessão Laravel (redirect tradicional).
     */
    public function report(): void
    {
        session()->flash('alert', [
            'status'   => $this->getStatusLabel(),
            'messages' => $this->getMessages(),
        ]);

        $this->reported = true;
    }

    /**
     * Helper: retorna JsonResponse pronto para o controller.
     *
     * Uso: return $result->toJsonResponse();
     */
    public function toJsonResponse(): \Illuminate\Http\JsonResponse
    {
        $httpStatus = $this->hadFailed() ? 422 : 200;
        return response()->json($this->toAjax(), $httpStatus);
    }
}
