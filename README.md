# JsonResponse

This is a package for JSON-Responses with a standardized structure.
This package is an extension for the [HttpFoundation\JsonResponse](http://symfony.com/doc/current/components/http_foundation/introduction.html) of [Symfony](http://symfony.com/).

## Install

Include `gridonic/json-response` in your `composer.json`.

## Usage

Use a `Gridonic\JsonResponse\SuccessJsonResponse` or a `Gridonic\JsonResponse\ErrorJsonResponse` to build a structured JSON Response.

```php
/**
 * @param  mixed            $data       The response data
 * @param  string           $message    Optional success message
 * @param  integer          $status     The response status code
 * @param  array            $headers    An array of response headers
 * @throws \InvalidArgumentException
 */
 new SuccessJsonResponse($data, 'Success message');
```

```php
/**
 * @param  mixed            $data       The response data
 * @param  string           $message    Error message
 * @param  integer          $status     The response status code
 * @param  array            $headers    An array of response headers
 * @param  string           $errorCode  An individual error code
 * @throws \InvalidArgumentException
 */
    new ErrorJsonResponse($data, 'Error message');
```

## Licence
The JsonResponse is licensed under the [MIT license](LICENSE).
