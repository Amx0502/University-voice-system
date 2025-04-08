<?php
class model{
    protected $db;
    
    public function __construct(){
        $this->initDB(); // 初始化数据库连接
    }
    
    private function initDB(){
        // $dbConfig = array('user'=>'root','pass'=>'toor','dbname'=>'hcit_msg');
        $this->db = MySQLPDO::getInstance($GLOBALS['config']['db']); // 使用MySQLPDO类连接数据库
        // $this->db = MySQLPDO::getInstance($dbConfig);
    }
    
    /**
     * 过滤函数
     * @param array $arr 需要过滤的数组
     * @param function $func 过滤函数
     */
    protected function filter($arr,$func) {
        /**
         * 遍历数组
         */
        foreach ($arr as $v) {
            /**
             * 如果$_POST中不存在$v，则设置为空
             */
            if (!isset($_POST[$v])) {
                $_POST[$v] = '';
            }
            /**
             * 使用过滤函数$_POST[$v]
             */
            $_POST[$v] = $func($_POST[$v]);
        }
    }
}