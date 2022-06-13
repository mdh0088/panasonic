<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
header('Content-Type: text/html; charset=utf-8');
$uploadBase = $_SERVER['DOCUMENT_ROOT']."/cert/file/";

if (!is_dir($uploadBase)){
    if(@mkdir($uploadBase, 0777)) {
        if(is_dir($uploadBase)) {
            @chmod($uploadBase, 0777);
        }
    }
    else {
        
    }
}


if($_FILES['cert_file']['name'] != null && $_FILES['cert_file']['name'] != "")
{
        $cert_file_name = $_FILES['cert_file']['name'][0];
        $uploadFile = $uploadBase.$cert_file_name;
        if(move_uploaded_file($_FILES['cert_file']['tmp_name'][0], $uploadFile)){
            
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





$title = htmlspecialchars(addslashes($_POST['cert_title']));
$kor_title = htmlspecialchars(addslashes($_POST['cert_kor_title']));
$cert_chk = htmlspecialchars(addslashes($_POST['cert_chk']));
$contents = htmlspecialchars(addslashes($_POST['contents']));
$cert_type = htmlspecialchars(addslashes($_POST['cert_type']));

$my_ip = $_SERVER["REMOTE_ADDR"];
$choose='';
if (isset($_POST['choose']) && $_POST['choose']=='edit') {
    $choose="edit";
}else if (isset($_POST['choose']) && $_POST['choose']=='del') {
    $choose="del";
}


if ($_POST['choose']=="edit") {
    $query = "update h_cert
    set
    title='{$title}',
    contents='{$contents}',
    filename1='{$cert_chk}',
    col1 = '{$kor_title}',
    col3 ='{$cert_type}'
    where idx='{$_POST['idx']}'
    ";
    
}else if($_POST['choose']=="del"){
    $query = "delete from h_cert where idx='{$_POST['idx']}'";
}
else{
    $query = "insert into h_cert
    set
    title='{$title}',
    contents='{$contents}',
    filename1='{$cert_file_name}',
    col1 = '{$kor_title}',
    reg_ip='{$my_ip}',
    col3 ='{$cert_type}',
    reg_date = now()+0
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

