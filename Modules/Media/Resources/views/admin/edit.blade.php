@extends('layouts.master')

@section('content-header-title')
{{ trans('media::media.title.edit media') }} <small>{{ $file->filename }}</small>
@stop

@section('content')
{!! Form::open(['route' => ['admin.media.media.update', $file->id], 'method' => 'put']) !!}

<div class="row">
    <div class="col-xs-12">
        <div class="ibox">
            <div class="ibox-content">

                <div class="row">
                    <div class="col-md-8">
                        <div class="tabs-container">
                            @include('partials.form-tab-headers')
                            <div class="tab-content">
                                <?php $i = 0; ?>
                                <?php foreach (LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                                    <?php ++$i; ?>
                                    <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                        <div class="panel-body">
                                            @include('media::admin.partials.edit-fields', ['lang' => $locale])
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="hr-line-dashed"></div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                                    <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                                    <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.media.media.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                                </div>
                            </div>
                        </div> {{-- end nav-tabs-custom --}}
                    </div>
                    <div class="col-md-4">
                        <?php if ($file->isImage()): ?>
                            <img src="{{ $file->path }}" alt="" style="width: 100%;"/>
                        <?php else: ?>
                            <i class="fa fa-file" style="font-size: 50px;"></i>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<?php if ($file->isImage()): ?>
<div class="row">
    <div class="col-md-12">
        <h3>Thumbnails</h3>


<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Thumbnails</h5>
    </div>
    <div class="ibox-content ">

        <ul class="list-unstyled clearfix">
            <?php foreach ($thumbnails as $thumbnail): ?>
                <li style="float:left; margin-right: 10px">
                    <img src="{{ Imagy::getThumbnail($file->path, $thumbnail->name()) }}" alt=""/>
                    <p class="text-muted" style="text-align: center">{{ $thumbnail->name() }} ({{ $thumbnail->size() }})</p>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</div>
<?php endif; ?>
{!! Form::close() !!}
@stop


@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop

@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index', ['name' => 'media']) }}</dd>
    </dl>
@stop

@section('scripts')
    <script>
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.media.media.index') ?>" }
                ]
            });
        });
    </script>
@stop
