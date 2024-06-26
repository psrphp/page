<?php

declare(strict_types=1);

namespace App\Psrphp\Page\Http;

use App\Psrphp\Admin\Http\Common;
use PsrPHP\Database\Db;
use PsrPHP\Framework\Request;
use PsrPHP\Framework\Template;

class Index extends Common
{

    public function get(
        Db $db,
        Request $request,
        Template $template
    ) {
        $data = [];
        $where = [];
        $total = $db->count('psrphp_page', $where);
        $page = $request->get('page') ?: 1;
        $size = 20;
        $data['maxpage'] = ceil($total / $size) ?: 1;
        $data['total'] = $total;
        $where['LIMIT'] = [($page - 1) * $size, $size];
        $where['ORDER'] = [
            'id' => 'DESC',
        ];
        $data['datas'] = $db->select('psrphp_page', '*', $where);
        return $template->renderFromFile('index@psrphp/page', $data);
    }
}
