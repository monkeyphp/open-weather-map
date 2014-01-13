<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OpenWeatherMap\Entity;

/**
 * Description of Symbol
 *
 * @author David White <david@monkeyphp.com>
 */
class Symbol
{
    protected $number;
    
    protected $name;
    
    protected $var;
    
    public function getNumber()
    {
        return $this->number;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getVar()
    {
        return $this->var;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setVar($var)
    {
        $this->var = $var;
        return $this;
    }


}
