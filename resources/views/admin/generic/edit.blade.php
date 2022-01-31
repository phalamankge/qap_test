@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <i class="{{ $icon ?? '' }}"></i>&nbsp;{{ $title ?? '' }} 
    </div>
    <div class="card-body">
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @method($method ?? 'PUT')
        @csrf
        <div class="row">
        @foreach ($fields as $field)
            <div class="col-md-{{ $field['columns'] ?? '3' }}">
                
                    <div class="form-group">
                        <label @if ($field['required']) class="required" @endif for="{{ $field['name'] ?? ''}}">{{ $field['label'] ?? ''}}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="{{ $field['name'] ?? ''}}" id="{{ $field['name'] ?? ''}}" value="{{ $field['value'] }}" @if ($field['required']) required @endif>
                    </div>
                
                @if($errors->has($field['name']))
                    <div class="invalid-feedback">
                        {{ $errors->first($field['name']) }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.'.Str::singular($field['name']).'_helper') }}</span>
            </div>
        @endforeach
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="form-group">
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
            <a class="btn btn-secondary" href="{{ url()->previous() }}">{{ trans('global.back') }}</a>
        </div>
    </div>
    </form>
</div>



@endsection