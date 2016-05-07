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

<ul class="list-group">
	@foreach ($albums as $album)
		<li class="list-group-item">
		   <a href="/album/{{id}}">{{$album}}</a>
	   </li>
	@endforeach
</ul>

@stop