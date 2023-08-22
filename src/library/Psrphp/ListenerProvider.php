<?php

declare(strict_types=1);

namespace App\Psrphp\Page\Psrphp;

use App\Psrphp\Admin\Model\MenuProvider;
use App\Psrphp\Page\Http\Index;
use App\Psrphp\Page\Middleware\Page;
use PsrPHP\Framework\Handler;
use PsrPHP\Framework\Listener;

class ListenerProvider extends Listener
{
    public function __construct()
    {
        $this->add(Handler::class, function (
            Handler $handler
        ) {
            $handler->pushMiddleware(Page::class);
        });

        $this->add(MenuProvider::class, function (
            MenuProvider $provider
        ) {
            $provider->add('单页管理', Index::class);
        });
    }
}
