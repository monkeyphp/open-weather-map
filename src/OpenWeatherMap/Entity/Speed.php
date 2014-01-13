<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Entity;
/**
 * Description of Speed
 *
 * @author David White <david@monkeyphp.com>
 */
class Speed
{
    protected $value;
    
    protected $name;
    
    public function getValue()
    {
        return $this->value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}
