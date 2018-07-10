<?php
    if (isset($errors)){
        echo '
            <div class="alert alert-danger">'. $errors .'</div>
        ';
    }
?>

<div class="form-style-6" style="min-height: 400px;">
    <h1>Capture.. Upload.. Charm</h1>
    <form action="upload" method="post" enctype="multipart/form-data">

        <br /><br />


        <label>Say something about your photo:</label>
        <input type="text" name="post" placeholder="Say something about your photo" maxlength="255">

        <br /><br />

        <label>Upload your photo -- CHARM!!:</label>
        <input type="file" name="userfile"/>

        <br /><br />
        <br /><br />

        <input type="submit" value="upload" />


    </form>

</div>