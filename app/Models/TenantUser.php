<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TenantUser extends Pivot
{
    protected $table = 'tenants_users';

    protected $casts = [
        'role' => UserRole::class, // O Laravel converte a string do banco no Enum
        'entered_at' => 'datetime',
        'left_at' => 'datetime',
    ];
}
