<?php

namespace Deimos\Route;

use Deimos\Route\Exceptions\PathNotFound;

class Route
{

    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $defaults = [];

    /**
     * @var array
     */
    protected $allowMethods = [];

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
     * @param array $path
     * @param array $defaults
     * @param array $allowMethods
     *
     * @throws PathNotFound
     */
    public function __construct(array $path, array $defaults = [], array $allowMethods = [])
    {
        $this->path = current($path);

        if (!$this->path || $this->path{0} !== '/')
        {
            throw new PathNotFound('Path not found');
        }

        $this->regExp       = next($path) ?: [];
        $this->defaults     = $defaults;
        $this->allowMethods = $allowMethods;
    }

    /**
     * @return string
     */
    public function route()
    {
        return $this->path;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function regExp($name)
    {
        return isset($this->regExp[$name]) ?
            $this->regExp[$name] :
            $this->defaultRegExp;
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return $this->defaults;
    }

    /**
     * @param $needle
     *
     * @return bool
     */
    public function methodIsAllow($needle)
    {
        if (empty($this->allowMethods))
        {
            return true;
        }

        return in_array($needle, $this->allowMethods, true);
    }

}