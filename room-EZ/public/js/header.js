// let provinceSearch = document.querySelector('#province');
// let citySearch = document.querySelector('#city');
// provinceSearch.addEventListener('change', function(e) {
//     let xhr = new XMLHttpRequest();
//     xhr.open('GET', `index.php?action=getCities&province=${e.target.options[e.target.selectedIndex].text}`);
//     xhr.onload = function (e) {
//         if (xhr.status == 200) {
//             citySearch.innerHTML = xhr.responseText;
//         }
//     }
//     xhr.send(null)
// })

///////////SIGN OUT TOAST BUTTON//////////////
document.addEventListener("DOMContentLoaded", function (e) {
    let msg = document.querySelector(".toast")
    if (msg) msg.style.display = "flex";
})