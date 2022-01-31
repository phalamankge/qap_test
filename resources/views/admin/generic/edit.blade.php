@extends('layouts.admin')
@section('content')

<div class="card">
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @method($method ?? 'PUT')
    @csrf
        <div class="card-header">
            <div class="card-header" >
                <i class="{{ $icon ?? '' }}"></i>  {{ $title ?? '' }}
            </div>

            <div class="card-body">
                <div class="row">
                    @foreach($fields as $field)
                        <div class="col-md-{{ $field['columns'] ?? '3' }} form-group">
                            <label @if($field['required']) class='required' @endif for="{{ $field['label'] ?? ' ' }}">{{ $field['label'] ?? ' ' }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="{{ $field['type'] ?? ' ' }}"
                                   name="name" id="name" value="{{ $field['value'] ?? ' ' }}" @if($field['required']) required @endif>
                        </div>
                        @if($errors->has($field['name']))
                            <div class="invalid-feedback">
                                {{ $errors->first($field['name']) }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans("cruds.product.fields.".Str::singular($field['name'])."_helper") }}</span>
                    @endforeach
                </div>
            </div>

            <div class="card-footer">
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                    <a class="btn btn-info" href="{{ url()->previous() }}">
                        {{ trans('global.back') }}
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.products.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($product) && $product->photo)
                var file = {!! json_encode($product->photo) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
