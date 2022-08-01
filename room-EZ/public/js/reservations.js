let owner = document.querySelector('#owner');
let number = document.querySelector('#cardNumber');
let cvv = document.querySelector('#cvv');  
let confirmButton = document.querySelector('#confirm-purchase');
let ownerC = document.querySelector('.ownerC');
let cardNumC = document.querySelector('.cardNumC');
let cvvC = document.querySelector('.cvvC');

function checkCardholder(){
    let regex = /^(?![\s.]+$)[A-Z\-a-z\s.]{2,}$/;
    if (regex.test(owner.value)) {
        owner.classList.add('green');
        owner.classList.remove('red'); 
        ownerC.nextElementSibling.classList.add('nameError'); 
        return true;
    }
    else {
        owner.classList.add('red');
        owner.classList.remove('green');
        ownerC.nextElementSibling.classList.remove('nameError'); 
        return false; 
    }
}

function checkCardNumber(){
    let regex = /^4[0-9]{12}(?:[0-9]{3})?|(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}|3[47][0-9]{13}$/;
    if (regex.test(number.value.replace(/-/g, ''))) {
        number.classList.add('green');
        number.classList.remove('red'); 
        cardNumC.nextElementSibling.classList.add('numError'); 
        return true;
    }
    else {
        number.classList.add('red');
        number.classList.remove('green');
        cardNumC.nextElementSibling.classList.remove('numError'); 
        return false; 
    }
}

function checkCVV(){
    let regex = /^[0-9]{3,4}$/;
    if (regex.test(cvv.value)) {
        cvv.classList.add('green');
        cvv.classList.remove('red'); 
        cvvC.nextElementSibling.classList.add('cvvError'); 
        return true;
    }
    else {
        cvv.classList.add('red');
        cvv.classList.remove('green');
        cvvC.nextElementSibling.classList.remove('cvvError'); 
        return false; 
    }
}


function resetForm(){
    document.getElementById('paymentForm').reset(); 
}

function dateDiff(){
    var d2 = document.getElementById("startDate").value;
    var d1 = document.getElementById("endDate").value;
  
    var t2 = new Date(d2);
    var t1 = new Date(d1);

    var currentLocation = window.location.href;
    var url = new URL(currentLocation);
    var price = url.searchParams.get("price");

    for (let i = 0; i < price.length; i++){
        price = price.replace(',', ''); // go through all the characters and replace commas if they are present
    }

    if (((t1 - t2) / (24 * 3600 * 1000)) >= 30){
        document.getElementById("dateBtn").innerHTML = "Your total price is " + Math.round(((t1 - t2) / (24 * 3600 * 1000))/30 * parseInt(price)).toLocaleString('en-US') + "₩"; 
    }
    else {
        document.getElementById("dateBtn").innerHTML = "Minimum stay is 30 days. Please enter new dates"; 
    }
}

owner.addEventListener('keyup', checkCardholder);
number.addEventListener('keyup', checkCardNumber);
cvv.addEventListener('keyup', checkCVV);

let datePicker = document.getElementById('datepicker');
let hiddenContainer = document.querySelector('.hiddenContainer');

datePicker.addEventListener('click', function(e){
    e.preventDefault();
    hiddenContainer.classList.add('showC');
    // hiddenContainer.classList.add('placeAbove');
});

hiddenContainer.addEventListener('click', function(e){
    e.preventDefault();
    hiddenContainer.classList.remove('showC');
    // hiddenContainer.classList.remove('placeAbove');
    datePicker.value = "";
});

function formatCreditCard() {
    var x = document.getElementById("cardNumber");
    var index = x.value.lastIndexOf('-');
    var test = x.value.substr(index + 1);
    if (test.length === 4 && x.value.length < 19)
         x.value = x.value + '-';
}



