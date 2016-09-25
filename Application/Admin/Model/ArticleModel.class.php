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
        array('title', 'require', '文章名称不得为空！', 1, 'regex', 3),
        array('cateid', 'require', '所属栏目不得为空！', 1, 'regex', 3),
        array('content', 'require', '文章内容不得为空！', 1, 'regex', 3),
        array('title', '', '文章标题不得重复！', 1, 'unique', 3),
    );
}