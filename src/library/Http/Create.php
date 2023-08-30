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
use PsrPHP\Form\Radio;
use PsrPHP\Form\Radios;
use PsrPHP\Request\Request;

class Create extends Common
{
    public function get()
    {
        $form = new Builder('添加页面');
        $form->addItem(
            (new Row())->addCol(
                (new Col('col-md-9'))->addItem(
                    (new Input('页面', 'page'))->setHelp('例如：/, /help, /about.html, /page/map.php'),
                    (new Code('模板', 'tpl'))->setHelp('支持模板标签'),
                    (new Radios('是否发布'))->addRadio(
                        new Radio('否', 'state', 0, false),
                        new Radio('是', 'state', 1, true),
                    ),
                    new Input('备注', 'tips')
                )
            )
        );
        return $form;
    }

    public function post(
        Request $request,
        Db $db
    ) {
        $db->insert('psrphp_page', [
            'page' => $request->post('page'),
            'tpl' => $request->post('tpl'),
            'state' => $request->post('state', 1, ['intval']),
            'tips' => $request->post('tips'),
        ]);
        return Response::success('操作成功！', 'javascript:history.go(-2)');
    }
}
