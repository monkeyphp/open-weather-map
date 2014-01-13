<?php
// require
require_once 'vendor/autoload.php';

$openWeatherMap = new OpenWeatherMap\OpenWeatherMap();

//$weather = $openWeatherMap->getWeather(array(
//    'query' => 'London',
//    'mode'  => 'xml'
//));

//echo '<pre>';
//print_r($weather);
//echo '</pre>';

//$weatherData = $openWeatherMap->getDaily(array(
//    'query' => 'Harrogate,uk',
//    'mode'  => 'xml'
//));


$weatherData = $openWeatherMap->getForecast(array(
    'query' => 'Harrogate,uk',
    'mode'  => 'xml'
));


echo '<pre>';
print_r($weatherData);
echo '</pre>';
