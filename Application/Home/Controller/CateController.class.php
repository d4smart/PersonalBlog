<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/9/29
 * Time: 12:28
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;
use Think\Controller;

class CateController extends CommonController
{
    public function index() {
        $this->current();
        $this->display();
    }

    public function current() {
        $current = I('id');
        $this->assign('current', $current);
    }
}