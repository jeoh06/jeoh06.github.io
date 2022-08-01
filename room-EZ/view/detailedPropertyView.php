<?php if($propDetails[0]['post_title']==''){
        $title = $propDetails[0]['p_type'].' in '.$propDetails[0]['province_state'].', '.$propDetails[0]['city'];
    } else {
        $title = $propDetails[0]['post_title'];
    };;?>

<?php ob_start();?>
<section id="detailedView">
    <h2><?php 
        if($propDetails[0]['post_title']==''){
            echo $propDetails[0]['p_type'].' in '.$propDetails[0]['province_state'].', '.$propDetails[0]['city'];
        } else {
            echo $propDetails[0]['post_title'];
        };?></h2>
    <p><?= $propDetails[0]['province_state'].', '.$propDetails[0]['city'];?><?php
        if($propDetails[0]['validation']) {
            echo ' ‣ Validated Property'?> <img class='validatedCheck' src="./public/images/validatedPropertyCheck.png" alt="validation green check"><?php ;}
            else?></p>
    <?php if(!empty($_SESSION['uid'])) {
    if($_SESSION['uid'] === $_SESSION['user_uid']) { ?>
       <button class="primaryBtn offsetFill modifyPropBtn"><a class="primaryColor" href="index.php?action=prefillProperty&propId=<?= $_REQUEST['propId'];?>"><span>Modify Property Details </span><i class="fa-solid fa-pen-to-square"></i></a></button>
    <?php }} ?>
    <div class='propImages'>
        <?php if(count($propDetails)>1) {
            include('propImagesCarousel.php');
        } else {
            echo "<div class='propImgSlides'><img alt=".$propDetails[0]['image_description']." src=./public/images/property_images/{$propDetails[0]['p_id']}/{$propDetails[0]['p_img']}></div>";
        } ?>
    </div>
    <div class="slideButtons">
        <?php if(count($propDetails)>1) {
            for($i=0; $i<count($propDetails); $i++) {?>
        <span class="propImgDots" onclick="currentSlide(<?=$i+1?>)"></span>
        <?php }};?>
    </div>
    <div class='propDetails'>
        <div class='propDesc'>
            <h3><?=$propDetails[0]['r_type']?> in <?= $propDetails[0]['p_type'];?></h3>
            <p>Size: <?=$propDetails[0]['size'];?>m²<span class='roomDetails'> | <?='<span> '.$propDetails[0]['room_num'].'</span>';?> <i class="fa-solid fa-people-roof primaryColor"></i> <?= $propDetails[0]['bed_num'] !== null ? '| <span>'.$propDetails[0]['bed_num'].'</span> <i class="fa-solid fa-bed primaryColor"></i>' : '';?> | <?='<span> '.$propDetails[0]['bath_num'].'</span>';?> <i class="fa-solid fa-bath primaryColor"></i></span></p>
            <p class='upperLowerBorders'><?= $propDetails[0]['description'];?></p>
            <p>Address: <?= $propDetails[0]['province_state'].', '.$propDetails[0]['city'];?></p>
            <div id="map" style="width:100%;height:350px;"></div>
        </div>
        <div class='propResv flexColumn'>
            <p class='price'>Price: <span><?= number_format($propDetails[0]['monthly_price_won']);?></span>₩/month</p>
            <p>Property Owner: </p>
            <a href="index.php?action=profile&user=<?=$propOwner['uid'];?>">
                <div class="propOwnerInfo flexColumn">
                    <p><?=$propOwner['first_name'];?></p>
                    <div class="propOwnerIcon">
                        <img src="./profile_images/<?=$propOwner['profile_img'];?>" alt="">
                    </div>
                </div>
            </a>
            <button class='resvbutton primaryBtn primaryFill'><a href="index.php?action=reservations&propId=<?=$_REQUEST['propId']?>&price=<?= number_format($propDetails[0]['monthly_price_won']);?>" class="offsetColor">Reserve now</a></button>
            <!-- TODO: reservation action -->
        </div>
    </div>
    <!-- pass database parameters to frontend mapview.js -->
    <input class="latitude" type="hidden" value = "<?= $propDetails[0]['latitude']?>">
    <input class="longitude" type="hidden" value = "<?= $propDetails[0]['longitude']?>">
    <!-- pass database parameters to frontend mapview.js -->

</section>


<!-- All property photos modal -->
<div class="photoModalContainer">
    
    <!-- grid view -->
    <p></p>
    <div class="innerContainer">
        <button class="pModalCloseButton primaryBtn primaryColor">Close</button>
        <div class="imgGrid">
        <?php
        for($i=0; $i<count($propDetails); $i++) {?>
            <div class="allPropImgContainer">
                <img class="allPropImg" src="<?= "./public/images/property_images/{$propDetails[$i]['p_id']}/{$propDetails[$i]['p_img']}";?>" alt="<?= $propDetails[$i]['image_description'];?>">
            </div>
            <?php 
        };
        ?>
        </div>
    </div>
    
    <!-- detailed view -->
    <div class="detailedPhotoView">
        <button class="detailedCloseButton primaryBtn primaryFill offsetColor">Close</button>

        <div class="slideContainer">
            <?php
            for($i=0; $i<count($propDetails); $i++) {?>
                <div class="detailedImgSlides fade">
                    <img class="propertyGallery" src="<?= "./public/images/property_images/{$propDetails[$i]['p_id']}/{$propDetails[$i]['p_img']}";?>" alt="<?= $propDetails[$i]['image_description'];?>">
                </div>
            <?php
            };
            ?>
        </div>
        <a class="prevD" onclick="nextSlide(-1)">&#10094;</a>
        <a class="nextD" onclick="nextSlide(1)">&#10095;</a>
        
        <div style="text-align:center">
            <?php if(count($propDetails)>1) {
                for($i=0; $i<count($propDetails); $i++) {?>
            <span class="detailedImgDots" onclick="currentSlideD(<?=$i+1?>)"></span>
            <?php }};?>
        </div>
    </div>
</div>

<script src="./public/js/propImagesCarousel.js"></script>
<script src="./public/js/viewAllPhoto.js"></script>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=2d4e6c65e087f4ced51eeb4ccd34262c"></script>
<script src="./public/js/propertyMapView.js"></script>

<?php $content = ob_get_clean();?>
<?php require('template.php');?>