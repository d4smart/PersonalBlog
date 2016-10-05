<?php
/**
 * Desp: 后台首页控制器
 * User: d4smart
 * Date: 2016/9/22
 * Time: 9:58
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;

class IndexController extends CommonController
{
    /**
     * 显示后台首页
     */
    public function index() {
        $this->display(); //渲染模板
    }
}