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
        "gridonic/json-response": "1.*"
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

## JsonResponse

We differentiate between two different types of Responses:
* SuccessJsonResponse
* ErrorJsonResponse

### SuccessJsonResponse

Parameter | Type | Needed? | Default value | Description
--- | --- | --- | --- | ---
`$data` | mixed | optional | null | The response data
`$message` | string | optional | null | A success message
`$title` | string | optional | null | A success title
`$status` | integer | optional | 200 | The response status code
`$headers` | array | optional | array() | An array of response headers

```php
/**
 * @throws \InvalidArgumentException
 */
 new SuccessJsonResponse($data, 'Success message', 'Success title', 200);
```

```json
{
    "status" : "success",
    "data" : { ... },
    "message" : "Sucess message",
    "title" : "Success title"
}
```

### ErrorJsonResponse

Parameter | Type | Needed? | Default value | Description
--- | --- | --- | --- | ---
`$data` | mixed | optional | null | The response data
`$message` | string | required |  | The error message
`$title` | string | optional | null | An error title
`$status` | integer | optional | 400 | The response status code
`$errorCode` | string | optional | null | An individual error code
`$errors` | array | optional | array() | An array of errors
`$headers` | array | optional | array() | An array of response headers

```php
/**
 * @throws \InvalidArgumentException
 */
 new ErrorJsonResponse($data, 'Error message', 'Error title', 400, 'e311', $errors);
```

```json
{
    "status" : "error",
    "data" : { ... },
    "message" : "Error message",
    "title" : "Error title",
    "error_code" : "e311",
    "errors" : { ... }
}
```

### JSend
Our Responses are based on the Model of JSend.
You can find the documentation of JSend on the [JSend website](http://labs.omniti.com/labs/jsend)

## Usage


### SuccessJsonResponse
Use a `Gridonic\JsonResponse\SuccessJsonResponse` to build a structured JSON Response.

#### Empty SuccessJsonResponse

```php
new SuccessJsonResponse();
```

```json
{
    "status" : "success",
    "data" : null
}
```

#### SuccessJsonResponse with Content

```php
$data = array(
    'post' => array(
        'id' => 1,
        'title' => 'A blog post',
    )
);
$message = 'The Blog post was successfully created.';
$title = 'Successfully created!';
$statusCode = 205;

new SuccessJsonResponse($data, $message, $title, $statusCode);
```

```json
{
    "status" : "success",
    "data" : {
        "post": {
            "id" : 1,
            "title" : "A blog post"
        }
    },
    "message" : "The Blog post was successfully created.",
    "title" : "Successfully created!"
}
```

### SuccessJsonResponse

Use a `Gridonic\JsonResponse\ErrorJsonResponse` to build a structured JSON Response.

#### ErrorJsonResponse with Message

```php
$message = 'Oups, data is missing.';

new ErrorJsonResponse(null, $message); // you have to send a message!
```

```json
{
    "status" : "error",
    "data" : null,
    "message" : "Oups, data is missing"
}
```

#### ErrorJsonResponse with Content

```php
$data = array(
    'post' => array(
        'title' => 'A blog post',
    )
);
$message = 'Oups, data is not correct.';
$title = 'An error occured!';
$statusCode = 400;
$errorCode = e311;
$errors = array(
    'body' => 'The parameter is missing.',
    'title' => 'This parameter is too long.'
);

new ErrorJsonResponse($data, $message, $title, $statusCode, $errorCode, $errors);
```

```json
{
    "status" : "error",
    "data" : {
        "post": {
            "title" : "A blog post"
        }
    },
    "message" : "Oups, data is missing",
    "title" : "An error occured",
    "error_code" : "e311",
    "errors" : {
        "body" : "The parameter is missing.",
        "title" : "This parameter is too long."
    }
}
```

## Major & Minor [Releases](https://github.com/gridonic/JsonResponse/releases)
##### 1.1.0
New structure of the responses

##### 1.0.0
Initial Release

## Licence

The JsonResponse is licensed under the [MIT license](LICENSE).
