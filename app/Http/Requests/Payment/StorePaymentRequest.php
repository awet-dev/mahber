<?php

namespace App\Http\Requests\Payment;

use Cknow\Money\Rules\Money;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // todo check if the user has right to do this action
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'amount_paid' => ['required', new Money('EUR')],
            'amount_left' => ['sometimes', new Money('EUR')],
            'amount_back' => ['sometimes', new Money('EUR')],
        ];
    }
}
