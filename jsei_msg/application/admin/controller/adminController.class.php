<?php

// 继承platformController类
class adminController extends platformController {
    
    // 登录动作
    public function loginAction(){
        if(!empty($_POST)) {
            $adminModel = new adminModel(); // 实例化adminModel类
            if ($adminModel->checkByLogin()) { // 如果登录成功
                session_start(); // 开启session会话
                $_SESSION['admin']='yes'; // 设置session变量
                $this->jump('index.php?p=admin','登录成功！',1); // 跳转到后台首页
            } else {
                $this->jump('index.php','登录失败,用户名或密码错误!'); // 跳转到登录页面
                // echo 'alert("登录失败,用户名或密码错误!");'; // 输出提示框
                // die('登录失败,用户名或密码错误!'); // 退出脚本
            }
        }
        require './application/admin/view/admin_login.html'; // 加载登录页面
    }
    
    // 注册动作
    public function registerAction(){  
        // 判断POST是否有数据
        if(!empty($_POST)) {  
            // 实例化adminModel
            $adminModel = new adminModel();  
            // 调用registerUser函数，执行注册操作
            if ($adminModel->registerUser($_POST['username'], $_POST['password'])) {  
                // 注册成功，跳转到登录页面
                $this->jump('index.php?p=admin&c=admin&a=login', '注册成功，请登录！');  
            } else {  
                // 注册失败，跳转到注册页面
                $this->jump('index.php?p=admin&c=admin&a=register', '注册失败，请重试！');  
            }  
        }  
        // 加载注册页面
        require './application/admin/view/admin_register.html';  
    }
    
    // 注销动作
    public function logoutAction(){
        // 销毁session变量
        unset($_SESSION['admin']);
        // 跳转到首页
        $this->jump('index.php?p=admin','退出登录成功');
    }
}