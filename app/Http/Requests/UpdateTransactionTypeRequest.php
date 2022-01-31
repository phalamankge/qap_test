<?php

namespace App\Http\Requests;

use App\Models\TransactionType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:3',
                'max:25',
                'required',
                'unique:transaction_types,name,' . request()->route('transaction_type')->id,
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
