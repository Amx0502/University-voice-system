<?php

class commentModel extends model{
    /**
     * 获取所有评论
     * @param int $limit 获取评论的数量
     */
    public function getAll($limit){
        $order = '';
        if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
            $order = 'order by id desc';
        }
        $sql = "select id,poster,comment,date,reply,likes,step_on,is_private,reply2 from comment $order limit $limit";
        $data = $this->db->fetchAll($sql);
        return $data;
    }
    
    /**
     * 获取评论总数
     */
    public function getNumber() {
        $data = $this->db->fetchRow("select count(*) from comment");
        return $data['count(*)'];
    }
    
    /**
     * 根据ID获取评论
     * @param int $id 评论ID
     */
    public function getByID($id){
        $data = $this->db->fetchRow("select * from comment where id={$id}");
        return $data;
    }
    
    /**
     * 插入评论
     */
    public function insert(){
        $this->filter(array('poster','mail','comment','is_private'),'htmlspecialchars');
        $this->filter(array('comment'),'nl2br');
        $data['poster']=$_POST['poster'];
        $data['mail']=$_POST['mail'];
        $data['comment']=$_POST['comment'];
        if ($_POST['is_private']) {  // 检查是否设置了私密选项
            $data['is_private'] = 1;
        } elseif($_POST['is_private']='') {  
            $data['is_private'] = '';
        }  
        
        $data['reply']='';
        $data['reply2']='';
        $data['date']=date('Y-m-d H:i:s');
        $data['ip']=$_SERVER['REMOTE_ADDR'];
        $data['likes']=0;
        $data['step_on']=0;
        $data['report']=0;
        
        $badWords = array('草', '操', '色','sb','你妈'); //敏感词列表
        $comment = $data['comment'];  // 获取评论内容
        foreach ($badWords as $word) {  // 检查评论内容是否包含敏感词
            if (stripos($comment, $word) !== false) {  // 检查是否包含敏感词，忽略大小写
                $data['comment'] = str_ireplace($word, '***', $comment);  // 将敏感词替换为***
                break;
            }
        }
        
        // 插入数据到数据库
        // 定义SQL语句
        $sql="insert into comment set ";
        // 遍历$data数组
        foreach($data as $k=>$v){
            // 将数组中的键值对拼接成SQL语句
            $sql.="$k=:$k,";
        }
        // 去掉最后一个逗号
        $sql=rtrim($sql,',');
        // 执行SQL语句
        $this->db->execute($sql,$data,$flag);
        // 返回$flag
        return $flag;
    }
    
    public function insert1() {  
        // 过滤id和reply2，防止SQL注入  
        $this->filter(array('id'), 'intval');  
        $this->filter(array('reply2'), 'htmlspecialchars'); // 使用htmlspecialchars防止XSS  
      
        // 获取POST数据  
        $id = $_POST['id'];  
        $reply2 = $_POST['reply2'];  
        
        // 构造SQL语句  
        $sql = "UPDATE comment SET reply2 = :reply2 WHERE id = :id";  
        $params = array(  
            ':reply2' => $reply2,  
            ':id' => $id  
        );  
      
        // 执行SQL语句  
        $flag = $this->db->execute($sql, $params);  
        return $flag;  
    }  
}