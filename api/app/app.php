<?php

/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

use Phalcon\Mvc\Micro\Collection as MicroCollection;

// Users handler
$users = new MicroCollection();
$users->setHandler(new UserController());
$users->setPrefix('/user');
$users->post('/register', 'register');
$users->put('/update', 'update');
$app->mount($users);

$homepage = new MicroCollection();
$homepage->setHandler(new IndexController());
$homepage->post('/login', 'login');
$app->mount($homepage);

/**
 * Add your routes here
 */
$app->get('/', function () {
    //echo $this['view']->render('index');
    echo "Welcome Weather Status API";
});

/**
 * Not found handler
 */
$app->notFound(function () use($app) {
    $app->response->setStatusCode(404)->sendHeaders();
    $app->response->setContent('Url not found!');
    $app->response->setJsonContent(
        array(
            'status' => 'ERROR',
            'msg'   => 'Page not found.'
        )
    );
    $app->response->send();
    //echo $app['view']->render('404');
});
