<?php

namespace wcoding\batch16\finalproject\Model;

use Exception;
use TypeError;

require_once('Manager.php');
class PropertyManager extends Manager
{
    public function __construct($user = 0)
    {
        parent::__construct();
        $this->_user_id = $user;
    }

    // getProperties to display on the propertyCard, which is shown on the viewProfile page and index page
    public function getProperties($action = '')
    {
        if ($action == 'profile') {
            $req = $this->_connection->prepare("SELECT p.id, p.user_uid, p.post_title, p.country, p.province_state, p.zipcode, p.latitude, p.longitude, p.city, p.address1, p.address2, p.size, p.property_type_id, p.room_type_id, p.monthly_price_won, p.description, p.validation, p.date_created, pt.property_type AS p_type, pt.description AS property_type_description, rt.room_type AS r_type, rt.description AS room_type_description, pi.property_id AS p_id, pi.img_url AS p_img, pi.description AS image_description
            FROM properties p
            LEFT JOIN property_types pt
            ON p.property_type_id = pt.id
            LEFT JOIN room_types rt
            ON p.room_type_id = rt.id
            LEFT JOIN property_imgs pi
            ON p.id = pi.property_id
            WHERE p.is_active = 1 AND p.user_uid = :uid
            GROUP BY pi.property_id");
            $req->bindParam('uid', $_REQUEST['user']);
            $req->execute();
        } else {
            $req = $this->_connection->query("SELECT p.id, p.user_uid, p.post_title, p.country, p.province_state, p.zipcode, p.latitude, p.longitude, p.city, p.address1, p.address2, p.size, p.property_type_id, p.room_type_id, p.monthly_price_won, p.description, p.validation, p.date_created, pt.property_type AS p_type, pt.description AS property_type_description, rt.room_type AS r_type, rt.description AS room_type_description, pi.property_id AS p_id, pi.img_url AS p_img, pi.description AS image_description
            FROM properties p
            LEFT JOIN property_types pt
            ON p.property_type_id = pt.id
            LEFT JOIN room_types rt
            ON p.room_type_id = rt.id
            LEFT JOIN property_imgs pi
            ON p.id = pi.property_id
            WHERE p.is_active = 1
            GROUP BY pi.property_id
            ORDER BY date_created DESC LIMIT 0,8");
        }
        $properties = $req->fetchAll(\PDO::FETCH_ASSOC);

        $req->closeCursor();
        foreach($properties as &$property) {
            $property['country'] = $this::COUNTRIES['KR'];
            $property['province_state'] = $this::PROVINCES['KR'][$property['province_state']];
            $property['city'] = !empty($this::CITIES[$property['province_state']][$property['city']]) ? $this::CITIES[$property['province_state']][$property['city']] : '';
          }
        return $properties;
    }

    // Single property detail for property listing page
    public function getProperty($propId)
    {
        $req = $this->_connection->prepare("SELECT p.id, p.user_uid, p.post_title, p.country, p.province_state, p.zipcode, p.latitude, p.longitude, p.city, p.address1, p.address2, p.room_num, p.bed_num, p.bath_num, p.is_furnished, p.size, p.property_type_id, p.room_type_id, p.monthly_price_won, p.description, p.validation, p.date_created, pt.property_type AS p_type, pt.description AS property_type_description, rt.room_type AS r_type, rt.description AS room_type_description, pi.property_id AS p_id, pi.img_url AS p_img, pi.description AS image_description
        FROM properties p
        LEFT JOIN property_types pt
        ON p.property_type_id = pt.id
        LEFT JOIN room_types rt
        ON p.room_type_id = rt.id
        LEFT JOIN property_imgs pi
        ON p.id = pi.property_id
        WHERE p.is_active = 1 AND p.id = :propId");
        $req->bindParam('propId', $propId);
        $req->execute();
        $propDetails = $req->fetchAll(\PDO::FETCH_ASSOC);
        $req->closeCursor();

        if (isset($_SESSION['email'])) {
            $req2 = $this->_connection->prepare("SELECT uid FROM users WHERE email='{$_SESSION['email']}'");
            $req2->execute();
            $data = $req2->fetch(\PDO::FETCH_ASSOC);
            $req2->closeCursor();

            $_SESSION['uid'] = $data['uid'];
            $_SESSION['user_uid'] = $propDetails[0]['user_uid'];
        }
        $propDetails[0]['province_state'] = $this::PROVINCES['KR'][$propDetails[0]['province_state']];
        $propDetails[0]['city'] = $this::CITIES[$propDetails[0]['province_state']][$propDetails[0]['city']];
        return $propDetails;
    }

    public function getPropertyOwner($propId)
    {
        $req = $this->_connection->prepare("SELECT u.uid, u.first_name, u.profile_img, p.user_uid FROM users u JOIN properties p ON u.uid = p.user_uid AND u.is_active = 1 WHERE p.id = :propId");
        $req->bindParam('propId', $propId);
        $req->execute();
        $propOwner = $req->fetch(\PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $propOwner;
    }

    public function prefillProperty($propId)
    {
        $req = $this->_connection->prepare("SELECT p.id AS propId, p.post_title, p.room_num, p.bed_num, p.bath_num, p.is_furnished, p.room_type_id, p.monthly_price_won, p.description, p.bank_account_num, p.validation, rt.room_type AS r_type, pi.property_id AS p_id, pi.img_url AS p_img, pi.description AS image_description
        FROM properties p
        LEFT JOIN property_types pt
        ON p.property_type_id = pt.id
        LEFT JOIN room_types rt
        ON p.room_type_id = rt.id
        LEFT JOIN property_imgs pi
        ON p.id = pi.property_id
        WHERE p.is_active = 1 AND p.id = :propId");
        $req->bindParam('propId', $propId);
        $req->execute();
        $propDetails = $req->fetchAll(\PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $propDetails;
    }

    // SEARCH FUNCTION : $search = "search" get parameter called from router

    public function searchProperties($province, $city, $rangeMin, $rangeMax, $propertyType, $roomType)
    {

        $province = ($province == "any") ? "%%" : $province-1; //// If search input is empty, show all results ("%%" is regex that catches any string)
        $city = ($city == "any") ? "%%" : $city-1; //// If search input is empty, show all results ("%%" is regex that catches any string)
        $rangeMin = strip_tags($rangeMin);
        $rangeMax = ($rangeMax == 1000000) ? 100000000000 : strip_tags($rangeMax); /// default number large enough to catch all properties
        $propertyType = ($propertyType == "any") ? "%%" : $propertyType + 0;
        $roomType = ($roomType == "any") ? "%%" : $roomType + 0;


        $req = $this->_connection->prepare("SELECT p.id, p.user_uid, p.post_title, p.country, p.province_state, p.zipcode, p.latitude, p.longitude, p.city, p.address1, p.address2, p.size, p.property_type_id, p.room_type_id, p.monthly_price_won, p.description, p.validation, p.date_created, pt.property_type AS p_type, pt.description AS property_type_description, rt.room_type AS r_type, rt.description AS room_type_description, pi.img_url AS p_img, pi.property_id AS p_id, pi.img_url AS p_img, pi.description AS image_description
        FROM properties p
        LEFT JOIN property_types pt
        ON p.property_type_id = pt.id
        LEFT JOIN room_types rt
        ON p.room_type_id = rt.id
        LEFT JOIN property_imgs pi
        ON p.id = pi.property_id
        WHERE p.is_active = 1 AND (p.city LIKE :inCity AND p.province_state LIKE :inProvince) AND monthly_price_won >= :inRangeMin AND monthly_price_won <= :inRangeMax AND property_type_id LIKE :inPropertyType AND room_type_id LIKE :inRoomType
        GROUP BY pi.property_id");
        $req->bindParam('inCity', $city);
        $req->bindParam('inProvince', $province);
        $req->bindParam('inRangeMin', $rangeMin);
        $req->bindParam('inRangeMax', $rangeMax);
        $req->bindParam('inPropertyType', $propertyType);
        $req->bindParam('inRoomType', $roomType);
        $req->execute();

        $properties = $req->fetchAll(\PDO::FETCH_ASSOC);

        // foreach($properties as &$property) {
        //     $req = $this->_connection->query("SELECT property_types.property_type AS p_type FROM property_types WHERE property_types.id ='{$property['property_type_id']}'");
        //     $types = $req ->fetch(\PDO::FETCH_ASSOC);
        //     $property['p_type'] = $types['p_type'];
        // }

        // foreach($properties as &$property) {
        //     $req = $this->_connection->query("SELECT room_types.room_type AS r_type FROM room_types WHERE room_types.id ='{$property['room_type_id']}'");
        //     $types = $req ->fetch(\PDO::FETCH_ASSOC);
        //     $property['r_type'] = $types['r_type'];
        // }

        // foreach($properties as &$property) {
        //     $req = $this->_connection->query("SELECT property_imgs.img_url AS p_img FROM property_imgs WHERE property_imgs.property_id ='{$property['id']}'");
        //     $types = $req ->fetch(\PDO::FETCH_ASSOC);
        //     $property['p_img'] = $types['p_img'];
        // }

        $req->closeCursor();
        foreach($properties as &$property) {
            $property['country'] = $this::COUNTRIES['KR'];
            $property['province_state'] = $this::PROVINCES['KR'][$property['province_state']];
            $property['city'] = !empty($this::CITIES[$property['province_state']][$property['city']]) ? $this::CITIES[$property['province_state']][$property['city']] : '';
          }
        $_REQUEST['province'] = $province != '%%' ? $this::PROVINCES['KR'][$province] : 'anywhere';
        $_REQUEST['city'] = ($city != '%%' AND !empty($this::CITIES[$_REQUEST['province']][$city])) ? $this::CITIES[$_REQUEST['province']][$city] : '';

        return $properties;
    }

    public function postProperty($title, $country, $province, $city, $district, $address1, $address2, $zipcode, $propertyType, $roomType, $roomNum, $bedNum, $bathNum, $furnished, $size, $price, $description, $bankAccNum, $imgs, $imgDescriptions)
    {
        $uid = $this->_connection->query("SELECT uid FROM users WHERE email='{$_SESSION['email']}'")->fetch(\PDO::FETCH_ASSOC)['uid'];
        // INFO validation
        // Address
        if (strlen($title) < 50)
            $title = strip_tags($title);
        else 
            throw(new Exception('Title is too long'));
        if (empty($this::COUNTRIES[$country]))
            throw(new Exception('This country is not supported')) ;
        if (empty($this::PROVINCES[$country][$province-1]))
            throw(new Exception('Province/State is not found'));
        else 
            $province-=1; 
        if ($city >= 0 AND !empty($this::CITIES[$this::PROVINCES[$country][$province]][$city-1]))
            $city-=1;
        else if ($city < -1) 
            throw(new Exception('City is not found'));
        if ($district >= 0 AND (!empty($this::DISTRICTS[$this::CITIES[$this::PROVINCES[$country][$province]][$city]][$district-1])))
            $district-=1;
        else if ($district<-1) 
            throw(new Exception('City is too long'));
        if (strlen($address1) < 256)
            $address1 = strip_tags($address1);
        else
            throw(new Exception('Address1 is too long'));
        if (strlen($address2) < 256)
            $address2 = strip_tags($address2);
        else
            throw(new Exception('Address2 is too long'));
        if (strlen($zipcode) < 11)
            $zipcode = strip_tags($zipcode);
        else
            throw(new Exception('Zipcode is too long'));
        if ($propertyType <= 0 OR $propertyType >= 7)
            throw(new TypeError("Invalid property type"));
        if ($roomType <= 0 OR $roomType >= 4)
            throw(new TypeError("Invalid room type"));
        if ($roomNum <= 0 OR $roomNum >= 100)
            throw(new TypeError("Invalid room number"));
        $furnished = $furnished ? 1 : 0;
        if ($furnished AND $bedNum >= 100)
            throw(new TypeError("Invalid bed number")); 
        else if ($furnished) {
            $bedNum = strip_tags($bedNum);
        } 
        else {
            $bedNum = 0;
        }
        if ($bathNum <= 0 OR $bathNum >= 100)
            throw(new TypeError("Invalid room number"));
        if ($size <= 0 OR $size >= 10000)
            throw(new TypeError("Invalid size"));
        if ($price <= 0)
            throw(new TypeError("Invalid price"));
        $description = strip_tags($description);
        if (strlen($bankAccNum) < 21)
            $bankAccNum = strip_tags($bankAccNum);
        else
            throw(new Exception('Bank Account Number is too long'));
        // Img Check
        foreach($imgDescriptions as &$desc) {
            if (strlen($desc) < 256) 
                $desc = htmlspecialchars($desc);
            else
                throw(new Exception('Bank Account Number is too long'));
        }
        foreach ($imgs as $file) {
            if ($file['size'] > 10485760) {
                throw(new Exception('Image is too big'));
            }
        }

        //////////////API CALL to GeoCode to turn the zipcode into Long + latt///////////////////
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "geocode.xyz/" . $zipcode . "?region=KR&json=1&auth=364183126080998536780x77547");
        // return the transfer as a string, also with setopt()
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // curl_exec() executes the started curl session
        // $output contains the output string
        $output = curl_exec($curl);
        // close curl resource to free up system resources
        // (deletes the variable made by curl_init)
        curl_close($curl);

        $outputArray = json_decode($output, true); ////// convert API JSON output into an Array

        $latitude = strval($outputArray['latt']);
        $longitude = strval($outputArray['longt']);
    
        $req = $this->_connection->prepare("INSERT 
            INTO properties (user_uid, post_title, country, province_state, zipcode, latitude, longitude, city, district, address1, address2, size, property_type_id, room_type_id, monthly_price_won, description, bank_account_num, room_num, bed_num, bath_num, is_furnished) 
            VALUES (
                :uid, 
                :title,
                :country,
                :province,
                :zipcode, 
                :latitude,
                :longitude,
                :city,
                :district,
                :address1,
                :address2,
                :size,
                :propertyType,
                :roomType,
                :price,
                :description,
                :bankAccNum, 
                :roomNum, 
                :bedNum, 
                :bathNum, 
                :furnished)");

            $req->bindParam('uid',$uid,\PDO::PARAM_STR );
            $req->bindParam('title',$title,\PDO::PARAM_STR);
            $req->bindParam('country',$country,\PDO::PARAM_INT);
            $req->bindParam('province',$province,\PDO::PARAM_INT);
            $req->bindParam('zipcode',$zipcode,\PDO::PARAM_STR );
            $req->bindParam('latitude',$latitude,\PDO::PARAM_STR);
            $req->bindParam('longitude',$longitude,\PDO::PARAM_STR);
            $req->bindParam('city',$city,\PDO::PARAM_INT);
            $req->bindParam('district',$district,\PDO::PARAM_INT);
            $req->bindParam('address1',$address1,\PDO::PARAM_STR);
            $req->bindParam('address2',$address2,\PDO::PARAM_STR);
            $req->bindParam('size',$size,\PDO::PARAM_INT);
            $req->bindParam('propertyType',$propertyType,\PDO::PARAM_INT);
            $req->bindParam('roomType',$roomType,\PDO::PARAM_INT);
            $req->bindParam('price',$price,\PDO::PARAM_INT);
            $req->bindParam('description',$description,\PDO::PARAM_STR);
            $req->bindParam('bankAccNum',$bankAccNum,\PDO::PARAM_STR );
            $req->bindParam('roomNum',$roomNum,\PDO::PARAM_INT );
            $req->bindParam('bedNum',$bedNum,\PDO::PARAM_INT );
            $req->bindParam('bathNum',$bathNum,\PDO::PARAM_INT );
            $req->bindParam('furnished',$furnished,\PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        

        // Create a folder for the property on the server
        $propertyId = $this->_connection->query("SELECT id FROM properties ORDER BY ID DESC LIMIT 0, 1")->fetch(\PDO::FETCH_ASSOC)['id'];
        if (!file_exists("./public/images/property_images/$propertyId")) {
            mkdir("./public/images/property_images/$propertyId");
        }
        foreach ($imgs as $file) {
            $fileName = pathinfo($file["name"]);
            $extension  = $fileName['extension'];
            $fileLocation = $file["tmp_name"];
            $bytes = bin2hex(random_bytes(16)); // generates secure pseudo random bytes and bin2hex converts to hexadecimal string
            $imgName[] = $bytes . "." . $extension;
            move_uploaded_file($fileLocation, "./public/images/property_images/$propertyId/" . $imgName[count($imgName) - 1]);
        }

        for ($i = 0; $i < count($imgName); $i++) {
            $req = $this->_connection->prepare("INSERT
                INTO property_imgs (property_id, img_url, description) 
                VALUES (:propertyId, :imgName, :imgDescription)
            ");
            $req->bindParam('propertyId', $propertyId, \PDO::PARAM_INT);
            $req->bindParam('imgName', $imgName[$i], \PDO::PARAM_STR);
            $req->bindParam('imgDescription', $imgDescriptions[$i], \PDO::PARAM_STR);
            $req->execute();
            $req->closeCursor();
        }
        header("Location:index.php?action=property&propId={$propertyId}");
    }

    
    public function modifyProperty($propId, $imgs, $imgDescriptions, $oldImgs) {
        // INFO validation
        if ($propId < 0)
            throw (new Exception('Invalid property id'));

        if (strlen($_POST['title']) < 50 AND strlen($_POST['title']) > 0) {
            $title = strip_tags($_POST['title']);
        } else {
            throw (new Exception('Title is too long'));
        }

        if ($_POST['roomType'] > 0 and $_POST['roomType'] < 5) {
            $roomType = $_POST['roomType'];
        } else {
            throw (new TypeError("Invalid room type"));
        }

        if ($_POST['bedroom'] > 0 and $_POST['bedroom'] < 100) {
            $bedrooms = $_POST['bedroom'];
        } else {
            throw (new TypeError("Invalid room number"));
        }

        if($_POST['bath'] > 0 and $_POST['bath'] < 100) {
            $bathrooms = $_POST['bath'];
        } else {
            throw (new TypeError("Invalid room number"));
        }

        if (isset($_POST['furnished'])) {
            $furnished = 1;
            if ($_POST['bed']< 100) {
                $beds = $_POST['bed'];
            } else {
                throw (new TypeError("Invalid bed number"));
            }
        } else {
            $furnished = 0;
            $beds = 0;
        }

        if($_POST['price'] > 0) {
            $price = $_POST['price'];
        } else {
            throw (new TypeError("Invalid price"));
        }

        $description = strip_tags($_POST['description']);

        if(strlen($_POST['bankAccNum']) < 21 AND strlen($_POST['bankAccNum']) > 0) {
            $bankAccNum = strip_tags($_POST['bankAccNum']);
        } else {
            throw (new Exception('Bank Account Number is too long'));
        }
        // Img Check
        foreach ($imgDescriptions as &$desc) {
            if(strlen($desc) < 256 AND strlen($desc) > 0) {
                $desc = htmlspecialchars($desc);
            } else {
                throw (new Exception('Description must be less than 256 characters'));
            }
        }
        foreach ($imgs as $file) {
            if ($file['size'] > 1048576) {
                throw (new Exception('Image is too big'));
            }
        }
        $imgsToDelete = 0;
        foreach($oldImgs as $img=>&$desc) {
            if (preg_match("/^delete\+".$img."/", $desc)) {
                $imgsToDelete++;
            }
        }
        if (count($imgs)+count($oldImgs)-$imgsToDelete < 2) {
            throw (new Exception('At least 2 images'));
        }
        
        // Copying previous entry
        $copy = $this->_connection->prepare("INSERT INTO properties (user_uid, post_title, country, province_state, zipcode, city, district, address1, address2, size, property_type_id, room_type_id, monthly_price_won, description, bank_account_num, room_num, bed_num, bath_num, is_furnished, latitude, longitude)
        SELECT user_uid, post_title, country, province_state, zipcode, city, district, address1, address2, size, property_type_id, room_type_id, monthly_price_won, description, bank_account_num, room_num, bed_num, bath_num, is_furnished, latitude, longitude
        FROM properties
        WHERE id = :propId");
        $copy->bindParam('propId', $propId, \PDO::PARAM_INT);
        $copy->execute();
        $copy->closeCursor();
        
        $newPropId = $this->_connection->query("SELECT id FROM properties ORDER BY ID DESC LIMIT 0, 1")->fetch(\PDO::FETCH_ASSOC)['id'];
        $dest = "./public/images/property_images/$newPropId/";
        $src = "./public/images/property_images/$propId/";
        
        // Deleting images
        foreach($oldImgs as $img=>&$desc) {
            if (preg_match("/^delete\+".$img."/", $desc)) {
                $delete = $this->_connection->prepare("DELETE FROM property_imgs WHERE property_id=:propId AND img_url=:img");
                $delete->bindParam('img', $img, \PDO::PARAM_STR);
                $delete->bindParam('propId', $propId, \PDO::PARAM_INT);
                $delete->execute();
                $delete->closeCursor();
                unlink($src.$img);
            } else {
                $up = $this->_connection->prepare("UPDATE property_imgs SET property_id=$newPropId, description=:desc WHERE property_id=$propId AND img_url=:img");
                $up->bindParam('img', $img, \PDO::PARAM_STR);
                $up->bindParam('desc', $desc, \PDO::PARAM_STR);
                $up->execute();
                $up->closeCursor();
            }
        }

        // Create new folder for old images of updated property
        if (!file_exists($dest)) { 
            mkdir($dest);
        }
        // Getting all old images from the folder
        $files = glob($src."*.{"."jpg,png,gif"."}", GLOB_BRACE);
    
        // Move all old images from old folder into a new one
        if (count($files)>0) { 
            foreach ($files as $f) {
                $moveTo = $dest . basename($f);
                rename($f, $moveTo);
            }
        }

        // Move uploaded images into the folder
        foreach ($imgs as $file) {
            $fileName = pathinfo($file["name"]);
            $extension  = $fileName['extension'];
            $fileLocation = $file["tmp_name"];
            $bytes = bin2hex(random_bytes(16)); // generates secure pseudo random bytes and bin2hex converts to hexadecimal string
            $imgName[] = $bytes . "." . $extension;
            move_uploaded_file($fileLocation, "./public/images/property_images/$newPropId/" . $imgName[count($imgName) - 1]);
        }

        if (empty($imgName)) {
            $imgName = [];
        }

        // Deactivating previous entry
        $req = $this->_connection->prepare("UPDATE properties SET is_active = 0 WHERE id = :propId");
        $req->bindParam('propId', $propId, \PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
        
        // Updating copy of an old entry
        $update = $this->_connection->prepare("UPDATE properties 
        SET post_title=:title, 
            room_type_id=:roomType, 
            monthly_price_won=:price, 
            description=:description, 
            bank_account_num=:bankAccNum, 
            room_num=:bedrooms, 
            bath_num=:bathrooms, 
            is_furnished=:furnished, 
            bed_num=:beds 
        WHERE id=$newPropId");
        $update->bindParam('title', $title, \PDO::PARAM_STR);
        $update->bindParam('roomType', $roomType, \PDO::PARAM_INT);
        $update->bindParam('price', $price, \PDO::PARAM_INT);
        $update->bindParam('description', $description, \PDO::PARAM_STR);
        $update->bindParam('bankAccNum', $bankAccNum, \PDO::PARAM_STR);
        $update->bindParam('bedrooms', $bedrooms, \PDO::PARAM_INT);
        $update->bindParam('bathrooms', $bathrooms, \PDO::PARAM_INT);
        $update->bindParam('furnished', $furnished, \PDO::PARAM_INT);
        $update->bindParam('beds', $beds, \PDO::PARAM_INT);
        $update->execute();

        // Adding images into the database
        for ($i = 0; $i < count($imgName); $i++) {
            $res = $this->_connection->prepare("INSERT
                INTO property_imgs (property_id, img_url, description) 
                VALUES ('$newPropId', :imgName, :imgDescription)
            ");
            $res->bindParam('imgName', $imgName[$i], \PDO::PARAM_STR);
            $res->bindParam('imgDescription', $imgDescriptions[$i], \PDO::PARAM_STR);
            $res->execute();
            $res->closeCursor();
        }

        header("Location: index.php?action=property&propId={$newPropId}");
    }

    public function getReservations() {
        
        $req = $this->_connection->query("SELECT * FROM reservations WHERE property_id='{$_REQUEST['propId']}' AND is_active=1");
        $reservations = $req->fetchAll(\PDO::FETCH_ASSOC);
       
        return $reservations;
    }

}