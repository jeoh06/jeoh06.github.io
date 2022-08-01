const viewOpenButton = document.querySelector(".allPropPhotos");
const photoModalContianer = document.querySelector(".photoModalContainer");
const viewCloseButton = document.querySelector(".pModalCloseButton");
const propertyImg = document.getElementsByClassName("allPropImgContainer");
let slideNum = 1;

// carousel functions //
function nextSlide(n) {
    displaySlides(slideNum += n);
}
  
function currentSlideD(n) {
    displaySlides(slideNum = n);
}
  
function displaySlides(n) {
    let i;
    let slides = document.getElementsByClassName("detailedImgSlides");
    let dots = document.getElementsByClassName("detailedImgDots");
    if (n > slides.length) {slideNum = 1};    
    if (n < 1) {slideNum = slides.length};
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    };
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" detailedImgDotsActive", "");
    };
    slides[slideNum-1].style.display = "block";
    dots[slideNum-1].className += " detailedImgDotsActive";
}

// let modalBox = document.querySelector("#modalBox");
viewOpenButton.addEventListener("click", function(e) { 
    e.preventDefault();
    photoModalContianer.classList.add("showP");
    document.documentElement.classList.add("disableScroll");

});

viewCloseButton.addEventListener("click", function(e) {
    e.preventDefault();
    photoModalContianer.classList.remove("showP");
    document.documentElement.classList.remove("disableScroll");
});


// detailed property photo view //
const detailedPhotoView = document.querySelector(".detailedPhotoView");
const detailedCloseButton = document.querySelector(".detailedCloseButton");

for(let i = 0; i < propertyImg.length; i++){
    propertyImg[i].addEventListener("click", function(e){
        e.preventDefault();
        detailedPhotoView.classList.add("showP"); 
        slideNum = i + 1;
        displaySlides(slideNum);
    });
};

detailedCloseButton.addEventListener("click", function(e) {
    e.preventDefault();
    detailedPhotoView.classList.remove("showP");
});


