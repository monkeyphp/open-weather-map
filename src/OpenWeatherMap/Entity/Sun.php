<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Entity;
/**
 * Description of Sun
 *
 * @author David White <david@monkeyphp.com>
 */
class Sun
{
    protected $rise;
    
    protected $set;
    
    public function getRise()
    {
        return $this->rise;
    }

    public function getSet()
    {
        return $this->set;
    }

    public function setRise($rise)
    {
        $this->rise = $rise;
        return $this;
    }

    public function setSet($set)
    {
        $this->set = $set;
        return $this;
    }


}
