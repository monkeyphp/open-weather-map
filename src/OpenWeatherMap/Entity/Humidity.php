<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Entity;
/**
 * Description of Humidity
 *
 * @author David White <david@monkeyphp.com>
 */
class Humidity
{
    protected $value;
    
    protected $unit;
    
    public function getValue()
    {
        return $this->value;
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

    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }


}
