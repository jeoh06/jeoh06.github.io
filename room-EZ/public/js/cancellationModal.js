let cancellationModal = document.getElementById("cancellationModal"),
	formsContainer = document.getElementById("cancellation"),
	confirmButton = document.querySelector('.confirmButton')
//// open the modal on aboutUs button click
for(let i=0; i<formsContainer.children.length; i++)
{
	let form = formsContainer.children[i];
	form.addEventListener("submit", function(e) {
		e.preventDefault()
		cancellationModal.style.display = "block";
		setTimeout(opacity, 50, 1, cancellationModal);
		confirmButton.onclick = function(e) {
			form.submit();
		}
	})
}

// close the modal when click X
document.querySelector("#cancellationModal .close").addEventListener("click", function() {
	cancellationModal.style.display = "none";
	document.querySelector("body").style.overflowY = "visible";
	opacity(0, cancellationModal);
})

document.querySelector("#cancellationModal .closeButton").addEventListener("click", function() {
	cancellationModal.style.display = "none";
	document.querySelector("body").style.overflowY = "visible";
	opacity(0, cancellationModal);
})

// close the modal when click outside modal
window.addEventListener("click", function(e) {
	if (e.target == cancellationModal) {
		cancellationModal.style.display = "none";
		document.querySelector("body").style.overflowY = "visible";
		opacity(0, cancellationModal);
	}
})

