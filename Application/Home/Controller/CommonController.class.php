<?php
/**
 * Desp: 前台公共控制器，获得前台的公共部分（右边栏的文章分类，最新发表，友情链接）所需要的数据并赋值给对应模板，其他前台控制器继承
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
    /**
     * CommonController constructor.
     * 继承父类的构造方法，并调用自定义方法，获得前台的公共部分所需要的数据并赋值给模板
     */
    public function __construct() {
        parent::__construct();
        $this->nav();
        $this->link();
        $this->news();
    }

    /**
     * 获取文章分类数据
     */
    public function nav() {
        $cate = D('cate');
        $cates = $cate->order('sort')->select();
        $this->assign('cates', $cates);
    }

    /**
     * 获取链接数据
     */
    public function link() {
        $link = D('link');
        $links = $link->order('sort')->limit(12)->select();
        $this->assign('links', $links);
    }

    /**
     * 获取最新发表的文章数据
     */
    public function news() {
        $articles = D('article')->order('time desc')->limit(6)->select();
        $this->assign('articles', $articles);
    }
}