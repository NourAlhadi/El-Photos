<div class="form-style-6">
    <h1>Changing Avatar</h1>

    <?php if (isset($_SESSION['form_error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['form_error'];?></div>
    <?php endif; ?>

    <form action="change_avatar" method="post" enctype="multipart/form-data">

    <input type="file" name="userfile"/>

    <br /><br />

    <input type="submit" value="upload" />

    <br /><br />
    <?php echo anchor('profile/remove_avatar','<input type="button" value="Remove Avatar">','') ?>


    </form>

</div>