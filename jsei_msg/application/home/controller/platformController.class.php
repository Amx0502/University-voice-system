<?php
// 定义一个平台控制器类
class platformController{
    public function __construct(){
        $this->checkLogin();
    }
    private function checkLogin(){
        if(CONTROLLER=='user'&&ACTION=='login'){
            return ;
        }
        session_start();
        if(!isset($_SESSION['user'])){
            $this->jump('index.php?p=user&c=user&a=login');
        }
    }
    
    // 跳转函数
    protected function jump($url,$msg='',$time=2) {
        // 如果msg为空，则直接跳转到指定url
        if ($msg == '') {
            header("Location:$url");
        } else {
            // 否则，加载jump.html页面
            require './application/home/view/jump.html';
        }
        // 结束脚本执行
        die;
    }
}