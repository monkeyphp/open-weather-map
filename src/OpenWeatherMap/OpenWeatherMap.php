<?php
/**
 * OpenWeatherMap.php
 *
 * @category OpenWeatherMap
 * @package  OpenWeatherMap
 * @author   David White [monkeyphp] <david@monkeyphp.com>
 *
 * Copyright (C) 2014  David White
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see [http://www.gnu.org/licenses/].
 */
namespace OpenWeatherMap;

use OpenWeatherMap\Connector\DailyConnectorInterface;
use OpenWeatherMap\Connector\Factory\ConnectorFactory;
use OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface;
use OpenWeatherMap\Connector\ForecastConnectorInterface;
use OpenWeatherMap\Connector\WeatherConnectorInterface;
use OpenWeatherMap\Entity\Current;
use OpenWeatherMap\Entity\WeatherData;
use Traversable;

/**
 * OpenWeatherMap
 *
 * @category OpenWeatherMap
 * @package  OpenWeatherMap
 * @author   David White [monkeyphp] <david@monkeyphp.com>
 */
class OpenWeatherMap implements OpenWeatherMapInterface
{
    /**
     * Instance of ConnectorFactoryInterface
     *
     * @var ConnectorFactoryInterface
     */
    protected $connectorFactory;

    /**
     * Instance of WeatherConnectorInterface
     *
     * @var WeatherConnectorInterface
     */
    protected $weatherConnector;

    /**
     * Instance of DailyConnectorInterface
     *
     * @var DailyConnectorInterface
     */
    protected $dailyConnector;

    /**
     * Instance of ForecastConnectorInterface
     *
     * @var ForecastConnectorInterface
     */
    protected $forecastConnector;

    /**
     * An array of default options that are supplied to Connector
     * instances when queries are made
     *
     * @var array
     */
    protected $defaults;

    /**
     * Constructor
     *
     * @param array $options Array of default options
     *
     * @return void
     */
    public function __construct($options = array())
    {
        $this->setOptions($options);
    }

    /**
     * This method will return an array of default query parameters
     *
     * If the defaults have not already been set, calling this method
     * will set the defaults property to an empty array
     *
     * @return array
     */
    public function getDefaults()
    {
        if (! isset($this->defaults)) {
            $this->defaults = array();
        }
        return $this->defaults;
    }

    /**
     * Set the defaults
     *
     * @param array $defaults
     *
     * @return OpenWeatherMap
     */
    public function setDefaults($defaults = array())
    {
        if (is_array($defaults)) {
            $defaults = array_intersect_key($defaults, array_flip(array(
                'latitude', 'longitude',
                'apiKey',   'query',
                'count',    'mode',
                'units',    'language',
                'id'
            )));
            $this->defaults = $defaults;
        }
        return $this;
    }

    /**
     * Set the options values
     *
     * @param array $options
     *
     * @return OpenWeatherMap
     */
    public function setOptions($options = array())
    {
        if (is_array($options) || ($options instanceof Traversable)) {

            foreach ($options as $key => $value) {
                $key = strtolower($key);
                switch ($key) {
                    case 'defaults':
                        $this->setDefaults($value);
                        break;
                    case 'connectorfactory':
                        $this->setConnectorFactory($value);
                        break;
                }
            }
        }
        return $this;
    }

    /**
     * Merge the supplied options with the previously set defaults
     *
     * This method will strip out certain default options if the supplied
     * options contains certain other keys.
     *
     * @param array $options
     *
     * @return array
     */
    public function mergeOptions($options = array())
    {
        $defaultOptions = $this->getDefaults();
        if (isset($options['query'])) {
            unset($defaultOptions['latitude']);
            unset($defaultOptions['longitude']);
            unset($defaultOptions['id']);
        }
        if (isset($options['longitude']) &&
            isset($options['latitude'])
        ) {
            unset($defaultOptions['id']);
            unset($defaultOptions['query']);
        }
        if (isset($options['id'])) {
            unset($defaultOptions['query']);
            unset($defaultOptions['latitude']);
            unset($defaultOptions['longitude']);
        }
        return $defaultOptions + $options;
    }

    /**
     * Set the ConnectorFactory instance
     *
     * This method accepts an instance of ConnectorFactoryInterface or an instance
     * of parameters that will be used to configure an instance of
     * ConnectorFactory
     *
     * @param ConnectorFactoryInterface|array $connectorFactory
     *
     * @return OpenWeatherMap
     */
    public function setConnectorFactory($connectorFactory = array())
    {
        if (is_array($connectorFactory)) {
            $connectorFactory = new ConnectorFactory($connectorFactory);
        }
        if ($connectorFactory instanceof ConnectorFactoryInterface) {
            $this->connectorFactory = $connectorFactory;
        }
        return $this;
    }

    /**
     * Return the ConnectorFactory instance
     *
     * This method will instantiate an instance of ConnectorFactory and set
     * the instance property if an instance has not already been set
     *
     * @return ConnectorFactoryInterface
     */
    public function getConnectorFactory()
    {
        if (! isset($this->connectorFactory)) {
            $this->connectorFactory = new ConnectorFactory();
        }
        return $this->connectorFactory;
    }

    /**
     * Return the instance of WeatherConnectorInterface
     *
     * @return WeatherConnectorInterface
     */
    public function getWeatherConnector()
    {
        if (! isset($this->weatherConnector)) {
            $this->weatherConnector = $this->getConnectorFactory()->getWeatherConnector();
        }
        return $this->weatherConnector;
    }

    /**
     * Return an instance of DailyConnectorInterface
     *
     * @return DailyConnectorInterface
     */
    public function getDailyConnector()
    {
        if (! isset($this->dailyConnector)) {
            $this->dailyConnector = $this->getConnectorFactory()->getDailyConnector();
        }
        return $this->dailyConnector;
    }

    /**
     * Return an instance of ForecastConnectorInterface
     *
     * @return ForecastConnectorInterface
     */
    public function getForecastConnector()
    {
        if (! isset($this->forecastConnector)) {
            $this->forecastConnector = $this->getConnectorFactory()->getForecastConnector();
        }
        return $this->forecastConnector;
    }

    /**
     * Return an instance of \OpenWeatherMap\Entity\Current
     *
     * @param array $options
     *
     * @return Current
     */
    public function getWeather($options = array())
    {
        $options = $this->mergeOptions($options);
        return $this->getWeatherConnector()->getWeather($options);
    }

    /**
     * Return an instance of WeatherData
     *
     * Accepted options are:
     * - mode
     * - language
     * - units
     * - apiKey
     * - query|id|latitude & longitude
     * - count (<= 14)
     *
     * @param array $options
     *
     * @return WeatherData
     */
    public function getDaily($options = array())
    {
        $options = $this->mergeOptions($options);
        return $this->getDailyConnector()->getDaily($options);
    }

    /**
     * Return an instance of WeatherData
     *
     * @param array $options
     *
     * @return WeatherData
     */
    public function getForecast($options = array())
    {
        $options = $this->mergeOptions($options);
        return $this->getForecastConnector()->getForecast($options);
    }
}
