<?php
/**
 * TemperatureTest.php
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

use OpenWeatherMap\Entity\Temperature;
use PHPUnit_Framework_TestCase;

/**
 * TemperatureTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class TemperatureTest extends PHPUnit_Framework_TestCase
{
    // <temperature value="299.867" min="299.867" max="299.867" unit="kelvin"/>
    // <temperature day="6.07" min="1.5" max="6.07" night="1.57" 
    // eve="4.23" morn="6.07"/>
    public function testGetSetDay() 
    {
        $day = "6.07";
        $temperature = new Temperature();
        
        $this->assertNull($temperature->getDay());
        $this->assertSame($temperature, $temperature->setDay($day));
        $this->assertEquals($day, $temperature->getDay());
    }
    
    public function testGetSetMin() 
    {
        $min = "1.5";
        $temperature = new Temperature();
        
        $this->assertNull($temperature->getMin());
        $this->assertSame($temperature, $temperature->setMin($min));
        $this->assertEquals($min, $temperature->getMin());
    }
    
    public function testGetSetMax()
    {
        $max = "6.07";
        $temperature = new Temperature();
        
        $this->assertNull($temperature->getMax());
        $this->assertSame($temperature, $temperature->setMax($max));
        $this->assertEquals($max, $temperature->getMax());
    }
    
    public function testGetSetNight()
    {
        $night = "1.57";
        $temperature = new Temperature();
        
        $this->assertNull($temperature->getNight());
        $this->assertSame($temperature, $temperature->setNight($night));
        $this->assertEquals($night, $temperature->getNight());
    }
    
    public function testGetSetEvening()
    {
        $evening = "4.23";
        $temperature = new Temperature();
        
        $this->assertNull($temperature->getEvening());
        $this->assertSame($temperature, $temperature->setEvening($evening));
        $this->assertEquals($evening, $temperature->getEvening());
    }
    
    public function testGetSetMorning()
    {
        $morning = "6.07";
        $temperature = new Temperature();
        
        $this->assertNull($temperature->getMorning());
        $this->assertSame($temperature, $temperature->setMorning($morning));
        $this->assertEquals($morning, $temperature->getMorning());
    }
    
    public function testGetSetValue()
    {
        $value = "299.867";
        $temperature = new Temperature();
        
        $this->assertNull($temperature->getValue());
        $this->assertSame($temperature, $temperature->setValue($value));
        $this->assertEquals($value, $temperature->getValue());
    }
    
    public function testGetSetUnit() 
    {
        $unit = "kelvin";
        $temperature = new Temperature();
        
        $this->assertNull($temperature->getUnit());
        $this->assertSame($temperature, $temperature->setUnit($unit));
        $this->assertEquals($unit, $temperature->getUnit());
    }
}
