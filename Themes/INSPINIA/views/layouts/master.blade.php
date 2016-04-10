<!DOCTYPE html>
<html>

<head>
    <base src="{{ URL::asset('/') }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @section('title')
        {{ Setting::get('core::site-name') }} | Admin
        @show
    </title>

    @foreach($cssFiles as $css)
        <link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset($css) }}">
    @endforeach

    {!! Theme::style('css/bootstrap.min.css') !!}
    {!! Theme::style('vendor/components-font-awesome/css/font-awesome.min.css') !!}

    {!! Theme::style('vendor/alertify/build/css/alertify.min.css') !!}
    {!! Theme::style('vendor/alertify/build/css/themes/default.min.css') !!}

    {!! Theme::style('css/animate.css') !!}
    {!! Theme::style('css/style.css') !!}

    {!! Theme::style('css/asgard.css') !!}

    {!! Theme::script('vendor/jquery/dist/jquery.min.js') !!}
    @include('partials.asgard-globals')

    @section('styles')
    @show

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body class="{{ config('asgard.core.core.skin') }}">

    <div id="wrapper">

	@include('partials.sidebar-nav')

        <div id="page-wrapper" class="gray-bg">
	        <div class="row border-bottom">
	        	@include('partials.top-nav')
	        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
            	{{--@yield('content-header')--}}
                <div class="col-lg-10">
                    <h2>@yield('content-header-title')</h2>
                    {!! \Breadcrumbs::render() !!}
                </div>
                <div class="col-lg-2">

                </div>

            </div>

            <div class="wrapper wrapper-content">
            	@include('flash::message')
                @yield('content')
            </div>
            @include('partials.footer')

        </div>
        </div>

    @foreach($jsFiles as $js)
	    <script src="{{ URL::asset($js) }}" type="text/javascript"></script>
	@endforeach

    <!-- Mainly scripts -->
    {!! Theme::script('js/bootstrap.min.js') !!}
    {!! Theme::script('js/plugins/metisMenu/jquery.metisMenu.js') !!}
    {!! Theme::script('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}

    {!! Theme::script('vendor/alertify/build/alertify.min.js') !!}
    {!! Theme::script('js/mousetrap.min.js') !!}
    {!! Theme::script('js/jquery.slug.js') !!}

    <!-- Custom and plugin javascript -->
    {!! Theme::script('js/inspinia.js') !!}
	
	<?php if (is_module_enabled('Notification')): ?>
	    <script src="https://js.pusher.com/3.0/pusher.min.js"></script>
	    <script src="{{ Module::asset('notification:js/pusherNotifications.js') }}"></script>
	    <script>
	        $(".notifications-list").pusherNotifications({
	            pusherKey: '{{ env('PUSHER_KEY') }}',
	            loggedInUserId: {{ $currentUser->id }}
	        });
	    </script>
	<?php endif; ?>

	@section('scripts')
	@show

</body>

</html>