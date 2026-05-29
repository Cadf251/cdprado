<?php

namespace App\Enums;

enum TenantStatus: string
{
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case PENDING = 'pending';

    // Opcional: Para usar cores no seu painel depois
    public function color(): string
    {
        return match($this) {
            self::ACTIVE => 'green',
            self::SUSPENDED => 'red',
            self::PENDING => 'yellow'
        };
    }

    public function name():string
    {
        return match($this) {
            self::ACTIVE => 'Ativo',
            self::SUSPENDED => 'Suspenso',
            self::PENDING => 'Pendente'
        };
    }
}