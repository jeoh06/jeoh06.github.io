<?php
for($i=0; $i<count($propDetails); $i++) {?>
    <div class="propImgSlides">
        <img src="<?= "./public/images/property_images/{$propDetails[$i]['p_id']}/{$propDetails[$i]['p_img']}";?>" alt="<?= $propDetails[$i]['image_description'];?>">
        <div class="propImgDesc"><?=$propDetails[$i]['image_description'];?></div>
    </div>
    <?php 
};
?>
<button class="allPropPhotos primaryBtn"><a href="#" class="primaryColor"><span>See all photos </span><i class="fa-solid fa-images"></i></a></button>
<!-- TODO: click for modal with grid for showing all property photos -->

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
