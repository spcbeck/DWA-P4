@extends('layout.master')

@section('title')
    Delete Book
@stop

@section('content')
    <h1>Delete Book</h1>
    <p>Are you sure you want to remove <em>{{$album->title}}</em> from your collection?</p>
    <p><a class="btn btn-danger" href='/albums/delete/{{$album->id}}'>Remove Album</a></p>
    <p><a class="btn btn-link" href='/albums/{{$album->id}}'>Go Back</a></p>
@stop