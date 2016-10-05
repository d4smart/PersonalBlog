<?php
/**
 * Desp: 友情链接控制器
 * User: d4smart
 * Date: 2016/9/24
 * Time: 8:46
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;

class LinkController extends CommonController
{
    /**
     * 友情链接列表页面
     * 分页显示友情链接
     */
    public function lst() {
        $link = D('link');

        $count = $link->count();
        $page = new \Think\Page($count, 10);
        $show = $page->show();
        $links = $link->order('sort')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('links', $links);
        $this->assign('page', $show);

        $this->display(); //渲染模板
    }

    /**
     * 友情链接添加页面
     * 如果有post数据，就添加友情链接并跳转；否则显示友情链接添加页面
     */
    public function add() {
        $link = D('link');

        if (IS_POST) {
            // 获取友情连接数据
            $data['title'] = I('title');
            $data['url'] = I('url');
            $data['desp'] = I('desp');

            if ($link->create($data)) {
                if ($link->add()) {
                    $this->success('添加链接成功！', U('lst'));
                } else {
                    $this->error('添加链接失败！');
                }
            } else {
                $this->error($link->getError());
            }
            return;
        }

        // 显示友链添加页面
        $this->display();
    }

    /**
     * 友情链接编辑页面
     * 如果有post数据，就添加友链并跳转；否则显示友链编辑页面
     */
    public function edit() {
        $link = D('link');

        if (IS_POST) {
            // 获取友链数据
            $data['id'] = I('id');
            $data['title'] = I('title');
            $data['url'] = I('url');
            $data['desp'] = I('desp');

            if ($link->create($data)) {
                if ($link->save()) {
                    $this->success('修改链接成功！', U('lst'));
                } else {
                    $this->error('修改链接失败或未作修改！');
                }
            } else {
                $this->error($link->getError());
            }
            return;
        }

        // 显示友链编辑页面
        $cat = $link->find(I('id'));
        $this->assign('link', $cat);

        $this->display();
    }

    /**
     * 友情链接删除
     * 根据传递的id删除友链并跳转
     */
    public function del() {
        $link = D('link');

        if ($link->delete(I('id'))) {
            $this->success('删除链接成功！', U('lst'));
        } else {
            $this->error('删除链接失败！');
        }
    }

    /**
     * 友链排序更新页面
     * 根据post的数据更新友链的排序
     */
    public function sort() {
        $link = D('link');

        foreach ($_POST as $id => $sort) {
            $link->where(array('id' => $id))->setField('sort', $sort);
        }
        $this->success('排序修改成功！', U('lst'));
    }
}
