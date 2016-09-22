<?php
/**
 * Desp:
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
        $this->display();
    }

    public function add() {
        $cate = D('cate');

        if (IS_POST) {
            $data['catename'] = I('catename');

            if ($cate->add($data)) {
                $this->success('添加栏目成功！', U('lst'));
            } else {
                $this->error('添加栏目失败！');
            }
            return;
        }

        $this->display();
    }

    public function edit() {
        $this->display();
    }

    public function del() {

    }
}