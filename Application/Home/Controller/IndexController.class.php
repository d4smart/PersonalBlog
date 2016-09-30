<?php
/**
 * Desp: 首页控制器，按排序显示文章
 * User: d4smart
 * Date: 2016/9/29
 * Time: 12:28
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;
use Think\Controller;

class IndexController extends CommonController
{
    public function index() {
        $articles = D('article');
        $count = $articles->count();
        $page = new \Think\Page($count, 10);
        $show = $page->show();
        $list = $articles->order('time desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();
    }
}