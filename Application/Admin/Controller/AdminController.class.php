<?php
/**
 * Desp: 管理员的控制器
 * User: d4smart
 * Date: 2016/9/22
 * Time: 9:58
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */
namespace Admin\Controller;

use Think\Controller;

class AdminController extends CommonController
{
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

	public function add() {
		$admin = D('admin');

		if (IS_POST) {
			$data['username'] = I('username');
            $data['password'] = md5(I('password'));

			if ($admin->create($data)) {
				if ($admin->add()) {
					$this->success('添加管理员成功！', U('lst'));
				} else {
					$this->error('添加管理员失败！');
				}
			} else {
				$this->error($admin->getError());
			}
			return;
		}

		$this->display();
	}

	public function edit() {
		$admin = D('admin');

		if (IS_POST) {
            $data['id'] = I('id');
            $data['username'] = I('username');
            //$password = $admin->find($data['id'])['password'];

            if (I('password')) {
                $data['password'] = md5(I('password'));
            }

			if ($admin->create($data)) {
				if ($admin->save()) {
					$this->success('修改管理员成功！', U('lst'));
				} else {
					$this->error('修改管理员失败或未作修改！');
				}
			} else {
				$this->error($admin->getError());
			}
			return;
		}
		$cat = $admin->find(I('id'));
		$this->assign('admin', $cat);

		$this->display();
	}

	public function del() {
		$admin = D('admin');

        $id = I('id');
        if ($id == 1) {
            $this->error('超级管理员不能删除！');
        } else {
            if ($admin->delete($id)) {
                $this->success('删除管理员成功！', U('lst'));
            } else {
                $this->error('删除管理员失败！');
            }
        }

	}

	public function logout() {
	    session(null);
        $this->success('退出成功，跳转中...', U('Login/index'));
    }

}