<?php 
require($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");


$now_idx = $_GET['idx'];

$query = "SELECT * FROM product_cate WHERE idx = {$now_idx}";

$result = sql_query($query);

$row = sql_fetch($result);

echo json_encode($row);
?>