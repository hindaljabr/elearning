@php
	use Carbon\Carbon;

	$pageTitle = "Adding Room Form";

	$carbonInst = new Carbon;
@endphp

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Room</div>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('addRoom_form.form') }}">
                        {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Room name </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Room description </label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('Capacity') ? ' has-error' : '' }}">
                                <label for="Capacity" class="col-md-4 control-label">Room Capacity </label>

                                <div class="col-md-6">
                                    <input id="Capacity" type="text" class="form-control" name="Capacity" value="{{ old('Capacity') }}" required autofocus>

                                    @if ($errors->has('Capacity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Capacity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                             Room image <input type="file" name="image">
                                 </div>
                                    </div>

                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
