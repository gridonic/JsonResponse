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

    public function testInstance()
    {
        $this->assertInstanceOf('\Symfony\Component\HttpFoundation\JsonResponse', new ErrorJsonResponse());
    }
}
