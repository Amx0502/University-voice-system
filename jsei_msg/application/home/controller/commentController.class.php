<?php

// 继承平台控制器
class commentController extends platformController{
    // 显示评论列表
    public function listAction() {
        // 实例化评论模型
        $comment = new commentModel();
        // 获取评论数量
        $num = $comment->getNumber();
        // 实例化分页类
        $page = new page($num,$GLOBALS['config'][PLATFORM]['pagesize']);
        // 获取评论数据
        $data = $comment->getAll($page->getLimit());
        // 获取分页列表
        $pageList = $page->getPageList();
        // 加载评论列表模板
        require './application/home/view/comment_list.html';
    }
    
    // 添加评论
    public function addAction() {
        // 判断POST是否为空
        if(empty($_POST)){
            return false;
        }
        // 实例化评论模型
        $comment = new commentModel();
        // 插入评论数据
        $pass = $comment->insert();
        // 判断插入是否成功
        if ($pass) {
            // 跳转到首页
            $this->jump('index.php','发表留言成功!');
            // echo '发表留言成功';
        } else {
            // 跳转到首页
            $this->jump('index.php','发表留言失败!');
            // echo '发表留言失败';
        }
    }
    
    public function add1Action() {
        // 判断POST是否为空
        if(empty($_POST)){
            return false;
        }
        // 实例化评论模型
        $comment = new commentModel();
        // 插入评论数据
        $pass = $comment->insert1();
        // 判断插入是否成功
        if ($pass) {
            // 跳转到首页
            $this->jump('index.php','发表回复成功!');
            // echo '发表留言成功';
        } else {
            // 跳转到首页
            $this->jump('index.php','发表回复失败!');
            // echo '发表留言失败';
        }
    }
}