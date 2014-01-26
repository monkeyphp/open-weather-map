<?php
/**
 * WeatherDataTest.php
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
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
namespace OpenWeatherMapTest\Entity;

use OpenWeatherMap\Entity\Credit;
use OpenWeatherMap\Entity\Forecast;
use OpenWeatherMap\Entity\Location;
use OpenWeatherMap\Entity\Meta;
use OpenWeatherMap\Entity\Sun;
use OpenWeatherMap\Entity\WeatherData;
use PHPUnit_Framework_TestCase;

/**
 * WeatherDataTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WeatherDataTest extends PHPUnit_Framework_TestCase
{
    public function testGetSetLocation() 
    {
        $location = new Location();
        $weatherData = new WeatherData();
        
        $this->assertNull($weatherData->getLocation());
        $this->assertSame($weatherData, $weatherData->setLocation($location));
        $this->assertSame($location, $weatherData->getLocation());
    }
    
    public function testGetSetCredit() 
    {
        $credit = new Credit();
        $weatherData = new WeatherData();
        
        $this->assertNull($weatherData->getCredit());
        $this->assertSame($weatherData, $weatherData->setCredit($credit));
        $this->assertSame($credit, $weatherData->getCredit());
    }
    
    public function testGetSetMeta() 
    {
        $meta = new Meta();
        $weatherData = new WeatherData();
        
        $this->assertNull($weatherData->getMeta());
        $this->assertSame($weatherData, $weatherData->setMeta($meta));
        $this->assertSame($meta, $weatherData->getMeta());
    }
    
    public function testGetSetSun() 
    {
        $sun = new Sun();
        $weatherData = new WeatherData();
        
        $this->assertNull($weatherData->getSun());
        $this->assertSame($weatherData, $weatherData->setSun($sun));
        $this->assertSame($sun, $weatherData->getSun());
    }
    
    public function testGetSetForecast() 
    {
        $forecast = new Forecast();
        $weatherData = new WeatherData();
        
        $this->assertNull($weatherData->getForecast());
        $this->assertSame($weatherData, $weatherData->setForecast($forecast));
        $this->assertSame($forecast, $weatherData->getForecast());
    }
}
