@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.transactionType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaction-types.update", [$transactionType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.transactionType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $transactionType->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transactionType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="credit_account">{{ trans('cruds.transactionType.fields.credit_account') }}</label>
                <input class="form-control {{ $errors->has('credit_account') ? 'is-invalid' : '' }}" type="text" name="credit_account" id="credit_account" value="{{ old('credit_account', $transactionType->credit_account) }}" required>
                @if($errors->has('credit_account'))
                    <span class="text-danger">{{ $errors->first('credit_account') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transactionType.fields.credit_account_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="debit_account">{{ trans('cruds.transactionType.fields.debit_account') }}</label>
                <input class="form-control {{ $errors->has('debit_account') ? 'is-invalid' : '' }}" type="text" name="debit_account" id="debit_account" value="{{ old('debit_account', $transactionType->debit_account) }}" required>
                @if($errors->has('debit_account'))
                    <span class="text-danger">{{ $errors->first('debit_account') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transactionType.fields.debit_account_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection