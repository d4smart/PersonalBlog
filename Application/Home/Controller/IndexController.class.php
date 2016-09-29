<?php
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