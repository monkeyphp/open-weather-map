<?php
// require
require_once 'vendor/autoload.php';

$openWeatherMap = new OpenWeatherMap\OpenWeatherMap(array(
    'query' => 'Harrogate,uk',
    'mode'  => 'xml'
));

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


$weatherData = $openWeatherMap->getForecast();


echo '<pre>';
print_r($weatherData);
echo '</pre>';
