<?php
declare(strict_types=1);
use Phalcon\Http\Response;

class IndexController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function login()
    {
        $email = $this->request->get('email');
        $password = $this->request->get('password');
        $response = new Response();

        if (empty($email) || empty($password)) {
            $response->setStatusCode(400);
            $response->setJsonContent(
                array(
                    'status' => 'ERROR',
                    'msg'   => 'email/password required.'
                )
            );
            $response->send();
            die();
        }

        $user = User::findFirst([
            'conditions'  => 'email = :email: AND ' .
                'password = :pass:',
            'bind'        => [
                'email' => $email,
                'pass' => md5($password),
            ]
        ]);

        /** @var $user User */
        if ($user) {
            $user_id = $user->getId();
            $token = Token::findFirst([
                'conditions'  => 'user_id = :id:',
                'bind'        => ['id' => $user_id]
            ]);

            if (!$token) {
                $api_token = Helper::createToken($user_id);
            } else {
                $end_time = strtotime($token->getExpireAt());
                if ($end_time < time()) {
                    $token->delete();
                    $api_token = Helper::createToken($user_id);
                } else {
                    $api_token = $token->getToken();
                }

            }

            $response->setStatusCode(200, "OK");
            $response->setJsonContent(
                array(
                    'status' => 'OK',
                    'msg'   => 'Login successful.',
                    'token' => $api_token
                )
            );
        } else {
            $response->setStatusCode(400);
            $response->setJsonContent(
                array(
                    'status' => 'ERROR',
                    'msg'   => 'Invalid credentials.'
                )
            );
        }

        return $response;
    }

}

