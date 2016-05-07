@extends('layout.master')

@section('content')
	<div class="row">
		<img src="http://placehold.it/260x260">
		<h1>
			@if(!empty($name))
				{{$name}}
			@endif
		</h1>
		<h2>
			@if(!empty($artist))
				{{$artist}}
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
							
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop