@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.transactionType.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.transaction-types.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.transactionType.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transactionType.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="credit_account">{{ trans('cruds.transactionType.fields.credit_account') }}</label>
                            <input class="form-control" type="text" name="credit_account" id="credit_account" value="{{ old('credit_account', '') }}" required>
                            @if($errors->has('credit_account'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('credit_account') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transactionType.fields.credit_account_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="debit_account">{{ trans('cruds.transactionType.fields.debit_account') }}</label>
                            <input class="form-control" type="text" name="debit_account" id="debit_account" value="{{ old('debit_account', '') }}" required>
                            @if($errors->has('debit_account'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('debit_account') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection