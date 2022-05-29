const loader = document.getElementById("loader-spinner");
const error = document.getElementById("error");
const forecast = document.getElementById("forecast");

const city = document.getElementById("city");
const temperature = document.getElementById("temp");
const weatherDescription = document.getElementById("weather");
const maxTem = document.getElementById("max-temp");
const minTem = document.getElementById("min-temp");
const icon = document.getElementById("icon");

const windSpeed = document.getElementById("wind");

const nextDaysForecast = document.getElementById("nex-days-forecast");

const checkWeather = (event) => {
    event.preventDefault();

    const { cp, state } = Object.fromEntries(
        new FormData(event.target).entries()
    );

    const queryString = new URLSearchParams();

    queryString.append("zip", `${cp},${state}`);

    apiCall(queryString);
};

const apiCall = async (queryString) => {
    try {
        showLoadingSpinner();

        const response = await fetch(`/api/weather?${queryString}`);

        const data = await response.json();

        if (data) {
            console.log(data);

            renderResults(data);
        }
    } catch (error) {
        showError();
    }
};

const showLoadingSpinner = () => {
    showElement(loader);
    hideElement(forecast);
    hideElement(error);
};

const showForecast = () => {
    showElement(forecast);
    hideElement(loader);
    hideElement(error);
};

const showError = () => {
    showElement(error);
    hideElement(loader);
    hideElement(forecast);
};

const renderResults = (data) => {
    showForecast();

    const { name, main } = data;
    const { temp, temp_max, temp_min } = main;
    const [weather] = data.weather;
    const { description, icon: iconId } = weather;

    city.textContent = name;
    temperature.textContent = `${temp} \u2103`;
    weatherDescription.textContent = description;
    maxTem.textContent = `Tempeatura máxima: ${temp_max} \u2103`;
    minTem.textContent = `Temperatura mínima: ${temp_min} \u2103`;
    icon.src = `http://openweathermap.org/img/wn/${iconId}@2x.png`;
};

const hideElement = (element) => element.classList.add("d-none");

const showElement = (element) => element.classList.remove("d-none");
