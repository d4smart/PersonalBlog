<?php
/**
 * Desp: 管理员的验证规则
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
    protected $_validate = array(
        array('username', 'require', '管理员名称不得为空！', 1, 'regex', 3),
        array('password', 'require', '密码不得为空！', 1, 'regex', 1),
        array('username', '', '管理员名称已存在！', 1, 'unique', 2),
        array('username', 'require', '管理员名称不得为空！', 1, 'regex', 4),
        array('password', 'require', '密码不得为空！', 1, 'regex', 4),
    );

    public function login() {
        $password = $this->password;
        $info = $this->where(array('username'=>$this->username))->find();

        if ($info) {
            if ($info['password'] == md5($password)) {
                session('id', $info['id']);
                session('username', $info['password']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}