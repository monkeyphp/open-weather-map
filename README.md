# OpenWeatherMap

A PHP client library for accessing the [OpenWeatherMap](http://openweathermap.org) Api.

[![Build Status](https://travis-ci.org/monkeyphp/open-weather-map.png?branch=develop)](https://travis-ci.org/monkeyphp/open-weather-map)
[![Latest Stable Version](https://poser.pugx.org/monkeyphp/open-weather-map/v/stable.png)](https://packagist.org/packages/monkeyphp/open-weather-map) 
[![Total Downloads](https://poser.pugx.org/monkeyphp/open-weather-map/downloads.png)](https://packagist.org/packages/monkeyphp/open-weather-map) 
[![Latest Unstable Version](https://poser.pugx.org/monkeyphp/open-weather-map/v/unstable.png)](https://packagist.org/packages/monkeyphp/open-weather-map) 
[![License](https://poser.pugx.org/monkeyphp/open-weather-map/license.png)](https://packagist.org/packages/monkeyphp/open-weather-map)

The OpenWeatherMap library is a client library for accessing weather data from the 
free [OpenWeatherMap](http://openweathermap.org/) Api.

You can read more about OpenWeatherMap [here](http://openweathermap.org/).

The library is built on top of a number of [Zend Framework 2](http://framework.zend.com/manual/2.2/en/index.html) components.


## Links

- http://openweathermap.org/
- http://openweathermap.org/appid


## Get the OpenWeatherMap library

The easiest way to get the library is to use [Composer](https://getcomposer.org/) 
and [Packagist](http://packagist.org/).

If you do not already have Composer in your application, you can install it as
follows.
    
    $ curl -sS https://getcomposer.org/installer | php

Create the ```composer.json``` file.

    $ touch composer.json
    
Add the following to the ```composer.json``` file

    {
        "require": {
            "monkeyphp/open-weather-map" "*"
        }
    }

Finally run Composer install

    $ php composer.phar install

You should now have the library installed into your ```vendors``` directory.

### Autoloading the OpenWeatherMap library

The easiest way to start using OpenWeatherMap is to use the Composer autoloader.

Include the Composer autoloader into your script

    require_once "vendor/autoload.php";


## Create an instance of OpenWeatherMap

The OpenWeatherMap library provides a top level class ```OpenWeatherMap``` that all
available functionality can be accessed through.

A default instance (without any parameters) can be constructed as follows:

    $openWeatherMap = new OpenWeatherMap\OpenWeatherMap();

You can alos construct an instance of ```OpenWeatherMap``` you can also supply a set of constructor options. 

The accepted keys to the constructor are:

<dl>
    <dt>defaults</dt>
    <dd>Supply an array of query values that will be used as parameters in subsequent queries</dd>
    <dt>connectorFactory</dt>
    <dd></dd>
</dl>

For example, we can create an instance of ```OpenWeatherMap``` as follows

    $options = array (
        'defaults' => array (
            'apikey' => _YOURAPIKEY_,
            'mode'   => 'xml',
            'query'  => 'London,UK'
        )
    );
    $openWeatherMap = new OpenWeatherMap\OpenWeatherMap($options);

Now all subsequent queries will automatically include the supplied __apiKey__,
__mode__ and __query__ value.

    $current = $openWeatherMap->weather();


## ConnectorFactory and Connectors

Internally, the OpenWeatherMap library uses a factory class to manage the plumbing for connecting to the OpenWeatherMap Api.

The primary role of the ConnectorFactory is to create Connector classes that are then used to query each of the endpoints that the OpenWeatherMap Api exposes.

Each of the Connector classes requires a Lock classes that manages throttling calls to the api.


## Locking

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


##Using the OpenWeatherMap instance    

Once you have constructed an ```OpenWeatherMap``` instance, configured to your 
needs, you can now start using it to query the api.

There are 3 methods that the ```OpenWeatherMap``` exposes.

All 3 methods accept an array of values, which may contain the following keys.

<dl>
    <dt>latitude</dt>
    <dd></dd>
    
    <dt>longitude</dt>
    <dd></dd>
    
    <dt>id</dt>
    <dd></dd>
    
    <dt>query</dt>
    <dd></dd>
    
    <dt>apiKey</dt>
    <dd></dd>
    
    <dt>count</dt>
    <dd></dd>
    
    <dt>mode</dt>
    
    <dt>units</dt>
    
    <dt>language</dt>
</dl>

In the array of options, you must provide at least one of the following (in preference order):

1. __query__
2.  __latitude__ and __longitude__
3. __id__

The above keys are used in part of a preferential order.

For example, supplying both __query__ and __id__ will result in the __query__ value
being used to query the OpenWeatherMap Api with as that has a higher preference.

### Get the current weather

If you supplied a set of default options when you created the OpenWeatherMap, then
you can just make the call.

    $weather = $openWeatherMap->getWeather();

If you created a default instance of OpenWeatherMap, then you will need to 
supply an array of options when you make the call. 

Remember that you _must_ provide an id, a query or a latitude and longitude value.

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

Remember that you _must_ provide an id, a query or a latitude and longitude value.

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

Remember that you _must_ provide an id, a query or a latitude and longitude value.

    $options = array(
        'query' => 'London,uk',
        'mode'  => 'xml' 
    );
    $weatherData = $openWeatherMap->getForecast($options);
   

## Run the PHPUnit tests

The library is tested with [PHPUnit](http://phpunit.de/).

    $ vendor/bin/phpunit -c tests/phpunit.xml


## Run the PHP CS tests

The library uses a PSR compatible coding standard.

    $ vendor/bin/phpcs --standard="PSR2" src/


## License

Copyright (C) 2014  David White
 
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see [http://www.gnu.org/licenses/].