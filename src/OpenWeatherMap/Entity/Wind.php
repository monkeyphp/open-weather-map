<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Entity;
/**
 * Description of Wind
 *
 * @author David White <david@monkeyphp.com>
 */
class Wind
{
    protected $speed;
    
    protected $direction;
    
    public function getSpeed()
    {
        return $this->speed;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    public function setDirection($direction)
    {
        $this->direction = $direction;
        return $this;
    }


}
