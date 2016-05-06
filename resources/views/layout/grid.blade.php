@extends('layout.master')

@section('content')
<h1>Title Here</h1>
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
	<li class="list-group-item">
		@if(!empty($name))
			{{ $name }}
		@endif
	</li>
</ul>

@stop