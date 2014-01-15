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
     * An array of options that are supplied to Connector instances when then
     * are created
     * 
     * @var array
     */
    protected $options;
    
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
     * Return the options value
     * 
     * @return array
     */
    public function getOptions()
    {
        if (! isset($this->options)) {
            $this->options = array();
        }
        return $this->options;
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
        $this->options = $options;
        return $this;
    }
    
    /**
     * Merge the supplied options with the 
     * previously set options
     * 
     * @param array $options
     * 
     * @return array
     */
    public function mergeOptions($options = array())
    {
        $defaultOptions = $this->getOptions();
        
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
     * @param ConnectorFactoryInterface $connectorFactory
     * 
     * @return OpenWeatherMap
     */
    public function setConnectorFactory(ConnectorFactoryInterface $connectorFactory)
    {
        $this->connectorFactory = $connectorFactory;
        return $this;
    }
    
    /**
     * Return the ConnectorFactory instance
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
