<?php
require('controller/controller.php');

//TODO put in password conditions

session_start();
try {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
    if (!empty($_SESSION['email'])) {
        updateLastActive();
    }
    switch ($action) {
        case 'googleOauth':
            googleOauth($_REQUEST);
            break;
            // catching users trying to bypass front-end check
        case 'wrongPassword':
            throw (new Exception('You tried to sign in using wrong password.'));
        case 'signIn':
            if (!empty($_REQUEST['password']) and !empty($_REQUEST['email'])) {
                signIn($_REQUEST);

            } else {
                throw (new Exception('You tried to sign in without a password.'));
            }
            break;
            // case for ajax request to check if email/password are correct without refreshing the page
        case 'checkSignIn':
            checkSignIn($_REQUEST);
            break;
        case 'signOut':
            signOut();
            break;
        case 'loggedIn':
            getLanding();
            include("view/toaster.php"); ///// Notification toaster
            break;
        case 'loggedOut':
            getLanding();
            include("view/toaster.php"); ///// Notification toaster
            break;
        case 'profile':
            showUserInfo($_REQUEST['action'], $_REQUEST['user']);
            break;
        case 'listProperties':
            listProperties();
            break;
        case 'property':
            getProperty($_REQUEST['propId']);
            break;
        case 'signUp':
            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}+$#", $_POST['email'])  and !empty($_POST['firstName']) and !empty($_POST['lastName']) and !empty($_POST['password']) and !empty($_POST['passwordConfirm']) and $_POST['passwordConfirm'] == $_POST['password'] and preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $_POST['password']) and preg_match('/^(?![\s.]+$)[A-Z\-a-z\s.]{2,}$/', $_POST['firstName']) and preg_match('/^(?![\s.]+$)[A-Z\-a-z\s.]{2,}$/', $_POST['lastName'])) {
                signUp($_REQUEST);
            }
            break;
        
        case 'createProfile':
            createProfile();
            break;

        case 'checkProfile':
            checkProfile();
            break;
        case 'modifyProfile':
            modifyProfileView($_REQUEST['user']);
            break;

        case 'updateUserData':
            if (!empty($_REQUEST['language']) or !empty($_REQUEST['phone_number']) or !empty($_REQUEST['bio']) or !empty($_FILES["uploadFile"]["name"])) {
                updateProfile();
            }
            break;


            //Search//
        case 'search':
            $_REQUEST['province'] = !empty($_REQUEST['province']) ? strip_tags($_REQUEST['province']) : 'any';
            $_REQUEST['province'] = $_REQUEST['province'] == -1 ? 'any' : $_REQUEST['province'];
            $_REQUEST['city'] = !empty($_REQUEST['city']) ? strip_tags($_REQUEST['city']) : 'any';
            $_REQUEST['city'] = $_REQUEST['city'] == -1 ? 'any' : $_REQUEST['city'];
            search($_REQUEST);
            break;
        case 'postProperty':
            $bedNum = (!empty($_REQUEST['furnished']) and !empty($_REQUEST['bedNum'])) ? !empty($_REQUEST['bedNum']) : empty($_REQUEST['furnished']) and empty($_REQUEST['bedNum']) ? true : false;
            $_REQUEST['district'] = (!empty($_REQUEST['city']) and $_REQUEST['city'] == -1) ? -1 : $_REQUEST['district'];
            if (
                !empty($_REQUEST['title'])
                and !empty($_SESSION['email'])
                and !empty($_REQUEST['city'])
                and !empty($_REQUEST['country'])
                and !empty($_REQUEST['province'])
                and !empty($_REQUEST['address1'])
                and !empty($_REQUEST['zipcode'])
                and !empty($_REQUEST['propertyType'])
                and !empty($_REQUEST['roomType'])
                and !empty($_REQUEST['size'])
                and !empty($_REQUEST['price'])
                and !empty($_REQUEST['description'])
                and count($_FILES) >= 2
                and count($_FILES) <= 20
                and !empty($_REQUEST['bankAccNum'])
                and !empty($_REQUEST['roomNum'])
                and !empty($_REQUEST['bathNum'])
                and $bedNum
                and !empty($_REQUEST['district'])
            ) {
                for ($i = 0; $i < count($_FILES); $i++) {
                    if (empty($_REQUEST["t-attachment-$i"])) {
                        throw (new Exception("Message description is empty"));
                    }
                }
                postProperty($_REQUEST, $_FILES);
            }

            break;

        case 'prefillProperty':
            prefillProperty($_REQUEST['propId']);
            break;

        case 'modifyProperty':
            // for ($i = 0; $i < count($_FILES); $i++) {
            //     if (empty($_REQUEST["t-attachment-$i"])) {
            //         throw (new Exception("Message description is empty"));
            //     }
            // }
            modifyProperty($_REQUEST, $_FILES);
            break;
        case 'viewPostProperty':
            if (!empty($_SESSION['email'])) {
                viewPostProperty();
            } else {
                header('Location:index.php');
            }
            break;
        case 'getCities':
            if (!empty($_REQUEST['province'])) {
                getCities($_REQUEST['province']);
            }
            break;
        case 'getDistricts':
            if (!empty($_REQUEST['city'])) {
                getDistricts($_REQUEST['city']);
            }
            break;
        case 'reservations':
            reservationView();
            break;
        case 'addReservationInfo':
            if (preg_match('/^(?![\s.]+$)[A-Z\-a-z\s.]{2,}$/', $_POST['owner']) and preg_match('/^4[0-9]{12}(?:[0-9]{3})?|(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}|3[47][0-9]{13}$/', str_replace('-','',$_POST['cardNumber'])) and preg_match('/^[0-9]{3,4}$/', $_POST['cvv']) and preg_match('/^([0][1-9])|([1][0-2])$/', $_POST['month']) and preg_match('/^([2][2-7])$/', $_POST['year'])){
                addReservationInfo($_REQUEST);
            }
            break;
        case 'cancelReservation':
            cancelReservation($_REQUEST);
            break;
        default:
            getLanding();
            break;
        
        case 'reserveComplete':
            getLanding();
            include("view/reserveToaster.php"); ///// reservation toaster
            break;
        case 'reserveIncomplete':
            getLanding();
            include("view/reserveToaster.php"); ///// reservation toaster
            break;
    }
} catch (Exception $e) {
    die('error' . $e->getMessage());
}
