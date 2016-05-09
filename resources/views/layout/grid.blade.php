@extends('layout.master')

@section('content')
<h1>{{$title}}</h1>

@if(!empty($data))
<div class="row item-list">
	@foreach ($data as $item)
		<div class="col-md-4">
			<div class="item">
				 <a href="/{{$type}}s/{{$item->id}}">
					@if ($type == "artist")
							<img src="{{$item->picture or "https://placehold.it/150x150"}}">
					   		<h2>{{$item->name}} </h2>
					@endif
					@if ($type == "album")
							<img src="{{$item->cover or "https://placehold.it/65x65"}}">
					   		<h2>{{$item->title}}</h2>
					   		<h3>{{ $item->artist->name}}</h3>
					@endif
				</a>
			</div>
	   </div>
	@endforeach
</ul>
@endif

@stop