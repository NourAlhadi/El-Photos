<div class="alert alert-info alert-dark"> People from all over the world are trying to share their daily life captures!! <strong>Join them now!!</strong> </div>

<div class="container">
    <div class="row">
        <?php foreach ($photos as $photo): ?>
            <div id="photo<?php echo $photo->id; ?>" onclick="openModal(<?php echo $photo->id; ?>);" class="col-12 col-sm-6 col-lg-4" style="margin-bottom: 20px">
                <div class="card text-center">
                    <!-- Heading -->
                    <div class="card-body">
                        <h4 class="card-title">By <?php echo $photo->uploader_name ?></h4>
                        <h6 class="card-subtitle text-muted">Uploaded at: <?php echo $photo->date ?></h6>
                    </div>
                    <!-- Image -->
                    <img style="width: 90%; height: 175px!important; margin: 0 auto;" src="<?php echo base_url(); ?>uploads/posts/<?php echo $photo->link ?>">
                    <!-- Text Content -->
                    <div class="card-body">
                        <p class="card-text"><?php echo $photo->post ?></p>
                        <i id="views_<?php echo $photo->id; ?>" class="fa fa-2x fa fa-eye" style="color: royalblue"> <?php echo $photo->views; ?></i> &nbsp;&nbsp;
                        <i id="loves_<?php echo $photo->id; ?>" class="fa fa-2x fa-heart" style="color: indianred"> <?php echo $photo->loves; ?></i> &nbsp;&nbsp;
                        <br /><br />
                        <?php if($user_logged_in): ?>
                            <button onclick="addLove(<?php echo $photo->id . ',' . $user->id;?>)" class="btn btn-danger">Love it!!</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


            <div id="myModal<?php echo $photo->id; ?>" class="modal">
                <span class="close cursor" onclick="closeModal(<?php echo $photo->id; ?>)">&times;</span>
                <div class="modal-content">
                    <div class="mySlides<?php echo $photo->id; ?>">
                        <img width="100%" height="auto" src="<?php echo base_url(); ?>uploads/posts/<?php echo $photo->link ?>">
                    </div>
                    <div class="caption-container">
                        <p id="caption"><?php echo $photo->post; ?></p>
                        <i id="modal_views_<?php echo $photo->id; ?>" class="fa fa-eye" style="color: royalblue"> <?php echo $photo->views; ?></i> &nbsp;&nbsp;
                        <i id="modal_loves_<?php echo $photo->id; ?>" class="fa fa-heart" style="color: indianred"> <?php echo $photo->loves; ?></i> &nbsp;&nbsp;
                        <?php if($user_logged_in): ?>
                            <button onclick="addLove(<?php echo $photo->id . ',' . $user->id;?>)" class="btn btn-sm btn-samll btn-danger">Love it!!</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>


<div id="hides" class="alert alert-danger">
    You Already Loved this photo!!
</div>

<style>

    #hides{
        position: fixed;
        bottom: 25px;
        right: 25px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        z-index: 10001;
        padding-top: 50px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: black;
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #9e9e9e;
        margin: auto;
        padding: 0;
        width: 60%;
        max-width: 1200px;
    }

    @media screen and (max-width: 480px){
        .modal-content {
            position: relative;
            background-color: #9e9e9e;
            margin: auto;
            padding: 0;
            width: 90%;
            height: auto;
            max-width: 1200px;
        }
    }

    /* The Close Button */
    .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    .mySlides {
        display: none;
        height: 75%!important;
        width: 90%!important;
        margin: 0 auto;
    }

    .cursor {
        cursor: pointer;
    }


    img {
        margin-bottom: -4px;
    }

    .caption-container {
        text-align: center;
        background-color: rgba(150,150,150,.2);
        padding: 16px;
        color: black;

    }

    /**********************************/

</style>

<script>

    let lock = false;

    function openModal(n) {
        if (lock){
            lock = false;
            return;
        }
        document.getElementById('myModal' + n).style.display = "block";
        addView(n);
        incViews(n);
    }


    function closeModal(n) {
        document.getElementById('myModal' + n).style.display = "none";
    }


    function addView(idx) {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/ajax/add_view",
            dataType: 'json',
            data: {photo_id: idx},
            success: function(res) {
                console.log("Added");
            }
        });
    }

    function incViews(idx){
        let x = document.getElementById('views_' + idx).innerText;
        x++;
        document.getElementById('views_' + idx).innerText = x;
        document.getElementById('modal_views_' + idx).innerText = x;
    }

    function showNoLove(){
        let $div2 = $("#hides");
        if ($div2.is(":visible")) { return; }
        $div2.show();
        setTimeout(function() {
            $div2.hide();
        }, 5000);
    }

    function addLove(idx,user) {
        lock = true;
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/ajax/add_love",
            dataType: 'json',
            data: {photo_id: idx, user_id: user},
            success: function(res) {
                console.log(res.status);
                if (res.status === "success"){
                    incLoves(idx);
                }else{
                    showNoLove();
                }
            }

        });
    }

    function incLoves(idx){
        let x = document.getElementById('loves_' + idx).innerText;
        x++;
        document.getElementById('loves_' + idx).innerText = x;
        document.getElementById('modal_loves_' + idx).innerText = x;
    }


    $(document).ready(function(){
        $("#hides").hide();
    });
</script>