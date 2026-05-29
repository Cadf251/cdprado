<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use App\Enums\ProjectSyncStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'name',
        'url',
        'api_token',
        'payload',
        'sync_entry_point',
        'sync_status',
        'last_sync_at',
        'status',
        'tenant_id'
    ];

    protected $casts = [
        'status' => ProjectStatus::class,
        'sync_status' => ProjectSyncStatus::class

    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(ProjectContent::class);
    }

    protected static function booted()
    {
        static::creating(function ($project) {
            // Cria um token se ele não existir
            $project->api_token = $project->api_token ?? Str::random(32);

            // Garante que o status seja ativo
            $project->status = $project->status ?? ProjectStatus::ACTIVE;
        });
    }
}
