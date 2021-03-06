@extends('layouts.master')

@section('content-header-title', trans('page::pages.title.create page') )

@section('styles')
    {!! Theme::script('js/vendor/ckeditor/ckeditor.js') !!}
    <style>
        .checkbox label {
            padding-left: 0;
        }
    </style>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.page.page.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-9">
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <div class="tabs-container">
                        @include('partials.form-tab-headers', ['fields' => ['title', 'body']])
                        <div class="tab-content">
                            <?php $i = 0; ?>
                            <?php foreach (LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                            <?php ++$i; ?>
                            <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                <div class="panel-body">
                                    @include('page::admin.partials.create-fields', ['lang' => $locale])
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php if (config('asgard.page.config.partials.normal.create') !== []): ?>
                                <?php foreach (config('asgard.page.config.partials.normal.create') as $partial): ?>
                                    @include($partial)
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <div class="hr-line-dashed"></div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                                <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                                <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.page.page.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                            </div>
                        </div>
                    </div> {{-- end nav-tabs-custom --}}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="checkbox{{ $errors->has('is_home') ? ' has-error' : '' }}">
                        <label for="is_home">
                            <input id="is_home"
                                   name="is_home"
                                   type="checkbox"
                                   class="flat-blue"
                                   value="1" />
                            {{ trans('page::pages.form.is homepage') }}
                            {!! $errors->first('is_home', '<span class="help-block">:message</span>') !!}
                        </label>
                    </div>
                    <hr/>
                    <div class='form-group{{ $errors->has("template") ? ' has-error' : '' }}'>
                        {!! Form::label("template", trans('page::pages.form.template')) !!}
                        {!! Form::select("template", $all_templates, old("template", 'default'), ['class' => "form-control", 'placeholder' => trans('page::pages.form.template')]) !!}
                        {!! $errors->first("template", '<span class="help-block">:message</span>') !!}
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
        <dd>{{ trans('page::pages.navigation.back to index') }}</dd>
    </dl>
@stop

@section('scripts')
    <script type="text/javascript">
        $(function() {
            /*CKEDITOR.replaceAll(function( textarea, config ) {
                if (!$(textarea).hasClass('ckeditor')) {
                    return false;
                }
                config.language = '<?php echo App::getLocale() ?>';
            } );*/
        });
    </script>
    <script>
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.page.page.index') ?>" }
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
@stop
