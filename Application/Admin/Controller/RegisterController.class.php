<?php
/**
 * Desp: 用户注册控制器
 * User: d4smart
 * Date: 2016/10/4
 * Time: 12:57
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Controller;

class RegisterController extends Controller
{
    /**
     * 用户注册方法
     * 如果有post数据，判断用户输入合法性，添加用户并跳转；否则显示注册页面
     */
    public function index() {
        $admin = D('admin');

        if (IS_POST) {
            // 注册模式数据验证
            if ($admin->create($_POST)) {
                // 对密码md5加密
                $admin->password = md5(I('password'));

                if ($admin->add()) {
                    $this->success('注册成功，跳转中...', U('Login/index'));
                } else {
                    $this->error('注册失败！');
                }
            } else {
                $this->error($admin->getError());
            }
            return;
        }

        // 显示注册页面
        $this->display('register');

    }

    /**
     * 验证码生成函数
     */
    public function verify() {
        $verify = new \Think\Verify();
        $verify->fontSize = 30;
        $verify->length = 4;
        $verify->useNoise = true;
        $verify->entry();
    }

}
