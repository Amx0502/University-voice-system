<?php

class adminModel extends model{
    
    public function checkByLogin(){
        // 过滤用户名和密码字段，使用trim方法去除两端的空格
        $this->filter(array('username','password'),'trim');
        // 获取用户输入的用户名和密码
        $username = $_POST['username'];
        $password = $_POST['password'];
        // 查询数据库，根据用户名获取密码和盐值
        $sql = 'select password,salt from admin where username=:username';
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
        // 判断用户名和密码是否都存在
        if ($username && $password) {
        
        // $params = [$username, $password];
        // $data = $this->db->execute($sql);
        // return $data;
        // 将用户名和密码存入数据库
        $data['username']=$_POST['username'];
        $data['password']=$_POST['password'];
        $data['salt']=$_POST['salt'];
        $sql = "insert into admin (username, password,salt) VALUES ('$username', md5('$password'),'Hcit')";
        // 执行sql语句
        $this->db->execute($sql,$data,$flag);
        // 返回flag
        return $flag;
        }
    }
}