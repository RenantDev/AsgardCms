@extends('layouts.master')

@section('content-header-title', trans('user::roles.title.roles') )

@section('content')


<div class="row">
    <div class="col-xs-12">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                
                <div class="text-right">
                    <a href="{{ URL::route('admin.user.role.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('user::roles.button.new-role') }}
                    </a>
                </div>

            </div>
            <div class="ibox-content">


                <table class="data-table table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <th>{{ trans('user::roles.table.name') }}</th>
                            <th>{{ trans('user::users.table.created-at') }}</th>
                            <th data-sortable="false">{{ trans('user::users.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($roles)): ?>
                        <?php foreach ($roles as $role): ?>
                            <tr>
                                <td>
                                    <a href="{{ URL::route('admin.user.role.edit', [$role->id]) }}">
                                        {{ $role->id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ URL::route('admin.user.role.edit', [$role->id]) }}">
                                        {{ $role->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ URL::route('admin.user.role.edit', [$role->id]) }}">
                                        {{ $role->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.user.role.edit', [$role->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.user.role.destroy', [$role->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Id</td>
                            <th>{{ trans('user::roles.table.name') }}</th>
                            <th>{{ trans('user::users.table.created-at') }}</th>
                            <th>{{ trans('user::users.table.actions') }}</th>
                        </tr>
                    </tfoot>
                </table>


            </div>
        </div>

    <!-- /.col (MAIN) -->
    </div>
</div>


@include('core::partials.delete-modal')
@stop

@section('scripts')
<?php $locale = App::getLocale(); ?>
<script type="text/javascript">
    $( document ).ready(function() {
        $(document).keypressAction({
            actions: [
                { key: 'c', route: "<?= route('admin.user.role.create') ?>" }
            ]
        });
    });
    $(function () {
        $('.data-table').dataTable({
            "paginate": true,
            "lengthChange": true,
            "filter": true,
            "sort": true,
            "info": true,
            "autoWidth": true,
            "order": [[ 0, "desc" ]],
            "language": {
                "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
            }
        });
    });
</script>
@stop
