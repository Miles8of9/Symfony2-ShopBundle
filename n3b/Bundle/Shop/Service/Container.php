<?php

namespace n3b\Bundle\Shop\Service;

class Container {
    protected $container = array();

    public function __construct($params)
    {
        $this->processParams($params, '');
    }

    public function set($key, $value)
    {
        $this->container[$key] = $value;
    }

    public function get($key)
    {
        if (!isset($this->container[$key]))
            return $this->getNode($key . '.');
        return $this->container[$key];
    }

    protected function getNode($node)
    {
        $keys = array();

        foreach (\array_keys($this->container) as $key)
            if (0 === \strpos($key, $node))
                $keys[] = $key;

        if (count($keys))
            return \array_intersect_key($this->container, \array_flip($keys));
        return null;
    }

    protected function processParams($params, $nodeName)
    {
        $nodeName = \strlen($nodeName) ? $nodeName.'.' : '';
        foreach ($params as $k => $v) {
            $path = $nodeName . $k;
            if (is_array($v))
                $this->processParams($v, $path);
            else
                $this->set($path, $v);
        }
    }
}
