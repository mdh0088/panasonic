<?php 
require($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");


$now_cate = $_GET['cate_no'];
$upper_cate = $now_cate-1;
$first_cate = 1;


if ($now_cate == 2 || $now_cate == 4) {
    $query = "SELECT DISTINCT product.product_cate{$upper_cate} as result_cate1 FROM product 
                
                union all
            
              SELECT DISTINCT kmew.product_cate{$upper_cate} as result_cate1 FROM kmew";
              //ORDER BY product_cate{$upper_cate} asc";

              
}else if($now_cate==3){
    
    $query = "SELECT DISTINCT product.product_cate{$first_cate} as result_cate1 ,product.product_cate{$upper_cate} as result_cate2 FROM product
                
                union all

              SELECT DISTINCT kmew.product_cate{$first_cate} as result_cate1 ,kmew.product_cate{$upper_cate} as result_cate2 FROM kmew";
    //ORDER BY product_cate{$first_cate} asc";
             
} 

$result = sql_query($query);

$emparray = array();
while($row = mysqli_fetch_assoc($result))
{   
    $emparray[] = $row;
}
echo json_encode($emparray);

?>