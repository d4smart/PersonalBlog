<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/9/24
 * Time: 8:47
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Model;
use Think\Model;

class ArticleModel extends Model
{
    protected $_validate = array(
        array('title', 'require', '链接名称不得为空！', 1, 'regex', 3),
        array('url', 'require', '链接地址不得为空！', 1, 'regex', 3),
        array('title', '', '连接名称不得重复！', 1, 'unique', 3),
    );
}