<?php

namespace Core;

use Core\Gateways\AsaasGateway;
use Core\Gateways\CieloGateway;

class GatewayService
{
    public array $gateway = [];

    public function __construct()
    {
        $this->gateway = [
            new CieloGateway(),
            new AsaasGateway()
        ];
    }

    public function process(array $data): array
    {
        foreach ($this->gateway as $gateway)
        {
            try {
                return $gateway->processPayment($data);
            } catch (\Throwable $th) {
                continue;
            }
        }

        throw new \Exception("Nenhum gateway conseguiu processar o pagamento.");
    }
}
