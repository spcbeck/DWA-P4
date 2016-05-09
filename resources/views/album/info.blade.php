@extends('layout.master')

@section('content')
	<div class="row album-info">
		@if(!empty($cover_url))
		<img class="pull-left" src="{{$cover_url}}">
		@endif
		<h1>
			@if(!empty($album->title))
				{{$album->title}}
			@endif
		</h1>
		<h2>
			@if(!empty($album->artist->name))
				{{$album->artist->name}}
			@endif
		</h2>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							Name
						</th>
						<th>
							Length
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tracks as $track)
					   <tr>
					   		<td>
					   			{{$track->track_number}}
					   		</td>
							<td>
								{{$track->name}}
							</td>
							<td>
								{{$track->duration_ms}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop