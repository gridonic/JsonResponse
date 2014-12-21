# JsonResponse

Provides simple classes for JSON responses that adhere to a standardized structure.
Since JSON responses may have very different formats, this package supports the specific
[JSend](http://labs.omniti.com/labs/jsend) format defined at http://labs.omniti.com/labs/jsend.

This package is an extension of the [HttpFoundation\JsonResponse](http://symfony.com/doc/current/components/http_foundation/introduction.html)
class from the [Symfony](http://symfony.com/) package.

[![Build Status](https://travis-ci.org/gridonic/JsonResponse.svg?branch=master)](https://travis-ci.org/gridonic/JsonResponse)

## Install

The recommended way to install JsonResponse is [through composer](http://getcomposer.org).

You can either add it as a depedency to your project using the command line:

    $ composer require gridonic/json-response

or by adding it directly to your ```composer.json``` file:

```json
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

## JSend

A basic JSend-compliant response is as simple as this:

```json
{
    "status" : "success",
    "data" : {
        "post" : { "id" : 1, "title" : "A blog post", "body" : "Some useful content" }
    }
}
```

When setting up a JSON API, you'll have all kinds of different types of calls and responses.
JSend separates responses into some basic types, and defines required and optional keys for each type:

Type | Description | Required Keys | Optional Keys
--- | --- | --- | ---
success | All went well, and (usually) some data was returned | ```status```, ```data``` |
fail | There was a problem with the data submitted, or some pre-condition of the API call wasn't satisfied | ```status```, ```data``` |
error | An error occurred in processing the request, i.e. an exception was thrown | ```status```, ```data``` | ```code```, ```data```

Further details and more examples can be found on the [JSend website](http://labs.omniti.com/labs/jsend).

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
