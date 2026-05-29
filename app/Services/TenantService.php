<?php

namespace App\Services;

use App\Enums\TenantStatus;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class TenantService
{
  public function register(string $companyName, string $masterEmail)
  {
    $tenant = Tenant::create([
      'name' => $companyName,
      'contact_email' => $masterEmail,
      'status' => TenantStatus::ACTIVE,
    ]);
  }

  public function select(int $id): bool
  {
    $user = Auth::user();

    $hasAccess = $user->tenants()->where('tenants.id', $id)->exists();

    if (!$hasAccess) {
      return false;
    }

    session(['active_tenant_id' => $id]);

    return true;
  }
}