<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Entity;
/**
 * Description of Temperature
 *
 * @author David White <david@monkeyphp.com>
 * 
 * <temperature day="7.94" min="6.46" max="8.78" night="6.46" eve="7.18" morn="7.94"/>
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
