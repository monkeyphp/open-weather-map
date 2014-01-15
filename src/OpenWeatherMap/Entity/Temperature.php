<?php
/**
 * Temperature.php
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
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
namespace OpenWeatherMap\Entity;

/**
 * Temperature
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Temperature
{
    protected $day;
    
    protected $min;
    
    protected $max;
    
    protected $night;
    
    protected $evening;
    
    protected $morning;
    
    protected $value;
    
    protected $unit;
    
    public function getValue()
    {
        return $this->value;
    }

    public function getMin()
    {
        return $this->min;
    }

    public function getMax()
    {
        return $this->max;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function setMin($min)
    {
        $this->min = $min;
        return $this;
    }

    public function setMax($max)
    {
        $this->max = $max;
        return $this;
    }

    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }
    
    public function getDay()
    {
        return $this->day;
    }

    public function getEvening()
    {
        return $this->evening;
    }

    public function getMorning()
    {
        return $this->morning;
    }

    public function setDay($day)
    {
        $this->day = $day;
        return $this;
    }

    public function setEvening($evening)
    {
        $this->evening = $evening;
        return $this;
    }

    public function setMorning($morning)
    {
        $this->morning = $morning;
        return $this;
    }

    public function getNight()
    {
        return $this->night;
    }

    public function setNight($night)
    {
        $this->night = $night;
        return $this;
    }
}
