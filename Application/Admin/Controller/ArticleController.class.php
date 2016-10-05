<?php
/**
 * Desp: 文章控制器
 * User: d4smart
 * Date: 2016/9/24
 * Time: 8:46
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;

class ArticleController extends CommonController
{
    /**
     * 文章列表页面
     * 若有post数据，则显示相应分类的文章；否则显示全部文章
     */
    public function lst() {
        $article = D('ArticleView');

        if (IS_POST) {
            $count = $article->where(array('catename'=>I('catename')))->count(); //相应分类的文章数量
        } else {
            $count = $article->count(); //全部文章数量
        }

        $page = new \Think\Page($count, 10);
        $show = $page->show();

        if (IS_POST) {
            // 相应分类文章分页显示
            $articles = $article->where(array('catename'=>I('catename')))->order('time desc')->limit($page->firstRow.','.$page->listRows)->select();
        } else {
            // 全部文章分页显示
            $articles = $article->order('time desc')->limit($page->firstRow.','.$page->listRows)->select();
        }

        $this->assign('articles', $articles);
        $this->assign('page', $show);

        // 获取所有分类数据，并传递给模板
        $cates = D('cate')->order('sort')->select();
        $this->assign('cates', $cates);

        $this->display();
    }

    /**
     * 文章添加页面
     * 如果有post的数据，则添加文章并作出响应跳转；否则显示文章添加页面
     */
    public function add() {
        $article = D('article');

        if (IS_POST) {
            // 获取文章数据
            $data['title'] = I('title');
            $data['desp'] = I('desp');
            $data['cateid'] = I('cateid');
            $data['content'] = I('content');
            $data['time'] = time();

            // 保存缩略图
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

        // 显示文章添加页面
        $cates = D('cate')->order('sort')->select();
        $this->assign('cates', $cates);
        $this->display();
    }

    /**
     * 文章编辑页面
     * 如果有post数据，则更新文章并作出响应跳转；否则显示文章编辑页面
     */
    public function edit() {
        $article = D('article');

        if (IS_POST) {
            // 获取文章页面
            $data['id'] = I('id');
            $data['title'] = I('title');
            $data['desp'] = I('desp');
            $data['cateid'] = I('cateid');
            $data['content'] = I('content');

            // 保存缩略图
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

        // 显示文章编辑页面
        $cat = $article->find(I('id'));
        $this->assign('article', $cat);
        $cates = D('cate')->select();
        $this->assign('cates', $cates);

        $this->display();
    }

    /**
     * 文章删除
     * 根据传递的id删除文章，并跳转
     */
    public function del() {
        $article = D('article');

        if ($article->delete(I('id'))) {
            $this->success('删除文章成功！', U('lst'));
        } else {
            $this->error('删除文章失败！');
        }
    }
}
