<?php
defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config( array(
    'database' => array(
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '',
        'dbname'      => 'itv_shopping',
    ),
    'time_zone'         => "Asia/Ho_Chi_Minh",
    'app' => array(
        'fullUri'   => 'http://itv-homeshopping.dev/',
        'image' => array(
            'directory' =>  '/images/upload/',
            'baseURL'   => "http://itv-homeshopping.dev",
            'minsize' => 1000,
            'maxsize' => 1000000,
            'mimes' => array(
                'image/gif',
                'image/jpeg',
                'image/png',
            ),
            'extensions' => array(
                'gif',
                'jpeg',
                'jpg',
                'png',
            ),
            'sanitize' => true,
            'hash' => 'md5'
        )
    ),
    'frontend' => array(
        'controllersDir' => APP_PATH . '/apps/frontend/controllers/',
        'modelsDir'      => APP_PATH . '/apps/frontend/models/',
        'migrationsDir'  => APP_PATH . '/apps/frontend/migrations/',
        'viewsDir'       => APP_PATH . '/apps/frontend/views/',
        'pluginsDir'     => APP_PATH . '/apps/frontend/plugins/',
        'cacheDir'       => APP_PATH . '/apps/frontend/cache/',
        'publicDir'      => APP_PATH . '/public/frontend/',
        'baseUri'        => '/',
    ),
    'backend' => array(
        'controllersDir' => APP_PATH . '/apps/backend/controllers/',
        'modelsDir'      => APP_PATH . '/apps/backend/models/',
        'migrationsDir'  => APP_PATH . '/apps/backend/migrations/',
        'viewsDir'       => APP_PATH . '/apps/backend/views/',
        'pluginsDir'     => APP_PATH . '/apps/backend/plugins/',
        'cacheDir'       => APP_PATH . '/apps/backend/cache/',
        'publicDir'      => APP_PATH . '/public/backend/',
        'baseUri'        => '/'
    ),

));
?>
