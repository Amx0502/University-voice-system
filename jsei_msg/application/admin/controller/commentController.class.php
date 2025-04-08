<?php

class commentController extends platformController{
    
    /**
     * 列出评论列表
     */
    public function listAction() {
        $commentModel = new commentModel();
        $num = $commentModel->getNumber();
        $page = new page($num,$GLOBALS['config'][PLATFORM]['pagesize']);
        $data = $commentModel->getAll($page->getLimit());
        $pageList = $page->getPageList();
        require './application/admin/view/comment_list.html';
    }
    
    /**
     * 回复评论
     */
    public function replyAction(){
        if (!isset($_GET['id'])){
            return false;
        }
        $commentModel = new commentModel();
        $data = $commentModel->getById();
        if ($data==false) {
            die('找不到这条记录');
        }
        require './application/admin/view/comment_reply.html';
    }
    
    /**
     * 更新评论
     */
    public function updateAction() {
        if (empty($_POST)) {
            return false;
        }
        $commentModel = new commentModel();
        if ($commentModel->save()) {
            $this->jump('index.php?p=admin&c=comment&a=list','留言更新成功');
        } else {
            die('留言更新失败');
        }
    }
    
    /**
     * 删除评论
     */
    public function deleteAction() {
        if (!isset($_GET['id'])){
            return false;
        }
        $commentModel = new commentModel();
        if ($commentModel->deleteById()) {
            $this->jump('index.php?p=admin&c=comment&a=list','留言删除成功');
        } else {
            die('留言删除失败');
        }
    }
}