<?php

declare(strict_types=1);

namespace App\Psrphp\Page\Psrphp;

use App\Psrphp\Admin\Model\MenuProvider;
use App\Psrphp\Page\Http\Index;
use App\Psrphp\Page\Http\Show;
use Psr\EventDispatcher\ListenerProviderInterface;
use PsrPHP\Database\Db;
use PsrPHP\Framework\Framework;
use PsrPHP\Router\Router;

class ListenerProvider implements ListenerProviderInterface
{
    public function getListenersForEvent(object $event): iterable
    {
        if (is_a($event, Router::class)) {
            yield function () use ($event) {
                Framework::execute(function (
                    Db $db,
                    Router $router,
                ) {
                    $router->addGroup($router->getSiteRoot(), function (Router $router) use ($db) {
                        foreach ($db->select('psrphp_page', '*') as $vo) {
                            $router->addRoute(['*'], $vo['page'], Show::class, [], [
                                'id' => $vo['id'],
                            ], '/psrphp/page/show');
                        }
                    });
                }, [
                    Router::class => $event,
                ]);
            };
        }

        if (is_a($event, MenuProvider::class)) {
            yield function () use ($event) {
                Framework::execute(function (
                    MenuProvider $provider
                ) {
                    $provider->add('单页管理', Index::class);
                }, [
                    MenuProvider::class => $event,
                ]);
            };
        }
    }
}
