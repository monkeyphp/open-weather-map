<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OpenWeatherMap\Entity;

/**
 * Description of WindSpeed
 *
 * @author David White <david@monkeyphp.com>
 */
class WindSpeed
{
    protected $mps;
    
    protected $name;
    
    public function getMps()
    {
        return $this->mps;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setMps($mps)
    {
        $this->mps = $mps;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}
