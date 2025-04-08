<?php
// 定义数据库配置
return array(
    'db' => array('user' => 'root','pass' => 'toor','dbname' => 'hcit_msg'),
    // 定义默认平台
    'app' => array('default_platform' => 'home'),
    // 定义默认首页
    'home' => array('default_controller' => 'comment','default_action' => 'list','pagesize' => 2),
    // 定义默认用户页面
    'user' => array('default_controller' => 'user','default_action' => 'login'),
    // 定义默认管理页面
    'admin' => array('default_controller' => 'comment','default_action' => 'list','pagesize' => 5),
);