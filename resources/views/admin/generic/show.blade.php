@extends('layouts.admin')
@section('content')

<!-- Modal -->
<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <p id="myMessage">Hey there</p>
      <form id="formButton" action='' method='POST'>
			@csrf
			<input id="_method" name="_method" value="" type="hidden" />
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-danger">{{ trans("global.yes") }}</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ trans("global.no") }}</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="card">
    <div class="card-header">
        {{ $title ?? '' }}
       <!-- {{ trans('global.show') }} {{ trans('cruds.product.title') }}-->
    </div>
    <div class="card-body">
        <div class="form-group">
            @if(!empty($buttons))
                <div class="text-right">
                    <div class="btn-group mb-2"  role="group" aria-label="Basic example">
                        @foreach ($buttons as $button)
                            @if(empty($button['method']))
                                <a class="{{ $button['class'] }}"  href="{{ $button['href'] }}">
                                    <i class="{{ $button['icon'] }}"></i> {{ $button['label'] }}
                                </a>
                            @else
                                <a class="{{ $button['class'] }} btnForm"  data-action="{{ $button['href'] }}" data-method="{{ $button['method'] }}" data-confirm="{{ $button['confirm'] }}" data-title="{{ $button['title'] }}">
                                    <i class="{{ $button['icon'] }}"></i> {{ $button['label'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="row">
                @foreach($fields as $field)
                    <div class = "col-md-3">
                            {{ $field['label'] ?? ''}}
                    </div>
                    <div class = "col-md-3">
                            {{ $field['value'] }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>

function btnFormClick(e)
{
    e.preventDefault();

    var href = $(this).data("action");
    var method = $(this).data("method");
    var message = $(this).data("confirm");
    var title = $(this).data("title");

    //alert("Hi " + href + " , " + method + " , " + message + " , " + title); 

    $("#formButton").attr("action", href);
    $("#_method").val(method);
    $('#myMessage').html(message);
	$('#staticBackdropLabel').html(title);

    if(message)
        $("#myModal").modal("show");
    else
        $("#formButton").submit();
}

$(document).ready(function() {
	$(".btnForm").click(btnFormClick);
});

</script>

@endsection