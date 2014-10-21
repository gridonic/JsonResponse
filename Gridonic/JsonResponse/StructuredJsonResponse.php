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
    protected $message;
    protected $errorCode;

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
     * @param string $errorCode
     */
    public function setErrorCode($errorCode = null)
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return string The type of the StructuredJsonResponse
     *
     */
    abstract public function getType();

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
            'message' => $this->message
        );

        if ($this->errorCode != null) {
            $structuredResponse['error_code'] = $this->errorCode;
        }

        // Encode <, >, ', &, and " for RFC4627-compliant JSON, which may also be embedded into HTML.
        $this->data = json_encode($structuredResponse, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);

        return $this->update();
    }

    /**
     * @return array JSON decoded data
     */
    public function getData() {
        return json_decode($this->data);
    }
}
