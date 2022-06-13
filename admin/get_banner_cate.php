<?php 
require($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");


$now_cate = $_GET['cate_no'];

$cate3_title = $_GET['cate3_title'];

if (strpos($cate3_title,'@')!==false) {
    $cate3_title=str_replace("@","&",$cate3_title);
}

if ($now_cate == 3 ) {
    $query = "SELECT DISTINCT product_cate3 as result_cate FROM product";
}else if($now_cate==4){
    $query = "SELECT DISTINCT product_cate4 as result_cate2 FROM product where product_cate3 ='{$cate3_title}' ";
} 

$result = sql_query($query);

$emparray = array();
while($row = mysqli_fetch_assoc($result))
{   
    $emparray[] = $row;
}
    
echo json_encode($emparray);


?>