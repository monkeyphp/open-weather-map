<?php
/**
 * WeatherConnectorTest.php
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com>
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
namespace OpenWeatherMapTest\Connector;

use OpenWeatherMap\Connector\WeatherConnector;
use PHPUnit_Framework_TestCase;

/**
* WeatherConnectorTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WeatherConnectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can construct an instance of WeatherConnector
     */
    public function test__construct()
    {
        $weatherConnector = new WeatherConnector();
        
        $this->assertInstanceOf('\OpenWeatherMap\Connector\WeatherConnectorInterface', $weatherConnector);
        $this->assertInstanceOf('\OpenWeatherMap\Connector\AbstractConnector', $weatherConnector);
    }
    
    /**
     * Test that we can get the end point
     */
    public function testGetEndPoint()
    {
        $weatherConnector = new WeatherConnector();
        
        $this->assertInternalType('string', $weatherConnector->getEndPoint());
    }
    
    /**
     * Test that we can get a Current instance from the WeatherConnector when 
     * we search with a query
     */
    public function testGetWeatherUsingQuery()
    {
        $weatherConnector = new WeatherConnector();
        $options = array(
            'query' => 'New York'
        );
        // http://api.openweathermap.org/data/2.5/weather?q=New+York&mode=xml
        $results = file_get_contents(__DIR__ . '/../../data/weather/xml/new_york.xml');
        
        $mockResponse = $this->getMock('\Zend\Http\Response');
        $mockResponse->expects($this->once())
            ->method('isSuccess')
            ->will($this->returnValue(true));
        
        $mockResponse->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($results));
        
        $mockClient = $this->getMock('\Zend\Http\Client');
        $mockClient->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf('\Zend\Http\Request'))
            ->will($this->returnValue($mockResponse));
        
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\Lock', array(), array(), 'mockLock', false);
        
        $mockLock->expects($this->once())
            ->method('lock')
            ->will($this->returnValue(true));
        
        $mockLock->expects($this->once())
            ->method('unlock')
            ->will($this->returnValue(true));
        
        $weatherConnector->setHttpClient($mockClient);
        $weatherConnector->setLock($mockLock);
        
        $current = $weatherConnector->getWeather($options);
        
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Current', $current);
    }
    
    /**
     * Test that we can get a Current instance from the WeatherConnector when
     * we search with latitude and longitude
     */
    public function testGetWeatherUsingLatitudeLongitude()
    {
        $weatherConnector = new WeatherConnector();
        $options = array(
            'latitude'   => 35,
            'longitude' => 139
        );
        // http://api.openweathermap.org/data/2.5/weather?lat=35&lon=139&mode=xml
        $results = file_get_contents(__DIR__ . '/../../data/weather/xml/lat_35_lng_139.xml');
        $mockResponse = $this->getMock('\Zend\Http\Response');
        $mockResponse->expects($this->once())
            ->method('isSuccess')
            ->will($this->returnValue(true));
        
        $mockResponse->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($results));
        
        $mockClient = $this->getMock('\Zend\Http\Client');
        $mockClient->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf('\Zend\Http\Request'))
            ->will($this->returnValue($mockResponse));
        
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\Lock', array(), array(), 'mockLock', false);
        
        $mockLock->expects($this->once())
            ->method('lock')
            ->will($this->returnValue(true));
        
        $mockLock->expects($this->once())
            ->method('unlock')
            ->will($this->returnValue(true));
        
        $weatherConnector->setHttpClient($mockClient);
        $weatherConnector->setLock($mockLock);
        
        $current = $weatherConnector->getWeather($options);
        
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Current', $current);
        $this->assertInstanceOf('\OpenWeatherMap\Entity\City', $current->getCity());
    }
    
    /**
     * Test that we can get a Current instance from the WeatherConnector when
     * we search with an id
     */
    public function testGetWeatherUsingId()
    {
        $weatherConnector = new WeatherConnector();
        $options = array(
            'id'   => 2172797
        );
        // http://api.openweathermap.org/data/2.5/weather?id=2172797&mode=xml 
        $results = file_get_contents(__DIR__ . '/../../data/weather/xml/2172797.xml');
        
        $mockResponse = $this->getMock('\Zend\Http\Response');
        $mockResponse->expects($this->once())
            ->method('isSuccess')
            ->will($this->returnValue(true));
        
        $mockResponse->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($results));
        
        $mockClient = $this->getMock('\Zend\Http\Client');
        $mockClient->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf('\Zend\Http\Request'))
            ->will($this->returnValue($mockResponse));
        
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\Lock', array(), array(), 'mockLock', false);
        
        $mockLock->expects($this->once())
            ->method('lock')
            ->will($this->returnValue(true));
        
        $mockLock->expects($this->once())
            ->method('unlock')
            ->will($this->returnValue(true));
        
        $weatherConnector->setHttpClient($mockClient);
        $weatherConnector->setLock($mockLock);
        
        $current = $weatherConnector->getWeather($options);
        
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Current', $current);
        $this->assertInstanceOf('\OpenWeatherMap\Entity\City', $current->getCity());
    }
}
