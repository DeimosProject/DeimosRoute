<?php

namespace Test;

class RouteTest extends \PHPUnit_Framework_TestCase
{

    public function testRoute()
    {

        $route = new \Deimos\Route\Route(['/hello']);

        $this->assertEquals(
            '/hello',
            $route->route()
        );

        $route = new \Deimos\Route\Route([
            '/hello', [
                'controller' => 'first',
                'prefix'     => 'admin',
            ]
        ]);

        $this->assertEquals(
            '/hello',
            $route->route()
        );

        $this->assertTrue($route->methodIsAllow('GET'));
        $this->assertTrue($route->methodIsAllow('POST'));
        $this->assertTrue($route->methodIsAllow('PUT'));

        $this->assertEquals(
            '[\w-А-ЯЁа-яё]+',
            $route->regExp('id')
        );

        $route = new \Deimos\Route\Route([
            ['/hello-array', [ 'id' => '\d+' ]], [
                'controller' => 'first',
                'prefix'     => 'admin',
            ], ['POST', 'GET']
        ]);

        $this->assertEquals(
            '/hello-array',
            $route->route()
        );

        $attributes = $route->attributes();
        $this->assertEquals(
            'first',
            $attributes['controller']
        );
        $this->assertEquals(
            'admin',
            $attributes['prefix']
        );

        $this->assertTrue($route->methodIsAllow('GET'));
        $this->assertTrue($route->methodIsAllow('POST'));
        $this->assertFalse($route->methodIsAllow('PUT'));

        $this->assertEquals(
            '\d+',
            $route->regExp('id')
        );

    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmptyException()
    {
        new \Deimos\Route\Route([]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testParseException()
    {
        new \Deimos\Route\Route([123]);
    }

}