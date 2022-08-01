<?php $title = "Modify Property";
ob_start(); ?>
<section>
    <form action="index.php" method="post" id="modifyPropertyForm" enctype="multipart/form-data">
        <div id="allPropInfo">
            <div id="modifyTextInfo">
                <label for="title">Title<input type="text" name="title" id="title" value="<?= $propDetails[0]['post_title']; ?>"></label>
                <label for="roomTypeMod">
                    <span>Room Type</span>
                    <div id="roomModMenu" class="multi-selector">
                        <div class="roomModBar select-field">
                            <p class="choose">Room Type</p>
                            <p class="down-arrow">&blacktriangledown;</p>
                        </div>
                        <div id="roomModList" class="list modifyList">
                            <label><input type="radio" name="roomType" value="1" <?php if ($propDetails[0]['room_type_id'] === 1) : ?> checked <?php endif; ?>>Private Room</label>
                            <label><input type="radio" name="roomType" value="2" <?php if ($propDetails[0]['room_type_id'] === 2) : ?> checked <?php endif; ?>>Shared Room</label>
                            <label><input type="radio" name="roomType" value="3" <?php if ($propDetails[0]['room_type_id'] === 3) : ?> checked <?php endif; ?>>Entire Place</label>
                        </div>
                    </div>
                    <span class="hide">Select one</span>
                </label>
                <label for="bedroom">
                    Number of bedrooms
                    <input type="number" name="bedroom" id="bedroom" value="<?= $propDetails[0]['room_num']; ?>">
                    <span class='hide'>Number between 1 and 100</span>
                </label>
                <label for="bath">
                    Number of baths
                    <input type="number" name="bath" id="bath" value="<?= $propDetails[0]['bath_num']; ?>">
                    <span class='hide'>Number between 1 and 100</span>
                </label>
                <label for="furnished">
                    <span>Furnished</span>
                    <label class="switch">
                        <input type="checkbox" name="furnished" id="furnished">
                        <span class="slider"></span>
                    </label>
                </label>
                <label for="bed" id="bedField">
                    Number of beds
                    <input type="number" name="bed" id="bed" value="<?= $propDetails[0]['bed_num']; ?>">
                    <span class='hide'>Number between 1 and 100</span>
                </label>
                <label for="price">
                    Price(Monthly)
                    <input type="number" name="price" id="price" value="<?= $propDetails[0]['monthly_price_won']; ?>">
                    <span class='hide'>Number greater than 0</span>
                </label>
                <label for="description">
                    Description<textarea name="description" id="description"><?= $propDetails[0]['description']; ?></textarea>
                    <span class="hide">At least 4 charachters</span>
                </label>
                <label for="bankAccNum">
                    Bank Account Number
                    <input type="text" name="bankAccNum" id="bankAccNum" value="<?= $propDetails[0]['bank_account_num']; ?>">
                    <span class="hide">Enter real bank account number</span>
                </label>
                <div>
                    <button type="submit" id="postPropertyButton" class="primaryBtn primaryColor offsetFill">SUBMIT</button>
                </div>
            </div>
            <div id="modifyImgInfo">
                <label for="addImg" id="newPropImg">
                    <span>Add an Image</span>
                    <button id="addImg" class="primaryBtn primaryFill offsetColor">Add img</button>
                    <span class="hide">(At least 2, at most 20)</span>
                </label>
                <div id="photosPreview">
                    <?php
                    for ($i = 0; $i < count($propDetails); $i++) {
                    ?>
                        <div>
                            <input value="<?= $propDetails[$i]['image_description'] ?>" name="t-imgName-<?= $i ?>" type="text" class="t-description">
                            <span class="closeBttn">&times;</span>
                            <img src="./public/images/property_images/<?= $propDetails[$i]['propId'] ?>/<?= $propDetails[$i]['p_img'] ?>" alt="">
                            <input value="<?= $propDetails[$i]['p_img'] ?>" name="imgName-<?= $i ?>" type="hidden">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <input type="hidden" id="propId" name="propId" value="<?= $propDetails[0]['propId']; ?>">
                <input type="hidden" name="action" value="modifyProperty">
            </div>
        </div>
        <button type="submit" id="postPropertyButton2" class="primaryBtn primaryColor offsetFill">SUBMIT</button>
    </form>
</section>
<script src="./public/js/modifyProperty.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>