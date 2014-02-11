<?php
/**
 * PressureTest.php
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

use OpenWeatherMap\Entity\Pressure;
use PHPUnit_Framework_TestCase;

/**
 * PressureTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class PressureTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \OpenWeatherMap\Entity\Pressure::getValue
     * @covers \OpenWeatherMap\Entity\Pressure::setValue
     */
    public function testGetSetValue()
    {
        $value = "965.98";
        $pressure = new Pressure();

        $this->assertNull($pressure->getValue());
        $this->assertSame($pressure, $pressure->setValue($value));
        $this->assertEquals($value, $pressure->getValue());
    }

    /**
     * @covers \OpenWeatherMap\Entity\Pressure::getUnit
     * @covers \OpenWeatherMap\Entity\Pressure::setUnit
     */
    public function testGetSetUnit()
    {
        $unit = 'hPa';
        $pressure = new Pressure();

        $this->assertNull($pressure->getUnit());
        $this->assertSame($pressure, $pressure->setUnit($unit));
        $this->assertEquals($unit, $pressure->getUnit());
    }
}
