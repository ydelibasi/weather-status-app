<?php
declare(strict_types=1);

use Phalcon\Http\Response;

class UserController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function register()
    {
        $email = $this->request->get('email');
        $password = $this->request->get('password');
        $city_id = $this->request->get('city_id');
        $device_os = $this->request->get('device_os');
        $timezone = $this->request->get('timezone');
        $language = $this->request->get('language');
        $notify_token = $this->request->get('notify_token');

        $user = new User();

        $user->setEmail($email);
        $user->setPassword(md5($password));
        $user->setDeviceOs($device_os);
        $user->setCityId($city_id);
        $user->setTimezone($timezone);
        $user->setLanguage($language);
        $user->setNotifyToken($notify_token);
        $result = $user->save();


        // Create a response
        $response = new Response();

        // Check if the insertion was successful
        if ($result) {
            $response->setStatusCode(201, "Created");
            $response->setJsonContent(
                array(
                    'status' => 'OK',
                    'msg'   => 'User created.',
                    'id' => $user->getId()
                )
            );

        } else {
            $response->setStatusCode(500);
            $response->setJsonContent(
                array(
                    'status'   => 'ERROR',
                    'message' => 'Register failed.'
                )
            );
        }
        return $response;
    }

    public function update()
    {
        $application = $this->di->getShared('application');

        $email = $this->request->getPut('email');
        $password = $this->request->getPut('password');
        $city_id = $this->request->getPut('city_id');
        $device_os = $this->request->get('device_os');
        $timezone = $this->request->get('timezone');
        $language = $this->request->get('language');
        $response = new Response();

        /** @var User $current_user */
        $current_user = $application->user;

        if ($email) {
            $user = User::findFirst([
                'conditions'  => 'email = :email: AND ' .
                    'id != :current_user_id:',
                'bind'        => [
                    'email' => $email,
                    'current_user_id' => $current_user->getId(),
                ]
            ]);
            if ($user) {
                $response->setStatusCode(400);
                $response->setJsonContent(
                    array(
                        'status'   => 'ERROR',
                        'message' => 'Email address not usable.'
                    )
                );
                $response->send();
                die();
            }
            $current_user->setEmail($email);
        }
        if ($password) {
            $current_user->setPassword(md5($password));
        }
        if ($device_os) {
            $current_user->setDeviceOs($device_os);
        }
        if ($city_id) {
            $current_user->setCityId($city_id);
        }
        if ($timezone) {
            $current_user->setTimezone($timezone);
        }
        if ($language) {
            $current_user->setLanguage($language);
        }
        $current_user->setUpdatedAt(date('Y-m-d H:i:s'));
        $result = $current_user->save();

        if ($result) {
            $response->setStatusCode(200, "Updated");
            $response->setJsonContent(
                array(
                    'status' => 'OK',
                    'msg'   => 'User updated.'
                )
            );

        } else {
            $response->setStatusCode(500);
            $response->setJsonContent(
                array(
                    'status'   => 'ERROR',
                    'message' => 'User could not be updated.'
                )
            );
        }
        return $response;
    }

}

