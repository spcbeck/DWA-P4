@extends('layout.master')

@section('content')
<h1>Edit Album</h1>

<div class="row">
<form method="POST" action="/album/edit" class="add-form col-md-4" >
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
	<input type="hidden" name="id" value="{{$album->id}}"/>
	<div class="form-group">
		<label for="title">Album Title</label>
		<input id="title" class="form-control" type="text" name="title" value="{{$album->title}}"/>
	</div>

	<div class="form-group">
		<label for="artist">Artist</label>
		<input id="artist" class="form-control" type="text" name="artist" value="{{$album->artist->name}}"/>
	</div>

	<div class="form-group">
		<label for="type">Type</label>
		<select id="type" class="form-control" name="type">
			<option value="LP" {{$album->type == "LP" ? "selected" : ""}}>LP</option>
			<option value="EP" {{$album->type == "EP" ? "selected" : ""}}>EP</option>
			<option value="Single" {{$album->type == "Single" ? "selected" : ""}}>Single</option>
		</select>
	</div>

	<div class="form-group">
		<label for="format">Format</label>
		<select id="format" class="form-control" name="format">
			<option value="Vinyl" {{$album->format == "Vinyl" ? "selected" : ""}}>Vinyl</option>
			<option value="CD" {{$album->format == "CD" ? "selected" : ""}}>CD</option>
		</select>
	</div>

	<button type="submit" class="btn btn-primary pull-right">Save Edits</button>
</form>
</div>

@stop