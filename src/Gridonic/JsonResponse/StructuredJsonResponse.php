<?php

namespace Gridonic\JsonResponse;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Represents a JSON response with a standardized structure.
 *
 * @author Dennis Schenk <dennis@gridonic.ch>
 */
abstract class StructuredJsonResponse extends JsonResponse
{
    /** @var string */
    protected $message;

    /** @var int */
    protected $errorCode;

    /**
     * @return string The type of the StructuredJsonResponse
     */
    abstract public function getType();

    /**
     * Sets the message to be sent.
     *
     * @param string $message
     *
     */
    public function setMessage($message = null)
    {
        $this->message = $message;
    }

    /**
     * Sets the error code to be sent.
     *
     * @param int $errorCode
     */
    public function setErrorCode($errorCode = null)
    {
        $this->errorCode = $errorCode;
    }

    /**
     * Sets the data to be sent as json.
     *
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function setData($data = array())
    {
        $structuredResponse = array(
            'status' => $this->getType(),
            'data' => $data,
            'message' => $this->message,
            'error_code' => $this->errorCode
        );

        // Post process data and unset variables where necessary
        $this->postProcessStructuredResponse($structuredResponse, $data);

        // Encode <, >, ', &, and " for RFC4627-compliant JSON, which may also be embedded into HTML.
        $this->data = json_encode($structuredResponse, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);

        return $this->update();
    }

    /**
     * @param array $structuredResponse
     * @param array $data
     * @return array
     */
    protected function postProcessStructuredResponse(&$structuredResponse, $data)
    {
        if (null === $this->errorCode) {
            unset($structuredResponse['error_code']);
        }
    }

    /**
     * @return array JSON decoded data
     */
    public function getData() {
        return json_decode($this->data);
    }
}
