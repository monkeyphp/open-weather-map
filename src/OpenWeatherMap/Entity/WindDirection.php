<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OpenWeatherMap\Entity;

/**
 * Description of WindDirection
 *
 * @author David White <david@monkeyphp.com>
 */
class WindDirection
{
    protected $deg;
    
    protected $code;
    
    protected $name;
    
    public function getDeg()
    {
        return $this->deg;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDeg($deg)
    {
        $this->deg = $deg;
        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}
