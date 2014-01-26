<?php
/**
 * WindSpeedTest.php
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

use OpenWeatherMap\Entity\WindSpeed;
use PHPUnit_Framework_TestCase;

/**
 * WindSpeedTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WindSpeedTest extends PHPUnit_Framework_TestCase
{
    public function testGetSetName()
    {
        $name = "Gentle Breeze";
        $windSpeed = new WindSpeed();
        
        $this->assertNull($windSpeed->getName());
        $this->assertSame($windSpeed, $windSpeed->setName($name));
        $this->assertEquals($name, $windSpeed->getName());
    }
    
    public function testSetNameThrowsException()
    {
        $windSpeed = new WindSpeed();
        
        $this->setExpectedException('\InvalidArgumentException');
        
        $windSpeed->setName(new \stdClass());
    }
    
    public function testGetSetValue()
    {
        $value = 1.25;
        $windSpeed = new WindSpeed();
        
        $this->assertNull($windSpeed->getValue());
        $this->assertSame($windSpeed, $windSpeed->setValue($value));
        $this->assertEquals($value, $windSpeed->getValue());
    }
    
    public function testSetValueThrowsException()
    {
        $windSpeed = new WindSpeed();
        
        $this->setExpectedException('\InvalidArgumentException');
        
        $windSpeed->setValue(new \stdClass());
    }
    
    public function testSetGetMps()
    {
        $mps = "3.91";
        $windSpeed = new WindSpeed();
        
        $this->assertNull($windSpeed->getMps());
        $this->assertSame($windSpeed, $windSpeed->setMps($mps));
        $this->assertEquals($mps, $windSpeed->getMps());
    }
}
