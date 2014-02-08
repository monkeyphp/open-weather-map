<?php
/**
 * CityStrategyTest.php
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

use OpenWeatherMap\Entity\City;
use OpenWeatherMap\Hydrator\Strategy\CityStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * CityStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class CityStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate a City instance
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CityStrategy::hydrate
     */
    public function testHydrate()
    {
        $id = 1; $name = 'London';
        $value = array(
            'id'   => $id,
            'name' => $name
        );
        $cityStrategy = new CityStrategy();

        $city = $cityStrategy->hydrate($value);

        $this->assertInstanceOf('\OpenWeatherMap\Entity\City', $city);
        $this->assertEquals($id, $city->getId());
        $this->assertEquals($name, $city->getName());
    }

    /**
     * Test that attempting to hydrate using a non array parameter will return
     * null
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CityStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $cityStrategy = new CityStrategy();

        $this->assertNull($cityStrategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract values from a City instance
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CityStrategy::extract
     */
    public function testExtract()
    {
        $cityStrategy = new CityStrategy();
        $city = new City();
        $city->setId(123)->setName('Los Angeles');

        $values = $cityStrategy->extract($city);

        $this->assertArrayHasKey('id', $values);
        $this->assertArrayHasKey('name', $values);
    }

    /**
     * Test that attempting to extract values from a non City instance
     * returns null
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CityStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $cityStrategy = new CityStrategy();

        $this->assertNull($cityStrategy->extract(new stdClass()));
    }
}
