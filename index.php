<?php
// require
require_once 'vendor/autoload.php';

ini_set('error_reporting', -1);
ini_set('display_errors', 1);

$openWeatherMap = new OpenWeatherMap\OpenWeatherMap(array(
    'query' => 'Harrogate,uk',
    'mode'  => 'xml'
));

//$current = $openWeatherMap->getWeather(array(
//    'query' => 'London',
//    'mode'  => 'xml'
//));

//$city = $current->getCity();
//$weather = $current->getWeather();
//$temperature= $current->getTemperature();
//
//echo <<<EOT
//The weather in {$city->getName()},{$city->getCountry()} will
//be {$weather->getValue()}.
//The temperature will be between {$temperature->getMin()}
//and {$temperature->getMax()} {$temperature->getUnit()}.
//EOT;
    

//echo '<pre>';
//print_r($weather);
//echo '</pre>';

try {
    $weatherData = $openWeatherMap->getDaily();
    echo 'Made the call' . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
    sleep(20);
}


try {
    $weatherData = $openWeatherMap->getDaily();
    echo 'Made the call' . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
    sleep(20);
}
try {
    $weatherData = $openWeatherMap->getDaily();
    echo 'Made the call' . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
    sleep(20);
}
try {
    $weatherData = $openWeatherMap->getDaily();
    echo 'Made the call' . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
    sleep(20);
}
try {
    $weatherData = $openWeatherMap->getDaily();
    echo 'Made the call' . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
    sleep(20);
}
try {
    $weatherData = $openWeatherMap->getDaily();
    echo 'Made the call' . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
    sleep(20);
}
