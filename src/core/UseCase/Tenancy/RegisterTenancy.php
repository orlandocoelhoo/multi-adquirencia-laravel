<?php
namespace Core\UseCase\Tenancy;

use App\Models\Tenant;
use Core\Enums\Status;

class RegisterTenancy
{
    public static function execute(string $name, Status $status): Tenant
    {
        $tenant = Tenant::create([
            'name' => $name,
            'status' => $status
        ]);

        return $tenant;
    }
}
