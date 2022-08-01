function opacity (opacity, modalContainer) {
    modalContainer.style.opacity = opacity;
}
if (modalBox = document.getElementById("modalBox")) {
    function moveBanner() {
        let left = parseInt(getComputedStyle(banner).left);
        if (left > 0) {
            showSignup();
            banner.classList.remove('right', 'animate-right');
            banner.classList.add('left', 'animate-left');
            
        } else {
            showSignin();
            banner.classList.remove('left', 'animate-left');
            banner.classList.add('right', 'animate-right');
        }
    }

    function showSignup() {
        banner.innerHTML = '';
        let h1 = document.createElement('h1');
        h1.textContent = 'Welcome Back!';
        let h2 = document.createElement('h2');
        h2.textContent = 'Already have an account?';
        let h3 = document.createElement('h2');
        h3.textContent = 'Click button below to sign in.';
        let bttn = document.createElement('button');
        bttn.classList.add('primaryBtn', 'primaryColor');
        bttn.textContent = 'Sign in';
        bttn.addEventListener('click', moveBanner)
        banner.appendChild(h1);
        banner.appendChild(h2);
        banner.appendChild(h3 );
        banner.appendChild(bttn);
    }

    function showSignin () {
        banner.innerHTML = '';
        let h1 = document.createElement('h1');
        h1.textContent = 'New Here?';
        let h2 = document.createElement('h2');
        h2.textContent = 'Click button below to sign up.';
        let bttn = document.createElement('button');
        bttn.classList.add('primaryBtn', 'primaryColor');
        bttn.textContent = 'Sign up';
        bttn.addEventListener('click', moveBanner);
        banner.appendChild(h1);
        banner.appendChild(h2);
        banner.appendChild(bttn);
    }

    let banner = document.querySelector('#banner-container');
    let signInContainer = document.querySelector('#signIn-container');
    let signUpContainer = document.querySelector('#signUp-container');

    //// open the modal on SignUp/Sign In button click
    document.getElementById("signUpButton").addEventListener("click", function(e) {
        banner.style.left = 0; 
        banner.classList.remove('right','left', 'animate-right', 'animate-left');
        banner.classList.add('left');
        e.preventDefault()
        showSignup();
        modalBox.style.display = "block";
        setTimeout(opacity, 50, 1, modalBox);
        let x = window.matchMedia("(max-width: 1000px");
        if(x.matches) {
            signInContainer.style.display = 'none';
            signUpContainer.style.display = 'block';
        }
    })

    document.getElementById("signInButton").addEventListener("click", function(e) {
        banner.style.left = '50%';
        banner.classList.remove('right','left','animate-right', 'animate-left');
        banner.classList.add('right');
        e.preventDefault();
        showSignin();
        modalBox.style.display = "block";
        setTimeout(opacity, 50, 1, modalBox);
        let x = window.matchMedia("(max-width: 1000px");
        if(x.matches) {
            signUpContainer.style.display = 'none';
            signInContainer.style.display = 'block';
        }
    })

    //switch to register modal view on click
    document.querySelector('#registerNow').addEventListener('click', (e) => {
        e.preventDefault();
        signInContainer.style.display = 'none';
        signUpContainer.style.display = 'block';
    })

    document.querySelector('#signInNow').addEventListener('click', (e) => {
        e.preventDefault();
        signInContainer.style.display = 'block';
        signUpContainer.style.display = 'none';
    })

    window.addEventListener('resize', () => {
        let x = window.matchMedia("(min-width: 1000px");
        if(x.matches) {
            signUpContainer.style.display = 'none';
        }
    })

    // close the modal when click X
    document.querySelector(".close").addEventListener("click", function() {
        modalBox.style.display = "none";
        document.body.style.overflowY = "visible";
        opacity(0, modalBox);
    })

    // close the modal when click outside modal
    window.addEventListener("click", function(e) {
        if (e.target == modalBox) {
            modalBox.style.display = "none";
            document.body.style.overflowY = "visible";
            opacity(0, modalBox);
        }
    })
}