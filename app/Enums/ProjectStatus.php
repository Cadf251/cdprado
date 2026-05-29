<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case ACTIVE = 'active';
    case ARCHIVED = 'archived';

    public function label()
    {
        return match ($this) {
            self::ACTIVE => "Ativo",
            self::ARCHIVED => "Arquivado" 
        };
    }

    public function color()
    {
        return match ($this) {
            self::ACTIVE => "green",
            self::ARCHIVED => "gray" 
        };
    }
}