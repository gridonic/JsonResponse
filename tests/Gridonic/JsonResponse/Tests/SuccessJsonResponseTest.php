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

    public function testConstructorDefaultJsonObject()
    {
        $response = new SuccessJsonResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('{"status":"success","data":null}', $response->getContent());
    }

    public function testJsonObjectWithData()
    {
        $postData = array(
            'post' => array(
                'id' => 1,
                'title' => 'A blog post',
            )
        );

        $response = new SuccessJsonResponse($postData);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('{"status":"success","data":{"post":{"id":1,"title":"A blog post"}}}', $response->getContent());
    }

    public function testJsonObjectWithMessage()
    {
        $postData = array(
            'post' => array(
                'id' => 1,
                'title' => 'A blog post',
            )
        );
        $postMessage = 'Successfully created';

        $response = new SuccessJsonResponse($postData, $postMessage);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('{"status":"success","data":{"post":{"id":1,"title":"A blog post"}},"message":"Successfully created"}', $response->getContent());
    }

    public function testJsonObjectWithTitle()
    {
        $postData = array(
            'post' => array(
                'id' => 1,
                'title' => 'A blog post',
            )
        );
        $postMessage = "This SuccessJsonResponse was created.";
        $postTitle = "Successfully created!";

        $response = new SuccessJsonResponse($postData, $postMessage, $postTitle);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('{"status":"success","data":{"post":{"id":1,"title":"A blog post"}},"message":"This SuccessJsonResponse was created.","title":"Successfully created!"}', $response->getContent());
    }

    public function testJsonObjectWithStatusCode()
    {
        $postData = array(
            'post' => array(
                'id' => 1,
                'title' => 'A blog post',
            )
        );
        $postMessage = "This SuccessJsonResponse was created.";
        $postTitle = "Successfully created!";
        $postStatusCode = 201;

        $response = new SuccessJsonResponse($postData, $postMessage, $postTitle, $postStatusCode);
        $this->assertEquals($postStatusCode, $response->getStatusCode());
        $this->assertSame('{"status":"success","data":{"post":{"id":1,"title":"A blog post"}},"message":"This SuccessJsonResponse was created.","title":"Successfully created!"}', $response->getContent());
    }
}
