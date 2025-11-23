<?php

namespace Core\Gateways;

use App\Rest\AsaasRestClient;
use Core\Interfaces\PaymentGatewayInterface;
use Core\UseCase\SavePayment;

class AsaasGateway implements PaymentGatewayInterface
{
    public function processPayment(array $paymentData): array
    {
        // Simulação de processamento de pagamento com Asaas
        $asaasResponse = new AsaasRestClient();
        $response = $asaasResponse->createPayment($paymentData);

        $save = $this->save([
            'name' => $paymentData['name'],
            'amount' => $paymentData['amount'],
            'installment' => $paymentData['installment'],
            'dueDate' => $paymentData['due_date'],
            'status' => $response['status'],
            'rawResponse' => $response,
        ]);

        return ['gateway' => 'Asaas', 'status' => $save];
    }

    public function save($data): bool
    {
        SavePayment::execute(
            'Asaas',
            $data['name'],
            $data['amount'],
            $data['installment'],
            $data['dueDate'],
            $data['status'],
            json_encode($data['rawResponse'])
        );

        return true;
    }
}
