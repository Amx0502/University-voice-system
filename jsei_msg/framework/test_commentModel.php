<?php
require 'MySQLPDO.class.php';
require 'model.class.php';
require 'commentModel.class.php';

$comment = new commentModel();
echo '<pre>';
print_r($comment->getAll()); // 获取所有评论信息并打印出来
print_r($comment->getByID(2));
echo '</pre>';