{include common/header@psrphp/admin}
<h1>页面管理</h1>
<div>管理网站单页，支持模板标签</div>
<br>
<div>
    <a href="{:$router->build('/psrphp/page/create')}">新增</a>
</div>
<br>
<form action="{:$router->build('/psrphp/page/index')}" method="GET">
    <input type="hidden" name="page" value="1">
    <input type="search" name="q" value="{:$request->get('q')}" placeholder="请输入搜索词" onchange="event.target.form.submit();">
</form>
<br>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>页面</th>
            <th>备注</th>
            <th>是否发布</th>
            <th>管理</th>
            <th>访问</th>
        </tr>
    </thead>
    <tbody>
        {foreach $datas as $vo}
        <tr>
            <td>
                <code>{$vo.page}</code>
            </td>
            <td>
                {$vo.tips}
            </td>
            <td>
                {$vo['state']==1?'是':'否'}
            </td>
            <td>
                <a href="{:$router->build('/psrphp/page/update', ['id'=>$vo['id']])}">编辑</a>
                <a href="{:$router->build('/psrphp/page/delete', ['id'=>$vo['id']])}" onclick="return confirm('确定删除吗？删除后不可恢复！');">删除</a>
            </td>
            <td>
                <a href="{:$router->build('')}{$vo.page}" target="_blank">访问</a>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
<br>
<div style="display: flex;flex-direction: row;flex-wrap: wrap;">
    <form>
        <button type="submit" name="page" value="1">首页</button>
        <button type="submit" name="page" value="{:max($request->get('page')-1, 1)}">上一页</button>
    </form>
    <form style="margin:0 5px;">
        <input type="number" name="page" min="1" max="{$maxpage}" step="1" style="width:50px" value="{:$request->get('page', 1)}" onchange="event.target.form.submit()">
    </form>
    <form>
        <button type="submit" name="page" value="{:min($request->get('page')+1, $maxpage)}">下一页</button>
        <button type="submit" name="page" value="{$maxpage}">末页</button>
    </form>
</div>
{include common/footer@psrphp/admin}