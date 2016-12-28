<?php

namespace Deimos\Route;

class Route
{

    /**
     * @var string
     */
    protected $route;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $methodAllow = [];

    /**
     * @var array
     */
    protected $regExp = [];

    /**
     * @var string
     */
    protected $defaultRegExp = '[\w-А-ЯЁа-яё]+';

    /**
     * Route constructor.
     *
     * @param array $route
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(array $route)
    {
        if (empty($route[0]))
        {
            throw new \InvalidArgumentException('Route not found');
        }

        $this->parseRoute(current($route));
        $this->attributes  = next($route) ?: [];
        $this->methodAllow = next($route) ?: [];
    }

    /**
     * @param $data
     *
     * @throws \InvalidArgumentException
     */
    protected function parseRoute($data)
    {
        if (is_string($data))
        {
            $this->route = $data;

            return;
        }

        if (is_array($data))
        {
            $this->route  = current($data);
            $this->regExp = next($data) ?: [];

            return;
        }

        throw new \InvalidArgumentException('Parse route error: ' . json_encode($data));
    }

    /**
     * @return string
     */
    public function regExp($name)
    {
        return isset($this->regExp[$name]) ? $this->regExp[$name] : $this->defaultRegExp;
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return $this->attributes;
    }

    /**
     * @param $needle
     *
     * @return bool
     */
    public function methodIsAllow($needle)
    {
        if (empty($this->methodAllow))
        {
            return true;
        }

        return in_array($needle, $this->methodAllow, true);
    }

}