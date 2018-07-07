<div class="form-style-6">
    <h1>Profile</h1>
    <div class="text-center">
        <img height="150px" width="150px" src="<?php echo base_url()?>assets/images/user.png">
        <hr>
    </div>
    <h5>First Name: <?php echo $user->first_name; ?></h5><hr>
    <h5>Last Name: <?php echo $user->last_name; ?></h5><hr>
    <h5>Username: <?php echo $user->username; ?></h5><hr>
    <h5>Email: <?php echo $user->email; ?></h5><hr>
    <?php echo anchor('auth/change_password','<input type="button" value="Change Password">','') ?>
</div>