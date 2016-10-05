<?php
/**
 * Desp: 后台公共控制器，在使用后台功能前要求先登陆，被需要登陆验证的后台控制器继承
 * User: d4smart
 * Date: 2016/9/28
 * Time: 11:05
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller
{
    /**
     * CommonController constructor.
     * 如果session中没有用户记录，就提示错误信息，跳转到登陆页面
     */
    public function __construct() {
        parent::__construct();
        if (!session('id') || !session('username')) {
            $this->error('请先登录！', U('Login/index'));
        }
    }
}