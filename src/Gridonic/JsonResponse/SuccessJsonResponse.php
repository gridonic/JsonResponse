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
     * @param  mixed                    $data       The response data
     * @param  string                   $message    The success message
     * @param  string                   $title      The success title
     * @param  integer                  $status     The response status code
     * @param  array                    $headers    An array of response headers
     * @throws \InvalidArgumentException
     */
    public function __construct(
            $data       = null,
            $message    = null,
            $title      = null,
            $status     = 200,
            $headers    = array()
        )
    {
        parent::__construct($data, $status, $headers);

        // Make sure error responses also have real error status codes
        if (!$this->isSuccessful()) {
            throw new \InvalidArgumentException(sprintf('The HTTP status code "%s" is not a success status code.', $status));
        }

        $this->setMessage($message);
        $this->setTitle($title);
        $this->setData($data);
    }

    /**
     * {@inheritDoc}
     */
    public static function create($data = null, $message = null, $title = null, $status = 200, $headers = array())
    {
        return new static($data, $message, $title, $status, $headers);
    }

    /**
     * @inheritdoc
     */
    protected function postProcessStructuredResponse(&$structuredResponse, $data)
    {
        parent::postProcessStructuredResponse($structuredResponse, $data);

        if (null === $this->message) {
            unset($structuredResponse['message']);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return 'success';
    }
}
