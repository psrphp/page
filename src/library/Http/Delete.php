<?php

declare(strict_types=1);

namespace App\Psrphp\Page\Http;

use App\Psrphp\Admin\Http\Common;
use App\Psrphp\Admin\Lib\Response;
use PsrPHP\Database\Db;
use PsrPHP\Framework\Request;

class Delete extends Common
{
    public function get(
        Request $request,
        Db $db
    ) {
        $db->delete('psrphp_page', [
            'id' => $request->get('id'),
        ]);
        return Response::success('操作成功！');
    }
}
