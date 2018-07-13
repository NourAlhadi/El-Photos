<div class="form-style-6">

    <?php if (isset($_SESSION['form_error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['form_error'];?></div>
    <?php endif; ?>

    <form method="post" action="change" enctype="multipart/form-data">
        <p>
            <label>First Name: </label>
            <?php echo form_input('first_name');?>
        </p>

        <p>
            <label>Last Name: </label>
            <?php echo form_input('last_name');?>
        </p>

        <p>
            <label>Company: </label>
            <?php echo form_input('company');?>
        </p>

        <p>
            <label>Phone: </label>
            <?php echo form_input('phone');?>
        </p>

        <p>
            <label for="pass">Password: </label>
            <input id="pass" type="password" name="password">
        </p>

        <?php echo form_hidden('id');?>
        <?php echo form_hidden('csrf'); ?>

        <p><input type="submit" value="Submit"></p>
    </form>
</div>