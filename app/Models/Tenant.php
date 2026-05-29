<?php

namespace App\Models;

use App\Enums\TenantStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'contact_email',
        'status'
    ];

    protected $casts = [
        'status' => TenantStatus::class,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tenants_users')
            ->using(TenantUser::class)
            ->withPivot('role', 'entered_at', 'left_at');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'tenant_id');
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d/m/Y H:i:s'),
        );
    }

    public function getStatusFormatedAttribute()
    {
        return $this->status->name();
    }
}
