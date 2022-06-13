<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$lec_idx = $_POST['lec_idx'];
$lec_action = $_POST['lec_action'];
$lec_idx_arr = explode('@', $lec_idx);

$reco_cnt_query = "SELECT count(*) as cnt from product where product_reco = 'Y'";
$reco_cnt_result = sql_query($reco_cnt_query);
$reco_cnt = sql_fetch($reco_cnt_result);

$specialty_cnt_query = "SELECT count(*) as cnt from product where product_indi = 'Y'";
$specialty_cnt_result = sql_query($reco_cnt_query);
$specialty_cnt = sql_fetch($reco_cnt_result);

if($lec_action == "reco")
{
    
//     $query = " update apply set isReco = ''";
//     sql_query($query);
    
    
    $query = " update apply set isReco = 'Y' where ";
}
else if($lec_action == "specialty")
{
//     $query = " update apply set isSpecialty = ''";
//     sql_query($query);
    
    $query = " update apply set isSpecialty = 'Y' where ";
}
else if($lec_action == "clear")
{
    $query = " update apply set isSpecialty = '',isReco = '' where ";
}






for ($i = 0; $i < count($lec_idx_arr)-1; $i++) {
    if ($i==0) {
         $query .= "idx ='$lec_idx_arr[$i]'";  
    }else{
        $query .= "or idx ='$lec_idx_arr[$i]'";
    }
}

sql_query($query);

?>
{
	"isSuc":"success",
	"msg":"저장되었습니다."
}