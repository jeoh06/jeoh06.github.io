<?php

    if(count($properties)>0){
        ?>
        
        <h2>Search Results for <?php echo $_REQUEST['province'].(!empty($_REQUEST['city']) ? ", {$_REQUEST['city']}" : '');?></h2>
        <div id='searchResultsContainer'>
            <div id='propertiesSearchList'>
                <?php
                foreach($properties as $property)
                {
                    include('propertyCard.php');?>
                    <input class="postTitle" type="hidden" value = "<?= $property['post_title']?>">
                    <input class="content" type="hidden" value = '<?= "<a href=index.php?action=property&propId={$property['id']}>-View Details</a>"?>'>
                    <input class="link" type="hidden" value = '<?= "index.php?action=property&propId={$property['id']}"?>'>
                    <input class="latitude" type="hidden" value = "<?= $property['latitude']?>">
                    <input class="longitude" type="hidden" value = "<?= $property['longitude']?>">
                <?php } ?>
            </div>
            
            <div id="searchMap"></div>
        </div>
    <?php
    }else {
        ?>
        <p>No Search Results Yet for <b><?php echo $_REQUEST['province'].(!empty($_REQUEST['city']) ? ", {$_REQUEST['city']}" : '');?></b> with the Selected Filters ! Try to expand your Search.</p>
        <?php
    } ?>
