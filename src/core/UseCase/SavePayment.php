<?php

namespace Core\UseCase;

use App\Models\Payment;

class SavePayment
{
    public static function execute($gateway, $name, $amount, $installment, $dueDate, $status, $rawResponse): Payment
    {

        // Verifica se o pagamento já existe para evitar duplicatas
        $existingPayment = Payment::where('user_id', auth()->id())
            ->where('gateway', $gateway)
            ->where('name_on_card', $name)
            ->where('amount', $amount)
            ->where('installment', $installment)
            ->where('due_date', $dueDate)
            ->where('status', $status)
            ->first();

        if (!$existingPayment) {
            $payment = Payment::create([
                'user_id' => auth()->id(),
                'gateway' => $gateway,
                'name_on_card' => $name,
                'amount' => $amount,
                'installment' => $installment,
                'due_date' => $dueDate,
                'status' => $status,
                'raw_response' => $rawResponse,
            ]);
            return $payment;
        }

        return $existingPayment;
    }
}
