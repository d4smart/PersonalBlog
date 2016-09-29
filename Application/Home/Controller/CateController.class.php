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
        $articles = D('article');
        $count = $articles->where(array('cateid'=>I('id')))->count();
        $page = new \Think\Page($count, 10);
        $show = $page->show();
        $list = $articles->where(array('cateid'=>I('id')))->order('time desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->current();
        $this->display();
    }

    public function current() {
        $current = I('id');
        $this->assign('current', $current);
    }
}