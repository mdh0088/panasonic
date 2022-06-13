<?php
require($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$idx=$_GET['idx'];

$kmew_chk = $_GET['kmew_chk'];

if ($kmew_chk=='KMEW') {
    $query = "SELECT * FROM kmew WHERE idx={$idx}";
}else{
    $query = "SELECT * FROM product WHERE idx={$idx}";
}

$result = sql_query($query);
$emparray = array();
while($row = mysqli_fetch_assoc($result))
{
    $is_file_exist = file($_SERVER['DOCUMENT_ROOT']."/img/product/{$row['product_thumb']}");
    if (!$is_file_exist) {
        $row['product_thumb']='detail_imsi.png';
    }
    
    $imagesize = getimagesize($_SERVER['DOCUMENT_ROOT']."/img/product/{$row['product_thumb']}");
    $row['img_width']=$imagesize[0];
    $row['img_height']=$imagesize[1];
    $emparray[] = $row;
}
echo json_encode($emparray);


?>