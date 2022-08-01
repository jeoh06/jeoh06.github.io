<?php
$title = "Post new property";
ob_start(); ?>
<section>
    <form action="index.php" method="post" id="postPropertyForm" enctype="multipart/form-data">
        <div id="allPropInfo">
            <div id="postTextInfo">
                <label for="title">
                    <span>Title</span>
                    <input type="text" name="title" id="title">
                    <span class='hide'>At least 4 charachters</span>
                </label>
                <label for="country">
                    <span>Country</span>
                    <div id="countryPostMenu" class="multi-selector">
                        <div class="countryPostBar select-field">
                            <p class="choose">Select a country</p>
                            <p class="down-arrow">&blacktriangledown;</p>
                        </div>
                        <div id="countryPostList" class="list modifyList">
                            <label><input type="radio" value="KR" name="country">South Korea</label>
                        </div>
                    </div>
                    <span class="hide">Select one</span>
                </label>
                <label for="provincePost">
                    <span>Province/Special City</span>
                    <div id="provincePostMenu" class="multi-selector">
                        <div class="provincePostBar select-field">
                            <p class="choose">Province/Special City</p>
                            <p class="down-arrow">&blacktriangledown;</p>
                        </div>
                        <div id="provincePostList" class="list modifyList">
                            <label><input type="radio" name="province">Province/Special City</label>
                            <label><input type="radio" name="province" value="1">Busan</label>
                            <label><input type="radio" name="province" value="2">Chungcheongbuk-do</label>
                            <label><input type="radio" name="province" value="3">Chungcheongnam-do</label>
                            <label><input type="radio" name="province" value="4">Daegu</label>
                            <label><input type="radio" name="province" value="5">Daejeon</label>
                            <label><input type="radio" name="province" value="6">Gangwon-do</label>
                            <label><input type="radio" name="province" value="7">Gwangju</label>
                            <label><input type="radio" name="province" value="8">Gyeonggi-do</label>
                            <label><input type="radio" name="province" value="9">Gyeongsangbuk-do</label>
                            <label><input type="radio" name="province" value="10">Gyeongsangnam-do</label>
                            <label><input type="radio" name="province" value="11">Incheon</label>
                            <label><input type="radio" name="province" value="12">Jeju-do</label>
                            <label><input type="radio" name="province" value="13">Jeollabuk-do</label>
                            <label><input type="radio" name="province" value="14">Jeollanam-do</label>
                            <label><input type="radio" name="province" value="15">Sejong-si</label>
                            <label><input type="radio" name="province" value="16">Seoul</label>
                        </div>
                    </div>
                    <span class="hide">Select one</span>
                </label>
                <label>
                    <span>City/District</span>
                    <div id="cityPostMenu" class="multi-selector">
                        <div class="cityPostBar select-field">
                            <p class="choose">-=-=-</p>
                            <p class="down-arrow">&blacktriangledown;</p>
                        </div>
                        <div id="cityPostList" class="list modifyList"></div>
                    </div>
                    <span class="hide">Select one</span>
                </label>
                <label>
                    <span>District</span>
                    <div id="districtPostMenu" class="multi-selector">
                        <div class="districtPostBar select-field">
                            <p class="choose">-=-=-</p>
                            <p class="down-arrow">&blacktriangledown;</p>
                        </div>
                        <div id="districtPostList" class="list modifyList"></div>
                    </div>
                    <span class="hide">Select one</span>
                </label>
                <label for="address1">
                    <span>Address 1</span>
                    <input type="text" name="address1" id="address1">
                    <span class='hide'>At least 4 charachters</span>
                </label>
                <label for="address2">
                    <span>Address 2</span>
                    <input type="text" name="address2" id="address2">
                </label>
                <label for="zipcode">
                    <span>Zipcode</span>
                    <input type="text" name="zipcode" id="zipcode">
                    <span class="hide">Enter real zipcode</span>
                </label>
                <label for="propertyTypePost">
                    <span>Property Type</span>
                    <div id="propertyPostMenu" class="multi-selector">
                        <div class="propertyPostBar select-field">
                            <p class="choose">Property Type</p>
                            <p class="down-arrow">&blacktriangledown;</p>
                        </div>
                        <div id="propertyPostList" class="list modifyList">
                            <label><input type="radio" name="propertyType" value="1">Apartment</label>
                            <label><input type="radio" name="propertyType" value="2">Officetel</label>
                            <label><input type="radio" name="propertyType" value="3">Villa</label>
                            <label><input type="radio" name="propertyType" value="4">House</label>
                            <label><input type="radio" name="propertyType" value="5">Shared House</label>
                            <label><input type="radio" name="propertyType" value="6">Residential Hotel</label>
                        </div>
                    </div>
                    <span class="hide">Select one</span>
                </label>
                <label for="roomTypePost">
                    <span>Room Type</span>
                    <div id="roomPostMenu" class="multi-selector">
                        <div class="roomPostBar select-field">
                            <p class="choose">Room Type</p>
                            <p class="down-arrow">&blacktriangledown;</p>
                        </div>
                        <div id="roomPostList" class="list modifyList">
                            <label><input type="radio" name="roomType" value="1">Private Room</label>
                            <label><input type="radio" name="roomType" value="2">Shared Room</label>
                            <label><input type="radio" name="roomType" value="3">Entire Place</label>
                        </div>
                    </div>
                    <span class="hide">Select one</span>
                </label>
                <label for="roomNum">
                    <span>Number of bedrooms</span>
                    <input type="number" name="roomNum" id="roomNum">
                    <span class='hide'>Number between 1 and 100</span>
                </label>
                <label for="bathNum">
                    <span>Number of baths</span>
                    <input type="number" name="bathNum" id="bathNum">
                    <span class='hide'>Number between 1 and 100</span>
                </label>
                <label for="furnished">
                    <span>Furnished</span>
                    <label class="switch">
                        <input type="checkbox" name="furnished" id="furnished">
                        <span class="slider"></span>
                    </label>
                </label>
                <label for="bedNum" id="bedField">
                    <span>Number of beds</span>
                    <input type="number" name="bedNum" id="bedNum">
                    <span class='hide'>Number between 1 and 100</span>
                </label>
                <label for="size">
                    <span>
                        Size (m<sup>2</sup>)
                    </span>
                    <input type="number" name="size" id="size">
                    <span class='hide'>Number between 1 and 10000</span>
                </label>
                <label for="price">
                    <span>Price(Monthly/Won)</span>
                    <input type="number" name="price" id="price">
                    <span class='hide'>Number greater than 0</span>
                </label>
                <label for="description">
                    Description
                    <textarea name="description" id="description" cols="23" rows="12" charswidth="100" name="text_body"></textarea>
                    <span class="hide">At least 4 charachters</span>
                </label>
                <label for="bankAccNum">
                    <span id="bank" class>Bank Account Number</span>
                    <input type="number" name="bankAccNum" id="bankAccNum">
                    <span class="hide">Enter real bank account number</span>
                </label>
                <div>
                    <button type="submit" id="postPropertyButton" class="primaryBtn primaryColor offsetFill">SUBMIT</button>
                </div>
            </div>
            <div id="postImgInfo">
                <label for="addImg" id="newPropImg">
                    <span>Add an Image</span>
                    <button id="addImg" class="primaryBtn primaryFill offsetColor">Add</button>
                    <span id="photos" class="hide">(At least 2, at most 20)</span>
                </label>
                <div id="photosPreview"></div>
                <input type="hidden" name="action" value="postProperty">
            </div>
        </div>
        <button type="submit" id="postPropertyButton2" class="primaryBtn primaryColor offsetFill">SUBMIT</button>
    </form>

</section>
<script src="./public/js/postProperty.js"></script>
<?php
$content = ob_get_clean();
include('template.php');
?>