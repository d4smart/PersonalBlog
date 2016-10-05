<?php
/**
 * Desp: 用户登陆控制器
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
    /**
     * 用户登陆方法
     * 如果有post数据，就进行用户登陆的验证并跳转；如果session里有用户的数据，则显示不要重复登陆；否则显示登陆页面
     */
    public function index() {
        $admin = D('admin');

        if (IS_POST) {
            // 登录模式验证
            if ($admin->create($_POST, 4)) {
                // 用户登录方法（定义在AdminModel里）
                if ($admin->login()) {
                    $this->success('登陆成功，跳转中...', U('Index/index'));
                } else {
                    $this->error('您的用户名或密码错误！');
                }
            } else {
                $this->error($admin->getError());
            }
            return;
        }

        // 判断session里是否存在用户
        if (session('id')) {
            $this->error('您已经登录该系统，请勿重复登陆！', U('Index/index'));
        } else {
            $this->display('login');
        }
    }

    /**
     * 验证码生成函数
     */
    public function verify() {
        $verify = new \Think\Verify();
        $verify->fontSize = 30;
        $verify->length = 4;    //4位验证码
        $verify->useNoise = true; //使用噪点
        $verify->entry();
    }

}
