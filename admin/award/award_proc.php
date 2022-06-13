<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

header('Content-Type: text/html; charset=utf-8');
   
# 디렉토리가 없을경우 생성 #
$uploadBase = $_SERVER['DOCUMENT_ROOT']."/img/";
if(!is_dir($uploadBase)){
    if(@mkdir($uploadBase, 0777)){
        if(is_dir($uploadBase)){
            @chmod($uploadBase, 0777);
        }
    }
    else{
        
    }
}

$result = sql_query("SELECT * FROM award WHERE award_title = '{$_POST['award_title']}'");
$row = sql_fetch($result);

# 파일 업로드 #
$uploadname_img = $row['award_img'];
if($_FILES['award_img']['name'] != null && $_FILES['award_img']['name'] != "")
{
    for($i = 0; $i < count($_FILES['award_img']['name']); $i++){
        $fileType = $_FILES['award_img']['type'][$i];
        if($fileType !== "image/jpeg" && $fileType !== "image/png")
        {
            ?>
            {
            	"isSuc" : "fail",
            	"msg" : "jpeg, png의 이미지파일만 가능합니다."
            }
            <?php
            exit;
        }
        $name = $_FILES['award_img']['name'][$i];
        $uploadname_img = explode('.', $name);
        $uploadname_img = time().'_img_'.$i.'.'.$uploadname_img[sizeof($uploadname_img) -1];
        $uploadFile = $uploadBase.$uploadname_img;
        if(move_uploaded_file($_FILES['award_img']['tmp_name'][$i], $uploadFile)){
        
        }else{
            ?>
        	{
        		"isSuc" : "fail",
        		"msg" : "파일 업로드에 실패하였습니다."
        	}
        	<?php
        	exit;
        }
    }
}

    # 문자열 변환 작업 #
    $award_title = htmlspecialchars(addslashes($_POST['award_title']));
    $award_from = htmlspecialchars(addslashes($_POST['award_from']));
    $award_conts = htmlspecialchars(addslashes($_POST['award_conts']));
    $award_when = htmlspecialchars(addslashes($_POST['award_when']));
    //$award_img = htmlspecialchars(addslashes($_POST['award_img']));
    $submit_date = htmlspecialchars(addslashes($_POST['submit_date']));
    
    # 수정 #
    if($_POST['choose'] == "edit")
    {
        $query = "UPDATE award
        SET
        award_title = '{$award_title}',
        award_from = '{$award_from}',
        award_conts = '{$award_conts}',
        award_when = '{$award_when}',
        award_img = '{$uploadname_img}'
        WHERE 
        idx = '{$_POST['idx']}'
        ";
    }
    # 삭제 #
    else if($_POST['choose'] == "del")
    {
        $query = "DELETE from award WHERE idx = '{$_POST['idx']}'";
    }
    # 작성 #
    else
    {
        $query = "INSERT INTO award
        SET
        award_title = '{$award_title}',
        award_from = '{$award_from}',
        award_conts = '{$award_conts}',
        award_when = '{$award_when}',
        award_img = '{$uploadname_img}',
        submit_date = now()+0
        ";
    }
    sql_query($query);
    ?>
	{
		"isSuc" : "success",
		"msg" : "<?php echo $_POST['idx']?>"
	}