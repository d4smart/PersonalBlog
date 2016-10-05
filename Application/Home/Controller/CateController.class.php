<?php
/**
 * Desp: 前台分类控制器
 * User: d4smart
 * Date: 2016/9/29
 * Time: 12:28
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;

class CateController extends CommonController
{
    /**
     * 获取某个分类下的文章数据，并分页显示
     */
    public function read() {
        $articles = D('article');

        $count = $articles->where(array('cateid'=>I('id')))->count(); //获取分类下文章数量
        $page = new \Think\Page($count, 10); //一页显示10条数据
        $show = $page->show();
        $list = $articles->where(array('cateid'=>I('id')))->order('time desc')->limit($page->firstRow.','.$page->listRows)->select(); //分页显示数据
        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->current(); //调用current()方法
        $this->display('index'); //渲染对应模板
    }

    /**
     * 获取分类id，并传递给模板，用于标记当前分类
     */
    public function current() {
        $current = I('id');
        $this->assign('current', $current);
    }
}