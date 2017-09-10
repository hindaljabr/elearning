<?php 
	$pageTitle = "Rooms";
 ?>



<?php $__env->startSection('content'); ?>

	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center"><strong>Rooms</strong></h1>
			<br />
		</div>
	</div>

	<div class="w3-content w3-display-container" style="max-width:600px">
	 <img class="mySlides" src="C:\xampp\htdocs\reservations\resources\views\Photo\Room1.jpg" style="width:100%">
	 <img class="mySlides" src="C:\xampp\htdocs\reservations\resources\views\Photo\Room2.jpg" style="width:100%">
	 <img class="mySlides" src="C:\xampp\htdocs\reservations\resources\views\Photo\Room3.jpg" style="width:100%">
	 <img class="mySlides" src="C:\xampp\htdocs\reservations\resources\views\Photo\Room4.jpg" style="width:100%">
	 <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
		 <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
		 <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
		 <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
		 <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
		 <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
			<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(4)"></span>
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
														<a href="<?php echo e(route('roomdetails', ['room_id' => $room->id])); ?>" class="btn btn-primary btn-block">
	       											Details
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