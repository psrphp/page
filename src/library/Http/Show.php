<?php

declare(strict_types=1);

namespace App\Psrphp\Page\Http;

use App\Psrphp\Admin\Lib\Response;
use App\Psrphp\Web\Http\Common;
use PsrPHP\Database\Db;
use PsrPHP\Framework\Request;
use PsrPHP\Router\Router;
use PsrPHP\Framework\Template;

class Show extends Common
{
    public function get(
        Db $db,
        Router $router,
        Request $request,
        Template $template
    ) {
        if (!$page = $db->get('psrphp_page', '*', [
            'state' => 1,
            'id' => $request->get('id'),
        ])) {
            return Response::redirect($router->build('/'), 302);
        }
        return $template->renderFromString($page['tpl']);
    }
}
