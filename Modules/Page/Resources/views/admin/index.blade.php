@extends('layouts.master')

@section('content-header-title', trans('page::pages.title.pages') )

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title text-right">
                
                <a href="{{ URL::route('admin.page.page.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                    <i class="fa fa-pencil"></i> {{ trans('page::pages.button.create page') }}
                </a>

            </div>
            <div class="ibox-content">

                    <table class="data-table table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('page::pages.table.name') }}</th>
                            <th>{{ trans('page::pages.table.slug') }}</th>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($pages)): ?>
                        <?php foreach ($pages as $page): ?>
                        <tr>
                            <td>
                                <a href="{{ URL::route('admin.page.page.edit', [$page->id]) }}">
                                    {{ $page->id }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ URL::route('admin.page.page.edit', [$page->id]) }}">
                                    {{ $page->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ URL::route('admin.page.page.edit', [$page->id]) }}">
                                    {{ $page->slug }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ URL::route('admin.page.page.edit', [$page->id]) }}">
                                    {{ $page->created_at }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ URL::route('admin.page.page.edit', [$page->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                    <button data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.page.page.destroy', [$page->id]) }}" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('page::pages.table.name') }}</th>
                            <th>{{ trans('page::pages.table.slug') }}</th>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th>{{ trans('core::core.table.actions') }}</th>
                        </tr>
                        </tfoot>
                    </table>

            </div><!-- /.ibox-content -->
        </div><!-- /.ibox float-e-margins -->
    </div>
</div>

    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('page::pages.title.create page') }}</dd>
    </dl>
@stop

@section('scripts')
    <?php $locale = App::getLocale(); ?>
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.page.page.create') ?>" }
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
