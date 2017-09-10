<?php 
	$pageTitle = "Contact Us";
 ?>



<?php $__env->startSection('content'); ?>
            <h1> Contact US </h1>
            <!-- this section show SendUsMail -->
            <div class="SendUsMail">
               <h2> Mail US </h2>
               <p>
                  <!-- code for the email form -->
               <form name="emailform" method="POST" action="<?php echo e(url('contactus')); ?>"  >
                  <?php echo e(csrf_field()); ?>

                  <div class="row">
                     <label for="name">Name:</label><br>
                     <input id="name" class="emailform" name="name" type="text" value="" size="30" /><br>
                  </div>
                  <div class="row">
                     <label for="email">E-mail:</label><br>
                     <input id="email" class="emailform" name="email" type="text" value="" size="30" /><br>
                  </div>
                  <div class="row">
                     <label for="subject">Subject:</label><br>
                     <input id="email" class="emailform" name="subject" type="text" value="" size="30" /><br>
                  </div>
                  <div class="row">
                     <label for="message">Message:</label><br>
                     <textarea id="emailMessage" class="emailform" name="emailMessage" rows="7" cols="30"></textarea><br>
                  </div>
                  <input id="submit_button" type="submit" value="Send E-mail" />
               </form>
            </div>
            </p>
            <!-- this section show OurLocation -->
            <div class="OurLocation">
               <h2> Our Location </h2>
               <p>
                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d28591.11658758793!2d50.17417170524109!3d26.394754999999982!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49ef9b16eef5e9%3A0x1cb9dc0ebd619138!2z2LnZhdin2K_YqSDYp9mE2KrYudmE2YrZhSDYp9mE2KXZhNmD2KrYsdmI2YbZiiDZiNin2YTYqti52YTZhSDYudmGINio2LnYrw!5e0!3m2!1sen!2s!4v1502092964818" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
               </p>
            </div>
            <!--this section show ContactInfo  $ContactUsInfo <?php echo e(nl2br(e($text))); ?> -->
            <div class="ContactInfo">
               <h2> Contact Information </h2>
            </div>
            nl2br(e(<?php echo e($ContactUsInfo -> ContactUs_ContactInfo); ?>))
            <div class="SocialMedia">
               Follow Us On Social Media. <br>
               <a href="https://www.twitter.com"><img src="twitter.png" width="42" height="42" border="0" ></a>
               <a href="https://www.facebook.com"><img src="facebook.png" width="42" height="42" border="0" ></a>
               <a href="https://www.youtube.com"><img src="youtube.png" width="42" height="42" border="0" ></a>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>