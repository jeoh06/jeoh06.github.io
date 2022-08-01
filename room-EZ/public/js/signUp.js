let firstName = document.querySelector('#firstName');
let lastName = document.querySelector('#lastName'); 
let email = document.querySelector('#email'); 
let password = document.querySelector('#password');
let passwordConfirm = document.querySelector('#passwordConfirm');
let signUpForm = document.querySelector('#signUpForm'); 
let reset = document.querySelector('#reset'); 

lastName.addEventListener('keyup', checkLastName);
firstName.addEventListener('keyup', checkFirstName);
email.addEventListener('keyup', checkEmail)
password.addEventListener('keyup', checkPassword);
passwordConfirm.addEventListener('keyup', checkPasswordConfirm); 
signUpForm.addEventListener('submit', submitForm); 
reset.addEventListener('click', resetForm); 

function checkFirstName() {
    let regex = /^(?![\s.]+$)[A-Z\-a-z\s.]{2,}$/;
    if (regex.test(firstName.value)) {
        firstName.classList.add('green');
        firstName.classList.remove('red'); 
        firstName.nextElementSibling.classList.add('nameError'); 
        return true;
    }
    else {
        firstName.classList.add('red');
        firstName.classList.remove('green');
        firstName.nextElementSibling.classList.remove('nameError'); 
        return false; 
    }
    }

function checkLastName() {
let regex = /^(?![\s.]+$)[A-Z\-a-z\s.]{2,}$/;
if (regex.test(lastName.value)) {
    lastName.classList.add('green');
    lastName.classList.remove('red'); 
    lastName.nextElementSibling.classList.add('lastNameError');  
    return true;
}
else {
    lastName.classList.add('red');
    lastName.classList.remove('green');
    lastName.nextElementSibling.classList.remove('lastNameError');
    return false; 
}
}

function checkEmail() {
let regex = /^[a-z.0-9_-]+@[a-z0-9_-].{2,}.[a-z.]{2,4}?[a-z]{2,4}$/i;
if (regex.test(email.value)) {
    email.classList.add('green');
    email.classList.remove('red'); 
    email.nextElementSibling.classList.add('emailError'); 
    return true;
}
else {
    email.classList.add('red');
    email.classList.remove('green');
    email.nextElementSibling.classList.remove('emailError'); 
    return false; 
}
}

function checkPassword() {
let regex = /^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/; 
if (regex.test(password.value)) {
    password.classList.add('green');
    password.classList.remove('red'); 
    password.nextElementSibling.classList.add('passwordError'); 
    return true;
}
else {
    password.classList.add('red');
    password.classList.remove('green');
    password.nextElementSibling.classList.remove('passwordError'); 
    return false; 
}
}

function checkPasswordConfirm() {
    if(password.value === passwordConfirm.value){
    passwordConfirm.classList.add('green');
    passwordConfirm.classList.remove('red'); 
    passwordConfirm.nextElementSibling.classList.add('passwordConfirmError'); 
    return true
    }
    else {
    passwordConfirm.classList.add('red');
    passwordConfirm.classList.remove('green');
    passwordConfirm.nextElementSibling.classList.remove('passwordConfirmError'); 
    return false
    }
}

function submitForm(e) {

    e.preventDefault();
    if(checkLastName() && checkFirstName() && checkEmail() && checkPassword() && checkPasswordConfirm()) {
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?action=signUp');
        
        var form = document.querySelector('#signUpForm'),
        formData = new FormData(form);
        xhr.addEventListener('readystatechange', function() {
            if (xhr.readyState === 4) {
                if (xhr.responseText == "1") //1 denotes if email is already in the database
                {
                    alert("Email is already registered. Please use another email or sign in using an existing account."); 
                } else {
                    document.querySelector("#signUp-container").innerHTML = ""
                    document.querySelector("#signUp-container").innerHTML = "Sign Up Successful! Please sign in"
                }
            }
        });
        
        // xhr.send();
        xhr.send(formData);


    } 
    // else {
    //     e.preventDefault();
    // }
}

// function verifyEmail(e) {
//     if(checkEmail() && checkPassword() && checkPasswordConfirm()) {
//         var xhr = new XMLHttpRequest();
//         xhr.open('POST', 'index.php?action=signUp');



//         xhr.send();
//         e.preventDefault();

//         document.querySelector("#signUp-container").innerHTML = ""
//         document.querySelector("#signUp-container").innerHTML = "Sign Up Successful! Please sign in"
//         document.querySelector("#signUp-container").innerHTML = "Account Created. Please sign in to complete the registration process." //////////// New Div
//         // let confirmationText = document.createElement(h4);
//         // h4.textContent = "Account created. Please sign in to complete the process";
        

//     } else {
//         e.preventDefault();
//     }
// }

function resetForm() {
    document.getElementById('myForm').reset(); 
}