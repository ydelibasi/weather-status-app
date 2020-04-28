<?php

/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

use Phalcon\Mvc\Micro\Collection as MicroCollection;

/**
 * Add your routes here
 */

// Index handler
$homepage = new MicroCollection();
$homepage->setHandler(new IndexController());
$homepage->post('/login', 'login');
$app->mount($homepage);

// Users handler
$users = new MicroCollection();
$users->setHandler(new UserController());
$users->setPrefix('/user');
$users->post('/register', 'register');
$users->put('/update', 'update');
$app->mount($users);

// Gift Code handler
$gift_code = new MicroCollection();
$gift_code->setHandler(new GiftCodeController());
$gift_code->post('/gift-code/activate', 'activate');
$app->mount($gift_code);


$app->get('/', function () {
    //echo $this['view']->render('index');
    echo "Welcome Weather Status API";
});

/**
 * Not found handler
 */
$app->notFound(function () use($app) {
    $app->response->setStatusCode(404)->sendHeaders();
    $app->response->setJsonContent(
        array(
            'status' => 'ERROR',
            'msg'   => 'Page not found.'
        )
    );
    $app->response->send();
    //echo $app['view']->render('404');
});
