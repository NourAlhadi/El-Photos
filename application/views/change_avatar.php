<div class="form-style-6">
    <h1>Changing Avatar</h1>
    <form action="change_avatar" method="post" enctype="multipart/form-data">

    <input type="file" name="userfile"/>

    <br /><br />

    <input type="submit" value="upload" />

    <br /><br />
    <?php echo anchor('profile/remove_avatar','<input type="button" value="Remove Avatar">','') ?>


    </form>

</div>