<div class="alert alert-info alert-dark"> People from all over the world are trying to share their daily life captures!! <strong>Join them now!!</strong> </div>

<div class="container">
    <div class="row">
        <?php foreach ($photos as $photo): ?>
            <div onclick="openModal(<?php echo $photo->id; ?>);" class="col-4" style="margin-bottom: 20px">
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
                        <i class=" fa fa-2x fa fa-eye" style="color: royalblue"> <?php echo $photo->views; ?></i> &nbsp;&nbsp;
                        <i class=" fa fa-2x fa-heart" style="color: indianred"> <?php echo $photo->loves; ?></i> &nbsp;&nbsp;
                        <br /><br /><button class="btn btn-danger">Love it!!</button>
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
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>


<style>
    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        z-index: 10001;
        padding-top: 100px;
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
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        width: 60%;
        max-width: 1200px;
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
        background-color: white;
        padding: 2px 16px;
        color: black;
    }

    /**********************************/

</style>

<script>
    function openModal(n) {
        document.getElementById('myModal' + n).style.display = "block";
        showSlides(n);
    }

    function closeModal(n) {
        document.getElementById('myModal' + n).style.display = "none";
    }

    function showSlides(n) {
        let slides = document.getElementById("mySlides"+n);
        slides[slideIndex-1].style.display = "block";
    }


</script>