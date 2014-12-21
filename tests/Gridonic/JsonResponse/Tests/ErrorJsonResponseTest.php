<?php

namespace Gridonic\JsonResponse\Tests;

use Gridonic\JsonResponse\ErrorJsonResponse;
use InvalidArgumentException;

/**
 * ErrorJsonResponse tests
 *
 * @package Gridonic\JsonResponse\Tests
 */
class ErrorJsonResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf('\Symfony\Component\HttpFoundation\JsonResponse', new ErrorJsonResponse(null, 'Error message'));
    }

    /**
     * @dataProvider invalidMessageProvider
     * @expectedException InvalidArgumentException
     */
    public function testEmptyMessageThrowsException($message)
    {
        new ErrorJsonResponse(null, $message);
    }

    public function testConstructorDefaultJsonObject()
    {
        $response = new ErrorJsonResponse(null, 'Error message');
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertSame('{"status":"error","message":"Error message"}', $response->getContent());
    }

    /**
     * @dataProvider optionalParametersProvider
     */
    public function testOptionalParametersInResponse($data, $message, $status, $expected)
    {
        $response = new ErrorJsonResponse($data, $message, $status);
        $this->assertSame($expected, $response->getContent());
    }

    public function invalidMessageProvider()
    {
        return array(
            array(null),
            array(false),
            array(''),
        );
    }

    public function optionalParametersProvider()
    {
        return array(
            array('data', 'Error message', 400, '{"status":"error","data":"data","message":"Error message"}'),
            array(array('data'), 'Error message', 400, '{"status":"error","data":["data"],"message":"Error message"}'),
            array(array('posts' => array('id' => 1)), 'Error message', 400, '{"status":"error","data":{"posts":{"id":1}},"message":"Error message"}'),
            array(null, 'Error message', 400, '{"status":"error","message":"Error message"}'),
            array(array(), 'Error message', 400, '{"status":"error","message":"Error message"}'),
        );
    }
}
