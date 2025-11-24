<?php

namespace Tests\Feature;

use App\Models\User;
use Core\GatewayService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Mockery;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_process_payment_success()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        // Mock do GatewayService
        $mock = Mockery::mock(GatewayService::class);
        $mock->shouldReceive('process')
             ->once()
             ->andReturn([
                'status' => true,
                'message' => 'Pagamento aprovado',
                'transaction_id' => 'ABC123'
             ]);

        $this->app->instance(GatewayService::class, $mock);

        $payload = [
            'name'       => 'John Doe',
            'number'     => '4242424242424242',
            'due_date'   => '10/2030',
            'cvv'        => '123',
            'installment'=> 1,
            'amount'     => '100.00',
        ];

        $response = $this->postJson('/api/v1/payment', $payload);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Pagamento aprovado'
            ]);
    }


    public function test_process_payment_invalided()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        // Enviando payload vazio
        $response = $this->postJson('/api/v1/payment', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'amount',
                'installment',
                'number',
                'due_date',
                'cvv',
            ]);
    }
}
