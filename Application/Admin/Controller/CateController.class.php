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

class CateController extends CommonController
{
    /**
     * 分类列表页面
     * 获取分类，并传递给模板
     */
	public function lst() {
		$cate = D('cate');
		$cates = $cate->order('sort asc')->select();
		$this->assign('cates', $cates);

		$this->display();
	}

    /**
     * 分类添加页面
     * 如果有post数据，则添加栏目并跳转；否则显示分类添加页面
     */
	public function add() {
		$cate = D('cate');

		if (IS_POST) {
		    // 获取分类数据
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

		// 显示分类添加页面
		$this->display();
	}

    /**
     * 分类编辑页面
     * 如果有post数据，就更新分类并跳转；否则显示分类编辑页面
     */
	public function edit() {
		$cate = D('cate');

		if (IS_POST) {
		    // 获取分类属性
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

		// 显示分类编辑页面
		$cat = $cate->find(I('id'));
		$this->assign('cate', $cat);

		$this->display();
	}

    /**
     * 分类删除
     * 根据传递的id删除分类，并跳转
     */
	public function del() {
		$cate = D('cate');

		if ($cate->delete(I('id'))) {
			$this->success('删除栏目成功！', U('lst'));
		} else {
			$this->error('删除栏目失败！');
		}
	}

    /**
     * 分类排序更新
     * 根据传递的post数据更新分类的排序
     */
	public function sort() {
		$cate = D('cate');

		foreach ($_POST as $id => $sort) {
			$cate->where(array('id' => $id))->setField('sort', $sort);
		}
		$this->success('排序修改成功！', U('lst'));
	}
}