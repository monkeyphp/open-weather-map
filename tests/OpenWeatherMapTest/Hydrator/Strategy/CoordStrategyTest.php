<?php
/**
 * CoordStrategyTest.php
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

use OpenWeatherMap\Entity\Coord;
use OpenWeatherMap\Hydrator\Strategy\CoordStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * CoordStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class CoordStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate an instance of Coord
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CoordStrategy::hydrate
     */
    public function testHydrate()
    {
        $lon = 145.77;
        $lat = -16.92;
        $strategy = new CoordStrategy();

        $coord = $strategy->hydrate(compact('lon', 'lat'));

        $this->assertEquals($lon, $coord->getLongitude());
        $this->assertEquals($lat, $coord->getLatitude());
    }

    /**
     * Test that attempting to hydrate using a non array parameter results
     * in null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CoordStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $strategy = new CoordStrategy();

        $this->assertNull($strategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract the values from an instance of Coord
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CoordStrategy::extract
     */
    public function testExtract()
    {
        $latitude = -16.92;
        $longitude = 145.77;
        $coord = new Coord();
        $coord->setLatitude($latitude)->setLongitude($longitude);
        $strategy = new CoordStrategy();

        $values = $strategy->extract($coord);

        $this->assertArrayHasKey('latitude', $values);
        $this->assertArrayHasKey('longitude', $values);
    }

    /**
     * Test that attempting to extract the values from a non Coord parameter
     * results in null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CoordStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $strategy = new CoordStrategy();

        $this->assertNull($strategy->extract(new stdClass()));
    }
}
