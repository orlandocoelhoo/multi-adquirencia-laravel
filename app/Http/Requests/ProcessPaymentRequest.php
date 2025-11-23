<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'amount' => 'required|decimal:2',
            'installment' => 'required|integer|min:1',
            'number' => 'required|string|min:16|max:16',
            'due_date' => 'required|date_format:m/Y',
            'cvv' => 'required|string|min:3|max:4',
        ];
    }
}
