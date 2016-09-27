<?php
/**
 * Desp: 登陆控制器
 * User: d4smart
 * Date: 2016/9/24
 * Time: 8:46
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller
{
    public function index() {
        $admin = D('admin');

        if (IS_POST) {
            if ($admin->create($_POST,4)) {
                if ($admin->login()) {
                    $this->success('登陆成功，跳转中...', U('Index/index'));
                } else {
                    $this->error('你的用户名或密码错误！');
                }
            } else {
                $this->error($admin->getError());
            }
            return;
        }

        $this->display('login');
    }
}
