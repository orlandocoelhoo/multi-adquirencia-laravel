<?php
namespace Core\UseCase\Users;

use App\Models\User;

class RegisterUser
{
    public static function execute(string $name, int $tenantId, string $email, string $password): User
    {
        $user = User::create([
            'name' => $name,
            'tenant_id' => $tenantId,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        return $user;
    }
}
