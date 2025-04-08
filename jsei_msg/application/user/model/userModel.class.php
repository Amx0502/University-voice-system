<?php

class userModel extends model{
    
    public function checkByLogin(){
        // 过滤用户名和密码字段，使用trim方法去除两端的空格
        $this->filter(array('username','password'),'trim');
        // 获取用户输入的用户名和密码
        $username = $_POST['username'];
        $password = $_POST['password'];
        // 查询数据库，根据用户名获取密码和盐值
        $sql = 'select password,salt from user where username=:username';
        $data = $this->db->fetchRow($sql,array(':username'=>$username));
        // 如果没有查询到数据，返回false
        if (!$data) {
            return false;
        }
        // 比较用户输入的密码和数据库中存储的密码是否相等
        return md5($password)==$data['password'];
    }
    
    public function registerUser($username,$password) {
        // 获取表单提交的数据
        $username = isset($_POST['username']) ? trim($_POST['username']) : false;
        $password = isset($_POST['password']) ? trim($_POST['password']) : false;
        // 判断用户名和密码是否不为空
        if ($username && $password) {
        // 将提交的数据赋值给data数组
        $data['username']=$_POST['username'];
        $data['password']=$_POST['password'];
        $data['salt']=$_POST['salt'];
        // 拼接sql语句，插入数据
        $sql = "insert into user (username, password,salt) VALUES ('$username', md5('$password'),'Hcit')";
        // 执行sql语句
        $this->db->execute($sql,$data,$flag);
        // 返回flag
        return $flag;
        }
    }
    
    public function incrementLikes() {
        // 从GET请求中获取id参数
        $id = (int)$_GET['id'];
        // 定义SQL语句，用于更新comment表中的likes字段
        $sql = "UPDATE comment SET likes = likes + 1 WHERE id=:id";  
        // 执行SQL语句，并传入参数，返回布尔值，表示是否成功更新了行
        $this->db->execute($sql,array(':id'=>$id),$flag);
        return $flag; // 返回布尔值，表示是否成功更新了行
    }
    
    public function incrementReport() {
        // 从GET请求中获取id参数
        $id = (int)$_GET['id'];
        // 定义SQL语句，将report字段的值加1，条件是id等于指定的id值
        $sql = "UPDATE comment SET report = report + 1 WHERE id=:id";  
        // 执行SQL语句，并传入参数，返回一个布尔值，表示是否成功更新了行
        $this->db->execute($sql,array(':id'=>$id),$flag);
        // 返回布尔值，表示是否成功更新了行
        return $flag; 
    }
    
    public function incrementStepOn() {
        // 从GET请求中获取id参数
        $id = (int)$_GET['id'];
        // 构造更新语句，将step_on字段的值加1，条件是id等于指定的id值
        $sql = "UPDATE comment SET step_on = step_on + 1 WHERE id=:id";  
        // 执行更新语句，并传入参数，返回布尔值，表示是否成功更新了行
        $this->db->execute($sql,array(':id'=>$id),$flag);
        // 返回布尔值，表示是否成功更新了行
        return $flag; 
    }
}