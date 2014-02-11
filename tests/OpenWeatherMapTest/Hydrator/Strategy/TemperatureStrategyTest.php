<?php
/**
 * TemperatureStrategyTest.php
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

use OpenWeatherMap\Entity\Temperature;
use OpenWeatherMap\Hydrator\Strategy\TemperatureStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * TemperatureStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class TemperatureStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate an instance of Temperature
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\TemperatureStrategy::hydrate
     */
    public function testHydrate()
    {
        $day = 263.09;
        $min = 262.93;
        $max = 263.88;
        $night = 263.88;
        $eve = 263.09;
        $morn = 263.09;
        $strategy = new TemperatureStrategy();

        $temperature = $strategy->hydrate(compact(
            'day', 'min', 'max', 'night', 'eve', 'morn'
        ));

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Temperature', $temperature);
    }

    /**
     * Test that attempting to call hydrate with a non array parameter results in
     * null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\TemperatureStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $strategy = new TemperatureStrategy();

        $this->assertNull($strategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract the values from an instance of Temperature
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\TemperatureStrategy::extract
     */
    public function testExtract()
    {
        $day     = 263.09;
        $min     = 262.93;
        $max     = 263.88;
        $night   = 263.88;
        $evening = 263.09;
        $morning = 263.09;
        $temperature = new Temperature();
        $temperature->setDay($day)
            ->setMin($min)
            ->setMax($max)
            ->setNight($night)
            ->setEvening($evening)
            ->setMorning($morning);
        $strategy = new TemperatureStrategy();
        $values = $strategy->extract($temperature);

        $this->assertArrayHasKey('day', $values);
        $this->assertArrayHasKey('min', $values);
        $this->assertArrayHasKey('max', $values);
        $this->assertArrayHasKey('night', $values);
        $this->assertArrayHasKey('evening', $values);
        $this->assertArrayHasKey('morning', $values);
    }

    /**
     * Test that attempting to extract the values from a non Temperature instance
     * results in null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\TemperatureStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $strategy = new TemperatureStrategy();

        $this->assertNull($strategy->extract(new stdClass()));
    }
}
