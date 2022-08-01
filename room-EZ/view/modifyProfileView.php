<?php $title = "Modify Profile"; ?>


<?php ob_start(); ?>
<section id="modifyProfileSection">
    <div class="personalInformationContainer">
        <h2>Modify Profile</h2>

        <form action="index.php" method="post" id="modifyFormM" enctype="multipart/form-data">

            <div id="photoContainerM">
                <div id="profilePhotoM">
                    <img id="photoM" src= "./profile_images/<?= $data['profile_img']?>"/>
                    <input type="file" id = "fileM" name = "uploadFile">
                    <label for="fileM" id = "uploadButtonM">Choose Photo</label>
                </div>
            </div>

            <div id="row1">

                <div id="phoneBox">
                    <div>
                        <label for="phoneNumber">Phone Number:</label>
                        <span id="alertMesg">Please Check Your Phone Number</span>
                    </div>
                    <div>
                        <input type="text" id="phoneNumber" class="box" name="phoneNumber" value="<?= $data['phone_number']; ?>">
                    </div>
                </div>

                <div>
                    <label for="birthdate">Birthdate:</label>
                    <div id="birthdate">
                        <select id="year" name="year"></select>
                        <select id="month" name="month">
                            <option value=1>Jan</option>
                            <option value=2>Feb</option>
                            <option value=3>Mar</option>
                            <option value=4>Apr</option>
                            <option value=5>May</option>
                            <option value=6>June</option>
                            <option value=7>July</option>
                            <option value=8>Aug</option>
                            <option value=9>Sept</option>
                            <option value=10>Oct</option>
                            <option value=11>Nov</option>
                            <option value=12>Dec</option>
                        </select>
                        <select id="day" name="day"></select>
                    </div>
                </div>
                <div id="genderField">
                    <label for="gender">Gender: </label>
                    <div id="gender">
                        <input type="radio" id="male" name="gender" value="M">
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="F">
                        <label for="female">Female</label>
                        <input type="radio" id="non-binary" name="gender" value="Nb">
                        <label for="non-binary">Non-Binary</label>
                    </div>
                </div>

                <div id="langDetails" class="modifyLang">
                    <p>Which languages can you speak?</p>
                    <div>
                        <div id="language" class="multi-selector">
                            <div class="select-field">
                                <p class="choose">Choose one or multiple</p>
                                <p class="down-arrow">&blacktriangledown;</p>
                            </div>
                            <div class="list modifyList">
                                <label for="HK" class="lang"><input type="checkbox" id="HK" name="HK" value="HK" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "HK")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Cantonese</label>
                                <label for="ZH" class="lang"><input type="checkbox" id="ZH" name="ZH" value="ZH" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "ZH")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Chinese(Mandarin)</label>
                                <label for="NL" class="lang"><input type="checkbox" id="NL" name="NL" value="NL" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "NL")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Dutch</label>
                                <label for="EN" class="lang"><input type="checkbox" id="EN" name="EN" value="EN" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "EN")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> English</label>
                                <label for="DE" class="lang"><input type="checkbox" id="DE" name="DE" value="DE" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "DE")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> German</label>
                                <label for="FR" class="lang"><input type="checkbox" id="FR" name="FR" value="FR" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "FR")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> French</label>
                                <label for="HI" class="lang"><input type="checkbox" id="HI" name="HI" value="HI" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "HI")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Hindi</label>
                                <label for="IN" class="lang"><input type="checkbox" id="IN" name="IN" value="IN" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "IN")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Indonesian</label>
                                <label for="IT" class="lang"><input type="checkbox" id="IT" name="IT" value="IT" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "IT")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Italian</label>
                                <label for="JA" class="lang"><input type="checkbox" id="JA" name="JA" value="JA" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "JA")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Japanese</label>
                                <label for="KO" class="lang"><input type="checkbox" id="KO" name="KO" value="KO" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "KO")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Korean</label>
                                <label for="VI" class="lang"><input type="checkbox" id="VI" name="VI" value="VI" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "VI")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Vietnamese</label>
                                <label for="PT" class="lang"><input type="checkbox" id="PT" name="PT" value="PT" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "PT")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Portugese</label>
                                <label for="RU" class="lang"><input type="checkbox" id="RU" name="RU" value="RU" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "RU")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Russian</label>
                                <label for="ES" class="lang"><input type="checkbox" id="ES" name="ES" value="ES" <?php for ($i = 0; $i < count($data['languages']); $i++) {
                                                                                                                        if ($data['languages'][$i] == "ES")
                                                                                                                            echo "checked";
                                                                                                                    } ?>> Spanish</label>
                            </div>

                        </div>
                        <input type="hidden" id="userLang" name="userLang" value="">
                    </div>
                </div>

            </div>

            <div class="bottomContainerM">
                <textarea id="userBio" class="box" name="bio"><?= $data['bio'] ?></textarea>
            </div>

            <div class="bottomContainerM">
                <button type="submit" class="buttons primaryBtn primaryColor" id="save" name="save">Save Profile Changes</button>
            </div>
            <input type="hidden" name="action" value="updateUserData">

        </form>
    </div>
</section>
<p></p>

<script src="public/js/modifyProfile.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>

<!-- /Applications/XAMPP/xamppfiles/htdocs/sites/batch16_project/view/modifyProfileView.php on line 11" id = "photo" /> -->