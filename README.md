# OpenWeatherMap

Client library for accessing the OpenWeatherMap Api.

## Links

- http://openweathermap.org/
- http://openweathermap.org/appid

## Examples

### Autoloading the OpenWeatherMap library

The easiest way to start using OpenWeatherMap is to use the Composer autoloader.

    require_once "vendor/autoload.php";



### Create an instance of OpenWeatherMap

Create a default instance of the OpenWeatherMap class.

    $openWeatherMap = new OpenWeatherMap\OpenWeatherMap();

You can also optionally supply a set a options to the OpenWeatherMap() constructor
which will be used as default options to all subsequent queries.
    
    $options = array(
        'apikey' => APIKEY,
        'mode'   => 'xml',
        'city'   => 'London,UK'
    );
    $openWeatherMap = new OpenWeatherMap\OpenWeatherMap($options);


Now we can start querying the api using the interface provided by the 
OpenWeatherMap class.



### Get the current weather

If you supplied a set of default options when you created the OpenWeatherMap, then
you can just make the call.

    $weather = $openWeatherMap->getWeather();

If you created a default instance of OpenWeatherMap, then you will need to 
supply an array of options when you make the call.

    $options = array(
        'query' => 'London,uk',
        'mode'  => 'xml' 
    );
    $current = $openWeatherMap->getWeather($options);

OpenWeatherMap::getWeather() will return an instance of OpenWeatherMap\Entity\Current
which can then be queried for the details about the current weather.

    $city        = $current->getCity();
    $weather     = $current->getWeather();
    $temperature = $current->getTemperature();

    echo <<<EOT
    The weather in {$city->getName()},{$city->getCountry()} will
    be {$weather->getValue()}.
    The temperature will be between {$temperature->getMin()}
    and {$temperature->getMax()} {$temperature->getUnit()}.
    EOT;



### Get the daily forecast

If you supplied a set of default options when you created the OpenWeatherMap, then
you can just make the call.

    $weatherData = $openWeatherMap->getDaily();

If you created a default instance of OpenWeatherMap, then you will need to 
supply an array of options when you make the call.

    $options = array(
        'query' => 'London,uk',
        'mode'  => 'xml' 
    );
    $weatherData = $openWeatherMap->getDaily($options);



### Get the hourly forecast

If you supplied a set of default options when you created the OpenWeatherMap, then
you can just make the call.

    $weatherData = $openWeatherMap->getForecast();

If you created a default instance of OpenWeatherMap, then you will need to 
supply an array of options when you make the call.

    $options = array(
        'query' => 'London,uk',
        'mode'  => 'xml' 
    );
    $weatherData = $openWeatherMap->getForecast($options);
