<?php
    require_once('./model/UserManager.php');
    use wcoding\batch16\finalproject\Model\PropertyManager;

    function listProperties() {
        $propertyM = new PropertyManager();
        $properties = $propertyM->getProperties();
    
        return $properties;
    }
    
    function getLanding() {
        $properties = listProperties();
        // $userM = new UserManager(); 
        // $data = $userM->viewUserData();
        require('./view/indexView.php');
    }
    
    function getProperty($propId) {
        $propertyM = new PropertyManager();
        $propDetails = $propertyM->getProperty($propId);
        $propOwner = $propertyM->getPropertyOwner($propId);
    
        require('./view/detailedPropertyView.php');
    }
    
    function getPropertyOwner($propId) {
        $propertyM = new PropertyManager();
        $propOwner = $propertyM->getPropertyOwner($propId);
    
        require('./view/detailedPropertyView.php');
    }
    
    function postProperty($params, $imgs) {
        $propertyM = new PropertyManager();
        for($i=0; $i<count($imgs); $i++) {
            $imgDescriptions[] = $params["t-attachment-$i"];
        }
        if (!empty($params['furnished'])) {
            $propertyM->postProperty($params['title'], $params['country'], $params['province'], $params['city'], $params['district'], $params['address1'], $params['address2'], $params['zipcode'], $params['propertyType'], $params['roomType'], $params['roomNum'], $params['bedNum'], $params['bathNum'],$params['furnished'], $params['size'], $params['price'], $params['description'], $params['bankAccNum'], $imgs, $imgDescriptions);
        } else {
            $propertyM->postProperty($params['title'], $params['country'], $params['province'], $params['city'], $params['district'], $params['address1'], $params['address2'], $params['zipcode'], $params['propertyType'], $params['roomType'], $params['roomNum'], null, $params['bathNum'], null, $params['size'], $params['price'], $params['description'], $params['bankAccNum'], $imgs, $imgDescriptions);
        }
    }
    
    function viewPostProperty() {
        require('view/postPropertyView.php');
    }

    function prefillProperty($propId) {
        if(isset($_SESSION['uid']) and $_SESSION['uid'] === $_SESSION['user_uid']) {
            $propertyM = new PropertyManager();
            $propDetails = $propertyM->prefillProperty($propId);
            
            require('./view/modifyProperty.php');
        } else {
            header('Location: index.php');
        }
    }
    
    function modifyProperty($params, $imgs) {
        if(isset($_SESSION['uid']) and $_SESSION['uid'] === $_SESSION['user_uid']) {
            $propertyM = new PropertyManager();
            for($i=0; $i<count($imgs); $i++) {
                $imgDescriptions[] = $params["t-attachment-$i"];
            }
            $i = 0;
            while(true) {
                if (!empty($_POST["imgName-$i"]) AND !empty($_POST["t-imgName-$i"])) {
                    if (strlen($_POST["t-imgName-$i"])>255) {
                        throw (new Exception('Title is too long'));
                    } else {
                        $oldImgs[strip_tags($_POST["imgName-$i"])] = strip_tags($_POST["t-imgName-$i"]);
                        $i++;
                    }
                } else
                    break;
            }
            if (empty($oldImgs)) {
                $oldImgs = [];
            }

            if (empty($imgDescriptions)) {
                $imgDescriptions = [];
            }
    
            $propertyM->modifyProperty($params['propId'], $imgs, $imgDescriptions, $oldImgs);
    
        } else {
            header("Location: index.php?action=property&propId={$params['propId']}");
        }
    }