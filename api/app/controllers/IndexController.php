<?php
declare(strict_types=1);
use Phalcon\Http\Response;

class IndexController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function login() {
        $response = new Response();
        $response->setStatusCode(201, "Created");
        $response->setJsonContent(
            array(
                'status' => 'OK',
                'msg'   => 'Login OK.'
            )
        );
        return $response;
    }

}

