<li class="@if($active)active @endif">
    <a href="{{ $item->getUrl() }}" @if(count($appends) > 0)class="hasAppend"@endif>
        <i class="{{ $item->getIcon() }}"></i>
        <span class="nav-label">{{ $item->getName() }}</span>

        @foreach($badges as $badge)
            {!! $badge !!}
        @endforeach
		
        @if($item->hasItems())<span class="fa arrow"></span>@endif
    </a>

    @foreach($appends as $append)
        {!! $append !!}
    @endforeach

    @if(count($items) > 0)
        <ul class="nav nav-second-level collapse">
            @foreach($items as $item)
                {!! $item !!}
            @endforeach
        </ul>
    @endif
</li>
