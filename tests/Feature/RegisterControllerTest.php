<?php

namespace Tests\Feature;

use App\Models\Tenant;
use Database\Factories\TenantFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_tenancy(): void
    {
        $response = $this->post(
            '/api/v1/tenancy/register',
            [
                "name" => "Tenancy Teste",
                "status" => "active"
            ]
        );

        $response->assertStatus(201)->assertJson([
            'message' => 'Tenancy register successful!',
        ]);
    }


    public function test_register_user(): void
    {
        $tenant = Tenant::factory()->create();

        $response = $this->post(
            '/api/v1/users/register',
            [
                "name" => "João da Silva",
                "tenant_id" => $tenant->id,
                "email" => "joao@teste.com",
                "password" => "password",
                "password_confirmation" => "password"
            ]
        );

        $response->assertStatus(201)->assertJson([
            'message' => 'User register successful!',
        ]);
    }
}
