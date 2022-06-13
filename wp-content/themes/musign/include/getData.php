<?php 
require($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$area = $_GET['area'];

$query = "select * from customer where customer_area = '{$area}' and idx < 372 ORDER BY customer_name";

$result = sql_query($query);
$emparray = array();
while($row = mysqli_fetch_assoc($result))
{
    $emparray[] = $row;
}
echo json_encode($emparray);
?>