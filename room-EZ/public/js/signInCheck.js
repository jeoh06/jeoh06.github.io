let signInForm = document.querySelector("#signInForm");
signInForm.addEventListener('submit', checkInput);
    
function checkInput(e){
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.open('GET', `index.php?action=checkSignIn&email=${signInForm.email.value}&password=${signInForm.password.value}`);
    xhr.onload = function () {
        if (xhr.status == 200) {
            if (xhr.responseText==1) {
                signInForm.submit();
            } else {
                let errorText = document.querySelector(".errorText");
                errorText.classList.remove('errorText');
            }
        } 
    }
    xhr.send();
}


  