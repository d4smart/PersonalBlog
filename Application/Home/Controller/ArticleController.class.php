<?php
/**
 * Desp: 前台文章控制器
 * User: d4smart
 * Date: 2016/9/29
 * Time: 12:28
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;

class ArticleController extends CommonController
{
    /**
     * 根据传入的id，获取文章内容、分类和上一篇与下一篇的数据，并传递给模板
     */
    public function read() {
        $arts = D('article')->find(I('id')); //获取文章内容
        $this->assign('arts', $arts); //赋值给模板

        $this->catename($arts['cateid']); //获取分类
        $this->other(I('id')); //获取上一篇下一篇

        $this->display('index'); //渲染对应模板
    }

    /**
     * @param $cateid 文章所属分类的id
     * 获取文章所属分类，并传递给模板
     */
    public function catename($cateid) {
        $cate = D('cate')->find($cateid);
        $this->assign('catename', $cate['catename']);
    }

    /**
     * @param $id 文章的id
     * 获取文章上一篇下一篇数据，并传递给模板
     */
    public function other($id) {
        $pre = D('article')->where('id<'.$id)->order('id desc')->find();
        $next = D('article')->where('id>'.$id)->order('id asc')->find();
        $this->assign('pre', $pre);
        $this->assign('next', $next);
    }
}