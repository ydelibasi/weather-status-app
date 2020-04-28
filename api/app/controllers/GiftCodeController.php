<?php
declare(strict_types=1);
use Phalcon\Http\Response;

class GiftCodeController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function activate()
    {
        $response = new Response();
        $gift_code = $this->request->get('code');
        if (!$gift_code) {
            $response->setStatusCode(400);
            $response->setJsonContent(
                array(
                    'status' => 'ERROR',
                    'msg'   => 'code is missing.'
                )
            );
            $response->send();
            die();
        }
        $code = GiftCode::findFirst([
            'conditions'  => 'code = :code: ',
            'bind'        => [
                'code' => $gift_code
            ]
        ]);


        if (!$code) {
            $response->setStatusCode(404);
            $response->setJsonContent(
                array(
                    'status' => 'ERROR',
                    'msg'   => 'Gift code not found.'
                )
            );
        }
        elseif ($code->getUserId()) {
            $response->setStatusCode(400);
            $response->setJsonContent(
                array(
                    'status' => 'ERROR',
                    'msg'   => 'Gift code has been already used.'
                )
            );
        }
        else {
            $application = $this->di->getShared('application');
            /** @var User $user */
            $user = $application->user;
            $user_code = GiftCode::findFirst([
                'conditions'  => 'user_id = :id: ',
                'bind'        => [
                    'id' => $user->getId()
                ]
            ]);
            if ($user_code) {
                $response->setStatusCode(400);
                $response->setJsonContent(
                    array(
                        'status' => 'ERROR',
                        'msg'   => 'You used a gift code before.'
                    )
                );
            } else {
                $code->setUserId($user->getId());
                $code->setUsageDate(date('Y-m-d H:i:s'));
                $code_result = $code->save();
                $subs_result = false;

                if ($code_result) {
                    $subs = Subscription::findFirst([
                        'conditions'  => 'user_id = :id: ',
                        'bind'        => [
                            'id' => $user->getId()
                        ]
                    ]);
                    if ($subs) {
                        $subs->setFoc(1);
                        $subs->setUpdatedAt(date('Y-m-d H:i:s'));
                        $subs_result = $subs->save();
                    }
                }
                if ($subs_result && $code_result) {
                    $response->setStatusCode(200, "OK");
                    $response->setJsonContent(
                        array(
                            'status' => 'OK',
                            'msg'   => 'Gift Code activated.',
                        )
                    );
                } else {
                    $response->setStatusCode(500);
                    $response->setJsonContent(
                        array(
                            'status' => 'ERROR',
                            'msg'   => 'Gift Code activation failed.',
                        )
                    );
                }
            }
        }
        return $response;
    }

}

