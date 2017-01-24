<?php

namespace Test;

use Deimos\Route\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{

    public function testRoute()
    {

        $route = new Route(['/hello']);

        $this->assertEquals(
            '/hello',
            $route->route()
        );

        $route = new Route([
            '/hello'
        ], [
            'controller' => 'first',
            'prefix'     => 'admin',
        ]);

        $this->assertEquals(
            '/hello',
            $route->route()
        );

        $route = new Route([
            '/<hello:\w+>/<controller>', [
                'controller' => '\w+'
            ]
        ], [
            'controller' => 'first',
            'prefix'     => 'admin',
        ]);

        $this->assertEquals(
            '\w+',
            $route->regExp('hello')
        );

        $this->assertEquals(
            '\w+',
            $route->regExp('controller')
        );

        $this->assertEquals(
            '[\w-А-ЯЁа-яё]+',
            $route->regExp('adfjkjl')
        );

        $this->assertEquals(
            '/<hello>/<controller>',
            $route->route()
        );

        $this->assertTrue($route->methodIsAllow('GET'));
        $this->assertTrue($route->methodIsAllow('POST'));
        $this->assertTrue($route->methodIsAllow('PUT'));

        $this->assertEquals(
            '[\w-А-ЯЁа-яё]+',
            $route->regExp('id')
        );

        $route = new Route([
            '/hello-array',
            [ 'id' => '\d+' ]
        ],[
            'controller' => 'first',
            'prefix'     => 'admin',
        ], ['POST', 'GET']);

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
     * @expectedException \Deimos\Route\Exceptions\PathNotFound
     */
    public function testEmptyException()
    {
        new Route([]);
    }

    /**
     * @expectedException \Deimos\Route\Exceptions\PathNotFound
     */
    public function testParseException()
    {
        new Route(['']);
    }

}