<div class="row top-buffer">
	<?php if( session()->has('info') ): ?>
		<div class="col-lg-8 col-lg-offset-2">
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <strong><?php echo e(session('info')); ?></strong>
			</div>
		</div>
	<?php endif; ?>

	<?php if( session()->has('success') ): ?>
		<div class="col-lg-8 col-lg-offset-2">
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <strong><?php echo e(session('success')); ?></strong>
			</div>
		</div>
	<?php endif; ?>

	<?php if( session()->has('warning') ): ?>
		<div class="col-lg-8 col-lg-offset-2">
			<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <strong><?php echo e(session('warning')); ?></strong>
			</div>
		</div>
	<?php endif; ?>

	<?php if( session()->has('error') ): ?>
		<div class="col-lg-8 col-lg-offset-2">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <strong><?php echo e(session('error')); ?></strong>
			</div>
		</div>
	<?php endif; ?>

	<?php if( session('status') ): ?>
		<div class="col-lg-8 col-lg-offset-2">
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		        <strong><?php echo e(session('status')); ?></strong>
		    </div>
		</div>
	<?php endif; ?>

	<?php if( count( $errors->all() ) > 0 ): ?>
		<div class="col-lg-8 col-lg-offset-2">
		    <div class="alert alert-danger">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		        <strong>Whoops!</strong> We detected some errors with your submitted input<br />
		        <ul style="margin-left: 0;">
		        	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        		<li><?php echo e($error); ?></li>
		        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		        </ul>
		    </div>
		</div>
	<?php endif; ?>
</div>