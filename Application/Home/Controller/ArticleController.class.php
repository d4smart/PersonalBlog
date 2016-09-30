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

class ArticleController extends CommonController
{
    public function index() {
        $arts = D('article')->find(I('id'));
        $this->assign('arts', $arts);
        $this->catename($arts['cateid']);
        $this->other(I('id'));
        $this->display();
    }

    public function catename($cateid) {
        $cate = D('cate')->find($cateid);
        $this->assign('catename', $cate['catename']);
    }

    public function other($id) {
        $pre = D('article')->where('id<'.$id)->order('id desc')->find();
        $next = D('article')->where('id>'.$id)->order('id asc')->find();
        $this->assign('pre', $pre);
        $this->assign('next', $next);
    }
}