@extends('layout.master')

@section('content')
<h1>{{$title}}</h1>

@if(!empty($data))
<div class="row item-list">
	@foreach ($data as $item)
		<div class="col-md-4">
			<div class="item item-{{ $type }}">
					@if ($type == "artist")
						<a href="/{{$type}}s/{{$item->id}}" style="background: url({{$item->artist->picture or "https://placehold.it/150x150"}})" class="{{$type}} artist-image">
							<div class="text-bg">
					   			<h2>{{$item->artist->name}}</h2>
					   		</div>
					   	</a>
					@endif
					@if ($type == "album")
						<a href="/{{$type}}s/{{$item->id}}" class="{{$type}}">
							<img src="{{$item->cover or "https://placehold.it/65x65"}}">
					   		<h2>{{$item->title}}</h2>
					   		<h3>{{ $item->artist->name}}</h3>
						</a>
					@endif
				</a>
			</div>
	   </div>
	@endforeach
</ul>
@endif

@stop