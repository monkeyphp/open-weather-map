OpenWeatherMap
==============

Client library for accessing the OpenWeatherMap Api -  http://openweathermap.org/

Examples
--------

Require the Composer autoloader

    require_once "vendor/autoload.php

Create an instance of the OpenWeatherMap class

    $openWeatherMap = new OpenWeatherMap\OpenWeatherMap();

Now we can start querying the api using the interface provided by the 
OpenWeatherMap class.

Current Weather
---------------

    $options = array(
        'query' => 'London,uk',
        'mode'  => 'xml' 
    );
    $weather = $openWeatherMap->getWeather($options);


Daily Forecast
--------------

    $options = array(
        'query' => 'London,uk',
        'mode'  => 'xml' 
    );
    $weatherData = $openWeatherMap->getDaily($options);

    
Hourly Forecast
---------------

    $options = array(
        'query' => 'London,uk',
        'mode'  => 'xml' 
    );
    $weatherData = $openWeatherMap->getForecast($options);
    