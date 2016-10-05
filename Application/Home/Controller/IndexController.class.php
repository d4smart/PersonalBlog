<?php
/**
 * Desp: 首页控制器，分页显示文章列表
 * User: d4smart
 * Date: 2016/9/29
 * Time: 12:28
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;

class IndexController extends CommonController
{
    /**
     * 获取文章数据并分页显示
     */
    public function index() {
        $articles = D('article');

        $count = $articles->count();
        $page = new \Think\Page($count, 10); //一页显示10条数据
        $show = $page->show();
        $list = $articles->order('time desc')->limit($page->firstRow.','.$page->listRows)->select(); //分页显示
        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display(); //渲染模板
    }
}