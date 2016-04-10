@extends('layouts.master')

@section('content-header-title', trans('setting::settings.title.module name settings', ['module' => ucfirst($currentModule)]) )

@section('content')
{!! Form::open(['route' => ['admin.setting.settings.store'], 'method' => 'post']) !!}
<div class="row">
    <div class="sidebar-nav col-sm-2">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ trans('setting::settings.title.module settings') }}</h5>
            </div><!-- /.ibox-title -->
            <div class="ibox-content" style="padding: 0px">
                <style>
                    a.active {
                        text-decoration: none;
                        background-color: #eee;
                    }
                </style>
        		<ul class="nav nav-list">
        		  <?php foreach ($modulesWithSettings as $module => $settings): ?>
                      <li>
                        <a href="{{ URL::route('dashboard.module.settings', [$module]) }}"
                           class="{{ $module == $currentModule->getLowerName() ? 'active' : '' }}">
                            {{ ucfirst($module) }}
                            <small class="label label-info pull-right">{{ count($settings) }}</small>
                        </a>
                        </li>
                  <?php endforeach; ?>
        		</ul>
            </div><!-- /.ibox-content -->
    	</div><!-- /.ibox float-e-margins -->
    </div>
    <div class="col-md-10">
        <?php if ($translatableSettings): ?>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ trans('core::core.title.translatable fields') }}</h5>
                </div><!-- /.ibox-title -->
                <div class="ibox-content">

                    <div class="tabs-container">
                        @include('partials.form-tab-headers')
                        <div class="tab-content">
                            <?php $i = 0; ?>
                            <?php foreach (LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                                <?php $i++; ?>
                                <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                    <div class="panel-body">
                                        @include('setting::admin.partials.fields', ['settings' => $translatableSettings])
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($plainSettings): ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ trans('core::core.title.non translatable fields') }}</h5>
            </div><!-- /.ibox-title -->
            <div class="ibox-content">

                @include('setting::admin.partials.fields', ['settings' => $plainSettings])
            </div>
        </div>
        <?php endif; ?>
        <div class="ibox">
            <div class="ibox-content">
                <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.setting.settings.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop

@section('scripts')
<script>
$( document ).ready(function() {
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
@stop
