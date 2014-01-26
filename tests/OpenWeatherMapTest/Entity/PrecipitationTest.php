<?php
/**
 * PrecipitationTest.php
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

use OpenWeatherMap\Entity\Precipitation;
use PHPUnit_Framework_TestCase;

/**
 * PrecipitationTest.php
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class PrecipitationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can set and get the mode value
     */
    public function testGetSetMode()
    {
        $mode = 'no';
        $precipitation = new Precipitation();
        
        $this->assertNull($precipitation->getMode());
        $this->assertSame($precipitation, $precipitation->setMode($mode));
        $this->assertEquals($mode, $precipitation->getMode());
    }
}
