<?php 
require($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$cate3=$_GET['cate3'];
$cate4=$_GET['cate4'];
$kmew_chk = $_GET['kmew_chk'];


if (strpos($cate3,'@')) {
    $cate3 = str_replace('@','&',$cate3);
}

if (strpos($cate4,'@')) {
    $cate4 = str_replace('@','&',$cate4);
}



if ($kmew_chk=='KMEW') {
    $query = "SELECT * FROM kmew WHERE product_cate3='{$cate3}' and product_cate4 = '{$cate4}'";
}else{
    $query = "SELECT * FROM product WHERE product_cate3='{$cate3}' and (product_cate4 = '{$cate4}' or product_cate4_en = '{$cate4}')";    
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