<?php
declare(strict_types=1);

use Phalcon\Http\Response;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

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

        $validator = new EmailValidator();
        $email_valid = $validator->isValid($email, new RFCValidation());
        $errors = array();
        if (empty($email)) {
            $errors[] = 'email is required.';
        } elseif (!$email_valid) {
            $errors[] = 'email is invalid.';
        }
        if (empty($password)) {
            $errors[] = 'password is required.';
        } elseif (mb_strlen($password, 'UTF-8') < 6) {
            $errors[] = 'Min password length must be 6.';
        }
        if (empty(intval($city_id))) {
            $errors[] = 'city_id is required.';
        }
        if (empty($timezone)) {
            $errors[] = 'timezone is required.';
        }
        if (empty($language)) {
            $errors[] = 'language is required.';
        } elseif (mb_strlen($language, 'UTF-8') != 2) {
            $errors[] = 'language length must be 2.';
        }

        // Create a response
        $response = new Response();
        if (count($errors) > 0) {
            $response->setStatusCode(400);
            $response->setJsonContent(
                array(
                    'status'   => 'ERROR',
                    'message' => implode(" ", $errors)
                )
            );
            $response->send();
            die();
        }
        $user = User::findFirst([
            'conditions'  => 'email = :email:',
            'bind'        => [
                'email' => $email
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

        $user = new User();
        $user->setEmail($email);
        $user->setPassword(md5($password));
        $user->setDeviceOs($device_os);
        $user->setCityId($city_id);
        $user->setTimezone($timezone);
        $user->setLanguage($language);
        $user->setNotifyToken($notify_token);
        $user_result = $user->save();
        $subs_result = false;

        if ($user_result) {
            $subscription = new Subscription();
            $subscription
                ->setUserId($user->getId())
                ->setServiceId(Helper::DEFAULT_SERVICE_ID)
                ->setStatus(1)
                ->setStartDate(date('Y-m-d H:i:s'))
                ->setFoc(0);
            $subs_result = $subscription->save();
        }

        // Check if the insertion was successful
        if ($user_result && $subs_result) {
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
        /** @var User $current_user */
        $current_user = $application->user;

        $email = $this->request->getPut('email');
        $password = $this->request->getPut('password');
        $city_id = $this->request->getPut('city_id');
        $device_os = $this->request->getPut('device_os');
        $timezone = $this->request->getPut('timezone');
        $language = $this->request->getPut('language');
        $response = new Response();
        $errors = array();

        if ($email) {
            $validator = new EmailValidator();
            $email_valid = $validator->isValid($email, new RFCValidation());
            if (!$email_valid) {
                $errors[] = 'email is invalid.';
            }
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
            if (mb_strlen($password, 'UTF-8') < 6) {
                $errors[] = 'Min password length must be 6.';
            }
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
            if (mb_strlen($language, 'UTF-8') != 2) {
                $errors[] = 'language length must be 2.';
            }
            $current_user->setLanguage($language);
        }
        if (count($errors) > 0) {
            $response->setStatusCode(400);
            $response->setJsonContent(
                array(
                    'status'   => 'ERROR',
                    'message' => implode(" ", $errors)
                )
            );
            $response->send();
            die();
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

