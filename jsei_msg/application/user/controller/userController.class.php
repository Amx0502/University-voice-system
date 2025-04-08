<?php
/**
 * 继承平台控制器类
 */
class userController extends platformController{
    /**
     * 登录功能
     */
    public function loginAction(){
        // 判断POST是否有提交数据
        if(!empty($_POST)){
            // 实例化userModel
            $userModel = new userModel();
            // 检查用户名和密码是否正确
            if($userModel->checkByLogin()){
                // 开启会话
                session_start();//检测会话
                // 设置会话数据
                $_SESSION['user']='yes';//访问数据
                // 跳转到首页
                $this->jump('index.php?p=home&c=comment&a=list','登录成功',1);
            }else{
                // 跳转到登录页面
                $this->jump('index.php','登陆失败，用户名或密码错误!');
                // 或者直接退出
                // die('登陆失败，用户名或密码错误!');
            }
        }
        require('./application/user/view/user_login.html');
    }
    
    /**
     * 注册功能
     */
    public function registerAction(){
        // 检查是否有POST数据
        if(!empty($_POST)) {  
            // 实例化userModel类
            $userModel = new userModel();  
            // 调用registerUser方法进行注册
            if ($userModel->registerUser($_POST['username'], $_POST['password'])) {  
                // 注册成功，跳转到登录页面
                $this->jump('index.php?p=user&c=user&a=login', '注册成功，请登录！');  
            } else {  
                // 注册失败，跳转到注册页面
                $this->jump('index.php?p=user&c=user&a=register', '注册失败，请重试！');  
            } 
        }  
        // 加载注册页面
        require './application/user/view/user_register.html';  
    }
    
    /**
     * 注销功能
     */
    public function logoutAction(){
        // 销毁session中的用户信息
        unset($_SESSION['user']);
        // 跳转到首页
        $this->jump('index.php','退出登录成功');
    }
    
    /**
     * 点赞评论
     */
    public function likesAction() {
        $userModel = new userModel();  // 创建userModel对象
            // 更新点赞数  
        $success = $userModel->incrementLikes($id);  // 调用incrementLikes方法，参数为$id，返回值为$success
        if ($success) {  // 如果点赞成功
            $this->jump('index.php');  // 跳转到index.php页面
        } else {  // 否则
            $this->jump('index.php');  // 跳转到index.php页面
        } 
    }
    
    /**
     * 举报评论
     */
    public function reportAction() {
        // 实例化userModel
        $userModel = new userModel();
        // 调用userModel的incrementReport方法，传入id参数，返回一个布尔值
        $success = $userModel->incrementReport($id);
        // 如果userModel实例化成功
        if ($userModel) {
            // 跳转到index.php页面，并传入参数reportSuccess，表示举报成功
            $this->jump('index.php','举报成功!');
        } else {
            // 跳转到index.php页面，并传入参数reportFailed，表示举报失败
            $this->jump('index.php','举报失败!');
        }
    }
    
    /**
     * 踩评论
     */
    public function steponAction() {
        // 创建userModel对象
        $userModel = new userModel();
        // 调用userModel的incrementStepOn方法，参数为$id，返回值为$success
        $success = $userModel->incrementStepOn($id);
        // 如果$userModel不为空，跳转到index.php
        if ($userModel) {
            $this->jump('index.php');
        } else {
            // 否则，跳转到index.php
            $this->jump('index.php');
        }
    }
}
?>