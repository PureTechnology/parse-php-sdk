<?php

namespace Parse;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * ParseSymfonySessionStorage - Uses Symfony session support for persistent storage.
 *
 * @author Agastiya S. Mohammad <egi@pure-technology.net>
 */
class ParseSymfonySessionStorage implements ParseStorageInterface
{
    /**
     * Parse will store its values in a specific key.
     *
     * @var string
     */
    private $storageKey = 'parseData';

    /**
     * Symfony session handler
     *
     * @var Session
     **/
    private $sh;

    public function __construct($sh)
    {
        $this->sh = $sh;
    }

    public function set($key, $value)
    {
        $this->sh->set($this->storageKey . '/' . $key, $value);
    }

    public function remove($key)
    {
        $this->sh->remove($this->storageKey . '/' . $key);
    }

    public function get($key)
    {
        return $this->sh->get($this->storageKey . '/' . $key);
    }

    public function clear()
    {
        $this->sh->remove($this->storageKey);
    }

    public function save()
    {
        // No action required.    PHP handles persistence for $_SESSION.
        return;
    }

    public function getKeys()
    {
        return array_keys($this->sh->get($this->storageKey));
    }

    public function getAll()
    {
        return $this->sh->get($this->storageKey);
    }
}

// vim: set et:
