@php
	use Carbon\Carbon;
	use App\Model\Reservation;

	$pageTitle = "Manage Room";

	$carbonInst = new Carbon;
@endphp

@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center"><strong>{{ $pageTitle }}</strong></h1>
			<br />
		</div>


	<div class="row" style="margin-top: 10px;">
		<div class="col-lg-12">
			@if( $allrooms->count() )
				<div class="table-responsive">
					<table class="table table-responsive table-hover table-bordered">
						<thead>
							<tr>
								<th style="width: 6%;">Room ID</th><th style="width: 9%;">Status</th><th style="width: 15%;">Room Name</th>
								<th>Room Description</th><th>Room capacity</th> <th style="width: 15%;">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $room as $r )
								<!--<tr @if( $r->status == App\Model\Reservation::REJECTED ) class="bg-danger" @endif> -->
									<td>{{ sprintf("%05d", $r->id) }}</td>
									<td>{{ $r->status }}</td>
									<td>{{ $r->capacity }}</td>
									<td>{{ $r->room->name }}</td>
									<td>{{ $r->description }}</td>

							@endforeach
						</tbody>
					</table>
					<div class="text-center">
						{{ $room->links() }}
					</div>
				</div>
			@else
				<div class="panel panel-danger">
					<div class="panel-body">
						<div class="text-center">No Rooms to display</div>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection
