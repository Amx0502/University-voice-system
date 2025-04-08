<?php
header('Content-Type:text/html;charset=utf-8');//设置编码格式为utf-8，防止乱码。
class MySQLPDO {
    // 数据库配置数组
    private $dbConfig = array(
        // 数据库类型
        'db' => 'mysql',
        // 数据库地址
        'host' => 'localhost',
        // 数据库端口
        'port' => '3306',
        // 数据库密码
        'pass' => '',
        // 数据库字符集
        'charset' => 'utf8',
        // 数据库名称
        'dbname' => 'msg',
    );
    //定义私有变量db
    private $db;

    //定义静态变量instance
    private static $instance;

    //构造函数
    private function __construct($params){
    //合并参数和默认配置
    $this->dbConfig = array_merge($this->dbConfig, $params);
    //连接数据库
    $this->connect();
    }
    
    public static function getInstance($params = array()){ //单例模式，确保只有一个实例。
        if (!self::$instance instanceof self) { //如果实例不存在，则创建实例。
            self::$instance = new self($params);//创建实例。
        }
        return self::$instance;//返回实例。
    }
    
    private function __clone(){
        
    }
    
    private function connect(){//连接数据库。
        try {//使用try catch语句，防止连接数据库时出现错误。
            $dsn = "{$this->dbConfig['db']}:host={$this->dbConfig['host']};" . "port={$this->dbConfig['port']};dbname={$this->dbConfig['dbname']};"."charset={$this->dbConfig['charset']};";
            $this->db = new PDO($dsn, $this->dbConfig['user'], $this->dbConfig['pass']);//创建PDO对象。
            $this->db->query("SET NAMES {$this->dbConfig['charset']}");//设置字符集。
        } catch (PDOException $e) {//捕获异常。
            die("数据库连接失败: {$e->getMessage()}" );//输出错误信息并终止程序。
        }
    }
    
    public function execute($sql,$data,&$flag=true){
        $stmt = $this->db->prepare($sql);//准备SQL语句。
        $flag = $stmt->execute($data);
        return $stmt;
    }
    
    public function query($sql){
        $rst = $this->db->query($sql);//执行SQL语句。
        if ($rst === false) {//如果执行失败，则返回false。
            $error = $this->db->errorInfo();//获取错误信息。
            die("执行SQL语句失败: ERROR{$error[1]}($error[0]:{$error[2]}))");//输出错误信息并终止程序。
        } 
        return $rst;//返回结果集。
    }
    
    public function fetchRow($sql,$data = array()){//获取一行数据。
        return $this->execute($sql,$data)->fetch(PDO::FETCH_ASSOC);//返回一行数据。
    }
    
    public function fetchAll($sql,$data = array()){//获取所有数据。
        return $this->execute($sql,$data)->fetchAll(PDO::FETCH_ASSOC);//返回所有数据。
    }
}