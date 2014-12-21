<?php

namespace Gridonic\JsonResponse;

/**
 * Represents a successfull JSON response with a standardized structure.
 *
 * @author Dennis Schenk <dennis@gridonic.ch>
 */
class SuccessJsonResponse extends StructuredJsonResponse
{
    /**
     * Constructor.
     *
     * @param  mixed                     $data    The response data
     * @param  string                    $message Optional success message
     * @param  integer                   $status  The response status code
     * @param  array                     $headers An array of response headers
     * @throws \InvalidArgumentException
     */
    public function __construct($data = null, $message = null, $status = 200, $headers = array())
    {
        parent::__construct($data, $status, $headers);

        // Make sure error responses also have real error status codes
        if (!$this->isSuccessful()) {
            throw new \InvalidArgumentException(sprintf('The HTTP status code "%s" is not a success status code.', $status));
        }

        if (null === $data) {
            $data = new \ArrayObject();
        }

        $this->setMessage($message);
        $this->setData($data);
    }

    /**
     * {@inheritDoc}
     */
    public static function create($data = null, $message = null, $status = 200, $headers = array())
    {
        return new static($data, $message, $status, $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return 'success';
    }
}
