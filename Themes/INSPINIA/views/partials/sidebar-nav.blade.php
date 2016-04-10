<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">

        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="{!! Theme::url('img/profile_small.jpg') !!}" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> 
                        	<span class="block m-t-xs"> 
                        		<strong class="font-bold">
                        			<?php if ($user->present()->fullname() != ' '): ?>
			                            <?= $user->present()->fullName(); ?>
			                        <?php else: ?>
			                            <em>{{trans('core::core.general.complete your profile')}}.</em>
			                        <?php endif; ?>
                        		</strong>
                         	</span> 
                         	<span class="text-muted text-xs block">User <b class="caret"></b></span> 
                         </span> 
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        {{--<li><a href="#">Profile</a></li>
                        <li class="divider"></li>--}}
                        <li><a href="{{ URL::route('logout')  }}">{{trans('core::core.general.sign out')}}</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            {!! $sidebar !!}
        </ul>

    </div>
</nav>