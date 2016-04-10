<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        {{--<form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>--}}
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <span class="m-r-sm text-muted welcome-message">
            	<?php if (isset($sitename)): ?>
	            {{ $sitename }}
	            <?php endif; ?>
            </span>
        </li>
        <?php if (is_module_enabled('Notification')): ?>
            @include('notification::partials.notifications')
        <?php endif; ?>
        <li><a href="{{ URL::to('/') }}" target="_blank"><i class="fa fa-eye"></i> {{trans('core::core.general.view website')}}</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag"></i>
                <span>
                    {{ LaravelLocalization::getCurrentLocaleName()  }}
                    <i class="caret"></i>
                </span>
            </a>
            <ul class="dropdown-menu language-menu">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="{{ App::getLocale() == $localeCode ? 'active' : '' }}">
                        <a rel="alternate" lang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                            {!! $properties['native'] !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        
        <li>
            <a href="{{ URL::route('logout')  }}">
                <i class="fa fa-sign-out"></i> {{trans('core::core.general.sign out')}}
            </a>
        </li>
    </ul>

</nav>