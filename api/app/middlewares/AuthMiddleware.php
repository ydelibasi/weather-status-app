<?php

use Phalcon\Mvc\Micro;
use Phalcon\Events\Event;
use Phalcon\Mvc\Micro\MiddlewareInterface;


class AuthMiddleware implements MiddlewareInterface
{
    public function beforeExecuteRoute(Event $event, Micro $application)
    {
        $authorizeExceptions = [
            '/',
            '/user/register',
            '/login',
        ];

        if (!in_array($_SERVER['REQUEST_URI'], $authorizeExceptions)) {
            $result = $this->authorize($application);
            if (is_null($result)) {
                $application->response->setStatusCode(401);
                $application->response->setContent('Please authorize with valid API token!');
                $application->response->send();
                die();
                //return false;
            }
        }

        return true;
    }

    private function authorize(Micro $application)
    {
        $application->token = null;
        $authorizationHeader = $application->request->getHeader('Authorization');

        if ($authorizationHeader == '1234') {  // check token validity and find from database what user has the token
            $application->token = $authorizationHeader;
            //$application->userid = ?;
        }

        return $application->token;
    }

    public function call(Micro $application)
    {
        return true;
    }
}
