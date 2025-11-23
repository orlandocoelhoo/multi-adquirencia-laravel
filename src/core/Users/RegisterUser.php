<?php
namespace Core\Users;

class RegisterUser
{
    public static function execute(string $name, int $tenantId, string $email, string $password)
    {
        $user = \App\Models\User::create([
            'name' => $name,
            'tenant_id' => $tenantId,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        return $user;
    }
}
