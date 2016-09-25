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
        $article = D('ArticleView');
        $count = $article->count();
        $page = new \Think\Page($count, 10);
        $show = $page->show();
        $articles = $article->order('id')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('articles', $articles);
        $this->assign('page', $show);

        $this->display();
    }

    public function add() {
        $article = D('article');

        if (IS_POST) {
            $data['title'] = I('title');
            $data['desp'] = I('desp');
            $data['cateid'] = I('cateid');
            $data['content'] = I('content');

            if ($_FILES['pic']['tmp_name'] != '') {
                $upload = new \Think\Upload();
                $upload->maxSize = 2048000;
                $upload->exts = array('jpg', 'gif', 'png', 'png', 'jpeg');
                $upload->savePath = '/Public/Uploads/';
                $upload->rootPath = './';

                $info = $upload->uploadOne($_FILES['pic']);
                if (!$info) {
                    $this->error($upload->getError());
                } else {
                    $data['pic'] = $info['savepath'].$info['savename'];
                }
            }

            if ($article->create($data)) {
                if ($article->add()) {
                    $this->success('添加文章成功！', U('lst'));
                } else {
                    $this->error('添加文章失败！');
                }
            } else {
                $this->error($article->getError());
            }
            return;
        }

        $cates = D('cate')->order('sort')->select();
        $this->assign('cates', $cates);
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
                    $this->success('修改文章成功！', U('lst'));
                } else {
                    $this->error('修改文章失败或未作修改！');
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
            $this->success('删除文章成功！', U('lst'));
        } else {
            $this->error('删除文章失败！');
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
