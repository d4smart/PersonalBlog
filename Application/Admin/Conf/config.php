<?php
return array(
	// 更改模块public目录
    'TMPL_PARSE_STRING' =>  array(
        '__PUBLIC__' => SITE_URL.'/Application/Admin/Public',   // 更改默认的Public替换规则，在Admin模块下Public目录为模块下的Public目录
    ),

    // 后台模块URL规则
    'URL_ROUTE_RULES'   =>  array(
        'article/edit/:id\d'    =>  'Article/edit', // "article/edit/8"
        'article/del/:id\d'     =>  'Article/del',  // "article/del/8"

        'cate/edit/:id\d'       =>  'cate/edit',    // "cate/edit/6"
        'cate/del/:id\d'        =>  'cate/del',     // "cate/del/6"

        'link/edit/:id\d'       =>  'link/edit',    // "link/edit/6"
        'link/del/:id\d'        =>  'link/del',     // "link/del/6"

        'user/lst'          =>  'Admin/lst',
        'user/add'          =>  'Admin/add',
        'user/logout'       =>  'Admin/logout',
        'user/edit/:id\d'   =>  'Admin/edit',   // "user/edit/7"
        'user/del/:id\d'    =>  'Admin/del',    // "user/del/7"
    ),
);