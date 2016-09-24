<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/9/24
 * Time: 8:46
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Controller;

class ArticleController extends Controller
{
    public function lst() {
        $article = D('article');
        $count = $article->count();
        $page = new \Think\Page($count, 10);
        $show = $page->show();
        $articles = $article->order('sort')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('articles', $articles);
        $this->assign('page', $show);

        $this->display();
    }

    public function add() {
        $article = D('article');

        if (IS_POST) {
            $data['title'] = I('title');
            $data['url'] = I('url');
            $data['desp'] = I('desp');

            if ($article->create($data)) {
                if ($article->add()) {
                    $this->success('添加链接成功！', U('lst'));
                } else {
                    $this->error('添加链接失败！');
                }
            } else {
                $this->error($article->getError());
            }
            return;
        }

        $this->display();
    }

    public function edit() {
        $article = D('article');

        if (IS_POST) {
            $data['id'] = I('id');
            $data['title'] = I('title');
            $data['url'] = I('url');
            $data['desp'] = I('desp');

            if ($article->create($data)) {
                if ($article->save()) {
                    $this->success('修改链接成功！', U('lst'));
                } else {
                    $this->error('修改链接失败或未作修改！');
                }
            } else {
                $this->error($article->getError());
            }
            return;
        }
        $cat = $article->find(I('id'));
        $this->assign('article', $cat);

        $this->display();
    }

    public function del() {
        $article = D('article');

        if ($article->delete(I('id'))) {
            $this->success('删除链接成功！', U('lst'));
        } else {
            $this->error('删除链接失败！');
        }
    }

    public function sort() {
        $article = D('article');

        foreach ($_POST as $id => $sort) {
            $article->where(array('id' => $id))->setField('sort', $sort);
        }
        $this->success('排序修改成功！', U('lst'));
    }
}
