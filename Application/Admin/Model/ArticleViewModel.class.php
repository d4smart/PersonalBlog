<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/9/24
 * Time: 8:47
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Model;
use Think\Model\ViewModel;

class ArticleViewModel extends ViewModel
{
    public $viewFields = array(
        'Article'=>array('id', 'title', 'desp', 'pic', 'content', '_type'=>'LEFT'),
        'Cate'=>array('catename', '_on'=>'Article.cateid=Cate.id'),
    );
}