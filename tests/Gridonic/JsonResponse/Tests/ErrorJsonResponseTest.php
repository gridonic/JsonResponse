<?php

namespace Gridonic\JsonResponse\Tests;

use Gridonic\JsonResponse\ErrorJsonResponse;

/**
 * ErrorJsonResponse tests
 *
 * @package Gridonic\JsonResponse\Tests
 */
class ErrorJsonResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf('\Symfony\Component\HttpFoundation\JsonResponse', new ErrorJsonResponse());
    }

    public function testConstructorDefaultJsonObject()
    {
        $response = new ErrorJsonResponse();
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertSame('{"status":"error","data":{},"message":null}', $response->getContent());
    }
}
