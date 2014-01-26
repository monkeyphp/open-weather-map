<?php
/**
 * TimeStrategyTest.php
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

use OpenWeatherMap\Entity\Time;
use OpenWeatherMap\Hydrator\Strategy\TimeStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * TimeStrategyTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class TimeStrategyTest extends PHPUnit_Framework_TestCase
{
    public function testHydrate()
    {
        $value = array();
        $timeStrategy = new TimeStrategy();
        
        $time = $timeStrategy->hydrate($value);
        
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Time', $time);
    }
    
    public function testHydrateReturnsNull()
    {
        $value = new stdClass();
        $timeStrategy = new TimeStrategy();
        
        $this->assertNull($timeStrategy->hydrate($value));
    }
    
    public function testExtract()
    {
        $from = '2014-01-26T18:00:00';
        $time = new Time();
        $time->setFrom($from);
        $timeStrategy = new TimeStrategy();
        
        $array = $timeStrategy->extract($time);
        
        $this->assertArrayHasKey('from', $array);
    }
    
    public function testExtractReturnsNull()
    {
        $timeStrategy = new TimeStrategy();
        $this->assertNull($timeStrategy->extract(new stdClass()));
    }
}
