<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");


header('Content-Type: text/html; charset=utf-8');

// $uploadBase = $_SERVER['DOCUMENT_ROOT']."/img/product/";
$uploadBase = $_SERVER['DOCUMENT_ROOT']."/img/product/";
if (!is_dir($uploadBase)){
    if(@mkdir($uploadBase, 0777)) {
        if(is_dir($uploadBase)) {
            @chmod($uploadBase, 0777);
        }
    }
    else {
        
    }
}

$uploadBase_auth = $_SERVER['DOCUMENT_ROOT']."/cert/file/";
if (!is_dir($uploadBase)){
    if(@mkdir($uploadBase, 0777)) {
        if(is_dir($uploadBase)) {
            @chmod($uploadBase, 0777);
        }
    }
    else {
        
    }
}

$uploadBase_manual = $_SERVER['DOCUMENT_ROOT']."/img/product_manual/";

if (!is_dir($uploadBase_manual)){
    if(@mkdir($uploadBase_manual, 0777)) {
        if(is_dir($uploadBase_manual)) {
            @chmod($uploadBase_manual, 0777);
        }
    }
    else {
        
    }
}

$uploadBase_map_1 = $_SERVER['DOCUMENT_ROOT']."/img/product_map/";

if (!is_dir($uploadBase_map)){
    if(@mkdir($uploadBase_map, 0777)) {
        if(is_dir($uploadBase_map)) {
            @chmod($uploadBase_map, 0777);
        }
    }
    else {
        
    }
}


$uploadBase_map_2 = $_SERVER['DOCUMENT_ROOT']."/img/product_map/";

if (!is_dir($uploadBase_map)){
    if(@mkdir($uploadBase_map, 0777)) {
        if(is_dir($uploadBase_map)) {
            @chmod($uploadBase_map, 0777);
        }
    }
    else {
        
    }
}

$product_title = htmlspecialchars(addslashes($_POST['product_title']));
$result = sql_query("select * from product where product_title = '{$product_title}'");
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
        $uploadname_thumb = explode('.', $name);
        $uploadname_thumb = $uploadname_thumb[0].'.'.$uploadname_thumb[sizeof($uploadname_thumb) -1];
        $uploadFile = $uploadBase.$uploadname_thumb;
        if(move_uploaded_file($_FILES['product_thumb']['tmp_name'][$i], $uploadFile)){
            
        }else{
            ?>
            {
            	"isSuc":"fail",
            	"msg":"1파일 업로드에 실패하였습니다."
            }
            <?php
            exit;
        }
    }
}

$uploadname_auth = $row['product_auth_file'];
if($_FILES['product_auth_file']['name'] != null && $_FILES['product_auth_file']['name'] != "")
{
    for( $i=0 ; $i < count($_FILES['product_auth_file']['name']); $i++ ) {
        $fileType = $_FILES['product_auth_file']['type'][$i];
        
        $name = $_FILES['product_auth_file']['name'][$i];
        $uploadname_auth = explode('.', $name);
        $uploadname_auth = $uploadname_auth[0].'.'.$uploadname_auth[sizeof($uploadname_auth) -1];
        $uploadFile = $uploadBase_auth.$uploadname_auth;
        if(move_uploaded_file($_FILES['product_auth_file']['tmp_name'][$i], $uploadFile)){
            
        }else{
            ?>
            {
            	"isSuc":"fail",
            	"msg":"2파일 업로드에 실패하였습니다."
            }
            <?php
            exit;
        }
    }
}





$uploadname_manual = $row['product_manual'];
if($_FILES['product_manual']['name'] != null && $_FILES['product_manual']['name'] != "")
{
    for( $i=0 ; $i < count($_FILES['product_manual']['name']); $i++ ) {
        $fileType = $_FILES['product_manual']['type'][$i];

        $name = $_FILES['product_manual']['name'][$i];
        $uploadname_manual = explode('.', $name);
        $uploadname_manual = $uploadname_manual[0].'.'.$uploadname_manual[sizeof($uploadname_manual) -1];
        $uploadFile = $uploadBase_manual.$uploadname_manual;
        if(move_uploaded_file($_FILES['product_manual']['tmp_name'][$i], $uploadFile)){
            
        }else{
            ?>
            {
            	"isSuc":"fail",
            	"msg":"4파일 업로드에 실패하였습니다."
            }
            <?php
            exit;
        }
    }
}

$uploadname_map_1 = $row['product_map_1'];
if($_FILES['product_map_1']['name'] != null && $_FILES['product_map_1']['name'] != "")
{
    for( $i=0 ; $i < count($_FILES['product_map_1']['name']); $i++ ) {
        $fileType = $_FILES['product_map_1']['type'][$i];

        $name = $_FILES['product_map_1']['name'][$i];
        $uploadname_map_1 = explode('.', $name);
        $uploadname_map_1 = $uploadname_map_1[0].'.'.$uploadname_map_1[sizeof($uploadname_map_1) -1];
        $uploadFile = $uploadBase_map_1.$uploadname_map_1;
        if(move_uploaded_file($_FILES['product_map_1']['tmp_name'][$i], $uploadFile)){
            
        }else{
            ?>
            {
            	"isSuc":"fail",
            	"msg":"5파일 업로드에 실패하였습니다."
            }
            <?php
            exit;
        }
    }
}

$uploadname_map_2 = $row['product_map_2'];
if($_FILES['product_map_2']['name'] != null && $_FILES['product_map_2']['name'] != "")
{
    for( $i=0 ; $i < count($_FILES['product_map_2']['name']); $i++ ) {
        $fileType = $_FILES['product_map_2']['type'][$i];
        
        $name = $_FILES['product_map_2']['name'][$i];
        $uploadname_map_2 = explode('.', $name);
        $uploadname_map_2 = $uploadname_map_2[0].'.'.$uploadname_map_2[sizeof($uploadname_map_2) -1];
        $uploadFile = $uploadBase_map_2.$uploadname_map_2;
        if(move_uploaded_file($_FILES['product_map_2']['tmp_name'][$i], $uploadFile)){
            
        }else{
            ?>
            {
            	"isSuc":"fail",
            	"msg":"6파일 업로드에 실패하였습니다."
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
    for( $i=0 ; $i < count($_FILES['layer_img_en']['name']); $i++ ) {
        $fileType = $_FILES['layer_img_en']['type'][$i];
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
        $name = $_FILES['layer_img_en']['name'][$i];
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
    
    
    
    $product_thumb = htmlspecialchars(addslashes($_POST['product_thumb']));
    $product_model = htmlspecialchars(addslashes($_POST['product_model']));
    
    $product_title = htmlspecialchars(addslashes($_POST['product_title']));
    $product_title_en = htmlspecialchars(addslashes($_POST['product_title_en']));
    
    $product_rating = htmlspecialchars(addslashes($_POST['product_rating']));
    $product_rating_en = htmlspecialchars(addslashes($_POST['product_rating_en']));
    
    $product_size = htmlspecialchars(addslashes($_POST['product_size']));
    $product_size_en = htmlspecialchars(addslashes($_POST['product_size_en']));
    
    $product_ea = htmlspecialchars(addslashes($_POST['product_ea']));
    $product_ea_en = htmlspecialchars(addslashes($_POST['product_ea_en']));
    
    $product_weight = htmlspecialchars(addslashes($_POST['product_weight']));
    $product_weight_en = htmlspecialchars(addslashes($_POST['product_weight_en']));
    
    $product_auth = htmlspecialchars(addslashes($_POST['product_auth']));
    $product_auth_en = htmlspecialchars(addslashes($_POST['product_auth_en']));
    
    $product_manual = htmlspecialchars(addslashes($_POST['product_manual']));
    $product_map = htmlspecialchars(addslashes($_POST['product_map']));
    $product_img = htmlspecialchars(addslashes($_POST['product_img']));
    
    $product_info = htmlspecialchars(addslashes($_POST['product_info']));
    $product_info_en = htmlspecialchars(addslashes($_POST['product_info_en']));
    
    $layer_type = htmlspecialchars(addslashes($_POST['layer_type']));
    $layer_title = htmlspecialchars(addslashes($_POST['layer_title']));
    $layer_title_en = htmlspecialchars(addslashes($_POST['layer_title_en']));
    
    $layer_conts = htmlspecialchars(addslashes($_POST['layer_conts']));
    $layer_conts_en = htmlspecialchars(addslashes($_POST['layer_conts_en']));
    
    $layer_img_arr = htmlspecialchars(addslashes($_POST['layer_img_arr']));
    $layer_img_arr_en = htmlspecialchars(addslashes($_POST['layer_img_arr_en']));
    
    $layer_img = htmlspecialchars(addslashes($_POST['layer_img']));
    
    
    if ($product_cate1=='KMEW') {
        if ($_POST['choose']=="edit") {
            $query = "update kmew
            set
            product_cate1='{$product_cate1}',
            product_cate1_en='{$product_cate1_en}',

            product_cate2='{$product_cate2}',
            product_cate2_en='{$product_cate2_en}',

            product_cate3='{$product_cate3}',
            product_cate3_en='{$product_cate3_en}',

            product_cate4='{$product_cate4}',
            product_cate4_en='{$product_cate4_en}',

            product_cate5='{$product_cate5}',
            product_cate5_en='{$product_cate5_en}',

            product_thumb='{$uploadname_thumb}',
            product_model='{$product_model}',

            product_title='{$product_title}',
            product_title_en='{$product_title_en}',

            product_ea='{$product_ea}',
            product_ea_en='{$product_ea_en}',

            product_size='{$product_size}',

            product_weight='{$product_weight}',
            product_weight_en='{$product_weight_en}',

            layer_type='{$layer_type}',

            layer_title='{$layer_title}',
            layer_title_en='{$layer_title_en}',

            layer_conts='{$layer_conts}',
            layer_conts_en='{$layer_conts_en}',

            layer_img='{$layer_img_arr}',
            layer_img_en='{$layer_img_arr_en}'

            where idx = '{$_POST['idx']}'
            ";
            
            }else if($_POST['choose']=="del"){
            $query = "delete from kmew where idx='{$_POST['idx']}'";
            }
            else{
            $query = "insert into kmew
            set
            product_cate1='{$product_cate1}',
            product_cate1_en='{$product_cate1_en}',
            product_cate2='{$product_cate2}',
            product_cate2_en='{$product_cate2_en}',
            product_cate3='{$product_cate3}',
            product_cate3_en='{$product_cate3_en}',
            product_cate4='{$product_cate4}',
            product_cate4_en='{$product_cate4_en}',
            product_cate5='{$product_cate5}',
            product_cate5_en='{$product_cate5_en}',
            product_thumb='{$uploadname_thumb}',
            product_model='{$product_model}',

            product_title='{$product_title}',
            product_title_en='{$product_title_en}',

            product_ea='{$product_ea}',
            product_ea_en='{$product_ea_en}',

            product_size='{$product_size}',

            product_weight='{$product_weight}',
            product_weight_en='{$product_weight_en}',

            layer_type='{$layer_type}',

            layer_title='{$layer_title}',
            layer_title_en='{$layer_title_en}',

            layer_conts='{$layer_conts}',
            layer_conts_en='{$layer_conts_en}',
    
            layer_img='{$layer_img_arr}',
            layer_img_en='{$layer_img_arr_en}',

            submit_date = now()+0
            ";
        }
    }else{
        if ($_POST['choose']=="edit") {
         $query = "update product
        set
        product_cate1='{$product_cate1}',
        product_cate1_en='{$product_cate1_en}',

        product_cate2='{$product_cate2}',
        product_cate2_en='{$product_cate2_en}',

        product_cate3='{$product_cate3}',
        product_cate3_en='{$product_cate3_en}',

        product_cate4='{$product_cate4}',
        product_cate4_en='{$product_cate4_en}',

        product_cate5='{$product_cate5}',
        product_cate5_en='{$product_cate5_en}',


        product_thumb='{$uploadname_thumb}',
        product_model='{$product_model}',

        product_title='{$product_title}',
        product_title_en='{$product_title_en}',

        product_rating='{$product_rating}',
        product_rating_en='{$product_rating_en}',

        product_size='{$product_size}',
        product_size_en='{$product_size_en}',

        product_auth='{$product_auth}',
        product_auth_en='{$product_auth_en}',
        product_auth_file='{$uploadname_auth}',

        product_manual='{$uploadname_manual}',
        product_map_1='{$uploadname_map_1}',
        product_map_2='{$uploadname_map_2}',

        product_info='{$product_info}',
        product_info_en='{$product_info_en}',

        layer_type='{$layer_type}',

        layer_title='{$layer_title}',
        layer_title_en='{$layer_title_en}',

        layer_conts='{$layer_conts}',
        layer_conts_en='{$layer_conts_en}',

        layer_img='{$layer_img_arr}',
        layer_img_en='{$layer_img_arr_en}'
        where idx = '{$_POST['idx']}'
        ";
        
        }else if($_POST['choose']=="del"){
         $query = "delete from product where idx='{$_POST['idx']}'";
        }
        else{
        $query = "insert into product
        set
        product_cate1='{$product_cate1}',
        product_cate1_en='{$product_cate1_en}',
        product_cate2='{$product_cate2}',
        product_cate2_en='{$product_cate2_en}',
        product_cate3='{$product_cate3}',
        product_cate3_en='{$product_cate3_en}',
        product_cate4='{$product_cate4}',
        product_cate4_en='{$product_cate4_en}',
        product_cate5='{$product_cate5}',
        product_cate5_en='{$product_cate5_en}',
        product_thumb='{$uploadname_thumb}',
        product_model='{$product_model}',

        product_title='{$product_title}',
        product_title_en='{$product_title_en}',

        product_rating='{$product_rating}',
        product_rating_en='{$product_rating_en}',

        product_size='{$product_size}',
        product_size_en='{$product_size_en}',

        product_auth='{$product_auth}',
        product_auth_en='{$product_auth_en}',
        product_auth_file='{$uploadname_auth}',

        product_manual='{$uploadname_manual}',
        product_map_1='{$uploadname_map_1}',
        product_map_2='{$uploadname_map_2}',

        product_info='{$product_info}',
        product_info_en='{$product_info_en}',

        layer_type='{$layer_type}',

        layer_title='{$layer_title}',
        layer_title_en='{$layer_title_en}',

        layer_conts='{$layer_conts}',
        layer_conts_en='{$layer_conts_en}',

        layer_img='{$layer_img_arr}',
        layer_img_en='{$layer_img_arr_en}',
        submit_date = now()+0
        ";
        }
    }
    
    sql_query($query);
    ?>
    {
    	"isSuc":"success",
    	"msg":"저장 되었습니다."
    }
    <?php




