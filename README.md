# OpenWeatherMap

Client library for accessing the OpenWeatherMap Api.

[![Build Status](https://travis-ci.org/monkeyphp/open-weather-map.png?branch=develop)](https://travis-ci.org/monkeyphp/open-weather-map)

## Links

- http://openweathermap.org/
- http://openweathermap.org/appid

## Learn

### Autoloading the OpenWeatherMap library

The easiest way to start using OpenWeatherMap is to use the Composer autoloader.

    require_once "vendor/autoload.php";



### Create an instance of OpenWeatherMap

Create a default instance of the OpenWeatherMap class.

    $openWeatherMap = new OpenWeatherMap\OpenWeatherMap();

You can also optionally supply a set a options to the OpenWeatherMap() constructor.
If you supply a key of _defaults_ containing an array, the contained values will 
be used as default options to all subsequent queries.

    $options = array (
        'defaults' => array (
            'apikey' => _YOURAPIKEY_,
            'mode'   => 'xml',
            'query'  => 'London,UK'
        )
    );
    $openWeatherMap = new OpenWeatherMap\OpenWeatherMap($options);

Now all subsequent queries will automatically include the supplied 'apiKey',
'mode' and 'query' value.

    $current = $openWeatherMap->weather();

These _default_ values, however, can be overridden in subsequent queries.

    $options = array (
        'defaults' => array (
            'apikey' => _YOURAPIKEY_,
            'mode'   => 'xml',
            'query'  => 'London,UK'
        )
    );
    $openWeatherMap = new OpenWeatherMap\OpenWeatherMap($options);

All queries from now on will, be default use the supplied apiKey, mode and query.
But we can pass in options when we perform our queries that will override those
defaults.

The following query will use the 'apiKey' supplied when the OpenWeatherMap was
constructed, but will use the supplied 'query' and 'mode' values overriding the
defaults.

    $options = array('query' => 'Los Angeles,US', 'mode' => 'json');
    $current = $openWeatherMap->getWeather($options);

The accepted values that can be supplied to the constructor in the _defaults_ key are

- latitude
- longitude
- apiKey
- query
- count
- mode
- units
- language
- id


### Locking

The OpenWeatherMap utilises a simple locking mechanism to throttle requests to the
http://openweathermap.org/ api.

To quote the openweathermap.org docs

> Do not send requests more then 1 time per 10 minutes from one device. The weather is changing not so frequently as usual.

The locking mechanism is enabled by default to work in accordance with the above
recommendation from openweathermap.org and should work out of the box.

What this means is that requests to the openweathermap.org api are throttled to
one request every 10 minutes (or 600 seconds).

It is possible to override the default implementation by constructing the 
OpenWeatherMap instance with the following parameters, setting 'minLifetime' to
the limit you require. 

For example, set this value to 300 to throttle requests to 1 time per 5 minutes.

    $options = array(
        'connectorFactory' => array(
            'lock' => array(
                'options' => array(
                    'minLifetime' => 300
                )
            )
        )
    );
    $openWeatherMap = new OpenWeatherMap\OpenWeatherMap($options);

It is also possible to construct a Lock instance first and pass that to the 
constructor in the options array.

    $lock = new OpenWeatherMap\Lock\Lock(array(
        'minLifetime' => 300,
    ));
    $options = array(
        'connectorFactory' => array(
            'lock' => $lock
        )
    );
    $openWeatherMap = new OpenWeatherMap\OpenWeatherMap($options);

It is also possible to enable locking that allows queries to be made irrespective
of throttling. 

    $lock = new OpenWeatherMap\Lock\Lock(array(
        'minLifetime' => null
    ));

The Lock class supports the following options

<dl>
    <dt>file</dt>
    <dd>The path of the lock file.</dd>
    <dt>maxLifetime</dt>
    <dd>The maximum number of seconds before a lock if forceably released.</dd>
    <dt>minLifetime</dt>
    <dd>The minium number of seconds that a lock lives for.</dd>
</dl>

    $lock = new OpenWeatherMap\Lock\Lock(array(
        'file'        => '/tmp/my.lock',
        'minLifetime' => 100,
        'maxLifetime' => 150
    ));



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



## Run the PHPUnit tests

    $ vendor/bin/phpunit -c tests/phpunit.xml
