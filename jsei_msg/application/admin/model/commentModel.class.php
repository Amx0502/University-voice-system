<?php

// 继承model类
class commentModel extends model{
    // 根据limit参数获取评论数据
    public function getAll($limit){
        // 定义查询语句
        $sql = "select id,poster,comment,date,reply,mail,ip,is_private,report from comment order by id desc limit $limit";
        // 执行查询语句，获取数据
        $data = $this->db->fetchAll($sql);
        // 返回数据
        return $data;
    }
    
    // 获取评论总数
    public function getNumber() {
        // 执行查询语句，获取评论总数
        $data = $this->db->fetchRow("select count(*) from comment");
        // 返回评论总数
        return $data['count(*)'];
    }
    
    // 根据id参数获取评论数据
    public function getById(){
        // 获取id参数
        $id = (int)$_GET['id'];
        // 定义查询语句
        $sql = "select poster,comment,reply,mail from comment where id=$id";
        // 执行查询语句，获取数据
        $data = $this->db->fetchRow($sql);
        // 如果数据不为false，则执行替换操作
        if ($data!=false) {
            $data['comment'] = str_replace('<br/>','',$data['comment']);
            $data['reply'] = str_replace('<br/>','',$data['reply']);
        }
        // 返回数据
        return $data;
    }

    public function save() {
        // 对id进行intval过滤
        $this->filter(array('id'),'intval');
        // 对poster、mail、comment、reply进行htmlspecialchars过滤
        $this->filter(array('poster','mail','comment','reply'),'htmlspecialchars');
        // 对comment、reply进行nl2br过滤
        $this->filter(array('comment','reply'),'nl2br');
        
        // 获取id
        $id=$_POST['id'];
        // 获取data
        $data['poster']=$_POST['poster'];
        $data['mail']=$_POST['mail'];
        $data['comment']=$_POST['comment'];
        $data['reply']=$_POST['reply'];
        
        // 构造sql语句
        $sql="update comment set ";
        // 遍历data
        foreach($data as $k=>$v){
            // 添加到sql语句中
            $sql.="$k=:$k,";
        }
        // 去掉最后一个逗号
        $sql=rtrim($sql,',');
        // 添加where id=xxx条件
        $sql.=" where id=$id";
        // 执行sql语句
        $this->db->execute($sql,$data,$flag);
        // 返回flag
        return $flag;
    }
    
    public function deleteById() {
        // 获取id
        $id = (int)$_GET['id'];
        // 构造sql语句
        $sql = "delete from comment where id=:id";
        // 执行sql语句
        $this->db->execute($sql,array(':id'=>$id),$flag);
        // 返回flag
        return $flag;
    }
}