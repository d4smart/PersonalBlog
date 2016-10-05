<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL' => 2,       // rewrite模式，去掉URL中的index.php

    // 数据库连接信息
    'DB_TYPE' => 'mysql',   // 数据库类型
    'DB_HOST' => '127.0.0.1',   // 服务器地址
    'DB_NAME' => 'blog',    // 数据库名
    'DB_USER' => 'root',    // 用户名
    'DB_PWD' => '',         // 密码
    'DB_PORT' => 3306,      // 端口
    'DB_PREFIX' => 'bg_',   // 数据库表前缀
    'DB_CHARSET'=> 'utf8',  // 字符集

    // 开启URL路由
    'URL_ROUTER_ON'   => true,

    // 跳转和错误页面模板
    'TMPL_ACTION_ERROR'     =>  'Public/Tpl/error.tpl',     // 错误跳转的模板文件
    'TMPL_ACTION_SUCCESS'   =>  'Public/Tpl/success.tpl',   // 成功跳转的模板文件
    'TMPL_EXCEPTION_FILE'   =>  'Public/Tpl/exception.tpl', // 异常页面的模板文件

    // 显示页面Trace信息
    'SHOW_PAGE_TRACE' =>true,
);