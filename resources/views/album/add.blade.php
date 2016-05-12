@extends('layout.master')

@section('content')
<h1>Add Album</h1>

<div class="row">
<form method="POST" action="/album/add" class="add-form col-md-4" >
	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	{{ csrf_field() }}
	<div class="form-group">
		<label for="title">Album Title</label>
		<input id="title" class="form-control" type="text" name="title"/>
	</div>

	<div class="form-group">
		<label for="artist">Artist</label>
		<input id="artist" class="form-control" type="text" name="artist"/>
	</div>

	<div class="form-group">
		<label for="type">Type</label>
		<select id="type" class="form-control" name="type">
			<option value="LP">LP</option>
			<option value="EP" >EP</option>
			<option value="Single">Single</option>
		</select>
	</div>

	<div class="form-group">
		<label for="format">Format</label>
		<select id="format" class="form-control" name="format">
			<option value="Vinyl">Vinyl</option>
			<option value="CD">CD</option>
		</select>
	</div>

	<button type="submit" class="btn btn-primary pull-right">Add Album</button>
</form>
</div>

@stop