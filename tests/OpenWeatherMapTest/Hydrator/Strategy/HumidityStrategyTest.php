<?php
/**
 * HumidityStrategyTest.php
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

use OpenWeatherMap\Entity\Humidity;
use OpenWeatherMap\Hydrator\Strategy\HumidityStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * HumidityStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class HumidityStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate an instance of Humidity
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\HumidityStrategy::hydrate
     */
    public function testHydrate()
    {
        $value = 85;
        $unit = '%';
        $strategy = new HumidityStrategy();

        $humidity = $strategy->hydrate(compact('value', 'unit'));

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Humidity', $humidity);
        $this->assertEquals($value, $humidity->getValue());
        $this->assertEquals($unit, $humidity->getUnit());
    }

    /**
     * Test that attempting to hydrate using a non array parameter returns null
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\HumidityStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $strategy = new HumidityStrategy();

        $this->assertNull($strategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract values from an instance of Humidity
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\HumidityStrategy::extract
     */
    public function testExtract()
    {
        $value = 10;
        $unit = '%';
        $humidity = new Humidity();
        $humidity->setValue($value)->setUnit($unit);
        $strategy = new HumidityStrategy();

        $values = $strategy->extract($humidity);

        $this->assertArrayHasKey('value', $values);
        $this->assertArrayHasKey('unit', $values);
    }

    /**
     * Test that attempting to extract values from a non Humidity instance results
     * in null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\HumidityStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $strategy = new HumidityStrategy();

        $this->assertNull($strategy->extract(new stdClass()));
    }
}
