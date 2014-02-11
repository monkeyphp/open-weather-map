<?php
/**
 * CloudsTest.php
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

use OpenWeatherMap\Entity\Clouds;
use PHPUnit_Framework_TestCase;

/**
 * CloudsTest
 *
 * <clouds value="overcast clouds" all="92" unit="%"/>
 * <clouds value="44" name="scattered clouds"/>
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class CloudsTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can get and set the value
     *
     * @covers \OpenWeatherMap\Entity\Clouds::getValue
     * @covers \OpenWeatherMap\Entity\Clouds::setValue
     */
    public function testGetSetValue()
    {
        $clouds = new Clouds();
        $value = 44;

        $this->assertNull($clouds->getValue());
        $this->assertSame($clouds, $clouds->setValue($value));
        $this->assertEquals($value, $clouds->getValue());
    }

    /**
     * Test that we can get and set the name
     *
     * @covers \OpenWeatherMap\Entity\Clouds::getName
     * @covers \OpenWeatherMap\Entity\Clouds::setName
     */
    public function testGetSetName()
    {
        $clouds = new Clouds();
        $name = 'scattered clouds';

        $this->assertNull($clouds->getName());
        $this->assertSame($clouds, $clouds->setName($name));
        $this->assertEquals($name, $clouds->getName());
    }

    /**
     * Test that we can get and set the all
     *
     * @covers \OpenWeatherMap\Entity\Clouds::getAll
     * @covers \OpenWeatherMap\Entity\Clouds::setAll
     */
    public function testGetSetAll()
    {
        $clouds = new Clouds();
        $all = 92;

        $this->assertNull($clouds->getAll());
        $this->assertSame($clouds, $clouds->setAll($all));
        $this->assertEquals($all, $clouds->getAll());
    }

    /**
     * Test that we can get and set the unit
     *
     * @covers \OpenWeatherMap\Entity\Clouds::getUnit
     * @covers \OpenWeatherMap\Entity\Clouds::setUnit
     */
    public function testGetSetUnit()
    {
        $clouds = new Clouds();
        $unit = '%';

        $this->assertNull($clouds->getUnit());
        $this->assertSame($clouds, $clouds->setUnit($unit));
        $this->assertEquals($unit, $clouds->getUnit());
    }
}
