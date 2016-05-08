@extends('layout.master')

@section('content')
<h1>{{$title}}</h1>
<a class="btn btn-primary pull-right" href="/album/add">Add Album</a>

<!--<table class="table">
	<thead>
		<tr>
			<th>
				Name
			</th>
			<th>
				Album
			</th>
			<th>
				Artist
			</th>
			<th>
				Length
			</th>
			<th>
				Date Added
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
			@if(!empty($name))
				{{ $name }}
				@endif
			</td>
		</tr>
	</tbody>
</table>-->

@if(!empty($data))
<ul class="list-group">
	@foreach ($data as $item)
		<li class="list-group-item">
			@if ($type == "artist")
			   <a href="/artists/{{$item->id}}">
			   		<h2>{{$item->name}} </h2>
			   </a>
			@endif

			@if ($type == "album")
			   <a href="/albums/{{$item->id}}">
			   		<h2>{{$item->title}} <small>{{ $item->artist->name}}</small></h2>
			   </a>
			@endif
	   </li>
	@endforeach
</ul>
@endif

@stop