<?php
class platformController{
    public function __construct($skipLoginCheck = false) {
        if (!$skipLoginCheck) {  
            $this->checkLogin(); // 检查用户是否已登录，未登录则跳转到登录页面  
        }  
    }  
          
    public function checkLogin() {  
        session_start();  
        if (!defined('CONTROLLER') || !defined('ACTION') || (CONTROLLER != 'user' && ACTION != 'login')) {  
            if (!isset($_SESSION['user'])) {  
                $this->jump('index.php?p=user&c=user&a=login'); // 跳转到登录页面  
            }  
        }  
    }  
    
    protected function jump($url,$msg='',$time=1.5) {
        // 如果msg为空，则跳转到指定URL
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
?>