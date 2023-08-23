<?php

declare(strict_types=1);

namespace App\Psrphp\Page\Psrphp;

use App\Psrphp\Admin\Model\MenuProvider;
use App\Psrphp\Page\Http\Index;
use App\Psrphp\Page\Middleware\Page;
use Psr\EventDispatcher\ListenerProviderInterface;
use PsrPHP\Framework\Framework;
use PsrPHP\Framework\Handler;

class ListenerProvider implements ListenerProviderInterface
{
    public function getListenersForEvent(object $event): iterable
    {
        if (is_a($event, Handler::class)) {
            yield function () use ($event) {
                Framework::execute(function (
                    Handler $handler
                ) {
                    $handler->pushMiddleware(Page::class);
                }, [
                    Handler::class => $event,
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
