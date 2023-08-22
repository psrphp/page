<?php

declare(strict_types=1);

namespace App\Psrphp\Page\Psrphp;

use PsrPHP\Framework\Script as FrameworkScript;

class Script
{
    public static function onInstall()
    {
        $sql = <<<'str'
DROP TABLE IF EXISTS `prefix_psrphp_page`;
CREATE TABLE `prefix_psrphp_page` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `page` varchar(255) NOT NULL DEFAULT '' COMMENT '页面',
    `tips` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
    `tpl` text COMMENT '模板',
    `state` tinyint(4) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
str;
        FrameworkScript::execSql($sql);
    }

    public static function onUnInstall()
    {
        $sql = <<<'str'
DROP TABLE IF EXISTS `prefix_psrphp_page`;
str;
        FrameworkScript::execSql($sql);
    }
}
