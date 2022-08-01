// function to determine number of days in select input
function checkDays() {
    let days30 = [4, 6, 9, 11];
    let days31 = [1, 3, 5, 7, 8, 10, 12];
    let birthMonth = parseInt(months.value);
    let daysInMonth;

    days.innerHTML = "";

    if (birthMonth === 2) {
        if ((years.value % 100 === 0 && years.value % 400 === 0) || (years.value % 100 !== 0 && years.value % 4 === 0)) {
            daysInMonth = 29;
        } else {
            daysInMonth = 28;
        }
    } else if (days30.includes(birthMonth)) {
        daysInMonth = 30;
    } else if (days31.includes(birthMonth)) {
        daysInMonth = 31;
    }

    for (let i = 1; i <= daysInMonth; i++) {
        let option = document.createElement("option");
        option.value = i;
        option.textContent = i;
        days.appendChild(option);
    }
}

const imgDiv = document.querySelector('#profilePhoto');
const file = document.querySelector('#fileM');
const uploadButton = document.querySelector('#uploadButtonM');
let profileForm = document.querySelector('#newProfile');
let contact;
let profilePic = document.querySelector('#file');
let phoneNum = document.querySelector('#phoneNum');
const inputBoxes = document.querySelectorAll('input');
let years = document.querySelector('#year');
let months = document.querySelector('#month');
let days = document.querySelector('#day');
let gender = document.querySelector('input[name="gender"]:checked');
let languages = document.querySelectorAll('.list input[type="checkbox"]');
let langArray = [];
let userLang = document.querySelector('#userLang');
let bio = document.querySelector('#bio');
let imgError = document.createElement('div');
imgError.style.marginTop = '0.625rem';
imgDiv.parentNode.appendChild(imgError);

// change the photo by choosing the different files
// file.addEventListener('change', function () {
//     imgContainer.innerHTML = "";
//     const chosenFile = this.files[0];
//     let fileSize = chosenFile.size;
//     let fileType = chosenFile.name.split('.').pop();

//     let fileTypeReg = /(jpg|jpeg|png|webp)/i;
//     let validFileType = fileTypeReg.test(fileType);

//     imgError.textContent = "";
//     if (fileSize > 500000 || (!validFileType && fileType !== "")) {
//         if (fileSize > 500000) {
//             return imgError.textContent = "Sorry, your file is too large";
//         } else {
//             return imgError.textContent = "Images must be in jpeg, jpg, png, or webp format";
//         }
//     }

//     let img = document.createElement('img');

//     if (chosenFile) {
//         const reader = new FileReader();

//         reader.addEventListener('load', function () {
//             img.setAttribute('src', reader.result);
//         });

//         reader.readAsDataURL(chosenFile);
//     }

//     imgContainer.appendChild(img);
// });

// change the photo by choosing the different files
file.addEventListener('change', function () {
    // refers to the file
    const img = document.createElement('img');
    const chosenFile = this.files[0];
    if (chosenFile) {
        const reader = new FileReader();

        reader.addEventListener('load', function () {
            img.setAttribute('src', reader.result);
        });

        reader.readAsDataURL(chosenFile);
    }

    imgDiv.appendChild(img);
});

// if user hovers on the profile photo, displays the choose photo button
imgDiv.addEventListener('mouseenter', function () {
    uploadButton.style.display = "block";
});

imgDiv.addEventListener('mouseleave', function () {
    uploadButton.style.display = "none";
});


// test if user phone # is valid
let regexp = /^\+?[0-9]{7,14}$/;
let validNum = regexp.test(phoneNum.value);

// list of years for birthday
let currentYear = new Date().getFullYear();
for (let i = currentYear - 19; i >= currentYear - 120; i--) {
    let option = document.createElement("option");
    option.value = i;
    option.textContent = i;
    years.appendChild(option);
}

checkDays();

months.addEventListener('change', () => {
    checkDays();
})

years.addEventListener('change', () => {
    checkDays();
})

for (i = 0; i < languages.length; i++) {
    languages[i].addEventListener('change', (e) => {
        if (e.target.checked) {
            langArray.push(e.target.value);
        } else if (!e.target.checked) {
            langArray = langArray.filter(lang => lang != e.target.value);
        }
        userLang.value = langArray;
    })
}

// profileForm.addEventListener('submit', (e) => {
//     if (!(validNum || gender.value || userLang.value || bio.value)) {
//         e.preventDefault();
//         let alert = document.querySelector('#line1 p');
//         if (!alert.textContent) {
//             alert.textContent = "Please check that all fields were filled out correctly";
//         }
//     }
// })

// hide and show message
const display = function (element) {
    alertMesg.style.display = "none";
    if (element.classList.contains("red")) {
        alertMesg.style.display = "block";
    }
}

// function to check the condition
const countStr = function (phoneNum) {
    let count = phoneNum.value.length; // add more condition
    if (count < 11 || count >= 15) {
        phoneNum.classList.remove("green");
        phoneNum.classList.add("red"); // display the input box in red color
    } else {
        phoneNum.classList.remove("red");
        phoneNum.classList.add("green");
    }
    display(phoneNum); // display the alert message
}

// to alert the user while they type their phone number
inputBoxes[2].addEventListener('change', function () {
    countStr(phoneNum);
});

// closes languages list when clicking outside .select-field
window.addEventListener("click", (e) => {
    let langMenu = document.querySelector('#language .select-field');
    let langList = langMenu.nextElementSibling
    if (e.target == langMenu || langMenu.contains(e.target)) {
        document.querySelector('#language .list').classList.toggle('show');
        document.querySelector('#language .down-arrow').classList.toggle('rotate180');
    } else if (langList != e.target && !langList.contains(e.target)){
        document.querySelector('#language .list').classList.remove('show');
        document.querySelector('#language .down-arrow').classList.remove('rotate180');
    }
})