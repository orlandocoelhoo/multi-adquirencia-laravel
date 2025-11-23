<?php
namespace Core\Interfaces;

interface PaymentGatewayInterface
{
    public function processPayment(array $paymentData): array;
    public function save();
}
