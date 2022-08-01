function postProperty() {
    let postPropertyForm = document.querySelector('#postPropertyForm'),
    photosPreview = document.querySelector('#photosPreview');

    document.querySelector('form button#addImg').addEventListener('click', function(e) {
        e.preventDefault();
        var nb_attachments = document.querySelectorAll("form input[type='file']").length;
        var input = document.createElement('input')
        input.type="file" 
        input.name='attachment-' + nb_attachments;
        input.accept = 'image/*'
        input.addEventListener('change', function(evt) {
            var f = evt.target.files[0];
            postPropertyForm.appendChild(evt.target);
            let img = document.createElement('img');
            img.src = URL.createObjectURL(f);
            let div = document.createElement('div');
            let title = document.createElement('input');
            title.name = 't-' + evt.target.name;
            title.type = 'text';
            title.className = 't-description';
            title.placeholder = "Write a short description";
            let closeBttn = document.createElement('span');
            closeBttn.innerHTML = '&times;';
            closeBttn.className = 'closeBttn';
            closeBttn.addEventListener('click', (e) => {
                postPropertyForm.removeChild(input)
                photosPreview.removeChild(e.target.parentElement);
                let files = document.querySelectorAll("form input[type='file']")
                let descriptions = photosPreview.querySelectorAll("input")
                files.forEach((file, idx) => {
                    file.name = 'attachment-' + idx;
                    descriptions[idx].name = 't-' + file.name
                })
            })
            div.appendChild(title);
            div.appendChild(closeBttn);
            div.appendChild(img);
            photosPreview.appendChild(div);
        });
        input.style.display = 'none';
        input.click();
    });

    function checkTitle(e) {
        return (e.value.length >= 4 && e.value.length <= 50)
    }

    function checkSelect(e) {
        if (e = e.querySelector('input[type="radio"]:checked')) 
            return e.value >= -1
        else
            return null
    }

    function checkCountry(e) {
        let countries = ['KR']
        if (e = e.querySelector('input[type="radio"]:checked'))
            return countries.indexOf(e.value) >= 0
        else
            return null
    }

    function checkAddress(e) {
        return (e.value.length >= 4 && e.value.length <= 255)
    }

    function checkZip(e) {
        return /^[a-z0-9]{5,10}$/i.test(e.value)
    }

    function checkNumber(e) {
        return (e.value > 0 && e.value < 100)
    }

    function checkSize(e) {
        return (e.value > 0 && e.value < 1000)
    }

    function checkPrice(e) {
        return e.value > 0
    }

    function checkImg() {
        let imgs = document.querySelectorAll("form input[type='file']")
        let desc = document.querySelectorAll("#photosPreview input[type='text']")
        if (imgs.length < 2 || imgs.length > 20) return 
        for (i=0; i<imgs.length; i++) {
            if(imgs[i].files[0].size > 10485760 || !checkDescription(desc[i])) {
                return
            }
        }
        return true
    }

    function checkDescription(e) {
        return (e.value.length >= 4 && e.value.length <= 255)
    }

    function checkBank(e) {
        return (e.value.length >= 12 && e.value.length <= 20)
    }
    let title = document.querySelector('#title');
    let country = document.querySelector('#countryPostMenu');
    let province = document.querySelector('#provincePostMenu');
    let city = document.querySelector('#cityPostMenu');
    let district = document.querySelector('#districtPostMenu');
    let roomType = document.querySelector('#roomPostMenu');
    let propertyType = document.querySelector('#propertyPostMenu');
    let address1 = document.querySelector('#address1');
    let zipcode = document.querySelector('#zipcode');
    let roomNum = document.querySelector('#roomNum');
    let bedNum = document.querySelector('#bedNum');
    let bathNum = document.querySelector('#bathNum');
    let size = document.querySelector('#size');
    let price = document.querySelector('#price');
    let description = document.querySelector('#description');
    let bankAccNum = document.querySelector('#bankAccNum');
    postPropertyForm.addEventListener('submit', (e)=> {
        e.preventDefault();
        if (checkTitle(title)&&
            checkCountry(country) &&
            checkSelect(province) &&
            checkSelect(city) &&
            checkSelect(district) &&
            checkSelect(roomType) &&
            checkSelect(propertyType) &&
            checkAddress(address1) &&
            checkZip(zipcode) &&
            checkNumber(roomNum) &&
            checkNumber(bathNum) &&
            checkSize(size) && 
            checkPrice(price) &&
            checkDescription(description) &&
            checkBank(bankAccNum) &&
            checkImg()) {
                postPropertyForm.submit()
            }
        else {
            let errorMsgs = document.querySelectorAll('#postPropertyForm span.hide');
            for (i=0; i<errorMsgs.length; i++) {
                errorMsgs[i].className = 'show'
            }
            let photos = document.querySelector(' #postImgInfo #newPropImg #photos');
            photos.style.left = 55 + 'rem';
            photos.style.top = 15 + 'rem';
        }
    })

    let furniture = document.querySelector('#furnished');
    let bedField = document.querySelector('#bedField');
    furniture.addEventListener('click', () => {
        if(furniture.checked) {
            bedField.classList.add('slideDown');
        } else {
            bedField.classList.remove('slideDown');
        }
    })

    title.addEventListener('keyup', (e) => {
        e.target.classList.remove('red', 'green');
        if(checkTitle(e.target)) {
            e.target.classList.add('green');
            e.target.nextElementSibling.className = 'hide';
        } else {
            e.target.classList.add('red');
            e.target.nextElementSibling.className = 'show';
        }
    })

    address1.addEventListener('keyup', (e) => {
        e.target.classList.remove('red', 'green');
        if(checkAddress(e.target)) {
            e.target.classList.add('green');
            e.target.nextElementSibling.className = 'hide';
        } else {
            e.target.classList.add('red');
            e.target.nextElementSibling.className = 'show';
        }
    })

    zipcode.addEventListener('keyup', (e) => {
        e.target.classList.remove('red', 'green');
        if(checkZip(e.target)) {
            e.target.classList.add('green');
            e.target.nextElementSibling.className = 'hide';
        } else {
            e.target.classList.add('red');
            e.target.nextElementSibling.className = 'show';
        }
    })

    roomNum.addEventListener('keyup', (e) => {
        e.target.classList.remove('red', 'green');
        if(checkNumber(e.target)) {
            e.target.classList.add('green');
            e.target.nextElementSibling.className = 'hide';
        } else {
            e.target.classList.add('red');
            e.target.nextElementSibling.className = 'show';
        }
    })

    bedNum.addEventListener('keyup', (e) => {
        e.target.classList.remove('red', 'green');
        if(checkNumber(e.target)) {
            e.target.classList.add('green');
            e.target.nextElementSibling.className = 'hide';
        } else {
            e.target.classList.add('red');
            e.target.nextElementSibling.className = 'show';
        }
    })

    bathNum.addEventListener('keyup', (e) => {
        e.target.classList.remove('red', 'green');
        if(checkNumber(e.target)) {
            e.target.classList.add('green');
            e.target.nextElementSibling.className = 'hide';
        } else {
            e.target.classList.add('red');
            e.target.nextElementSibling.className = 'show';
        }
    })

    size.addEventListener('keyup', (e) => {
        e.target.classList.remove('red', 'green');
        if(checkSize(e.target)) {
            e.target.classList.add('green');
            e.target.nextElementSibling.className = 'hide';
        } else {
            e.target.classList.add('red');
            e.target.nextElementSibling.className = 'show';
        }
    })

    price.addEventListener('keyup', (e) => {
        e.target.classList.remove('red', 'green');
        if(checkPrice(e.target)) {
            e.target.classList.add('green');
            e.target.nextElementSibling.className = 'hide';
        } else {
            e.target.classList.add('red');
            e.target.nextElementSibling.className = 'show';
        }
    });

    description.addEventListener('keyup', (e) => {
        e.target.classList.remove('red', 'green');
        if(checkDescription(e.target)) {
            e.target.classList.add('green');
            e.target.nextElementSibling.className = 'hide';
        } else {
            e.target.classList.add('red');
            e.target.nextElementSibling.className = 'show';
        }
    });

    bankAccNum.addEventListener('keyup', (e) => {
        e.target.classList.remove('red', 'green');
        if(checkBank(e.target)) {
            e.target.classList.add('green');
            e.target.nextElementSibling.className = 'hide';
        } else {
            e.target.classList.add('red');
            e.target.nextElementSibling.className = 'show';
        }
    });
    let propertyPostMenu = document.querySelector('.propertyPostBar');
    let propertyList = propertyPostMenu.nextElementSibling;
    let roomPostMenu = document.querySelector('.roomPostBar');
    let roomList = roomPostMenu.nextElementSibling;
    let provincePostMenu = document.querySelector('.provincePostBar');
    let provinceList = provincePostMenu.nextElementSibling;
    let cityPostMenu = document.querySelector('.cityPostBar');
    let cityList = cityPostMenu.nextElementSibling;
    let districtPostMenu = document.querySelector('.districtPostBar');
    let districtList = districtPostMenu.nextElementSibling;
    let countryPostMenu = document.querySelector('.countryPostBar');
    let countryList = countryPostMenu.nextElementSibling;

    let inputs = roomList.querySelectorAll('input')
    for (let i=0; i<inputs.length; i++) {
        inputs[i].addEventListener('click', (e)=> {
            roomPostMenu.firstElementChild.textContent = e.target.nextSibling.textContent
            roomPostMenu.parentElement.nextElementSibling.className = 'hide'
        })
    };

    inputs = propertyList.querySelectorAll('input')
    for (let i=0; i<inputs.length; i++) {
        inputs[i].addEventListener('click', (e)=> {
            propertyPostMenu.firstElementChild.textContent = e.target.nextSibling.textContent
            propertyPostMenu.parentElement.nextElementSibling.className = 'hide'
        })
    };

    inputs = countryList.querySelectorAll('input')
    for (let i=0; i<inputs.length; i++) {
        inputs[i].addEventListener('click', (e)=> {
            countryPostMenu.firstElementChild.textContent = e.target.nextSibling.textContent
            countryPostMenu.parentElement.nextElementSibling.className = 'hide'

        })
    };

    inputs = provinceList.querySelectorAll('input')
    for (let i=0; i<inputs.length; i++) {
        inputs[i].addEventListener('click', (e)=> {
            provincePostMenu.firstElementChild.textContent = e.target.nextSibling.textContent
            provincePostMenu.parentElement.nextElementSibling.className = 'hide'
            let xhr = new XMLHttpRequest();
            xhr.open('GET', `index.php?action=getCities&province=${e.target.nextSibling.textContent}`);
            xhr.onload = function (e) {
                if (xhr.status == 200) {
                    cityList.innerHTML = xhr.responseText
                    inputs = cityList.querySelectorAll('input')
                    for (let i=0; i<inputs.length; i++) {
                        inputs[i].addEventListener('click', (e)=> {
                            cityPostMenu.firstElementChild.textContent = e.target.nextSibling.textContent
                        })
                    };
                    cityPostMenu.firstElementChild.textContent = cityList.firstElementChild.lastChild.textContent
                    cityPostMenu.parentElement.nextElementSibling.className = 'hide'

                    districtPostMenu.firstElementChild.textContent = '-=-=-'
                    let cities = cityList.querySelectorAll('input')
                    for (let i=0; i<cities.length; i++) {
                        cities[i].addEventListener('click', (ev)=> {
                            cityPostMenu.firstElementChild.textContent = ev.target.nextSibling.textContent
                            let xhr = new XMLHttpRequest();
                            xhr.open('GET', `index.php?action=getDistricts&city=${ev.target.nextSibling.textContent}`);
                            xhr.onload = function () {
                                if (xhr.status == 200) {
                                    districtList.innerHTML = xhr.responseText
                                    let districts = districtList.querySelectorAll('input')
                                    for (let i=0; i<districts.length; i++) {
                                        districts[i].addEventListener('click', (evt)=> {
                                            districtPostMenu.firstElementChild.textContent = evt.target.nextSibling.textContent
                                        })
                                    };
                                    districtPostMenu.firstElementChild.textContent = districtList.firstElementChild.lastChild.textContent
                                    districtPostMenu.parentElement.nextElementSibling.className = 'hide'
                                }
                            }
                            xhr.send(null)
                        })
                    };
                }
            }
            xhr.send(null)
        })
    };


    window.addEventListener('click', (e) => {
        if (e.target === roomPostMenu || roomPostMenu.contains(e.target)) {
            document.querySelector('#roomPostList').classList.toggle('show');
            document.querySelector('#roomPostMenu .down-arrow').classList.toggle('rotate180');
        } else {
            document.querySelector('#roomPostList').classList.remove('show');
            document.querySelector('#roomPostMenu .down-arrow').classList.remove('rotate180');
        }

        if (e.target == propertyPostMenu || propertyPostMenu.contains(e.target)) {
            document.querySelector('#propertyPostList').classList.toggle('show');
            document.querySelector('#propertyPostMenu .down-arrow').classList.toggle('rotate180');
        } else {
            document.querySelector('#propertyPostList').classList.remove('show');
            document.querySelector('#propertyPostMenu .down-arrow').classList.remove('rotate180');
        }

        if (e.target == provincePostMenu || provincePostMenu.contains(e.target)) {
            document.querySelector('#provincePostList').classList.toggle('show');
            document.querySelector('#provincePostMenu .down-arrow').classList.toggle('rotate180');
        } else {
            document.querySelector('#provincePostList').classList.remove('show');
            document.querySelector('#provincePostMenu .down-arrow').classList.remove('rotate180');
        }

        if (e.target == cityPostMenu || cityPostMenu.contains(e.target)) {
            document.querySelector('#cityPostList').classList.toggle('show');
            document.querySelector('#cityPostMenu .down-arrow').classList.toggle('rotate180');
        } else {
            document.querySelector('#cityPostList').classList.remove('show');
            document.querySelector('#cityPostMenu .down-arrow').classList.remove('rotate180');
        }

        if (e.target == districtPostMenu || districtPostMenu.contains(e.target)) {
            document.querySelector('#districtPostList').classList.toggle('show');
            districtPostMenu.querySelector('.down-arrow').classList.toggle('rotate180');
        } else {
            document.querySelector('#districtPostList').classList.remove('show');
            districtPostMenu.querySelector('.down-arrow').classList.remove('rotate180');
        }

        if (e.target == countryPostMenu || countryPostMenu.contains(e.target)) {
            document.querySelector('#countryPostList').classList.toggle('show');
            document.querySelector('#countryPostMenu .down-arrow').classList.toggle('rotate180');
        } else {
            document.querySelector('#countryPostList').classList.remove('show');
            document.querySelector('#countryPostMenu .down-arrow').classList.remove('rotate180');
        }
    }, true)
}

postProperty();