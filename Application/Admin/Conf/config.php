<?php
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING' =>  array(
        '__PUBLIC__' => SITE_URL.'/Application/Admin/Public',   // 更改默认的Public替换规则，在Admin模块下Public目录为模块下的Public目录
    ),

    'URL_ROUTE_RULES'   =>  array(
        'article/edit/:id\d'    =>  'Article/edit',
        'article/del/:id\d'     =>  'Article/del',

        'cate/edit/:id\d'       =>  'cate/edit',
        'cate/del/:id\d'        =>  'cate/del',

        'link/edit/:id\d'       =>  'link/edit',
        'link/del/:id\d'        =>  'link/del',

        'user/lst'            =>  'Admin/lst',
        'user/add'            =>  'Admin/add',
        'user/logout'            =>  'Admin/logout',
        'user/edit/:id\d'       =>  'Admin/edit',
        'user/del/:id\d'        =>  'Admin/del',
    ),
);