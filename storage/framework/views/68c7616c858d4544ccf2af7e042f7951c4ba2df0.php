<?php 
	use Carbon\Carbon;

	$pageTitle = "Room Details";

	$carbonInst = new Carbon;
 ?>



<?php $__env->startSection('content'); ?>


    <img class="img-circle" src="C:\xampp\htdocs\reservations\resources\views\Photo\Room1.jpg" alt="Room1" width="300" height="200" frameborder="0" style="border:0" allowfullscreen>
    <div >


<h1>Hello</h1>
<h3>Details for <?php echo e($room->name); ?></h3>

          <div>
              <?php echo e($room->Image); ?>

              <?php echo e($room->Capacity); ?>

              <?php echo e($room->description); ?>

          </div>


    <div>
      <button style = "border-style: solid; background-color: white; left: -5em;"type="button" onclick="alert('Loading')">Reserve!

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>