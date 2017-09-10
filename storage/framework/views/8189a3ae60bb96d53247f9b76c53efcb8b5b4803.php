<?php 
	use Carbon\Carbon;

	$pageTitle = "Reservation Form";

	$carbonInst = new Carbon;
 ?>



<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center"><strong>Reservation For <?php echo e($room->name); ?></strong></h1>
			<br />
		</div>

		<div class="col-lg-6 col-lg-offset-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<form action="" method="POST" role="form">
						<?php echo e(csrf_field()); ?>

						<div class="form-group">
							<label for="date">Date</label>
							<input type="text" name="date" id="date" class="form-control datepicker" value="<?php echo e(! empty( $_GET['d'] ) ? $_GET['d'] : old('date')); ?>" placeholder="Select Date" required="required" readonly onchange="getAvailableHours( this.value )">
							<div class="text-danger"><?php echo e($errors->first('date')); ?></div>
						</div>

						<div class="form-group">
							<label for="hours">Time</label>
							
							
							<div class="btn-group" data-toggle="buttons">
								<?php $__currentLoopData = $hours_range; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<label class="btn btn-default <?php echo e(in_array( $h, $booked_hours ) || empty( $_GET['d'] ) ? '__disabled' : 'bolder'); ?>" style="margin-right: 5px; margin-bottom: 5px;">
									  <input type="checkbox" name="hours[]" value="<?php echo e($h); ?>" autocomplete="off"> 
									  <?php echo e($carbonInst->hour( ( int ) $h )->format('g A')); ?>

									</label>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
							
							<div class="text-danger"><?php echo e($errors->first('hours')); ?></div>
						</div>

						<div class="form-group">
							<label for="description">Description</label>
							<textarea name="description" id="description" placeholder="Enter description" class="form-control" rows="3" required="required"><?php echo e(old('description')); ?></textarea>
							<div class="text-danger"><?php echo e($errors->first('description')); ?></div>
						</div>

						<div class="form-group">
							<label for="notes">Notes</label>
							<input type="text" name="notes" id="notes" class="form-control" value="<?php echo e(old('notes')); ?>" placeholder="Enter notes" required="required">
							<div class="text-danger"><?php echo e($errors->first('notes')); ?></div>
						</div>
					
						<button type="submit" class="btn btn-primary">Reserve</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>