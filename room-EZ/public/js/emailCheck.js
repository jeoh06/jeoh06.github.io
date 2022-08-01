let signUpForm = document.querySelector("#signUpForm");
signUpForm.addEventListener('submit', verifyEmail);
    
function verifyEmail(e){
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.open('GET', `index.php?action=checkSignUp&email=${signUpForm.email.value}`);
    xhr.onload = function () {
        if (xhr.status == 200) {
            if (xhr.responseText==1) {
                signUpForm.submit();
            } else {
                let emailErrorText = document.querySelector(".emailErrorText");
                emailErrorText.classList.remove('emailErrorText');
            }
        } 
    }
    xhr.send();
}