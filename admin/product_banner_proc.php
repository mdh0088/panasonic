<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
header('Content-Type: text/html; charset=utf-8');
$uploadBase = $_SERVER['DOCUMENT_ROOT']."/img/product_banner/";

if (!is_dir($uploadBase)){
    if(@mkdir($uploadBase, 0777)) {
        if(is_dir($uploadBase)) {
            @chmod($uploadBase, 0777);
        }
    }
    else {
        
    }
}


if($_FILES['banner_pc']['name'] != null && $_FILES['banner_pc']['name'] != "")
{
        $fileType = $_FILES['banner_pc']['type'][0];
        if($fileType !== "image/jpeg" && $fileType !== "image/png")
        {
            ?>
            {
            	"isSuc":"fail",
            	"msg":"이미지 파일만 가능합니다."
            }
            <?php
            exit;
        }
        $name_pc = $_FILES['banner_pc']['name'][0];
        $uploadFile = $uploadBase.$name_pc;
        if(move_uploaded_file($_FILES['banner_pc']['tmp_name'][0], $uploadFile)){
            
        }else{
            ?>
            {
            	"isSuc":"fail",
            	"msg":"파일 업로드에 실패하였습니다."
            }
            <?php
            exit;
       }
    
}

if($_FILES['banner_mob']['name'] != null && $_FILES['banner_mob']['name'] != "")
{
    $fileType = $_FILES['banner_mob']['type'][0];
    if($fileType !== "image/jpeg" && $fileType !== "image/png")
    {
        ?>
            {
            	"isSuc":"fail",
            	"msg":"이미지 파일만 가능합니다."
            }
            <?php
            exit;
        }
        $name_mob = $_FILES['banner_mob']['name'][0];
        $uploadFile = $uploadBase.$name_mob;
        if(move_uploaded_file($_FILES['banner_mob']['tmp_name'][0], $uploadFile)){
            
        }else{
            ?>
            {
            	"isSuc":"fail",
            	"msg":"파일 업로드에 실패하였습니다."
            }
            <?php
            exit;
       }
    
}



$cate3 = htmlspecialchars(addslashes($_POST['cate3']));
$cate4 = htmlspecialchars(addslashes($_POST['cate4']));
$contents = htmlspecialchars(addslashes($_POST['contents']));

$pc_banner_chk = htmlspecialchars(addslashes($_POST['pc_banner_check']));
$mob_banner_chk = htmlspecialchars(addslashes($_POST['mob_banner_check']));

$choose='';
if (isset($_POST['choose']) && $_POST['choose']=='edit') {
    $choose="edit";
}else if (isset($_POST['choose']) && $_POST['choose']=='del') {
    $choose="del";
}


if ($_POST['choose']=="edit") {
    $query = "update product_banner
    set
    cate3='{$cate3}',
    cate4='{$cate4}',
    contents='{$contents}',
    banner='{$pc_banner_chk}',
    banner_mo='{$mob_banner_chk}'
    where idx='{$_POST['idx']}'
    ";
    
}else if($_POST['choose']=="del"){
    $query = "delete from product_banner where idx='{$_POST['idx']}'";
}
else{
    $query = "insert into product_banner
    set
    cate3='{$cate3}',
    cate4='{$cate4}',
    contents='{$contents}',
    banner='{$name_pc}',
    banner_mo='{$name_mob}',
    submit_date = now()+0
    ";
}
?>
    {
    	"isSuc":"success",
    	"msg":"저장 되었습니다."
    }
<?php 
sql_query($query);
?>

