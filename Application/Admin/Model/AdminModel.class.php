<?php
/**
 * Desp: 用户模型
 * User: d4smart
 * Date: 2016/9/22
 * Time: 20:41
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Model;
use Think\Model;

class AdminModel extends Model
{
    // 用户数据验证规则
    protected $_validate = array(
        array('username', 'require', '用户名称不得为空！', 1, 'regex', 3),
        array('password', 'require', '密码不得为空！', 1, 'regex', 1),
        array('username', '', '用户名称已存在！', 1, 'unique', 1),
        array('username', '', '用户名称已存在！', 1, 'unique', 2),

        array('password', 'require', '未填写密码！', 1, 'regex', 4),
        array('repassword', 'password', '密码不一致！', 1,'confirm', 1), // 验证确认密码是否和密码一致
        array('verify', 'check_verify', '验证码不正确！', 1, 'callback', 4),

    );

    /**
     * 用户登陆函数
     * 根据传递的username和password判断用户登录是否合法，并做出相应跳转
     * @return bool 登陆成功：true|登录失败：false
     */
    public function login() {
        $password = $this->password; //传递的密码
        $info = $this->where(array('username'=>$this->username))->find(); //数据库中存储的密码（md5）

        // 是否存在用户
        if ($info) {
            // 密码输入是否正确
            if ($info['password'] == md5($password)) {
                session('id', $info['id']);
                session('username', $info['username']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 验证码验证函数
     * @param $code, @param string $id
     * @return bool 验证码检查结果
     */
    public function check_verify($code, $id='') {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
}