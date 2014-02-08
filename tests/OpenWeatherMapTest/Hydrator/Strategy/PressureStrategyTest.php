<?php
/**
 * PressureStrategyTest.php
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
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
namespace OpenWeatherMapTest\Hydrator\Strategy;

use OpenWeatherMap\Entity\Pressure;
use OpenWeatherMap\Hydrator\Strategy\PressureStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * PressureStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class PressureStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate an instance of Pressure
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\PressureStrategy::hydrate
     */
    public function testHydrate()
    {
        $unit = 'hPa';
        $value = 1011.45;
        $strategy = new PressureStrategy();

        $pressure = $strategy->hydrate(compact('unit', 'value'));

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Pressure', $pressure);
        $this->assertEquals($pressure->getUnit(), $unit);
        $this->assertEquals($pressure->getValue(), $value);
    }

    /**
     * Test that supplying a non array to hydrate results in null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\PressureStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $strategy = new PressureStrategy();

        $this->assertNull($strategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract the values from an instance of Pressure
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\PressureStrategy::extract
     */
    public function testExtract()
    {
        $unit = 'hPa';
        $value = 1011.45;
        $pressure = new Pressure();
        $pressure->setUnit($unit)->setValue($value);
        $strategy = new PressureStrategy();

        $values = $strategy->extract($pressure);

        $this->assertArrayHasKey('unit', $values);
        $this->assertArrayHasKey('value', $values);
    }

    /**
     * Test that attempting to extract the values from a non Pressure instance
     * results in null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\PressureStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $strategy = new PressureStrategy();

        $this->assertNull($strategy->extract(new stdClass()));
    }
}
