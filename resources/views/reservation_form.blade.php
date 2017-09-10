@php
	use Carbon\Carbon;

	$pageTitle = "Reservation Form";

	$carbonInst = new Carbon;
@endphp

@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center"><strong>Reservation For {{ $room->name }}</strong></h1>
			<br />
		</div>

		<div class="col-lg-6 col-lg-offset-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<form action="" method="POST" role="form">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="date">Date</label>
							<input type="text" name="date" id="date" class="form-control datepicker" value="{{ ! empty( $_GET['d'] ) ? $_GET['d'] : old('date') }}" placeholder="Select Date" required="required" readonly onchange="getAvailableHours( this.value )">
							<div class="text-danger">{{ $errors->first('date') }}</div>
						</div>

						<div class="form-group">
							<label for="hours">Time</label>
							{{-- Display the 24 hours available --}}
							{{-- <label class="btn btn-primary">
							  <input type="checkbox" autocomplete="off"> Checkbox 2
							</label> --}}
							<div class="btn-group" data-toggle="buttons">
								@foreach( $hours_range as $h )
									<label class="btn btn-default {{ in_array( $h, $booked_hours ) || empty( $_GET['d'] ) ? '__disabled' : 'bolder' }}" style="margin-right: 5px; margin-bottom: 5px;">
									  <input type="checkbox" name="hours[]" value="{{ $h }}" autocomplete="off">
									  {{ $carbonInst->hour( ( int ) $h )->format('g A') }}
									</label>
								@endforeach
							</div>
							{{-- <div>
								@foreach( $hours_range as $h )
									<div class="checkbox-inline">
										<label>
											<input type="checkbox" name="hours[]" value="{{ $h }}" @if( in_array( $h, $booked_hours ) ) disabled="disabled" @elseif( empty( $_GET['d'] ) ) disabled="disabled" @endif>
											{{ $carbonInst->hour( ( int ) $h )->format('g A') }}
										</label>
									</div>
								@endforeach
							</div> --}}
							<div class="text-danger">{{ $errors->first('hours') }}</div>
						</div>

						<div class="form-group">
							<label for="description">Description</label>
							<textarea name="description" id="description" placeholder="Enter description" class="form-control" rows="3" required="required">{{ old('description') }}</textarea>
							<div class="text-danger">{{ $errors->first('description') }}</div>
						</div>

						<div class="form-group">
							<label for="notes">Notes</label>
							<input type="text" name="notes" id="notes" class="form-control" value="{{ old('notes') }}" placeholder="Enter notes" required="required">
							<div class="text-danger">{{ $errors->first('notes') }}</div>
						</div>

						<button type="submit" class="btn btn-primary">Reserve</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
