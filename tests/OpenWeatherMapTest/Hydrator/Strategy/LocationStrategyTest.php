<?php
/**
 * LocationStrategyTest.php
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

use OpenWeatherMap\Entity\Location;
use OpenWeatherMap\Hydrator\Strategy\LocationStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * LocationStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class LocationStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate an Location instance
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\LocationStrategy::hydrate
     */
    public function testHydrate()
    {
        $value = array();
        $locationStrategy = new LocationStrategy();

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Location', $locationStrategy->hydrate($value));
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\LocationStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $value = new stdClass();
        $locationStrategy = new LocationStrategy();

        $this->assertNull($locationStrategy->hydrate($value));
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\LocationStrategy::hydrate
     */
    public function testHydrateGeobaseId()
    {
        $geobaseId = 10;
        $value = array(
            'geobaseid' => $geobaseId
        );
        $locationStrategy = new LocationStrategy();
        $location = $locationStrategy->hydrate($value);

        $this->assertEquals($geobaseId, $location->getGeobaseId());
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\LocationStrategy::hydrate
     */
    public function testHydrateLocation()
    {
        $altitude = 0;
        $location = array(
            'altitude' => $altitude
        );
        $value = array(
            'location' => $location
        );
        $locationStrategy = new LocationStrategy();
        $entity = $locationStrategy->hydrate($value);

        $this->assertEquals($entity->getAltitude(), $altitude);
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\LocationStrategy::extract
     */
    public function testExtract()
    {
        $location = new Location();
        $location->setAltitude(5);
        $locationStrategy = new LocationStrategy();

        $array = $locationStrategy->extract($location);

        $this->assertArrayHasKey('altitude', $array);
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\LocationStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $locationStrategy = new LocationStrategy();
        $this->assertNull($locationStrategy->extract(new stdClass()));
    }
}
