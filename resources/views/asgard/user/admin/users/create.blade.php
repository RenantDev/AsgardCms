@extends('layouts.master')

@section('content-header-title', trans('user::users.title.new-user') )

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('user::users.navigation.back to index') }}</dd>
    </dl>
@stop
@section('content')

{!! Form::open(['route' => 'admin.user.user.store', 'method' => 'post']) !!}
<div class="row">
    <div class="col-xs-12">

        <div class="ibox float-e-margins">
            <div class="ibox-content">

                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab">{{ trans('user::users.tabs.data') }}</a></li>
                        <li class=""><a href="#tab_2-2" data-toggle="tab">{{ trans('user::users.tabs.roles') }}</a></li>
                        <li class=""><a href="#tab_3-3" data-toggle="tab">{{ trans('user::users.tabs.permissions') }}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                            {!! Form::label('first_name', trans('user::users.form.first-name')) !!}
                                            {!! Form::text('first_name', Input::old('first_name'), ['class' => 'form-control', 'placeholder' => trans('user::users.form.first-name')]) !!}
                                            {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                            {!! Form::label('last_name', trans('user::users.form.last-name')) !!}
                                            {!! Form::text('last_name', Input::old('last_name'), ['class' => 'form-control', 'placeholder' => trans('user::users.form.last-name')]) !!}
                                            {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            {!! Form::label('email', trans('user::users.form.email')) !!}
                                            {!! Form::email('email', Input::old('email'), ['class' => 'form-control', 'placeholder' => trans('user::users.form.email')]) !!}
                                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            {!! Form::label('password', trans('user::users.form.password')) !!}
                                            {!! Form::password('password', ['class' => 'form-control']) !!}
                                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            {!! Form::label('password_confirmation', trans('user::users.form.password-confirmation')) !!}
                                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2-2">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('user::users.tabs.roles') }}</label>
                                            <select multiple="" class="form-control" name="roles[]">
                                                <?php foreach ($roles as $role): ?>
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3-3">
                            <div class="panel-body">
                                @include('user::admin.partials.permissions-create')
                            </div>
                        </div>

                    </div>
                </div><!-- /.tabs-container -->


                <div class="hr-line-dashed"></div>

                <div>
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('user::button.create') }}</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.user.user.index')}}"><i class="fa fa-times"></i> {{ trans('user::button.cancel') }}</a>
                </div>

            </div><!-- /.ibox-content -->

        </div><!-- /.ibox float-e-margins -->
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
        <dd>{{ trans('user::users.navigation.back to index') }}</dd>
    </dl>
@stop
@section('scripts')
<script>
$( document ).ready(function() {
    $(document).keypressAction({
        actions: [
            { key: 'b', route: "<?= route('admin.user.user.index') ?>" }
        ]
    });
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
});
</script>
@stop
