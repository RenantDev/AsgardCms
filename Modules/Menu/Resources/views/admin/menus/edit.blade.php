@extends('layouts.master')

@section('content-header-title')
{{ trans('menu::menu.titles.edit menu') }}
@stop

@section('styles')
    <link href="{!! Module::asset('menu:css/nestable.css') !!}" rel="stylesheet" type="text/css" />
@stop

@section('content')
{!! Form::open(['route' => ['admin.menu.menu.update', $menu->id], 'method' => 'put']) !!}
<div class="row">
    <div class="col-md-6">

        <div class="ibox float-e-margins">
            <div class="ibox-title text-right">
                <a href="{{ URL::route('dashboard.menuitem.create', [$menu->id]) }}" class="btn btn-primary btn-flat">
                    <i class="fa fa-pencil"></i> {{ trans('menu::menu.button.create menu item') }}
                </a>
            </div>
            <div class="ibox-content" style="overflow: hidden;">
                {!! $menuStructure !!}
            </div>
        </div>

    </div>
    <div class="col-md-6">

        <div class="ibox float-e-margins">
            <div class="ibox-title text-right">
                <h5>{{ trans('core::core.title.translatable fields') }}</h5>
            </div>
            <div class="ibox-content">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <?php $i = 0; ?>
                        <?php foreach (LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                            <?php $i++; ?>
                            <li class="{{ App::getLocale() == $locale ? 'active' : '' }}">
                                <a href="#tab_{{ $i }}" data-toggle="tab">{{ trans('core::core.tab.'. strtolower($language['name'])) }}</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php $i = 0; ?>
                        <?php foreach (LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                            <?php $i++; ?>
                            <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                <div class="panel-body">
                                    @include('menu::admin.menus.partials.edit-trans-fields', ['lang' => $locale])
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="ibox float-e-margins">
            <div class="ibox-title text-right">
                <h5>{{ trans('core::core.title.non translatable fields') }}</h5>
            </div>
            <div class="ibox-content">
                @include('menu::admin.menus.partials.edit-fields')

                <div class="hr-line-dashed"></div>

                <div>
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.menu.menu.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('menu::menu.titles.create menu item') }}</dd>
        <dt><code>b</code></dt>
        <dd>{{ trans('menu::menu.navigation.back to index') }}</dd>
    </dl>
@stop

@section('scripts')
<script>
$( document ).ready(function() {
    $(document).keypressAction({
        actions: [
            { key: 'c', route: "<?= route('dashboard.menuitem.create', [$menu->id]) ?>" },
            { key: 'b', route: "<?= route('admin.menu.menu.index') ?>" }
        ]
    });

    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    $('input[type="checkbox"]').on('ifChecked', function(){
      $(this).parent().find('input[type=hidden]').remove();
    });

    $('input[type="checkbox"]').on('ifUnchecked', function(){
      var name = $(this).attr('name'),
          input = '<input type="hidden" name="' + name + '" value="0" />';
      $(this).parent().append(input);
    });
});
</script>
<script src="{!! Module::asset('menu:js/jquery.nestable.js') !!}"></script>
<script>
$( document ).ready(function() {
    $('.dd').nestable();
    $('.dd').on('change', function() {
        var data = $('.dd').nestable('serialize');
        $.ajax({
            type: 'POST',
            url: '{{ route('api.menuitem.update') }}',
            data: {'menu': JSON.stringify(data), '_token': '<?php echo csrf_token(); ?>'},
            dataType: 'json',
            success: function(data) {

            },
            error:function (xhr, ajaxOptions, thrownError){
            }
        });
    });
});
</script>
<script>
    $( document ).ready(function() {
        $('.jsDeleteMenuItem').on('click', function(e) {
            var self = $(this),
                menuItemId = self.data('item-id');
            $.ajax({
                type: 'POST',
                url: '{{ route('api.menuitem.delete') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    menuitem: menuItemId
                },
                success: function(data) {
                    if (! data.errors) {
                        var elem = self.closest('li');
                        elem.fadeOut()
                        setTimeout(function(){
                            elem.remove()
                        }, 300);
                    }
                }
            });
        });
    });
</script>
@stop
