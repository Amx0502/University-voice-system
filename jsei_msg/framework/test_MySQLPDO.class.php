    <?php
    require 'MySQLPDO.class.php';
    
    // private function initDB(){
    $dbConfig = array('user'=>'root','pass'=>'toor','dbname'=>'hcit_msg');
        // $this->db = MySQLPDO::getInstance($GLOBALS['config']['db']); // 使用MySQLPDO类连接数据库
    $db = MySQLPDO::getInstance($dbConfig);
    $data = $db->fetchAll("SELECT * FROM comment");
    print_r($data);