<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$type = htmlspecialchars(addslashes($_POST['type_cate']));
$kor_title = htmlspecialchars(addslashes($_POST['kor_title']));
$eng_title = htmlspecialchars(addslashes($_POST['eng_title']));
$result_cate1 = htmlspecialchars(addslashes($_POST['result_cate1']));
$result_cate2 = htmlspecialchars(addslashes($_POST['result_cate2']));
$upper_cate="";
/*
echo "*********************";
echo "$kor_title  :".$kor_title;
echo "$eng_title  :".$eng_title;
echo "$result_cate1  :".$result_cate1;
echo "$result_cate2  :".$result_cate2;
*/


if ($result_cate1=="") {
    $upper_cate = $result_cate2;
}else if($result_cate2==""){
    $upper_cate = $result_cate1;
}

if ($_POST['choose']=="edit") {
    $query = "update product_cate
    set
    cate_type='{$type}',
    kor_title='{$kor_title}',
    eng_title='{$eng_title}',
    upper_cate='{$upper_cate}'
    where idx='{$_POST['idx']}'
    ";
    
}else if($_POST['choose']=="del"){
    $query = "delete from product_cate where idx='{$_POST['idx']}'";
}
else{
    $query = "insert into product_cate
    set
    cate_type='{$type}',
    kor_title='{$kor_title}',
    eng_title='{$eng_title}',
    upper_cate='{$upper_cate}',
    submit_date = now()+0
    ";
}

?>
    {
    	"isSuc":"success",
    	"msg":"저장되었습니다."
    }
<?php 
sql_query($query);
?>

