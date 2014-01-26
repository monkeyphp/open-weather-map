<?php
/**
 * WeatherTest.php
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

use OpenWeatherMap\Entity\Weather;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * WeatherTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WeatherTest extends PHPUnit_Framework_TestCase
{
    public function testGetSetNumber()
    {
        $number = "802";
        $weather = new Weather();
        
        $this->assertNull($weather->getNumber());
        $this->assertSame($weather, $weather->setNumber($number));
        $this->assertEquals($number, $weather->getNumber());
    }
    
    public function testSetNumberThrowsException()
    {
        $weather = new Weather();
        $this->setExpectedException('\InvalidArgumentException');
        $weather->setNumber(new stdClass());
    }
    
    public function testGetSetValue()
    {
        $value = "scattered clouds";
        $weather = new Weather();
        
        $this->assertNull($weather->getValue());
        $this->assertSame($weather, $weather->setValue($value));
        $this->assertEquals($value, $weather->getValue());
    }
    
    public function testSetValueThrowsException()
    {
        $weather = new Weather();
        $this->setExpectedException('\InvalidArgumentException');
        $weather->setValue(new stdClass());
    }
    
    public function testGetSetIcon()
    {
        $icon = "03n";
        $weather = new Weather();
        
        $this->assertNull($weather->getIcon());
        $this->assertSame($weather, $weather->setIcon($icon));
        $this->assertEquals($icon, $weather->getIcon());
    }
    
    public function testSetIconThrowsException()
    {
        $weather = new Weather();
        $this->setExpectedException('\InvalidArgumentException');
        $weather->setIcon(new stdClass());
    }
}
