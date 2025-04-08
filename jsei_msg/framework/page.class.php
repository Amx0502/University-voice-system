<?php  
class Page {  
    private $total; // 总页数  
    private $size;  // 每页记录数  
    private $url;   // URL地址  
    private $page;  // 当前页码  
  
    public function __construct($total, $size, $url = '') {  
        $this->total = ceil($total / $size); // 计算总页数  
        $this->size = $size;  
        $this->url = $this->setUrl($url);  
        $this->page = $this->getNowPage();  
    }  
  
    // 被外部调用以获取当前页码  
    public function getNowPage() {
        $page=!empty($_GET['page']) ? $_GET['page']:1;
        if ($page < 1) {
            $this->page = 1;
        } else if ($page>$this->total) {
            $page = $this->total;
        }
        return $page;    //返回当前页码数
    }  
  
   private function setUrl($url) {
       $url.="?";
       foreach ($_GET as $k=>$v) {
           if ($k!='page') {
               $url.="$k=$v&";
           }
       }
       return $url;   //返回URL地址
   }
  
    public function getPageList() {
        if ($this->total<=1) {
            return;
        }
        $html='';
        if ($this->page>4) {
            $html = "<a href=\"{$this->url}page=1\">1</a>...";
        }
        for ($i = $this->page-3,$len = $this->page + 3;$i<=$len && $i<=$this->total;$i++) {
            if ($i>0){
                if ($i == $this->page) {
                    $html.="<a href=\"{$this->url}page=$i\" class=\"curr\">$i</a>";
                } else {
                    $html.="<a href=\"{$this->url}page=$i\">$i</a>"; 
                }
            }
        }
        if ($this->page+3<$this->total) {
            $html.="...<a href=\"{$this->url}page={$this->total}\">{$this->total}</a>";
        }
        return $html;  //返回分页列表HTML代码
    }
    
    public function getLimit() {
        if ($this->total==0) {
            return '0,0';
        }
        return ($this->page-1) * $this->size . ",{$this->size}";  //返回分页SQL语句中的LIMIT部分
    }  
}