<?php
return array(
	// 前台模块URL规则
    'URL_ROUTE_RULES' => array(
        'article/:id\d'     =>  'Article/read', // "article/23"
        'cate/:id\d'        =>  'Cate/read',    // "cate/8"
    ),
);