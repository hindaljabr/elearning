@php
	use Carbon\Carbon;
	use App\Model\Reservation;

	$pageTitle = "My Reservations";

	$carbonInst = new Carbon;
@endphp

@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center"><strong>{{ $pageTitle }}</strong></h1>
			<br />
		</div>
		@if( $reservations->count() )
			<div class="col-lg-4 col-lg-offset-8">
				<form action="" method="GET" id="filterForm">
					<select name="status" id="status" class="form-control" required="required" onchange="event.preventDefault();document.getElementById('filterForm').submit()">
						<option value="">:: Select Status ::</option>
						<option @if( ! empty( $_GET['status'] ) AND $_GET['status'] == Reservation::PENDING ) selected="selected" @endif selected="selected"  value="{{ Reservation::PENDING }}">{{ Reservation::PENDING }}</option>
						<option @if( ! empty( $_GET['status'] ) AND $_GET['status'] == Reservation::APPROVED ) selected="selected" @endif value="{{ Reservation::APPROVED }}">{{ Reservation::APPROVED }}</option>
						<option @if( ! empty( $_GET['status'] ) AND $_GET['status'] == Reservation::REJECTED ) selected="selected" @endif value="{{ Reservation::REJECTED }}">{{ Reservation::REJECTED }}</option>
					</select>
				</form>
			</div>
		@endif
	</div>

	<div class="row" style="margin-top: 10px;">
		<div class="col-lg-12">
			@if( $reservations->count() )
				<div class="table-responsive">
					<table class="table table-responsive table-hover table-bordered">
						<thead>
							<tr>
								<th style="width: 6%;">ID</th><th style="width: 9%;">Status</th><th style="width: 15%;">User</th><th>Room</th>
								<th>Description</th><th>Notes</th><th style="width: 12%;">Date</th><th style="width: 10%;">Hours</th>
								<th style="width: 15%;"></th>
							</tr>
						</thead>
						<tbody>
							@foreach( $reservations as $r )
								<tr @if( $r->status == App\Model\Reservation::REJECTED ) class="bg-danger" @endif>
									<td>{{ sprintf("%05d", $r->id) }}</td>
									<td>{{ $r->status }}</td>
									<td>{{ $r->user->firstname.' '.$r->user->lastname }}</td>
									<td>{{ $r->room->name }}</td>
									<td>{{ $r->description }}</td>
									<td>{{ $r->notes }}</td>
									<td>{{ $r->date->toFormattedDateString() }}</td>
									<td>
										@php
											$hours = explode(',', $r->hours);
										@endphp
										@foreach( $hours as $h )
											<span class="label label-default">
												{{ $carbonInst->hour( ( int ) $h )->format('g A') }}
											</span> &nbsp;
										@endforeach
									</td>
									<td>
										@if( $r->status == App\Model\Reservation::PENDING )
											<a href="{{ route('reservation.edit', ['reservation_id' => $r->id]) }}" class="btn btn-success btn-xs" title="Edit">
												<i class="glyphicon glyphicon-check"></i> Edit
											</a> &nbsp;
											<a href="{{ route('reservation.cancel', ['reservation_id' => $r->id]) }}" class="btn btn-danger btn-xs" title="Cancel">
												<i class="glyphicon glyphicon-ban-circle"></i> Cancel
											</a>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-center">
						{{ $reservations->links() }}
					</div>
				</div>
			@else
				<div class="panel panel-danger">
					<div class="panel-body">
						<div class="text-center">No record to display</div>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection
