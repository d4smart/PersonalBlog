<?php
/**
 * Desp: 分类的控制器
 * User: d4smart
 * Date: 2016/9/22
 * Time: 9:58
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */
namespace Admin\Controller;

use Think\Controller;

class CateController extends Controller
{
	public function lst() {
		$cate = D('cate');
		$cates = $cate->order('sort asc')->select();
		$this->assign('cates', $cates);

		$this->display();
	}

	public function add() {
		$cate = D('cate');

		if (IS_POST) {
			$data['catename'] = I('catename');

			if ($cate->create($data)) {
				if ($cate->add()) {
					$this->success('添加栏目成功！', U('lst'));
				} else {
					$this->error('添加栏目失败！');
				}
			} else {
				$this->error($cate->getError());
			}
			return;
		}

		$this->display();
	}

	public function edit() {
		$cate = D('cate');

		if (IS_POST) {
			$data['catename'] = I('catename');
			$data['id'] = I('id');
			if ($cate->create($data)) {
				if ($cate->save()) {
					$this->success('修改栏目成功！', U('lst'));
				} else {
					$this->error('修改栏目失败或未作修改！');
				}
			} else {
				$this->error($cate->getError());
			}
			return;
		}
		$cat = $cate->find(I('id'));
		$this->assign('cate', $cat);

		$this->display();
	}

	public function del() {
		$cate = D('cate');

		if ($cate->delete(I('id'))) {
			$this->success('删除栏目成功！', U('lst'));
		} else {
			$this->error('删除栏目失败！');
		}
	}

	public function sort() {
		$cate = D('cate');

		foreach ($_POST as $id => $sort) {
			$cate->where(array('id' => $id))->setField('sort', $sort);
		}
		$this->success('排序修改成功！', U('lst'));
	}
}