<?php

namespace Gridonic\JsonResponse\Tests;

use Gridonic\JsonResponse\SuccessJsonResponse;

/**
 * SuccessJsonResponse tests
 *
 * @package Gridonic\JsonResponse\Tests
 */
class SuccessJsonResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf('\Symfony\Component\HttpFoundation\JsonResponse', new SuccessJsonResponse());
    }
}
