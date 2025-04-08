<?php
class framework{
    public function runApp() {
        // 加载配置文件
        $this->loadConfig();
        // 注册自动加载
        $this->registerAutoLoad();
        // 获取请求参数
        $this->getRequestParams();
        // 调度
        $this->dispatch();
    }
    
    // 加载配置文件
    private function loadConfig(){
        $GLOBALS['config'] = require './application/config/app.conf.php';
    }
    
    // 注册自动加载
    private function registerAutoLoad() {
        spl_autoload_register(array($this,'user_autoload'));
    }
    
    // 用户自定义自动加载
    public function user_autoload($class_name) {
        // 定义一个基础类数组
        $base_classes = array(
            // 模型类
            'model' => './framework/model.class.php',
            // MySQLPDO类
            'MySQLPDO' => './framework/MySQLPDO.class.php',
            // 分页类
            'page' => './framework/page.class.php',
        );
        // 如果类名在基础类数组中，则require对应的文件
        if (isset($base_classes[$class_name])) {
            require $base_classes[$class_name];
        } elseif (substr($class_name,-5) == 'Model') {
            // 如果类名以Model结尾，则require对应的文件
            require './application/' . PLATFORM . "/model/{$class_name}.class.php";
        } elseif (substr($class_name,-10) == 'Controller') {
            // 如果类名以Controller结尾，则require对应的文件
            require './application/' . PLATFORM . "/controller/{$class_name}.class.php";
        }
    }
    
    // 获取请求参数
    private function getRequestParams(){
        define('PLATFORM',isset($_GET['p']) ? $_GET['p'] : $GLOBALS['config']['app']['default_platform']);
        // 定义控制器
        define('CONTROLLER',isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config'][PLATFORM]['default_controller']);
        // 定义动作
        define('ACTION',isset($_GET['a']) ? $_GET['a'] : $GLOBALS['config'][PLATFORM]['default_action']);
    }
    
    // 调度
    private function dispatch(){
        // 获取控制器名
        $controller_name = CONTROLLER . 'Controller';
        // 实例化控制器
        $controller = new $controller_name;
        // 获取动作名
        $action_name = ACTION . 'Action';
        // 执行动作
        $controller->$action_name();
    }
}
?>