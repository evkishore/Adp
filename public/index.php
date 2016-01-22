<?php
error_reporting(E_ALL);
define('APP_PATH', realpath('..'));

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as Database;

$config = include APP_PATH . "/apps/config/Config.php";
date_default_timezone_set($config['time_zone']);

$di = new FactoryDefault();

$di->set('config', $config, true);

$di->set('db', function () use ($config) {
    return new Database(array(
        "host"     => $config->database->host,
        "username" => $config->database->username,
        "password" => $config->database->password,
        "dbname"   => $config->database->dbname
    ));
});

$di->set('router', function () {
    $router = new Router();
    $router->setDefaultModule("frontend");
    $router->add(
        '/:controller',
        array(
            'module'  => 'frontend',
            'controller' => 1
        ))
        ->convert('controller', function($controller) {
            return str_replace('-', '', $controller);
        });
    $router->add(
        '/:controller/:action',
        array(
            'module'  => 'frontend',
            'controller' => 1,
            'action'     => 2
        )
    );
    $router->add(
        '/:controller/:action/:params',
        array(
            'module'  => 'frontend',
            'controller' => 1,
            'action'     => 2,
            'params'     => 3
        ))
        ->convert('controller', function($controller) {
            return str_replace('-', '', $controller);
    });

    $router->add(
        "/dich-vu/([0-9]+)/([a-z\-]+)",
        array(
           'module'  => 'frontend',
           "controller" => "dichvu",
           "action"     => "detail",
           "type"       => 1,
           "name"      => 2
        ))
        ->convert('controller', function($controller) {
            return str_replace('-', '', $controller);
    });

    $router->add(
        "/tin-tuc/([0-9]+)/([a-zA-Z0-9\_\-]+)",
        array(
           'module'  => 'frontend',
           "controller" => "tintuc",
           "action"     => "list",
           "cateId"       => 1,
           "cateName"      => 2
        ))
        ->convert('controller', function($controller) {
            return str_replace('-', '', $controller);
    });

     $router->add(
        "/tin-tuc/([0-9]+)/([a-zA-Z0-9\_\-]+)/([0-9]+)",
        array(
            'module'  => 'frontend',
            "controller" => "tintuc",
            "action"     => "list",
            "cateId"       => 1,
            "cateName"      => 2,
            "pageNum"   => 3
        ))
        ->convert('controller', function($controller) {
            return str_replace('-', '', $controller);
    });

     $router->add(
        "/tin-tuc/([0-9]+)/([a-zA-Z0-9\_\-]+)/([0-9]+)/([a-zA-Z0-9\_\-]+)",
        array(
           'module'  => 'frontend',
           "controller" => "tintuc",
           "action"     => "detail",
           "cateId"       => 1,
           "cateName"      => 2,
           "contentId"       => 3,
           "contentName"      => 4
        ))
        ->convert('controller', function($controller) {
            return str_replace('-', '', $controller);
    });

     $router->add(
        "/video/([0-9]+)/([a-zA-Z0-9\_\-]+)/([0-9]+)",
        array(
           'module'  => 'frontend',
           "controller" => "video",
           "action"     => "list",
           "cateId"       => 1,
           "cateName"      => 2,
            "pageNum"   => 3
        ))
        ->convert('controller', function($controller) {
            return str_replace('-', '', $controller);
    });

     $router->add(
        "/video/([0-9]+)/([a-zA-Z0-9\_\-]+)",
        array(
           'module'  => 'frontend',
           "controller" => "video",
           "action"     => "list",
           "cateId"       => 1,
           "cateName"      => 2
        ))
        ->convert('controller', function($controller) {
            return str_replace('-', '', $controller);
    });

    $router->add(
        "/video/([0-9]+)/([a-zA-Z0-9\_\-]+)/([0-9]+)/([a-zA-Z0-9\_\-]+)",
        array(
           'module'  => 'frontend',
           "controller" => "video",
           "action"     => "detail",
           "cateId"       => 1,
           "cateName"      => 2,
           "videoId"       => 3,
           "videoName"      => 4
        ))
        ->convert('controller', function($controller) {
            return str_replace('-', '', $controller);
    });

    $router->add(
        '/cpanel',
        array(
            'module' => 'backend',
            'action'    => 'index'
        )
    );
    $router->add(
        '/cpanel/:controller',
        array(
            'module'  => 'backend',
            'controller' => 1
        )
    );
    $router->add(
        '/cpanel/:controller/:action',
        array(
            'module'  => 'backend',
            'controller' => 1,
            'action'     => 2
        )
    );
    // Login and logout cpanel
    $router->add(
        '/cpanel/login',
        array(
            'module'  => 'backend',
            'controller' => 'index',
            'action'     => 'login'
        )
    );
    $router->add(
        '/cpanel/logout',
        array(
            'module'  => 'backend',
            'controller' => 'index',
            'action'     => 'logout'
        )
    );

    $router->add(
        '/cpanel/contact',
        array(
            'module'  => 'backend',
            'controller' => 'index',
            'action'     => 'contact'
        )
    );
    $router->add(
        '/cpanel/:controller/:action/:params',
        array(
            'module'  => 'backend',
            'controller' => 1,
            'action'     => 2,
            'params'     => 3
        )
    );
    $router->removeExtraSlashes(true);
    return $router;
});

try {
    $application = new Application($di);
    $application->registerModules(
        array(
            'frontend' => array(
                'className' => 'Multiple\Frontend\Module',
                'path'      => APP_PATH . '/apps/frontend/Module.php',
            ),
            'backend'  => array(
                'className' => 'Multiple\Backend\Module',
                'path'      => APP_PATH . '/apps/backend/Module.php',
            )
        )
    );
    echo $application->handle()->getContent();
} catch (\Exception $e) {
    echo $e->getMessage();
}
?>
