<?php 
	$pageTitle = "Home";
 ?>



<?php $__env->startSection('content'); ?>
	<div class="row">
	    <div class="col-md-8 col-md-offset-2">
	        <h1 class="text-center">
	            Welcome To Our Homepage
	        </h1>
	    </div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>