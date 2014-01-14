<?php
// require
require_once 'vendor/autoload.php';

$openWeatherMap = new OpenWeatherMap\OpenWeatherMap(array(
    'query' => 'Harrogate,uk',
    'mode'  => 'xml'
));

$current = $openWeatherMap->getWeather(array(
    'query' => 'London',
    'mode'  => 'xml'
));

$city = $current->getCity();
$weather = $current->getWeather();
$temperature= $current->getTemperature();

echo <<<EOT
The weather in {$city->getName()},{$city->getCountry()} will
be {$weather->getValue()}.
The temperature will be between {$temperature->getMin()}
and {$temperature->getMax()} {$temperature->getUnit()}.
EOT;
    

//echo '<pre>';
//print_r($weather);
//echo '</pre>';

//$weatherData = $openWeatherMap->getDaily(array(
//    'query' => 'Harrogate,uk',
//    'mode'  => 'xml'
//));


//$weatherData = $openWeatherMap->getForecast();
//
//
//echo '<pre>';
//print_r($weatherData);
//echo '</pre>';
