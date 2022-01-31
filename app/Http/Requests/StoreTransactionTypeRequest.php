<?php

namespace App\Http\Requests;

use App\Models\TransactionType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:3',
                'max:25',
                'required',
                'unique:transaction_types',
            ],
            'credit_account' => [
                'string',
                'required',
            ],
            'debit_account' => [
                'string',
                'required',
            ],
        ];
    }
}
