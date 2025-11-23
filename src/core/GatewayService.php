<?php

namespace Core;

use Core\Gateways\AsaasGateway;
use Core\Gateways\CieloGateway;

class GatewayService
{
    protected $gateway;

    public function __construct($gateway)
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
