<?php
namespace Multiple\Backend;

defined('APP_PATH') || define('APP_PATH', realpath('.'));

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Security;
use Multiple\Backend\Plugins\SecurityPlugin as SecurityPlugin;

class Module implements ModuleDefinitionInterface {
    public function registerAutoloaders(DiInterface $dependencyInjector = null) {
        global $config;
        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'Multiple\Backend\Controllers' => $config->backend->controllersDir,
                'Multiple\Backend\Models'      => $config->backend->modelsDir,
                'Multiple\Backend\Plugins'     => $config->backend->pluginsDir,
            )
        );
        $loader->registerDirs(
            array(
                $config->backend->controllersDir,
                $config->backend->modelsDir,
                $config->backend->pluginsDir
            )
        );
        $loader->register();
    }
    public function registerServices(DiInterface $di) {
        global $config;
        $di->setShared('url', function () use ($config) {
            $url = new UrlResolver();
            $url->setBaseUri($config->backend->baseUri);
            return $url;
        });
        // Register dispatcher
        $di->setShared('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Multiple\Backend\Controllers");

            // Create an EventsManager
            $eventsManager = new EventsManager();

            // Listen for events produced in the dispatcher using the Security plugin
            //$eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);

            // Attach a listener
            $eventsManager->attach("dispatch:beforeException", function ($event, $dispatcher, $exception) {
                // Handle 404 exceptions
                if ($exception instanceof DispatchException) {
                    $dispatcher->forward(
                        array(
                            'controller' => 'index',
                            'action'     => 'show404'
                        )
                    );
                    return false;
                }

                // Alternative way, controller or action doesn't exist
                switch ($exception->getCode()) {
                    case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                    case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                        $dispatcher->forward(
                            array(
                                'controller' => 'index',
                                'action'     => 'show404'
                            )
                        );
                        return false;
                }
            });

            // Assign the events manager to the dispatcher
            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        });

        // register view
        $di->setShared('view', function () use ($config) {
            $view = new View();
            $view->setViewsDir($config->backend->viewsDir);
            $view->setLayoutsDir('layouts/');
            $view->setPartialsDir('partials/');
            $view->registerEngines(array(
                '.phtml' => function ($view, $di) use ($config) {
                    $volt = new VoltEngine($view, $di);
                    $volt->setOptions(array(
                        'compiledPath' => $config->backend->cacheDir,
                        'compiledSeparator' => '_'
                    ));
                    return $volt;
                },
                '.volt' => 'Phalcon\Mvc\View\Engine\Php'
            ));
            return $view;
        });

        // Start the session the first time when some component request the session service
        $di->setShared('session', function () {
            $session = new Session();
            $session->start();
            return $session;
        });

        // Register the flash service with custom CSS classes
        $di->set('flash', function () {
            //$flash = new FlashDirect(
            $flash = new FlashSession(
                array(
                    'error'   => 'alert alert-danger',
                    'success' => 'alert alert-success',
                    'notice'  => 'alert alert-info',
                    'warning' => 'alert alert-warning'
                )
            );

            return $flash;
        });

        // Register the security
        $di->set('security', function () {
                $security = new Security();
                // Set the password hashing factor to 12 rounds
                $security->setWorkFactor(12);
                return $security;
            }, true);
    }
}
?>
