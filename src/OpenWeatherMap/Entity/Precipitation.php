<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Entity;
/**
 * Description of Precipitation
 *
 * @author David White <david@monkeyphp.com>
 */
class Precipitation
{
    protected $mode;
    
    protected $value;
    
    protected $type;
    
    public function getMode()
    {
        return $this->mode;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }


}
