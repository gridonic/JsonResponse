<?php

namespace Gridonic\JsonResponse;

/**
 * Represents an error JSON response with a standardized structure.
 *
 * @author Dennis Schenk <dennis@gridonic.ch>
 */
class ErrorJsonResponse extends StructuredJsonResponse
{
    /**
     * Constructor.
     *
     * @param  mixed                    $data    The response data
     * @param  string                   $message Error message
     * @param  integer                  $status  The response status code
     * @param  array                    $headers An array of response headers
     * @param  string                   $errorCode An individual error code
     * @throws \InvalidArgumentException
     */
    public function __construct($data = null, $message = null, $status = 400, $headers = array(), $errorCode = null)
    {
        parent::__construct($data, $status, $headers);

        // Make sure error responses also have real error status codes
        if (!$this->isClientError() && !$this->isServerError()) {
            throw new \InvalidArgumentException(sprintf('The HTTP status code "%s" is not an error status code.', $status));
        }

        if (null === $data) {
            $data = new \ArrayObject();
        }

        $this->setErrorCode($errorCode);
        $this->setMessage($message);
        $this->setData($data);
    }

    /**
     * {@inheritDoc}
     */
    public static function create($data = null, $message = null, $status = 400, $headers = array(), $errorCode = null)
    {
        return new static($data, $message, $status, $headers, $errorCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return 'error';
    }
}
