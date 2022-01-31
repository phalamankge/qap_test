@extends('layouts.admin')
@section('content')
@can('transaction_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transaction-types.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transactionType.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transactionType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TransactionType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.transactionType.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionType.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionType.fields.credit_account') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionType.fields.debit_account') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactionTypes as $key => $transactionType)
                        <tr data-entry-id="{{ $transactionType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $transactionType->id ?? '' }}
                            </td>
                            <td>
                                {{ $transactionType->name ?? '' }}
                            </td>
                            <td>
                                {{ $transactionType->credit_account ?? '' }}
                            </td>
                            <td>
                                {{ $transactionType->debit_account ?? '' }}
                            </td>
                            <td>

                                @can('transaction_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.transaction-types.edit', $transactionType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan


                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-TransactionType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection