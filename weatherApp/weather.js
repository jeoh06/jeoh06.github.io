function preload() {
    const xhr = new XMLHttpRequest()
    xhr.open('GET', 'city.list.json')
    xhr.onload = () => {
        //sorts cities by alphabetical order 
        cities = xhr.status === 200 ? JSON.parse(xhr.responseText).sort((a, b) => {
            return a.name.toLowerCase() < b.name.toLowerCase() ? -1
                 : a.name.toLowerCase() > b.name.toLowerCase() ? 1
                 : 0
        }) : null
    }
    xhr.send(null)
}

/**
 * 
 * @param {*} search user input 
 */
function autocomplete(search) {
    let search_name = new RegExp(`^${search}`, 'i'),
        search_results = new Set() //removes duplicate entries in JSON by only accepting the first one
    cities.forEach(city => {
        let city_match = city.state ? `${city.name}-${city.state}-${city.country}` : `${city.name}-${city.country}`
        if (search && city_match.match(search_name) && search_results.size < 10) { //limits the size of the dropdown to 10 items
            search_results.add(city_match)
        }
    })
    return Array.from(search_results) //needed to run forEach on keyup to generate list items in dropdown 
}

function get_Date(data, num) {
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    return days[new Date(data.list[num].dt_txt).getDay()];
}

function weekly_forecast(city_name) {
    let user_search = new RegExp(`^${city_name}`, 'i'),
        //checks if user input matches any objects in city.list.json file 
        city = cities.find(city => user_search.test(city.state ? `${city.name}-${city.state}-${city.country}` : `${city.name}-${city.country}`))
    const xhr = new XMLHttpRequest()
    xhr.open('GET', `https://api.openweathermap.org/data/2.5/forecast?id=${city.id}&appid=f67b34c951b6b9a0fbab016a58173f42&units=metric`)
    xhr.onload = () => {
        if (xhr.status === 200 || xhr.status === 0) {
            let weather_data = JSON.parse(xhr.responseText),
                title = document.querySelector('#title')
            display_forecast(weather_data)
            title.style.marginTop = 0
        } else if (xhr.status !== 200) {
            let div = document.createElement('div');
            div.className = "error";
            div.textContent = "404 Error: File Not Found";
            forecast.appendChild(div);
        }
    }
    xhr.send(null)
}

function display_forecast(data, time=Date.now()) {
    forecast.innerHTML = ''

    let current_weather,
        seconds = time/1000 //OpenWeather API tracks time in seconds so Date.now() must be converted
   
    let today = document.createElement('div'),
        city = document.createElement('h1'),
        dayOfWeek = document.createElement('h3'),
        icon = document.createElement('img'),
        temperature = document.createElement('h1'),
        sky = document.createElement('h3'),
        conditions = document.createElement('div'),
        top_row = document.createElement('div'),
        bottom_row = document.createElement('div'),
        wind = document.createElement('span'),
        pressure = document.createElement('span'),
        humidity = document.createElement('span'),
        cloudiness = document.createElement('span'),
        this_week = document.createElement('div')
    
//loops through array list of weather data until it finds correct time
//all days begin at 6:00 A.M. and there is a new entry for every 3 hours
    for(let i=0; i<8; i++) { 
        if(data.list[i]['dt'] < seconds) {
            continue
        } else if(data.list[i]['dt'] == seconds) {
            current_weather = data.list[i]
        } else if(data.list[i]['dt'] > seconds) {
            current_weather = data.list[i-1]
        }
    }

    set_background(current_weather)

    today.className = "today";
    city.textContent = data.city.name;
    dayOfWeek.textContent = get_Date(data, 0);
    icon.setAttribute('src', `http://openweathermap.org/img/wn/${current_weather['weather'][0]['icon']}@2x.png`)
    temperature.textContent = current_weather.main.temp + '° C';
    sky.textContent = current_weather.weather[0].description;
    wind.textContent = 'Wind : ' + current_weather.wind.speed + ' m/s';
    pressure.textContent = 'Pressure : ' + current_weather.main.pressure + ' h/Pa';
    humidity.textContent = 'Humidity : ' + current_weather.main.humidity + '%';
    cloudiness.textContent = 'Cloudiness : ' + current_weather.clouds.all + '%';
    this_week.className = "this_week"
   
    forecast.appendChild(today);
    today.appendChild(city);
    today.appendChild(dayOfWeek);
    today.appendChild(icon);
    today.appendChild(temperature);
    today.appendChild(sky);
    today.appendChild(conditions);
    conditions.appendChild(top_row);
    conditions.appendChild(bottom_row);
    top_row.appendChild(wind);
    top_row.appendChild(pressure);
    bottom_row.appendChild(humidity);
    bottom_row.appendChild(cloudiness);
    forecast.appendChild(this_week)

    for(let j=8; j<data.list.length; j+=8) { //retrieves 6:00 A.M. weather data for the next four dayss
        let this_day = document.createElement('div'),
            dayOfWeek = document.createElement('h3'),
            icon = document.createElement('img'),
            temperature = document.createElement('h1'),
            sky = document.createElement('h3')

        this_day.className = "this_day";
        dayOfWeek.textContent = get_Date(data, j);
        icon.setAttribute('src', `http://openweathermap.org/img/wn/${data.list[j]['weather'][0]['icon']}@2x.png`);
        temperature.textContent = data.list[j].main.temp + '°';
        sky.textContent = data.list[j].weather[0].description;

        this_day.appendChild(dayOfWeek);
        this_day.appendChild(icon);
        this_day.appendChild(temperature);
        this_day.appendChild(sky);
        this_week.appendChild(this_day);
    }

}

/** Function to dynamically set background of website based on data from server
 * 
 * @param {Object} data JSON object retrieved from server
 */
function set_background(data) {
    const body = document.querySelector('body')
    let background = data.weather[0].id
    body.style.backgroundImage = background >= 200 && background <= 232 || background == 781 ? "url('backgrounds/thunderstorm.gif')"
        : background >= 300 && background <= 531 ? "url('backgrounds/rain.gif')"
        : background >= 600 && background <= 622 ? "url('backgrounds/snow.gif')"
        : background >= 700 && background <= 780 ? "url('backgrounds/fog.jpeg')"
        : background >= 801 && background <= 804 ? "url('backgrounds/cloudy.gif')"
        : "url('backgrounds/sunny.gif')"
}

const form = document.querySelector('form'),
      search_bar = document.querySelector('#search_bar'),
      drop_list = document.querySelector('#search_list')

let cities, // stores the JSON object list of all cities covered by the API 
    count = -1 // tracks the position of the user when navigating the suggestions list 

preload()

form.addEventListener('submit', function (e) {
    e.preventDefault();
})

search_bar.addEventListener('keyup', (e) => {
    if (e.key === "Enter") {
        drop_list.innerHTML=''
        search_bar.style.borderRadius = '25px'
        weekly_forecast(e.target.value)
    } else if (e.key === "ArrowDown") {
        count++;
        if (count == drop_list.children.length) {
            count = -1;
            search_bar.focus();
            drop_list.children[drop_list.children.length - 1].classList.remove("navigate")
        } else if (count > 0) {
            drop_list.children[count - 1].classList.remove("navigate");
            drop_list.children[count].classList.add("navigate");
            e.target.value = drop_list.children[count].textContent;
        } else {
            drop_list.children[count].classList.add("navigate");
            e.target.value = drop_list.children[count].textContent;
        }
    } else if (e.key === "ArrowUp") {
        count--;
        if (count == -1) {
            search_bar.focus();
            drop_list.children[0].classList.remove("navigate");
        } else if (count < -1) {
            count = drop_list.children.length - 1;
            drop_list.children[count].classList.add("navigate");
            e.target.value = drop_list.children[count].textContent;
        } else if (count >= 0) {
            drop_list.children[count + 1].classList.remove("navigate");
            drop_list.children[count].classList.add("navigate");
            e.target.value = drop_list.children[count].textContent;
        }
    } else if (e.key != " " && e.key != "Tab") { // prevents random entries from appearing in dropdown
        drop_list.innerHTML = ''
        let suggestions = autocomplete(e.target.value.trim())
        suggestions.forEach(suggestion => {
            list_item = document.createElement('li')
            list_item.textContent = suggestion
            drop_list.appendChild(list_item)
        })
        search_bar.style.borderRadius = drop_list.innerHTML ?  "25px 25px 0 0" : "25px"
    }
})

// Allows user to navigate suggestions list using mouse 
drop_list.addEventListener('mouseover', (e) => {
    let list_items = Array.from(drop_list.children);
    for (i = 0; i < drop_list.children.length; i++) {
        if (drop_list.children[i].classList.contains("navigate")) {
            drop_list.children[i].classList.remove("navigate")
        }
    }
    e.target.classList.add("navigate")
    search_bar.value = e.target.textContent
    count = list_items.indexOf(e.target)
})

drop_list.addEventListener('click', () => {
    drop_list.innerHTML=''
    search_bar.style.borderRadius = '25px'
    weekly_forecast(search_bar.value)
})