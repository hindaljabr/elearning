<div class="row top-buffer">
	@if( session()->has('info') )
		<div class="col-lg-8 col-lg-offset-2">
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <strong>{{ session('info') }}</strong>
			</div>
		</div>
	@endif

	@if( session()->has('success') )
		<div class="col-lg-8 col-lg-offset-2">
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <strong>{{ session('success') }}</strong>
			</div>
		</div>
	@endif

	@if( session()->has('warning') )
		<div class="col-lg-8 col-lg-offset-2">
			<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <strong>{{ session('warning') }}</strong>
			</div>
		</div>
	@endif

	@if( session()->has('error') )
		<div class="col-lg-8 col-lg-offset-2">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <strong>{{ session('error') }}</strong>
			</div>
		</div>
	@endif

	@if ( session('status') )
		<div class="col-lg-8 col-lg-offset-2">
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		        <strong>{{ session('status') }}</strong>
		    </div>
		</div>
	@endif

	@if ( count( $errors->all() ) > 0 )
		<div class="col-lg-8 col-lg-offset-2">
		    <div class="alert alert-danger">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		        <strong>Whoops!</strong> We detected some errors with your submitted input<br />
		        <ul style="margin-left: 0;">
		        	@foreach ($errors->all() as $error)
		        		<li>{{$error}}</li>
		        	@endforeach
		        </ul>
		    </div>
		</div>
	@endif
</div>