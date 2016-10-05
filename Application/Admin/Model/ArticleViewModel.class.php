<?php
/**
 * Desp: 视图模型，连接文章和分类
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
    // 左连接，根据文章的cateid获取文章所属分类
    public $viewFields = array(
        'Article'=>array('id', 'title', 'desp', 'pic', 'content', '_type'=>'LEFT'),
        'Cate'=>array('catename', '_on'=>'Article.cateid=Cate.id'),
    );
}