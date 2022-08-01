<?php $title = "Create profile"; ?>

<?php ob_start(); ?>
<section id="createProfile">
    <form action="index.php?action=checkProfile" method="POST" id="newProfile" enctype="multipart/form-data">
        <div id="line1">
            <h1>Let's create a profile for you</h1>
            <p></p>
        </div>
        <div id="profilePhoto">
            <input type="file" id="fileM" name="uploadFile">
            <label for="fileM" id="uploadButtonM">Choose Photo</label>
        </div>
        <div class="flexRow">
            <div id="createProfileDetails">
                <div id="phoneBox">
                    <div>
                        <label for="phoneNum">Phone Number:</label>
                        <span id="alertMesg">Please Check Your Phone Number</span>
                    </div>
                    <div>
                        <input type="text" id="phoneNum" name="phoneNum">
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
                <div>
                    <label for="gender">Gender: </label>
                    <div>
                        <input type="radio" id="male" name="gender" value="M">
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="F">
                        <label for="female">Female</label>
                        <input type="radio" id="non-binary" name="gender" value="Nb">
                        <label for="non-binary">Non-Binary</label>
                    </div>
                </div>
            </div>

            <div id="langDetails">
                <p>Which languages can you speak?</p>
                <div>
                    <div id="language" class="multi-selector">
                        <div class="select-field">
                            <p class="choose">Choose one or multiple</p>
                            <p class="down-arrow">&blacktriangledown;</p>
                        </div>
                        <div id="langList" class="list modifyList">
                            <label for="HK" class="lang"><input type="checkbox" id="HK" name="HK" value="HK"> Cantonese</label>
                            <label for="ZH" class="lang"><input type="checkbox" id="ZH" name="ZH" value="ZH"> Chinese(Mandarin)</label>
                            <label for="NL" class="lang"><input type="checkbox" id="NL" name="NL" value="NL"> Dutch</label>
                            <label for="EN" class="lang"><input type="checkbox" id="EN" name="EN" value="EN"> English</label>
                            <label for="DE" class="lang"><input type="checkbox" id="DE" name="DE" value="DE"> German</label>
                            <label for="FR" class="lang"><input type="checkbox" id="FR" name="FR" value="FR"> French</label>
                            <label for="HI" class="lang"><input type="checkbox" id="HI" name="HI" value="HI"> Hindi</label>
                            <label for="IN" class="lang"><input type="checkbox" id="IN" name="IN" value="IN"> Indonesian</label>
                            <label for="IT" class="lang"><input type="checkbox" id="IT" name="IT" value="IT"> Italian</label>
                            <label for="JA" class="lang"><input type="checkbox" id="JA" name="JA" value="JA"> Japanese</label>
                            <label for="KO" class="lang"><input type="checkbox" id="KO" name="KO" value="KO"> Korean</label>
                            <label for="VI" class="lang"><input type="checkbox" id="VI" name="VI" value="VI"> Vietnamese</label>
                            <label for="PT" class="lang"><input type="checkbox" id="PT" name="PT" value="PT"> Portugese</label>
                            <label for="RU" class="lang"><input type="checkbox" id="RU" name="RU" value="RU"> Russian</label>
                            <label for="ES" class="lang"><input type="checkbox" id="ES" name="ES" value="ES"> Spanish</label>
                        </div>
                    </div>
                    <input type="hidden" id="userLang" name="userLang" value="">
                </div>
            </div>
        </div>
        <div>
            <textarea id="bio" name="bio" rows="4" placeholder="Introduce yourself"></textarea>
        </div>
        <input type="submit" id="create" name="create" class="primaryBtn primaryColor offsetFill" value="Create profile">
    </form>
</section>
<script src="./public/js/createProfile.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>