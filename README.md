# JsonResponse

Provides simple classes for JSON responses that adhere to a standardized structure.
Since JSON responses may have very different formats, this package supports the specific
[JSend](http://labs.omniti.com/labs/jsend) format defined at http://labs.omniti.com/labs/jsend.

This package is an extension of the [HttpFoundation\JsonResponse](http://symfony.com/doc/current/components/http_foundation/introduction.html)
class from the [Symfony](http://symfony.com/) package.

## Install

The recommended way to install JsonResponse is [through composer](http://getcomposer.org).

You can either add it as a depedency to your project using the command line:

    $ composer require gridonic/json-response

or by adding it directly to your ```composer.json``` file:

```JSON
{
    "require": {
        "gridonic/json-response": "1.0.*"
    }
}
```

Run these two commands to install it:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar install

Now you can add the autoloader, and you will have access to the library:

```php
<?php
require 'vendor/autoload.php';
```

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
