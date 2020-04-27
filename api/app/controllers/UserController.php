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
        $res = $user->save();


        // Create a response
        $response = new Response();

        // Check if the insertion was successful
        if ($res) {

            // Change the HTTP status
            $response->setStatusCode(201, "Created");
            $response->setJsonContent(
                array(
                    'status' => 'OK',
                    'msg'   => 'User created v2.',
                    'id' => $user->getId()
                )
            );

        } else {

            // Change the HTTP status

            $response->setStatusCode(409);
            $response->setJsonContent(
                array(
                    'status'   => 'ERROR',
                    'message' => 'Register failed.'
                )
            );
        }

        return $response;


    }

    public function update($id)
    {
        $application = $this->di->getShared('application');
        //print_r($application);


        $response = new Response();
        $response->setStatusCode(409);
        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'message' => 'Register failed.',
                'id' => $id,
                'token' => $application->token
            )
        );
        return $response;

    }

}

