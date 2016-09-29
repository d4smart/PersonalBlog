<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/9/29
 * Time: 13:23
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->nav();
        $this->link();
        $this->news();
    }

    public function nav() {
        $cate = D('cate');
        $cates = $cate->order('sort')->select();
        $this->assign('cates', $cates);
    }

    public function link() {
        $link = D('link');
        $links = $link->order('sort')->select();
        $this->assign('links', $links);
    }

    public function news() {
        $articles = D('article')->order('time desc')->limit(6)->select();
        $this->assign('articles', $articles);
    }
}