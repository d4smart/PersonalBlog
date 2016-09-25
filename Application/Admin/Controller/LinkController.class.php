<?php
/**
 * Desp: 友情链接的控制器
 * User: d4smart
 * Date: 2016/9/24
 * Time: 8:46
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Controller;

class LinkController extends Controller
{
    public function lst() {
        $link = D('link');
        $count = $link->count();
        $page = new \Think\Page($count, 10);
        $show = $page->show();
        $links = $link->order('sort')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('links', $links);
        $this->assign('page', $show);

        $this->display();
    }

    public function add() {
        $link = D('link');

        if (IS_POST) {
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

        $this->display();
    }

    public function edit() {
        $link = D('link');

        if (IS_POST) {
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
        $cat = $link->find(I('id'));
        $this->assign('link', $cat);

        $this->display();
    }

    public function del() {
        $link = D('link');

        if ($link->delete(I('id'))) {
            $this->success('删除链接成功！', U('lst'));
        } else {
            $this->error('删除链接失败！');
        }
    }

    public function sort() {
        $link = D('link');

        foreach ($_POST as $id => $sort) {
            $link->where(array('id' => $id))->setField('sort', $sort);
        }
        $this->success('排序修改成功！', U('lst'));
    }
}
// 1loO0I00000oooOOOOOOllllIIIIiiilLi