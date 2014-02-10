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

use RuntimeException;
use SplFileObject;
use Traversable;
use InvalidArgumentException;

/**
 * Lock
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Lock
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class File implements LockInterface
{
    /**
     * The default name to use for the lock file
     *
     * @var string
     */
    protected static $defaultLockFilename = 'my.lock';

    /**
     * Name of the lock file
     *
     * @var string|null
     */
    protected $filename;

    /**
     * Instance of SplFileObject
     *
     * @var SplFileObject
     */
    protected $file;

    /**
     * Boolean representing the current status of the lock
     *
     * @var boolean
     */
    protected $locked;

    /**
     * The maximum lifetime that the lock can live for
     *
     * Stored as seconds
     *
     * @var int|null
     */
    protected $maxLifetime;

    /**
     * The minimum lifetime that lock can live for
     *
     * Stored as seconds
     *
     * @var int|null
     */
    protected $minLifetime;

    /**
     * Constructor
     *
     * @param array $options The array of options to configure the Lock with
     *
     * @return void
     */
    public function __construct($options = array())
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set the options
     *
     * Supported options are:
     *
     * - filename|file
     * - maxlifetime|maxlife|max
     * - minlifetime|minlife|min
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
                    case 'filename':
                    case 'file':
                        $this->setFilename($value);
                        break;
                    case 'maxlifetime':
                    case 'maxlife':
                    case 'max':
                        $this->setMaxLifetime($value);
                        break;
                    case 'minlifetime':
                    case 'minlife':
                    case 'min':
                        $this->setMinLifetime($value);
                        break;
                }
            }
        }
        return $this;
    }

    /**
     * Set the filename of the lock file
     *
     * @param string|null $filename
     *
     * @return Lock
     * @throws InvalidArgumentException
     */
    public function setFilename($filename = null)
    {
        if (! is_null($filename)) {
            if (! is_string($filename)) {
                throw new InvalidArgumentException('Expects a string');
            }
            if (($this->filename !== $filename) && isset($this->file)) {
                unset($this->file);
            }
        }
        $this->filename = $filename;
        return $this;
    }

    /**
     * Return the name of the lockfile
     *
     * If the file name has not already been set, this method will
     * return a filename located is the systems temp directory.
     *
     * @return string
     */
    public function getFilename()
    {
        if (! isset($this->filename)) {
            $this->filename = (sys_get_temp_dir() . DIRECTORY_SEPARATOR . self::$defaultLockFilename);
        }
        return $this->filename;
    }

    protected function getFileInfo()
    {
        if (! isset($this->fileInfo)) {
            $fileInfo = new \SplFileInfo($this->getFilename());
            $this->fileInfo = $fileInfo;
        }
        return $this->fileInfo;
    }

    protected function fileExists()
    {
        return $this->getFileInfo()->isFile();
    }

    /**
     * Return the file
     *
     * @return SplFileObject
     *
     * @throws RuntimeException
     */
    protected function getFile()
    {
        if (! isset($this->file)) {
            $file = $this->getFileInfo()->openFile('w+b');//new SplFileObject($this->getFilename(), 'w+b');
            if (! $file->isWritable()) {
                throw new \RuntimeException('The file ' . $this->getFilename() . ' is not writable');
            }
            $this->file = $file;
        }
        return $this->file;
    }


    protected function getLocked()
    {
        if (! isset($this->locked)) {
            $this->locked = false;
        }
        return $this->locked;
    }

    protected function setLocked($locked)
    {
        $this->locked = (boolean) $locked;
        return $this;
    }

    /**
     * Return the last modified time of the lock file
     *
     * @return int
     */
    protected function getModifiedTime()
    {
        return $this->getFile()->getMTime();
    }

    /**
     * Return the age of the lock file
     *
     * @return int
     */
    protected function getLockAge()
    {
        return (time() - $this->getModifiedTime());
    }

    /**
     * Attempt to acquire a lock
     *
     * - If the minimum lifetime has been set and the age of the lock is less
     *   then do NOT release the lock.
     * - If the maximum lifetime has been set and the lock is locked and the age
     *   of the lock is greater then the maximum (i.e. a lock holder has died)
     *   then unlock the lock.
     * - If the lock is not locked, lock the lock and return true.
     * - Anything else, return the current status of the lock.
     *
     * Return true if the lock is acquired, else return false
     *
     * @link http://www.php.net/manual/en/splfileobject.flock.php
     *
     * @return boolean
     */
    public function acquire()
    {
        if ($this->fileExists()) {
            if (! is_null($this->getMinLifetime()) && ($this->getLockAge() < $this->getMinLifetime())) {
                return false;
            }
            if (! is_null($this->getMaxLifetime()) && $this->getLocked() && ($this->getMaxLifetime() < $this->getLockAge())) {
                $this->release();
            }
        }

        if (! $this->getLocked() && $this->getFile()->flock(LOCK_EX | LOCK_NB)) {
            if (null !== ($this->getFile()->fwrite(sha1(uniqid())))) {
                $this->setLocked(true);
            }
        }

        return $this->getLocked();
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
    public function release()
    {
        if ($this->getLocked()) {
            $unlocked = $this->getFile()->flock(LOCK_UN);
            unset($this->file);
            $this->setLocked(! $unlocked);
        }
        return ! $this->getLocked();
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
}
