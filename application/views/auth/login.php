<div class="form-style-6">
    <h1>Login</h1>

    <?php if(isset($message)): ?>
        <div class="alert alert-danger" id="infoMessage"><?php echo $message;?></div>
    <?php endif; ?>
    <?php echo form_open("auth/login");?>

      <p>
        <label for="identity">Username: </label>
        <?php echo form_input($identity);?>
      </p>

      <p>
        <?php echo lang('login_password_label', 'password');?>
        <?php echo form_input($password);?>
      </p>

      <p>
        <?php echo lang('login_remember_label', 'remember');?>
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
      </p>
      <?php if (!isset($_SESSION['redirect'])) $_SESSION['redirect'] = NULL; ?>
      <input type="hidden" name="redirect" value="<?php echo $_SESSION['redirect']; ?>">

      <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

    <?php echo form_close();?>

    <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
</div>