<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

$loader->registerDirs(
    [
        $config->application->modelsDir,
        $config->application->controllersDir,
        $config->application->middlewaresDir,
        $config->application->libraryDir,
    ]
)->register();
