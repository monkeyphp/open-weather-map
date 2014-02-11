<?php
// A basic example of using the OpenWeatherMap library

// sudo php -S localhost:80 -t examples/
//
// curl localhost:80/basic.php

// require the Composer autoloader
require_once '../vendor/autoload.php';

// create a default instance of OpenWeatherMap
$openWeatherMap = new OpenWeatherMap\OpenWeatherMap();

// lets get the current weather for New York, US
$current = $openWeatherMap->getWeather(array('query' => 'New York,US'));
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Basic 01</title>
    </head>
    <body>
        <h2>The Weather in <?php echo $current->getCity()->getName(); ?></h2>
        <table>
            <tr>
                <th>Temperature</th>
                <td><?php echo $current->getTemperature()->getValue(); ?> <?php echo $current->getTemperature()->getUnit(); ?></td>
            </tr>
            <tr>
                <th>Humidity</th>
                <td><?php echo $current->getHumidity()->getValue() ?> <?php echo $current->getHumidity()->getUnit(); ?></td>
            </tr>
            <tr>
                <th>Pressure</th>
                <td><?php echo $current->getPressure()->getValue(); ?> <?php echo $current->getPressure()->getUnit(); ?></td>
            </tr>
            <tr>
                <th>Wind Speed</th>
                <td><?php echo $current->getWindSpeed()->getMps(); ?></td>
            </tr>
            <tr>
                <th>Wind Direction</th>
                <td><?php echo $current->getWindDirection()->getValue(); ?></td>
            </tr>
            <tr>
                <th>Clouds</th>
                <td><?php echo $current->getClouds()->getValue(); ?></td>
            </tr>
            <tr>
                <th>Precipitation</th>
                <td><?php echo $current->getPrecipitation()->getValue(); ?></td>
            </tr>
        </table>
    </body>
</html>
