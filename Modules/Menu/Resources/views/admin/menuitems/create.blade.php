@extends('layouts.master')

@section('content-header-title')
{{ trans('menu::menu.titles.create menu item') }}
@stop

@section('styles')
@stop

@section('content')
{!! Form::open(['route' => ['dashboard.menuitem.store', $menu->id], 'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12">
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
                                    @include('menu::admin.menuitems.partials.create-trans-fields', ['lang' => $locale])
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
                @include('menu::admin.menuitems.partials.create-fields')

                <div class="hr-line-dashed"></div>

                <div>
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.menu.menu.edit', [$menu->id])}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index', ['name' => 'menu']) }}</dd>
    </dl>
@stop

@section('scripts')
<script>
$( document ).ready(function() {
    $(document).keypressAction({
        actions: [
            { key: 'b', route: "<?= route('admin.menu.menu.edit', [$menu->id]) ?>" }
        ]
    });
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
});
</script>
@stop
