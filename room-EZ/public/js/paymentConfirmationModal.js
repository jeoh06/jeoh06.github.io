let paymentConfirmModal = document.getElementById("paymentConfirmModal")
//// open the modal on aboutUs button click
document.getElementById("aboutUs").addEventListener("click", function(e) {
  e.preventDefault()
  paymentConfirmModal.style.display = "block";
  setTimeout(opacity, 50, 1, paymentConfirmModal);
})

// close the modal when click X
document.querySelector("#paymentConfirmModal .close").addEventListener("click", function() {
  paymentConfirmModal.style.display = "none";
  document.querySelector("body").style.overflowY = "visible";
  opacity(0, paymentConfirmModal);
})

// close the modal when click outside modal
window.addEventListener("click", function(e) {
if (e.target == paymentConfirmModal) {
  paymentConfirmModal.style.display = "none";
  document.querySelector("body").style.overflowY = "visible";
  opacity(0, paymentConfirmModal);
}
})