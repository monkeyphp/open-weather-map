<?php
/**
 * HumidityTest.php
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

use OpenWeatherMap\Entity\Humidity;
use PHPUnit_Framework_TestCase;

/**
 * HumidityTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class HumidityTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can get and set the value
     *
     * @covers \OpenWeatherMap\Entity\Humidity::getValue
     * @covers \OpenWeatherMap\Entity\Humidity::setValue
     */
    public function testSetGetValue()
    {
        $humidity = new Humidity();
        $value = 90;

        $this->assertNull($humidity->getValue());
        $this->assertSame($humidity, $humidity->setValue($value));
        $this->assertEquals($value, $humidity->getValue());
    }

    /**
     * Test that we can get and set the unit
     *
     * @covers \OpenWeatherMap\Entity\Humidity::getUnit
     * @covers \OpenWeatherMap\Entity\Humidity::setUnit
     */
    public function testGetSetUnit()
    {
        $humidity = new Humidity();
        $unit = '%';

        $this->assertNull($humidity->getUnit());
        $this->assertSame($humidity, $humidity->setUnit($unit));
        $this->assertEquals($unit, $humidity->getUnit());
    }
}
