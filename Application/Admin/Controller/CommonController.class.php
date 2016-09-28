<?php
/**
 * Desp:
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
    public function __construct() {
        parent::__construct();
        if (!session('id') || !session('username')) {
            $this->error('请先登录！', U('Login/index'));
        }
    }
}