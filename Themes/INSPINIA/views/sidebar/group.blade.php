{{--@if($group->shouldShowHeading())
    <li>
    	<a href="#">{{ $group->getName() }}</a>
    </li>
@endif--}}

@foreach($items as $item)
    {!! $item !!}
@endforeach
