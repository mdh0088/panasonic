<?php 
require($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$product_cate='product_cate'.$_GET['cate_num'];
$product_cate_sub='product_cate'.(($_GET['cate_num']*1)+1);
$keyword=$_GET['keyword'];



$query = "SELECT DISTINCT {$product_cate_sub} FROM product WHERE {$product_cate}='{$keyword}' AND {$product_cate_sub} != '' ";

$result = sql_query($query);
$emparray = array();
while($row = mysqli_fetch_assoc($result))
{
    $emparray[] = $row;
}
echo json_encode($emparray);
 

?>