<?php $__env->startComponent('mail::message'); ?>
##Hello <?php echo e($user->firstname." ".$user->lastname); ?>


Thank you!<br />
Your reservation has been saved. <br />
Kindly wait for our approval.



Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
