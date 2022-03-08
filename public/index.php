<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};


//use App\Kernel;
//use Symfony\Component\Dotenv\Dotenv;
//use Symfony\Component\ErrorHandler\Debug;
//use Symfony\Component\HttpFoundation\Request;
//
//require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';
//
//(new yyDotenv())->bootEnv(dirname(__DIR__) . '/.env');
//
//if ($_SERVER['APP_DEBUG']) {
//    umask(0000);
//
//    Debug::enable();
//}
//
//$kernel = new Kernel($_SERVER['APP_ENV'], (bool)$_SERVER['APP_DEBUG']);
//$request = Request::createFromGlobals();
//$response = $kernel->handle($request);
//$response->send();
//$kernel->terminate($request, $response);
