<?php

declare(strict_types=1);

namespace App\Psrphp\Page\Http;

use App\Psrphp\Admin\Http\Common;
use App\Psrphp\Admin\Lib\Response;
use PsrPHP\Database\Db;
use PsrPHP\Form\Builder;
use PsrPHP\Form\Col;
use PsrPHP\Form\Row;
use PsrPHP\Form\Code;
use PsrPHP\Form\Input;
use PsrPHP\Form\Hidden;
use PsrPHP\Form\Radio;
use PsrPHP\Form\Radios;
use PsrPHP\Request\Request;

class Update extends Common
{
    public function get(
        Request $request,
        Db $db
    ) {
        $version = $db->get('psrphp_page', '*', [
            'id' => $request->get('id', 0, ['intval']),
        ]);
        $form = new Builder('编辑页面');
        $form->addItem(
            (new Row())->addCol(
                (new Col('col-md-8'))->addItem(
                    (new Hidden('id', $version['id'])),
                    (new Input('页面', 'page', $version['page']))->setHelp('例如：/, /help, /about.html, /page/map.php'),
                    (new Code('模板', 'tpl', $version['tpl']))->setHelp('支持模板标签'),
                    (new Radios('是否发布'))->addRadio(
                        new Radio('否', 'state', 0, $version['state'] == 0),
                        new Radio('是', 'state', 1, $version['state'] == 1),
                    ),
                    new Input('备注', 'tips', $version['tips'])
                )
            )
        );
        return $form;
    }

    public function post(
        Request $request,
        Db $db
    ) {
        $version = $db->get('psrphp_page', '*', [
            'id' => $request->post('id', 0, ['intval']),
        ]);

        $update = array_intersect_key($request->post(), [
            'page' => '',
            'tpl' => '',
            'state' => '',
            'tips' => '',
        ]);

        $db->update('psrphp_page', $update, [
            'id' => $version['id'],
        ]);

        return Response::success('操作成功！');
    }
}
