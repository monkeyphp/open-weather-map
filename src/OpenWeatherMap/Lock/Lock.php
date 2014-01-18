<?php
/**
 * Lock.php
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Lock
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 * 
 * Copyright (C) 2014  David White
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see [http://www.gnu.org/licenses/].
 */
namespace OpenWeatherMap\Lock;

use Exception;
use RuntimeException;
use Traversable;

/**
 * Lock
 * 
 * @link http://www.tuxradar.com/practicalphp/8/11/0
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Lock
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Lock implements LockInterface
{
    /**
     * Name of the lock file
     * 
     * @var string|null
     */
    protected $file;
    
    /**
     * Handle to the lock file
     * 
     * @var resource
     */
    protected $handle;
    
    /**
     * Boolean representing the current status of the lock
     * 
     * @var boolean
     */
    protected $locked;
    
    /**
     *
     * @var int
     */
    protected $maxLifetime; // seconds
    
    /**
     *
     * @var int
     */
    protected $minLifetime; // seconds
    
    /**
     *
     * @var int
     */
    protected $createdTime;
    
    /**
     * Constructor
     * 
     * @param string $file
     * @param array  $options
     * 
     * @return void
     */
    public function __construct($file, $options = array())
    {
        $this->setFile($file);
        
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
    
    /**
     * Set the options
     * 
     * @param array|Traversable $options
     * 
     * @return Lock
     */
    public function setOptions($options = array())
    {
        if (is_array($options) || ($options instanceof Traversable)) {
            foreach ($options as $key => $value) {
                
                $key = strtolower($key);
                
                switch ($key) {
                    case 'maxlifetime':
                        $this->setMaxLifetime($value);
                    break;
                    case 'minlifetime':
                        $this->setMinLifetime($value);
                    break;
                }
            }
        }
        return $this;
    }
    
    /**
     * Return the lockFile
     * 
     * @return string
     * @throws RuntimeException
     */
    public function getFile()
    {
        if (! isset($this->file)) {
            throw new RuntimeException('File not set');
        }
        return $this->file;
    }
    
    /**
     * Set the lockFile
     * 
     * @link http://www.php.net/manual/en/function.pathinfo.php
     * 
     * @param string $lockFile
     * @return Lock
     */
    public function setFile($file)
    {
        $path_parts = pathinfo($file);
        
        $dirname = $path_parts['dirname'];
        
        if (! is_writable($dirname)) {
            throw new Exception('Cannot write to supplied directory');
        }
        
        $this->file = $file;
        return $this;
    }
    
    /**
     * Return the max lock life time
     * 
     * @return int
     */
    public function getMaxLifetime()
    {
        return $this->maxLifetime;
    }
    
    /**
     * Set the maxLifeTime
     * 
     * @param int $seconds
     * 
     * @return Lock
     */
    public function setMaxLifetime($seconds = null)
    {
        $this->maxLifetime = $seconds;
        return $this;
    }
    
    /**
     * Get the min lock life time
     * 
     * @return int
     */
    public function getMinLifetime()
    {
        return $this->minLifetime;
    }

    /**
     * Set the min lock life time
     * 
     * @param int $minLockLifetime
     * 
     * @return Lock
     */
    public function setMinLifetime($minLifetime = null)
    {
        $this->minLifetime = $minLifetime;
        return $this;
    }
    
    /**
     * Return the created time
     * 
     * @return int
     */
    protected function getCreatedTime()
    {
        if (! isset($this->createdTime)) {
            $this->createdTime = time() - $this->getMinLifetime();
        }
        return $this->createdTime;
    }
    
    /**
     * Set the created time
     * 
     * @param int $createdTime
     * 
     * @return Lock
     */
    protected function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;
        return $this;
    }
    
    /**
     * Get a handle to the lock file
     * 
     * @link http://uk3.php.net/manual/en/function.fopen.php
     * @return resource|boolean
     */  
    protected function getHandle()
    {
        if (! $this->handle) {
            $this->handle = fopen($this->getFile(), 'a');
        }
        return $this->handle;
    }
    
    /**
     * 
     * @return boolean
     */
    protected function isLocked($boolean = null)
    {
        if (! is_null($boolean)) {
            $this->locked = (boolean) $boolean;
        }
        return (boolean) $this->locked;
    }
    
    /**
     * Attempt to obtain a lock
     * 
     * - If the minimum lifetime has been set and the age of the lock is less
     *   then do NOT release the lock.
     * - If the maximum lifetime has been set and the lock is locked and the age 
     *   of the lock is greater then the maximum (i.e. a lock holder has died) 
     *   then unlock the lock.
     * - If the lock is not locked, lock the lock and return true.
     * - Anything else, return the current status of the lock.
     * 
     * @return boolean
     */
    public function lock()
    {   
        $currentTime = time();
        $lockAge = $currentTime - $this->getCreatedTime();
        
        if (! is_null($this->getMinLifetime()) && 
            ($lockAge < $this->getMinLifetime())
        ) {
            return false;
        }
        
        if (! is_null($this->getMaxLifetime()) && 
            $this->isLocked() && 
            ($this->getMaxLifetime() < $lockAge)
        ) {
            $this->unlock();
        }    

        if ((! $this->isLocked()) && flock($this->getHandle(), LOCK_EX | LOCK_NB)) {
            $this->isLocked(true);
            $this->setCreatedTime($currentTime);
        }
        return $this->isLocked();
    }

    /**
     * Unlock a lock
     * 
     * This method returns a boolean true on success of the lock being
     * unlocked.
     * 
     * Returning true indicates that the lock is unlocked.
     * 
     * @return boolean
     */
    public function unlock()
    {
        if ($this->isLocked()) {
            $this->isLocked(! flock($this->getHandle(), LOCK_UN));
        }
        return !$this->isLocked();
    }
}
