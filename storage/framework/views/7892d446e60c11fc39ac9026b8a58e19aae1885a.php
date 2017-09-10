<?php 
	use Carbon\Carbon;
	use App\Model\Reservation;

	$pageTitle = "Manage Reservations";

	$carbonInst = new Carbon;
 ?>



<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center"><strong><?php echo e($pageTitle); ?></strong></h1>
			<br />
		</div>
		<?php if( $reservations->count() ): ?>
			<div class="col-lg-4 col-lg-offset-8">
				<form action="" method="GET" id="filterForm">
					<select name="status" id="status" class="form-control" required="required" onchange="event.preventDefault();document.getElementById('filterForm').submit()">
						<option value="">:: Select Status ::</option>
						<option <?php if( ! empty( $_GET['status'] ) AND $_GET['status'] == Reservation::PENDING ): ?> selected="selected" <?php endif; ?> selected="selected"  value="<?php echo e(Reservation::PENDING); ?>"><?php echo e(Reservation::PENDING); ?></option>
						<option <?php if( ! empty( $_GET['status'] ) AND $_GET['status'] == Reservation::APPROVED ): ?> selected="selected" <?php endif; ?> value="<?php echo e(Reservation::APPROVED); ?>"><?php echo e(Reservation::APPROVED); ?></option>
						<option <?php if( ! empty( $_GET['status'] ) AND $_GET['status'] == Reservation::REJECTED ): ?> selected="selected" <?php endif; ?> value="<?php echo e(Reservation::REJECTED); ?>"><?php echo e(Reservation::REJECTED); ?></option>
					</select>
				</form>
			</div>
		<?php endif; ?>
	</div>

	<div class="row" style="margin-top: 10px;">
		<div class="col-lg-12">
			<?php if( $reservations->count() ): ?>
				<div class="table-responsive">
					<table class="table table-responsive table-hover table-bordered">
						<thead>
							<tr>
								<th style="width: 6%;">ID</th><th style="width: 9%;">Status</th><th style="width: 15%;">User</th><th>Room</th>
								<th>Description</th><th>Notes</th><th style="width: 12%;">Date</th><th style="width: 10%;">Hours</th>
								<th style="width: 15%;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr <?php if( $r->status == App\Model\Reservation::REJECTED ): ?> class="bg-danger" <?php endif; ?>>
									<td><?php echo e(sprintf("%05d", $r->id)); ?></td>
									<td><?php echo e($r->status); ?></td>
									<td><?php echo e($r->user->firstname.' '.$r->user->lastname); ?></td>
									<td><?php echo e($r->room->name); ?></td>
									<td><?php echo e($r->description); ?></td>
									<td><?php echo e($r->notes); ?></td>
									<td><?php echo e($r->date->toFormattedDateString()); ?></td>
									<td>
										<?php 
											$hours = explode(',', $r->hours);
										 ?>
										<?php $__currentLoopData = $hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<span class="label label-default">
												<?php echo e($carbonInst->hour( ( int ) $h )->format('g A')); ?>

											</span> &nbsp;
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</td>
									<td>
										<?php if( $r->status == App\Model\Reservation::PENDING ): ?>
											<a href="<?php echo e(route('reservation.approve', ['reservation_id' => $r->id])); ?>" class="btn btn-success btn-xs" title="Approve">
												<i class="glyphicon glyphicon-check"></i> Approve 
											</a> &nbsp; 
											<a href="<?php echo e(route('reservation.reject', ['reservation_id' => $r->id])); ?>" class="btn btn-danger btn-xs" title="Reject">
												<i class="glyphicon glyphicon-ban-circle"></i> Reject 
											</a>
										<?php endif; ?>
									</td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
					<div class="text-center">
						<?php echo e($reservations->links()); ?>

					</div>
				</div>
			<?php else: ?>
				<div class="panel panel-danger">
					<div class="panel-body">
						<div class="text-center">No record to display</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>