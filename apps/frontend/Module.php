<?php
namespace Multiple\Frontend;

defined('APP_PATH') || define('APP_PATH', realpath('.'));

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

class Module implements ModuleDefinitionInterface {
    public function registerAutoloaders(DiInterface $dependencyInjector = null) {
        global $config;
        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'Multiple\Frontend\Controllers' => $config->frontend->controllersDir,
                'Multiple\Frontend\Models'      => $config->frontend->modelsDir,
            )
        );
        $loader->registerDirs(
            array(
                $config->frontend->controllersDir,
                $config->frontend->modelsDir
            )
        );
        $loader->register();
    }
    public function registerServices(DiInterface $di) {
        global $config;
        $di->setShared('url', function () use ($config) {
            $url = new UrlResolver();
            $url->setBaseUri($config->frontend->baseUri);
            return $url;
        });
        $di->setShared('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Multiple\Frontend\Controllers");
            return $dispatcher;
        });
        $di->setShared('view', function () use ($config) {
            $view = new View();
            $view->setViewsDir($config->frontend->viewsDir);
            $view->setLayoutsDir('layouts/');
            $view->setPartialsDir('partials/');
            $view->registerEngines(array(
                '.phtml' => function ($view, $di) use ($config) {
                    $volt = new VoltEngine($view, $di);
                    $volt->setOptions(array(
                        'compiledPath' => $config->frontend->cacheDir,
                        'compiledSeparator' => '_'
                    ));
                    return $volt;
                },
                '.volt' => 'Phalcon\Mvc\View\Engine\Php'
            ));
            return $view;
        });
    }
}
?>