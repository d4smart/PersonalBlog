<?php
/**
 * Desp:
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
    public function index() {
        $admin = D('admin');

        if (IS_POST) {
            $data['username'] = I('username');
            $data['password'] = md5(I('password'));

            if ($admin->create($data)) {
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

        $this->display('register');

    }

    public function verify() {
        $verify = new \Think\Verify();
        $verify->fontSize = 30;
        $verify->length = 4;
        $verify->useNoise = true;
        $verify->entry();
    }

}
