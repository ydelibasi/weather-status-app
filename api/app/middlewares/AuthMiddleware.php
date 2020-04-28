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
            return $this->authorize($application);
        }

        return true;
    }

    private function authorize(Micro $application)
    {
        $api_token = $application->request->getHeader('Authorization');
        if (empty($api_token)) {
            $application->response->setStatusCode(401);
            $application->response->setContent('Token is missing.');
            $application->response->send();
            die();
        }
        $token = Token::findFirst([
            'conditions'  => 'token = :token:',
            'bind'        => ['token' => $api_token]
        ]);

        if (!$token) {
            $application->response->setStatusCode(401);
            $application->response->setContent('Token is invalid.');
            $application->response->send();
            die();
        }
        if (strtotime($token->getExpireAt()) < time()) {
            $application->response->setStatusCode(401);
            $application->response->setContent('Token is expired.');
            $application->response->send();
            die();
        }
        $user = User::findFirst($token->getUserId());
        if (!$user) {
            $application->response->setStatusCode(404);
            $application->response->setContent('User not found!');
            $application->response->send();
            die();
        }
        $application->user = $user;
        return true;
    }

    public function call(Micro $application)
    {
        return true;
    }
}
