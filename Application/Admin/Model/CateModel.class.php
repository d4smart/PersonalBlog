<?php
/**
 * Desp: 分类的验证规则
 * User: d4smart
 * Date: 2016/9/22
 * Time: 20:41
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Model;
use Think\Model;

class CateModel extends Model
{
    protected $_validate = array(
        array('catename', 'require', '栏目名称不得为空！', 1, 'regex', 3),
        array('catename', '', '栏目名称已存在！', 1, 'unique', 3),
    );
}