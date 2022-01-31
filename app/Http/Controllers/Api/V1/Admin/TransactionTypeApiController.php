<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionTypeRequest;
use App\Http\Requests\UpdateTransactionTypeRequest;
use App\Http\Resources\Admin\TransactionTypeResource;
use App\Models\TransactionType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaction_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionTypeResource(TransactionType::all());
    }

    public function store(StoreTransactionTypeRequest $request)
    {
        $transactionType = TransactionType::create($request->all());

        return (new TransactionTypeResource($transactionType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateTransactionTypeRequest $request, TransactionType $transactionType)
    {
        $transactionType->update($request->all());

        return (new TransactionTypeResource($transactionType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
