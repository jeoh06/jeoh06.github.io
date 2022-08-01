let aboutUsModal = document.getElementById("footerAboutUsModal")
//// open the modal on aboutUs button click
document.getElementById("aboutUs").addEventListener("click", function(e) {
  e.preventDefault()
  aboutUsModal.style.display = "block";
  document.body.style.overflow = "hidden";
  document.body.style.height = "100%";
  setTimeout(opacity, 50, 1, aboutUsModal);
})

// close the modal when click X
document.querySelector("#footerAboutUsModal .close").addEventListener("click", function() {
  aboutUsModal.style.display = "none";
  document.body.style.overflow = "auto";
  document.body.style.height = "auto";

  opacity(0, aboutUsModal);
})

// close the modal when click outside modal
window.addEventListener("click", function(e) {
if (e.target == aboutUsModal) {
  aboutUsModal.style.display = "none";
  document.body.style.overflow = "auto";
  document.body.style.height = "auto";

  opacity(0, aboutUsModal);
}
})

let privacyModal = document.getElementById("footerPrivacyModal");
//// open the modal on privacy button click
document.getElementById("privacy").addEventListener("click", function(e) {
    e.preventDefault()
    privacyModal.style.display = "block";
    setTimeout(opacity, 50, 1, privacyModal);
})

// close the modal when click X
document.querySelector("#footerPrivacyModal .close").addEventListener("click", function() {
    privacyModal.style.display = "none";
    document.querySelector("body").style.overflowY = "visible";
    opacity(0,privacyModal);
})

// close the modal when click outside modal
window.addEventListener("click", function(e) {
  if (e.target == privacyModal) {
    privacyModal.style.display = "none";
    document.querySelector("body").style.overflowY = "visible";
    opacity(0, privacyModal);
  }
})

let termsModal = document.getElementById("footerTermsModal")
//// open the modal on terms button click
document.getElementById("terms").addEventListener("click", function(e) {
  e.preventDefault()
  termsModal.style.display = "block";
  setTimeout(opacity, 50, 1, termsModal);
})

// close the modal when click X
document.querySelector("#footerTermsModal .close").addEventListener("click", function() {
  termsModal.style.display = "none";
  document.querySelector("body").style.overflowY = "visible";
  opacity(0, termsModal);
})

// close the modal when click outside modal
window.addEventListener("click", function(e) {
if (e.target == termsModal) {
  termsModal.style.display = "none";
  document.querySelector("body").style.overflowY = "visible";
  opacity(0, termsModal);
}
})