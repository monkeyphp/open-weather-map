<?php
/**
 * OpenWeatherMapTest.php
 * 
 * @category OpenWeatherMapTest
 * @package  OpenWeatherMapTest
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
namespace OpenWeatherMapTest;

use OpenWeatherMap\OpenWeatherMap;
use PHPUnit_Framework_TestCase;

/**
 * OpenWeatherMapTest
 * 
 * @category OpenWeatherMapTest
 * @package  OpenWeatherMapTest
 * @author   David White [monkeyphp] <david@monkeyphp.com>
 */
class OpenWeatherMapTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can create an instance of OpenWeatherMap
     */
    public function test__construct()
    {
        $openWeatherMap = new OpenWeatherMap();
        $this->assertInstanceOf('\OpenWeatherMap\OpenWeatherMapInterface', $openWeatherMap);
    }
    
    /**
     * Test that we can pass an options array when constructing an instance
     * of OpenWeatherMap
     */
    public function test__constructWithOptions()
    {
        $options = array();
        $openWeatherMap = new OpenWeatherMap($options);
        
        $this->assertEquals($options, $openWeatherMap->getOptions());
    }
    
    /**
     * Test that we can set the options value
     */
    public function testSetOptions()
    {
        $options = array('foo' => 'bar');
        $openWeatherMap = new OpenWeatherMap();
        
        $this->assertSame($openWeatherMap, $openWeatherMap->setOptions($options));
    }
    
    /**
     * Test that calling getOptions will return an array if the options value 
     * has not already been set
     */
    public function testGetOptionsReturnsEmptyArray()
    {
        $openWeatherMap = new OpenWeatherMap();
        $this->assertInternalType('array', $openWeatherMap->getOptions());
    }
    
    /**
     * Test that supplying 'query' in the array to mergeOptions will unset 
     * the 'latitude' key in the default options passed to OpenWeatherMap
     * constructor
     */
    public function testMergeOptionsWithQuery()
    {
        $defaults = array('latitude' => 10.0);
        $options = array('query' => 'London,UK');
        $openWeatherMap = new OpenWeatherMap($defaults);
        
        $this->assertSame($defaults, $openWeatherMap->getOptions());
        $this->assertArrayNotHasKey('latitude', $openWeatherMap->mergeOptions($options));
    }
    
    /**
     * Test that calling getConnectorFactory will return an instance
     * of ConnectorFactoryInterface
     */
    public function testGetConnectorFactory()
    {
        $openWeatherMap = new OpenWeatherMap();
        $this->assertInstanceOf('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface', $openWeatherMap->getConnectorFactory());
    }
    
    /**
     * Test that we can set the connector factory instance
     */
    public function testSetConnectorFactory()
    {
        $openWeatherMap = new OpenWeatherMap();
        $mockConnectorFactory = $this->getMock('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface');
        
        $this->assertSame($openWeatherMap, $openWeatherMap->setConnectorFactory($mockConnectorFactory));
        $this->assertSame($mockConnectorFactory, $openWeatherMap->getConnectorFactory());
    }
    
    /**
     * Test that calling getWeatherConnector will return an instance of
     * WeatherConnectorInterface
     */
    public function testGetWeatherConnector()
    {
        $openWeatherMap = new OpenWeatherMap();
        $mockConnectorFactory = $this->getMock('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface');
        $mockWeatherConnector = $this->getMock('\OpenWeatherMap\Connector\WeatherConnectorInterface');
        $openWeatherMap->setConnectorFactory($mockConnectorFactory);
                
        $mockConnectorFactory->expects($this->once())
            ->method('getWeatherConnector')
            ->will($this->returnValue($mockWeatherConnector));
        
        $this->assertSame($mockWeatherConnector, $openWeatherMap->getWeatherConnector());
    }
    
    /**
     * Test that calling getDailyConnector will return an instance of
     * DailyConnectorInterface
     */
    public function testGetDailyConnector()
    {
        $openWeatherMap = new OpenWeatherMap();
        $mockConnectorFactory = $this->getMock('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface');
        $mockDailyConnector = $this->getMock('\OpenWeatherMap\Connector\DailyConnectorInterface');
        $openWeatherMap->setConnectorFactory($mockConnectorFactory);
                
        $mockConnectorFactory->expects($this->once())
            ->method('getDailyConnector')
            ->will($this->returnValue($mockDailyConnector));
        
        $this->assertSame($mockDailyConnector, $openWeatherMap->getDailyConnector());
    }
    
    /**
     * Test that calling getForecaseConnector will return an instanc of 
     * ForecastConnectorInterface
     */
    public function testGetForecaseConnector()
    {
        $openWeatherMap = new OpenWeatherMap();
        $mockConnectorFactory = $this->getMock('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface');
        $mockForecastConnector = $this->getMock('\OpenWeatherMap\Connector\ForecastConnectorInterface');
        $openWeatherMap->setConnectorFactory($mockConnectorFactory);
                
        $mockConnectorFactory->expects($this->once())
            ->method('getForecastConnector')
            ->will($this->returnValue($mockForecastConnector));
        
        $this->assertSame($mockForecastConnector, $openWeatherMap->getForecastConnector());
    }
}
