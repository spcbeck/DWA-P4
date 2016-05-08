@extends('layout.master')

@section('content')
<h1>{{$title}}</h1>

@if(!empty($data))
<ul class="list-group">
	@foreach ($data as $item)
		<li class="list-group-item">
			 <a href="/{{$type}}s/{{$item->id}}">
				@if ($type == "artist")
				   		<h2>{{$item->artist->name}} </h2>
				@endif
				@if ($type == "album")
				   		<h2>{{$item->title}} <small>{{ $item->artist->name}}</small></h2>
				@endif
			</a>
	   </li>
	@endforeach
</ul>
@endif

@stop