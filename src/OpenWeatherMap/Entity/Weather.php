<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Entity;
/**
 * Description of Weather
 *
 * @author David White <david@monkeyphp.com>
 */
class Weather
{
    protected $number;
    
    protected $value;
    
    protected $icon;
    
    public function getNumber()
    {
        return $this->number;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }


}
