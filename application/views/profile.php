<div class="form-style-6">
    <h1>Profile</h1>
    <div class="text-center">
        <?php if (strlen($user->avatar)>3): ?>
            <img height="150px" width="150px" style="border-radius: 50%" src="<?php echo base_url()?>uploads/avatars/<?php echo $user->avatar ?>">
        <?php else: ?>
            <img height="150px" width="150px" style="border-radius: 50%" src="<?php echo base_url()?>assets/images/user.png">
        <?php endif; ?>
        <hr>
    </div>
    <h5>First Name: <?php echo $user->first_name; ?></h5><hr>
    <h5>Last Name: <?php echo $user->last_name; ?></h5><hr>
    <h5>Username: <?php echo $user->username; ?></h5><hr>
    <h5>Email: <?php echo $user->email; ?></h5><hr>
    <h5>Company: <?php echo $user->company; ?></h5><hr>
    <h5>Phone: <?php echo $user->phone; ?></h5><hr>
    <?php if ($user_logged_in): ?>
        <?php if (isset($strange) && $strange == true): ?>

            <?php if($friend == false): ?>
                <?php echo anchor('profile/add/'. $user->id ,'<input type="button" value="Add to Community">','') ?>
            <?php else: ?>
                <?php echo anchor('profile/remove/'. $user->id ,'<input type="button" value="Remove from Community">','') ?>
            <?php endif; ?>

        <?php else: ?>

            <?php echo anchor('profile/change','<input type="button" value="Change Profile">','') ?>
            <br />
            <br />

            <?php echo anchor('profile/change_avatar','<input type="button" value="Change Avatar">','') ?>
            <br />
            <br />


            <?php echo anchor('auth/change_password','<input type="button" value="Change Password">','') ?>

        <?php endif; ?>
    <?php endif; ?>

</div>