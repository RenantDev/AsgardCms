@extends('layouts.master')

@section('content-header-title')
{{ $theme->getName() }} <small>{{ trans('workshop::themes.theme') }}</small>
@stop

@section('content-header')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('user::users.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.workshop.themes.index') }}">{{ trans('workshop::themes.breadcrumb.themes') }}</a></li>
        <li class="active">{{ trans('workshop::themes.viewing theme', ['theme' => $theme->getName()]) }}</li>
    </ol>
@stop

@section('styles')
    <style>
        .module-type {
            text-align: center;
        }
        .module-type span {
            display: block;
        }
        .module-type i {
            font-size: 124px;
            margin-right: 20px;
        }
        .module-type span {
            margin-left: -20px;
        }
        form {
            display: inline;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title text-right">
                    <button class="btn btn-box-tool jsPublishAssets" data-toggle="tooltip"
                            title="" data-original-title="{{ trans("workshop::modules.publish assets") }}">
                        <i class="fa fa-cloud-upload"></i>
                        {{ trans("workshop::modules.publish assets") }}
                    </button>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6 module-details">
                            <div class="module-type pull-left">
                                <i class="fa fa-picture-o"></i>
                                <span>
                                    {{ $theme->version }}
                                </span>
                            </div>
                            <h2>{{ ucfirst($theme->getName()) }}</h2>
                            <p>{{ $theme->getDescription() }}</p>
                        </div>
                        <div class="col-sm-6">
                            <dl class="dl-horizontal">
                                <dt>{{ trans('workshop::themes.type') }}:</dt>
                                <dd>{{ $theme->type }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($theme->changelog) && count($theme->changelog['versions'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title text-right clearfix">
                    <h5><i class="fa fa-bars"></i> {{ trans('workshop::modules.changelog')}}</h5>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="ibox-content">
                    @include('workshop::admin.modules.partials.changelog', [
                        'changelog' => $theme->changelog
                    ])
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
@stop

@section('scripts')
    <script>
        $( document ).ready(function() {
            $('.jsPublishAssets').on('click',function (event) {
                event.preventDefault();
                var $self = $(this);
                $self.find('i').toggleClass('fa-cloud-upload fa-refresh fa-spin');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('api.workshop.theme.publish', [$theme->getName()]) }}',
                    data: {_token: '{{ csrf_token() }}'},
                    success: function() {
                        $self.find('i').toggleClass('fa-cloud-upload fa-refresh fa-spin');
                    }
                });
            });
        });
    </script>
@stop
