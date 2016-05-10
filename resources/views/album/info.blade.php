@extends('layout.master')

@section('content')
	<div class="row album-info">
		@if(!empty($cover_url))
			<img class="pull-left" src="{{$cover_url}}">
		@endif
		<h1>
			@if(!empty($data->title or $data->name))
				{{$data->title or $data->name}}
			@endif
		</h1>
		<h2>
			@if(!empty($data->artist->name))
				{{$data->artist->name}}
			@endif
		</h2>
		@if($type == "artist")
		<div class="related-artists">
		<h3>Related Artists</h3>
			<ul class="list-group">
				@foreach($related_artists as $artist)
				<li class="list-group-item">
					{{ $artist->name }}
				</li>
				@endforeach
			</ul>
		</h3>
		</div>
		@endif
	</div>	
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
					@if($type == "album")
						<th>
							#
						</th>
						<th>
							Name
						</th>
						<th>
							Length
						</th>
						@endif
						@if($type == "artist")
						<th>
							Albums
						</th>
						@endif
					</tr>
				</thead>
				<tbody>
					@if($type == "album")
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
					@endif
					@if($type == "artist")
					@foreach ($tracks as $track)
					   <tr>
					   		<td>
					   			{{$track}}
					   		</td>
						</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
@stop