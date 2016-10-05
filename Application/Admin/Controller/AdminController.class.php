<?php
/**
 * Desp: 用户控制器
 * User: d4smart
 * Date: 2016/9/22
 * Time: 9:58
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;

class AdminController extends CommonController
{
    /**
     * 用户列表页面
     * 分页显示用户数据
     */
	public function lst() {
        $admin = D('admin');

        $count = $admin->count();
        $page = new \Think\Page($count, 10);
        $show = $page->show();
        $admins = $admin->order('id')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('admins', $admins);
        $this->assign('page', $show);
        
        $this->display();
	}

    /**
     * 用户添加页面
     * 如果有post数据，则添加新用户，根据添加结果跳转；否则显示添加用户页面
     */
	public function add() {
		$admin = D('admin');

		if (IS_POST) {
			$data['username'] = I('username');
            $data['password'] = md5(I('password')); //用户密码md5加密存储

			if ($admin->create($data)) {
				if ($admin->add()) {
					$this->success('添加用户成功！', U('lst')); //添加成功跳转到用户列表页面
				} else {
					$this->error('添加用户失败！');
				}
			} else {
				$this->error($admin->getError()); //显示错误信息（如数据验证不通过的错误提示）
			}
			return;
		}

		$this->display();
	}

    /**
     * 用户编辑页面
     * 如果有post数据，则更新用户数据；否则显示用户编辑页面
     */
	public function edit() {
		$admin = D('admin');

		if (IS_POST) {
            $data['id'] = I('id');
            $data['username'] = I('username');
            //$password = $admin->find($data['id'])['password'];

            // 如果填写了密码字段，则接受数据并加密
            if (I('password')) {
                $data['password'] = md5(I('password'));
            }

			if ($admin->create($data)) {
				if ($admin->save()) {
					$this->success('修改用户成功！', U('lst'));
				} else {
					$this->error('修改用户失败或未作修改！');
				}
			} else {
				$this->error($admin->getError()); //显示错误信息（如数据验证不通过的错误提示）
			}
			return;
		}

		// 显示用户编辑页面
		$cat = $admin->find(I('id'));
		$this->assign('admin', $cat);

		$this->display();
	}

    /**
     * 用户删除
     * 根据传递的用户id值，做出相应的判断，并跳转
     */
	public function del() {
		$admin = D('admin');
        $id = I('id');

        // id为1的用户是超级用户，不能删除
        if ($id == 1) {
            $this->error('超级用户不能删除！');
        } else {
            if ($admin->delete($id)) {
                $this->success('删除用户成功！', U('lst'));
            } else {
                $this->error('删除用户失败！');
            }
        }

	}

    /**
     * 用户登出页面
     * 清空session，并跳转
     */
	public function logout() {
	    session(null);
        $this->success('退出成功，跳转中...', '/Blog/');
    }

}