<?php

use App\Psrphp\Admin\Model\MenuProvider;
use App\Psrphp\Page\Http\Index;
use App\Psrphp\Page\Http\Show;
use PsrPHP\Database\Db;
use PsrPHP\Framework\Framework;
use PsrPHP\Router\Router;

return [
    Router::class => function (
        Router $router
    ) {
        Framework::execute(function (
            Db $db,
        ) use ($router) {
            $router->addGroup($router->getSiteRoot(), function (Router $router) use ($db) {
                foreach ($db->select('psrphp_page', '*') as $vo) {
                    $router->addRoute($vo['page'], Show::class, '/psrphp/page/show', ['*'], [
                        'id' => $vo['id'],
                    ]);
                }
            });
        });
    },
    MenuProvider::class => function (
        MenuProvider $menuProvider
    ) {
        $menuProvider->add('单页管理', Index::class);
    },
];
