<?php
namespace Usuarios\Controller;

use RestApi\Controller\ApiController;

class FooController extends ApiController
{
     public function barAction()
    {
        // your action logic

        // Set the HTTP status code. By default, it is set to 200
        $this->httpStatusCode = 200;

        // Set the response
        $this->apiResponse['you_response'] = 'your response data';

        return $this->createResponse();
    }
}