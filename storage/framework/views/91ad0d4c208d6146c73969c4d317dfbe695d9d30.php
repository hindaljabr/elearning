<?php 
	$pageTitle = "Rooms";
 ?>



<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center"><strong>Available Rooms</strong></h1>
			<br />
		</div>
	</div>

	<div class="row">
	    <div class="col-md-12">
	       <?php if( $allrooms->count() ): ?>
	       		
	       		<?php $__currentLoopData = $allrooms->chunk( 3 ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	       			<div class="row">
	       				
	       				<?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	       					<div class="col-lg-4">
	       						<div class="panel panel-info">
	       							<div class="panel-body">
	       								<h2 class="text-center"><strong><?php echo e($room->name); ?></strong></h2>
	       								<hr />
	       								<p><?php echo e(str_limit($room->description, 100 )); ?></p>
	       							</div>
	       							<div class="panel-footer">
	       								<div class="row">
	       									
	       									<div class="col-lg-6">
	       										<a href="<?php echo e(route('reservation.form', ['room_id' => $room->id])); ?>" class="btn btn-primary btn-block">
	       											Reserve
	       										</a>
	       									</div>
	       								</div>
	       							</div>
	       						</div>
	       					</div>
	       				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	       			</div>
	       		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	       		<div class="text-center"><?php echo e($allrooms->links()); ?></div>
	       <?php else: ?>
	       		<div class="panel panel-danger">
	       			<div class="panel-body">
	       				<div class="text-center text-danger">
	       					No record to display
	       				</div>
	       			</div>
	       		</div>
	       <?php endif; ?>
	    </div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>