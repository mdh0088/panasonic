<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");


header('Content-Type: text/html; charset=utf-8');

$uploadBase = $_SERVER['DOCUMENT_ROOT']."/img/product";

if (!is_dir($uploadBase)){
    if(@mkdir($uploadBase, 0777)) {
        if(is_dir($uploadBase)) {
            @chmod($uploadBase, 0777);
        }
    }
    else {
        
    }
}

$result = sql_query("select * from product where product_title = '{$_POST['product_title']}'");
$row = sql_fetch($result);

$uploadname_thumb = $row['product_thumb'];
if($_FILES['product_thumb']['name'] != null && $_FILES['product_thumb']['name'] != "")
{
    for( $i=0 ; $i < count($_FILES['product_thumb']['name']); $i++ ) {
        $fileType = $_FILES['product_thumb']['type'][$i];
        if($fileType !== "image/jpeg" && $fileType !== "image/png")
        {
            ?>
            {
            	"isSuc":"fail",
            	"msg":"이미지1 파일만 가능합니다."
            }
            <?php
            exit;
        }
        $name = $_FILES['product_thumb']['name'][$i];
        $uploadName_thumb = explode('.', $name);
        $uploadname_thumb = $uploadName_thumb[0].'.'.$uploadName_thumb[sizeof($uploadName_thumb) -1];
        $uploadFile = $uploadBase.$uploadname_thumb;
        if(move_uploaded_file($_FILES['product_thumb']['tmp_name'][$i], $uploadFile)){
            
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
}

$uploadname_img = $row['product_img'];
if($_FILES['product_img']['name'] != null && $_FILES['product_img']['name'] != "")
{
    for( $i=0 ; $i < count($_FILES['product_img']['name']); $i++ ) {
        $fileType = $_FILES['product_img']['type'][$i];
        if($fileType !== "image/jpeg" && $fileType !== "image/png")
        {
            ?>
            {
            	"isSuc":"fail",
            	"msg":"이미지2 파일만 가능합니다."
            }
            <?php
            exit;
        }
        $name = $_FILES['product_img']['name'][$i];
        $uploadName_img = explode('.', $name);
        $uploadname_img = $uploadname_img[0].'.'.$uploadName_img[sizeof($uploadName_img) -1];
        $uploadFile = $uploadBase.$uploadname_img;
        if(move_uploaded_file($_FILES['product_img']['tmp_name'][$i], $uploadFile)){
            
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
}

$uploadname_layer = $row['layer_img'];
for( $i=0 ; $i < count($_FILES['layer_img']['name']); $i++ ) {
    $fileType = $_FILES['layer_img']['type'][$i];
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
        $name = $_FILES['layer_img']['name'][$i];
        $uploadname_layer = explode('.', $name);
        $uploadname_layer = $uploadname_layer[0].".".$uploadname_layer[sizeof($uploadname_layer) -1];
        $uploadFile = $uploadBase.$uploadname_layer;
        
        if ($uploadname_layer_arr=='' or $uploadname_layer_arr==null) {
            $uploadname_layer_arr = $uploadname_layer;
        }else{
            $uploadname_layer_arr = $uploadname_layer_arr.'@'.$uploadname_layer;
        }
        
        
        
        if(move_uploaded_file($_FILES['layer_img']['tmp_name'][$i], $uploadFile)){
            
        }else{
            ?>
            {
            	"isSuc":"fail",
            	"msg":"7파일 업로드에 실패하였습니다."
            }
            <?php
            exit;
        }
    }
    

    
    $uploadname_layer_en = $row['layer_img_en'];
    for( $i=0 ; $i < count($_FILES['layer_img']['name']); $i++ ) {
        $fileType = $_FILES['layer_img']['type'][$i];
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
        $name = $_FILES['layer_img']['name'][$i];
        $uploadname_layer_en = explode('.', $name);
        $uploadname_layer_en = $uploadname_layer_en[0].".".$uploadname_layer_en[sizeof($uploadname_layer_en) -1];
        $uploadFile = $uploadBase.$uploadname_layer_en;
        
        if ($uploadname_layer_arr=='' or $uploadname_layer_arr==null) {
            $uploadname_layer_arr = $uploadname_layer_en;
        }else{
            $uploadname_layer_en_arr = $uploadname_layer_en_arr.'@'.$uploadname_layer_en;
        }
        
        
        
        if(move_uploaded_file($_FILES['layer_img_en']['tmp_name'][$i], $uploadFile)){
            
        }else{
            ?>
            {
            	"isSuc":"fail",
            	"msg":"8파일 업로드에 실패하였습니다."
            }
            <?php
            exit;
        }
    }


    $product_cate1 = htmlspecialchars(addslashes($_POST['product_cate1']));
    $product_cate1 = str_replace('&amp;','&',$product_cate1);
    
    $product_cate2 = htmlspecialchars(addslashes($_POST['product_cate2']));
    $product_cate2 = str_replace('&amp;','&',$product_cate2);
    
    $product_cate3 = htmlspecialchars(addslashes($_POST['product_cate3']));
    $product_cate3 = str_replace('&amp;','&',$product_cate3);
    
    $product_cate4 = htmlspecialchars(addslashes($_POST['product_cate4']));
    $product_cate4 = str_replace('&amp;','&',$product_cate4);
    
    $product_cate5 = htmlspecialchars(addslashes($_POST['product_cate5']));
    $product_cate5 = str_replace('&amp;','&',$product_cate5);
    
    
    
    $eng_title_query = 'SELECT DISTINCT * FROM product_cate';
    $eng_title_result = sql_query($eng_title_query);
    for ($i = 0; $i < sql_count($eng_title_result); $i++) {
        $eng_title_row = sql_fetch($eng_title_result);
        
        if ($eng_title_row['kor_title']==$product_cate1) {
            $product_cate1_en = $eng_title_row['eng_title'];
            $product_cate1_en = str_replace('_',' ',$product_cate1_en);
            $product_cate1_en = str_replace('and','&',$product_cate1_en);
        }
        
        if ($eng_title_row['kor_title']==$product_cate2) {
            $product_cate2_en = $eng_title_row['eng_title'];
            $product_cate2_en = str_replace('_',' ',$product_cate2_en);
            $product_cate2_en = str_replace('and','&',$product_cate2_en);
        }
        
        if ($eng_title_row['kor_title']==$product_cate3) {
            $product_cate3_en = $eng_title_row['eng_title'];
            $product_cate3_en = str_replace('_',' ',$product_cate3_en);
            $product_cate3_en = str_replace('and','&',$product_cate3_en);
        }
        
        if ($eng_title_row['kor_title']==$product_cate4) {
            $product_cate4_en = $eng_title_row['eng_title'];
            $product_cate4_en = str_replace('_',' ',$product_cate4_en);
            $product_cate4_en = str_replace('and','&',$product_cate4_en);
        }
        
        if ($eng_title_row['kor_title']==$product_cate5) {
            $product_cate5_en = $eng_title_row['eng_title'];
            $product_cate5_en = str_replace('_',' ',$product_cate5_en);
            $product_cate5_en = str_replace('and','&',$product_cate5_en);
        }
    }

//     $product_cate1 = htmlspecialchars(addslashes($_POST['product_cate1']));
//     $product_cate2 = htmlspecialchars(addslashes($_POST['product_cate2']));
//     $product_cate3 = htmlspecialchars(addslashes($_POST['product_cate3']));
//     $product_cate4 = htmlspecialchars(addslashes($_POST['product_cate4']));
//     $product_cate5 = htmlspecialchars(addslashes($_POST['product_cate5']));
    
    $product_thumb = htmlspecialchars(addslashes($_POST['product_thumb']));
    $product_model = htmlspecialchars(addslashes($_POST['product_model']));
    
    $product_title = htmlspecialchars(addslashes($_POST['product_title']));
    $product_title_en = htmlspecialchars(addslashes($_POST['product_title_en']));
    
    $product_ea = htmlspecialchars(addslashes($_POST['product_ea']));
    $product_ea_en = htmlspecialchars(addslashes($_POST['product_ea_en']));
    
    $product_size = htmlspecialchars(addslashes($_POST['product_size']));
    
    $product_weight = htmlspecialchars(addslashes($_POST['product_weight']));
    $product_weight_en = htmlspecialchars(addslashes($_POST['product_weight_en']));
   
    $product_img = htmlspecialchars(addslashes($_POST['product_img']));
    
    
    $layer_type = htmlspecialchars(addslashes($_POST['layer_type']));
    $layer_title = htmlspecialchars(addslashes($_POST['layer_title']));
    $layer_conts = htmlspecialchars(addslashes($_POST['layer_conts']));
    $layer_img = htmlspecialchars(addslashes($_POST['layer_img']));
    
    if ($_POST['choose']=="edit") {
     $query = "update kmew
    set
    product_cate1='{$product_cate1}',
    product_cate2='{$product_cate2}',
    product_cate3='{$product_cate3}',
    product_cate4='{$product_cate4}',
    product_thumb='{$uploadname_thumb}',
    product_model='{$product_model}',
    product_title='{$product_title}',
    product_ea='{$product_ea}',
    product_size='{$product_size}',
    product_weight='{$product_weight}',
    layer_type='{$layer_type}',
    layer_title='{$layer_title}',
    layer_conts='{$layer_conts}',
    layer_img='{$uploadname_layer}'
    where idx = '{$_POST['idx']}'
    ";
    
    }else if($_POST['choose']=="del"){
     $query = "delete from kmew where idx='{$_POST['idx']}'";
    }
    else{
    $query = "insert into kmew
    set
    product_cate1='{$product_cate1}',
    product_cate2='{$product_cate2}',
    product_cate3='{$product_cate3}',
    product_cate4='{$product_cate4}',
    product_thumb='{$uploadname_thumb}',
    product_model='{$product_model}',
    product_title='{$product_title}',
    product_ea='{$product_ea}',
    product_size='{$product_size}',
    product_weight='{$product_weight}',
    layer_type='{$layer_type}',
    layer_title='{$layer_title}',
    layer_conts='{$layer_conts}',
    layer_img='{$uploadname_layer_arr}',
    submit_date = now()+0
    ";
    }
    
    
    sql_query($query);
    ?>
    {
    	"isSuc":"success",
    	"msg":"저장되었습니다."
    }
    <?php




