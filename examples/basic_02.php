<?php
// a basic example us using the OpenWeahtherMap library

// require the Composer autoloader
require_once '../vendor/autoload.php';

// create a default instance of OpenWeatherMap
$openWeatherMap = new OpenWeatherMap\OpenWeatherMap();

// get the daily weather for Berlin,DE
$weatherData = $openWeatherMap->getDaily(array('query' => 'Berlin,DE'));


echo '<pre>';
print_r($weatherData);
echo '</pre>';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Basic 02</title>
    </head>
    <body>

        <table>
            <?php foreach($weatherData->getForecast()->getTimes() as $time): ?>
            <tbody>
                <tr>
                    <td colspan="2"><?php echo $time->getDay(); ?></td>
                </tr>
                <tr>
                    <th>Temperature</th>
                    <td><?php echo $time->getTemperature()->getValue(); ?> <?php echo $current->getTemperature()->getUnit(); ?></td>
                </tr>
                <tr>
                    <th>Humidity</th>
                    <td><?php echo $time->getHumidity()->getValue() ?> <?php echo $time->getHumidity()->getUnit(); ?></td>
                </tr>
                <tr>
                    <th>Pressure</th>
                    <td><?php echo $time->getPressure()->getValue(); ?> <?php echo $time->getPressure()->getUnit(); ?></td>
                </tr>
                <tr>
                    <th>Wind Speed</th>
                    <td><?php echo $time->getWindSpeed()->getMps(); ?></td>
                </tr>
                <tr>
                    <th>Wind Direction</th>
                    <td><?php echo $time->getWindDirection()->getValue(); ?></td>
                </tr>
                <tr>
                    <th>Clouds</th>
                    <td><?php echo $time->getClouds()->getValue(); ?></td>
                </tr>
                <tr>
                    <th>Precipitation</th>
                    <td><?php echo $time->getPrecipitation()->getValue(); ?></td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </body>
</html>