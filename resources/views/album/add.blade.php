@extends('layout.master')

@section('content')
<h1>Add Album</h1>

<form method="POST" action="/album/add" >
	{{ csrf_field() }}
	<div class="form-group">
		<label for="name">Album Name</label>
		<input id="name" type="text" />
	</div>

	<div class="form-group">
		<label for="artist">Artist</label>
		<input id="artist" type="text" />
	</div>

	<div class="form-group">
		<label for="type">Type</label>
		<select id="type">
			<option value="lp">LP</option>
			<option value="ep">EP</option>
			<option value="single">Single</option>
		</select>
	</div>

	<div class="form-group">
		<label for="format">Format</label>
		<select id="format">
			<option value="vinyl">Vinyl</option>
			<option value="cd">CD</option>
		</select>
	</div>

	<button type="submit" class="btn btn-primary">Add Album</button>
</form>

@stop