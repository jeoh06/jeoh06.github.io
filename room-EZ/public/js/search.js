/////////// trigger search on icon click//////////////
    // Search Bar Carousel
function currentSearch(n) {
    showSearch(n);
}

function showSearch(n) {
    let i;
    let slides = document.getElementsByClassName("searchBarSlides");
    let dots = document.getElementsByClassName("searchBarDots");
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" searchBarDotActive", "");
    }
    slides[n-1].style.display = "flex";
    dots[n-1].className += " searchBarDotActive";
}

function loadSearch(e) {
    e.preventDefault()
    const xhr = new XMLHttpRequest()

    ////// LOAD THE ROUTER with action "Search"////////
    xhr.open("post", `index.php`)
    let formData = new FormData(e.target)
    let ranges = range.noUiSlider.get()
    formData.append('rangeMin', ranges[0].replace(/[( ₩),]/g, ''))
    formData.append('rangeMax', ranges[1].replace(/[( ₩),]/g, ''))
    ////// Response = searchResultsCard with $_get parameters loaded in xhr.open above //////////
    xhr.addEventListener("load", function(e) {
        if (e.target.status === 200) {
            document.querySelector("section").innerHTML = ""
            document.querySelector("section").innerHTML = xhr.responseText
            
            let coords = []
            
            for (let i=0; i<document.querySelectorAll("input.postTitle").length; i++)
            {
                let coord = {
                    "title" : document.querySelectorAll("input.postTitle")[i].value,
                    "content" : document.querySelectorAll("input.content")[i].value,
                    "link" : document.querySelectorAll("input.link")[i].value,
                    "latitude" : parseFloat(document.querySelectorAll("input.latitude")[i].value),
                    "longitude" : parseFloat(document.querySelectorAll("input.longitude")[i].value)
                }
                coords.push(coord)
            }
            searchMap(coords);
            
        } else {
            window.location = 'index.php';
        }
    })

    xhr.send(formData)
}

function instantiate (){
    let searchBar = document.querySelector("#searchBarContainer");

    //// CLICK ICON///////

    searchBar.addEventListener("submit", loadSearch)
    let formContainer = document.querySelector("#formContainer");
    let searchForm = document.querySelector('#searchForm');
    let regionSearch = document.querySelector("#regionSearch");
    let priceSearch = regionSearch.nextElementSibling;
    let propertyTypeSearch = priceSearch.nextElementSibling;
    let propertySearchMenu = document.querySelector('.propertySearchBar');
    let propertyList = propertySearchMenu.nextElementSibling;
    let roomSearchMenu = document.querySelector('.roomSearchBar');
    let roomList = roomSearchMenu.nextElementSibling;
    let provinceSearchMenu = document.querySelector('.provinceSearchBar');
    let provinceList = provinceSearchMenu.nextElementSibling;
    let citySearchMenu = document.querySelector('.citySearchBar');
    let cityList = citySearchMenu.nextElementSibling;

    regionSearch.addEventListener('click', e=> {
        currentSearch(1);
        formContainer.style.display = 'block';
        searchForm.style.display = 'block';
    })
    priceSearch.addEventListener('click', e=> {
        currentSearch(2);
        formContainer.style.display = 'block';
        searchForm.style.display = 'block';
    })
    propertyTypeSearch.addEventListener('click', e=> {
        currentSearch(3);
        formContainer.style.display = 'block';
        searchForm.style.display = 'block';
    })

    let inputs = roomList.querySelectorAll('input')
    for (let i=0; i<inputs.length; i++) {
        inputs[i].addEventListener('click', (e)=> {
            roomSearchMenu.firstElementChild.textContent = e.target.nextSibling.textContent
        })
    };

    inputs = propertyList.querySelectorAll('input')
    for (let i=0; i<inputs.length; i++) {
        inputs[i].addEventListener('click', (e)=> {
            propertySearchMenu.firstElementChild.textContent = e.target.nextSibling.textContent
        })
    };

    inputs = provinceList.querySelectorAll('input')
    for (let i=0; i<inputs.length; i++) {
        inputs[i].addEventListener('click', (e)=> {
            provinceSearchMenu.firstElementChild.textContent = e.target.nextSibling.textContent
            let xhr = new XMLHttpRequest();
            xhr.open('GET', `index.php?action=getCities&province=${e.target.nextSibling.textContent}`);
            xhr.onload = function (e) {
                if (xhr.status == 200) {
                    cityList.innerHTML = xhr.responseText
                    inputs = cityList.querySelectorAll('input')
                    for (let i=0; i<inputs.length; i++) {
                        inputs[i].addEventListener('click', (e)=> {
                            citySearchMenu.firstElementChild.textContent = e.target.nextSibling.textContent
                        })
                    };
                    citySearchMenu.firstElementChild.textContent = cityList.firstElementChild.lastChild.textContent
                }
            }
            xhr.send(null)
        })
    };
    
    window.addEventListener('click', (e) => {
        if (e.target == formContainer) {
            let curr = document.querySelector('#searchBarContainer .active');
            if (curr) curr.classList.remove('active');
            formContainer.style.display = 'none'
            searchForm.style.display = 'none';
        } 
        if (e.target === roomSearchMenu || roomSearchMenu.contains(e.target)) {
            document.querySelector('#roomSearchList').classList.toggle('show');
            document.querySelector('#roomSearchMenu .down-arrow').classList.toggle('rotate180');
        } else {
            document.querySelector('#roomSearchList').classList.remove('show');
            document.querySelector('#roomSearchMenu .down-arrow').classList.remove('rotate180');
        }
        
        if (e.target == propertySearchMenu || propertySearchMenu.contains(e.target)) {
            document.querySelector('#propertySearchList').classList.toggle('show');
            document.querySelector('#propertySearchMenu .down-arrow').classList.toggle('rotate180');
        } else {
            document.querySelector('#propertySearchList').classList.remove('show');
            document.querySelector('#propertySearchMenu .down-arrow').classList.remove('rotate180');
        }
        
        if (e.target == provinceSearchMenu || provinceSearchMenu.contains(e.target)) {
            document.querySelector('#provinceSearchList').classList.toggle('show');
            document.querySelector('#provinceSearchMenu .down-arrow').classList.toggle('rotate180');
        } else {
            document.querySelector('#provinceSearchList').classList.remove('show');
            document.querySelector('#provinceSearchMenu .down-arrow').classList.remove('rotate180');
        }
        
        if (e.target == citySearchMenu || citySearchMenu.contains(e.target)) {
            document.querySelector('#citySearchList').classList.toggle('show');
            document.querySelector('#citySearchMenu .down-arrow').classList.toggle('rotate180');
        } else {
            document.querySelector('#citySearchList').classList.remove('show');
            document.querySelector('#citySearchMenu .down-arrow').classList.remove('rotate180');
        }
    }, true)
}

instantiate()


var range = document.getElementById('range');

noUiSlider.create(range, {
    connect: true,
    range: {
        'min': 0,
        'max': 1000000  
    },
    step: 25000,
    start: [0, 1000000],
    margin: 25000,
    format: wNumb({
        decimals: 0,
        thousand: ',',
        suffix: ' ₩',
    }),
    pips: {
        mode: 'positions',
        values: [0, 20, 40, 60, 80, 100],
        density: 3,
        stepped: true,
        format: wNumb({
            decimals: 0,
            thousand: ',',
            suffix: ' ₩',
        }),
    },
    tooltips: true
});

document.querySelector('#range > div.noUi-pips.noUi-pips-horizontal > div:nth-child(42)').textContent = '1M +'