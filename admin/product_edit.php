<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
$query="select * from product where idx = {$_GET['idx']}";
$result = sql_query($query);
$row = sql_fetch($result);

$sub_cnt_arry = count(explode('@', $row['layer_type']));
$sub_cnt=$sub_cnt_arry-1;

$layer_type = $row['layer_type'];

$layer_title = $row['layer_title'];
$layer_title_en = $row['layer_title_en'];

$layer_conts = $row['layer_conts'];
$layer_conts_en = $row['layer_conts_en'];

$layer_img = $row['layer_img'];
$layer_img_en = $row['layer_img_en'];

$product_cate1 = $row['product_cate1'];
$product_cate2 = $row['product_cate2'];
$product_cate3 = $row['product_cate3'];
$product_cate4 = $row['product_cate4'];
$product_cate5 = $row['product_cate5'];

$type1_query="select * from product_cate where cate_type='1' and eng_title NOT LIKE '%KMEW%' ";
$type2_query="select * from product_cate where cate_type='2' and kmew_chk ='X' ";
$type3_query="select * from product_cate where cate_type='3' and kmew_chk ='X' ";
$type4_query="select * from product_cate where cate_type='4' and kmew_chk ='X' ";
$type5_query="select * from product_cate where cate_type='5' and kmew_chk ='X' ";

$type1_result=sql_query($type1_query);
$type2_result=sql_query($type2_query);
$type3_result=sql_query($type3_query);
$type4_result=sql_query($type4_query);
$type5_result=sql_query($type5_query);

$select_cate1_query = "SELECT * FROM product_cate WHERE kor_title='{$product_cate1}'";
$select_cate2_query = "SELECT * FROM product_cate WHERE kor_title='{$product_cate2}'";
$select_cate3_query = "SELECT * FROM product_cate WHERE kor_title='{$product_cate3}'";
$select_cate4_query = "SELECT * FROM product_cate WHERE kor_title='{$product_cate4}'";
$select_cate5_query = "SELECT * FROM product_cate WHERE kor_title='{$product_cate5}'";


$select_cate1_result = sql_query($select_cate1_query);
$select_cate2_result = sql_query($select_cate2_query);
$select_cate3_result = sql_query($select_cate3_query);
$select_cate4_result = sql_query($select_cate4_query);
$select_cate5_result = sql_query($select_cate5_query);

$select_cate1 = sql_fetch($select_cate1_result);
$select_cate2 = sql_fetch($select_cate2_result);
$select_cate3 = sql_fetch($select_cate3_result);
$select_cate4 = sql_fetch($select_cate4_result);
$select_cate5 = sql_fetch($select_cate5_result);

?>
<!doctype HTML>
<html>
<head>
<link rel="stylesheet" media="all" href="/admin/css/admin.css">
<script src="/admin/js/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<script>
var cate1_type = '<?php echo $select_cate1['cate_type']?>';
var cate2_type = '<?php echo $select_cate2['cate_type']?>';
var cate3_type = '<?php echo $select_cate3['cate_type']?>';
var cate4_type = '<?php echo $select_cate4['cate_type']?>';
var cate5_type = '<?php echo $select_cate5['cate_type']?>';

var cate1_kor = '<?php echo $select_cate1['kor_title']?>';
var cate2_kor = '<?php echo $select_cate2['kor_title']?>';
var cate3_kor = '<?php echo $select_cate3['kor_title']?>';
var cate4_kor = '<?php echo $select_cate4['kor_title']?>';
var cate5_kor = '<?php echo $select_cate5['kor_title']?>';

var layer_type = '<?php echo $layer_type?>';

var layer_title = '<?php echo $layer_title?>';
var layer_title_en = '<?php echo $layer_title_en?>';

var layer_conts = '<?php echo $layer_conts?>';
var layer_conts_en = "<?php echo $layer_conts_en?>";

var layer_img = '<?php echo $layer_img?>';
var layer_img_en = '<?php echo $layer_img_en?>';


var product_cate1 = '<?php echo $product_cate1?>';
var product_cate2 = '<?php echo $product_cate2?>';
var product_cate3 = '<?php echo $product_cate3?>';
var product_cate4 = '<?php echo $product_cate4?>';
var product_cate5 = '<?php echo $product_cate5?>';

var layer_type_arr = layer_type.split('@');
var layer_title_arr = layer_title.split('@');
var layer_conts_arr = layer_conts.split('@');
var layer_img_arr = layer_img.split('@');

var layer_title_en_arr = layer_title_en.split('@');
var layer_conts_en_arr = layer_conts_en.split('@');
var layer_img_en_arr = layer_img_en.split('@');

$(document).ready(function(){
	
	

	$('.tab03').hide();
	$('.tab04').hide();
	$('.tab05').hide();

	$("#product_cate1").val(cate1_kor);
	$("#product_cate2").val(cate2_kor);
	$("#product_cate3").val(cate3_kor);
	$("#product_cate4").val(cate4_kor);	
	$("#product_cate5").val(cate5_kor);	

	
	if (layer_type_arr[0]!="" ) {
        for (var i = 0; i < layer_type_arr.length-1; i++) {
        	add_layer();
        	$('#layer_type_'+(i+1)+' option[value=' + layer_type_arr[i] + ']').attr('selected', 'selected');
            //$('#layer_img_'+i).val(layer_img_arr[i]);
    		$('#layer_title_'+(i+1)).val(layer_title_arr[i]);
    		$('#layer_title_'+(i+1)+'_en').val(layer_title_en_arr[i]);
    		$('#layer_conts_'+(i+1)).val(layer_conts_arr[i]);
    		$('#layer_conts_'+(i+1)+'_en').val(layer_conts_en_arr[i]);

    		$('#layer_img_chk_'+(i+1)).attr('src','/img/product/'+layer_img_arr[i]);
    		$('#layer_img_title_chk_'+(i+1)).val(layer_img_arr[i]);

    		$('#layer_img_chk_en_'+(i+1)).attr('src','/img/product/'+layer_img_en_arr[i]);
    		$('#layer_img_title_chk_en_'+(i+1)).val(layer_img_en_arr[i]);
         }
	}else{
    	add_layer();
	}
 
	
});

function uploadfile(idx,type)
{
		$('#'+type).val("");
		
}

function selLoad(){
	if(product_cate1 != null && product_cate1 != ""){
		console.log(product_cate1);

	    $('.cate1 option[value=' + product_cate1 + ']').attr('selected', 'selected');
	}
	if(product_cate2 != null && product_cate2 != ""){
		console.log(product_cate2);

        $('.cate2 option[value=' + product_cate2 + ']').attr('selected', 'selected');
	}
	if(product_cate3 != null && product_cate3 != ""){
		console.log(product_cate3);

        $('.cate3 option[value=' + product_cate3 + ']').attr('selected', 'selected');
	}
	if(product_cate4 != null && product_cate4 != ""){
		console.log(product_cate4);

        $('.cate4 option[value=' + product_cate4 + ']').attr('selected', 'selected');
	}

	if(product_cate5 != null && product_cate5 != ""){
		console.log(product_cate5);

        $('.cate5 option[value=' + product_cate5 + ']').attr('selected', 'selected');
	}
}


var add_layer_cnt =1;
function add_layer()
{
	var inner ="";

	inner +="<li id='layer_"+add_layer_cnt+"'><h3>" + add_layer_cnt + "번 영역</h3>";
	inner +="<div class='detail-info'>";
	inner +="<dl><dt>타입</dt>";
	inner +="<dd><select name='layer_type_sub' id='layer_type_"+add_layer_cnt+"'>";
	inner +="<option value=''>선택</option>";
	inner +="<option value='1'>1</option>";
	inner +="<option value='2'>2</option>";
	inner +="<option value='3'>3</option>";
	inner +="</select></dd></dl>";
	
	inner +="<dl><dt>이미지</dt>";
	inner +="<dd><input type='file' class='layer_img' name='layer_img[]' id='layer_img_"+add_layer_cnt+"' onchange=file_change('kr',"+add_layer_cnt+",this);>";
	inner +="<img id='layer_img_chk_"+add_layer_cnt+"' src='' style='height:200px;'><br>";
	inner +="<input class='img_title_chk' id='layer_img_title_chk_"+add_layer_cnt+"' type='text' value='' readonly></dd></dl>";

	
	inner +="<dl><dt>이미지(영문)</dt>";
	inner +="<dd><input type='file' class='layer_img_en' name='layer_img_en[]' id='layer_img_"+add_layer_cnt+"_en' onchange=file_change('en',"+add_layer_cnt+",this);>";
	inner +="<img id='layer_img_chk_en_"+add_layer_cnt+"' src='' style='height:200px;'><br>";
	inner +="<input class='img_title_chk_en' id='layer_img_title_chk_en_"+add_layer_cnt+"' type='text' value='' readonly> </dd></dl>";
	

	inner +="<dl><dt>제목</dt>";
	inner +="<dd><input type='text' name='layer_title_sub' id='layer_title_"+add_layer_cnt+"'></dd></dl>";
	inner +="<dl><dt>제목(영문)</dt>";
	inner +="<dd><input type='text' name='layer_title_sub_en' id='layer_title_"+add_layer_cnt+"_en'></dd></dl>";

	inner +="<dl><dt>본문</dt>";
	inner +="<dd><textarea name='layer_conts_sub' id='layer_conts_"+add_layer_cnt+"'></textarea></dd></dl>";
	inner +="<dl><dt>본문(영문)</dt>";
	inner +="<dd><textarea name='layer_conts_sub_en' id='layer_conts_"+add_layer_cnt+"_en'></textarea></dd></dl>";
	if(add_layer_cnt != 1)
	{
	inner +="<button type='button' class='btn remove-btn' onclick='del_layer("+add_layer_cnt+");'>삭제</button>";
	}
	else
	{
	inner +="<button type='button' class='btn add-btn' onclick='add_layer();'>추가</button>";
	}
	
	inner +="</li>";
	$("#layer_div").append(inner);
	add_layer_cnt ++;
}

function del_layer(idx)
{
	$("#layer_"+idx).remove();
}


// function cate1Change(cate1)
// {
// 	if (cate1) {
// 		$(".cate2").hide();
// 		var selCate = cate1;
// 		$("#"+selCate).show();
// 	}else{
//     	$(".cate2").hide();
//     	var selCate = $("#cate1").val();
//     	$("#"+selCate).show();
// 	}
// }
// function cate2Change(cate1)
// {
// 	if (cate1) {
// 		$(".cate3").hide();
// 		var selCate = cate1;
// 		var selSubCate = $("#"+selCate).val();
// 		$("#"+selSubCate).show();
// 	}else{
//     	$(".cate3").hide();
//     	var selCate = $("#cate1").val();
//     	var selSubCate = $("#"+selCate).val();
//     	$("#"+selSubCate).show();
// 	}
// }

//특수문자, 공백제거
function regReplace(str){
	var regExp = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"\s]/gi;
	if(regExp.test(str)){
		var t = str.replace(regExp, "");
	}
	else{
		var t = str;
	}
	return t;
}


function form_submit(act)
{
	if (act=='edit') {
		$('#choose').val('edit');
	}
	if (act=='del') {
		$('#choose').val('del');;
	}
	
    var layer_type_list = document.getElementsByName("layer_type_sub");	
    $("#layer_type").val("");
    for (var i = 0; i < layer_type_list.length; i++)
    {
    	document.getElementById("layer_type").value += $("#"+layer_type_list[i].id).val()+"@";
    }

//     var layer_img_list = document.getElementsByName("layer_img_sub");	
//     $("#layer_img").val("");
//     for (var i = 0; i < layer_img_list.length; i++)
//     {
//         var fileValue = $("#layer_img_"+(i+1)).val().split("\\");
//         var fileName = fileValue[fileValue.length-1];
//     	//document.getElementById("layer_title").value += $("#"+layer_title_list[i].id).val()+"@";
//         document.getElementById("layer_img").value += fileName+"@";
//     	//document.getElementById("layer_img").value += $("#"+layer_img_list[i].id).val()+"@";
//     }

    var layer_conts_list = document.getElementsByName("layer_conts_sub");	
    $("#layer_conts").val("");
    for (var i = 0; i < layer_conts_list.length; i++)
    {
    	document.getElementById("layer_conts").value += $("#"+layer_conts_list[i].id).val()+"@";
    }
    
    var layer_conts_list_en = document.getElementsByName("layer_conts_sub_en");	
    $("#layer_conts_en").val("");
    for (var i = 0; i < layer_conts_list_en.length; i++)
    {
    	document.getElementById("layer_conts_en").value += $("#"+layer_conts_list_en[i].id).val()+"@";
    }

    var layer_title_list = document.getElementsByName("layer_title_sub");	
    $("#layer_title").val("");
    for (var i = 0; i < layer_title_list.length; i++)
    {
    	document.getElementById("layer_title").value += $("#"+layer_title_list[i].id).val()+"@";
    }
    
    var layer_title_list_en = document.getElementsByName("layer_title_sub_en");	
    $("#layer_title_en").val("");
    for (var i = 0; i < layer_title_list_en.length; i++)
    {
    	document.getElementById("layer_title_en").value += $("#"+layer_title_list_en[i].id).val()+"@";
    }

//img_title_chk
    
	var img_value='';
	$('.img_title_chk').each(function(){ 
         var fileValue = $(this).val();
         img_value = img_value+fileValue+'@';
	})
	$('#layer_img_arr').val(img_value);

	
	var img_value_en='';
	$('.img_title_chk_en').each(function(){ 
        var fileValue = $(this).val();
        img_value_en = img_value_en+fileValue+'@';
	})
	$('#layer_img_arr_en').val(img_value_en);
	
	$("#productForm").ajaxSubmit({
		success: function(data)
		{
			console.log(data);
    		var result = JSON.parse(data);
    		if(result.isSuc == "success")
    		{
    			alert(result.msg);
    			location.reload();
    		}
    		else
    		{
    			alert(result.msg);
    		}
		}	
	});
}

// function show(cate,idx,text){

// 	var cate_title = $(text).text();
// 	$(text).parent().prev().text(cate_title);
	
// 	if (cate_title.indexOf('&')!=-1) {
// 		cate_title= cate_title.replace('&','@');
// 	}
// 	if (cate==1) {
// 		$('#product_cate1').val($(text).text());
// 		$('#product_cate2').val("");
// 		$('#product_cate3').val("");
// 		$('#product_cate4').val("");
// 		$('.tab03').hide();
// 		$('.tab04').hide();
// 		$('.tab05').hide();
	
// 	}
// 	if (cate==2) {
// 		$('#product_cate2').val($(text).text());
// 		$('#product_cate3').val("");
// 		$('#product_cate4').val("");
// 		$('.tab03').show();
// 	}

// 	if (cate==3) {
// 		$('#product_cate3').val($(text).text());
// 		$('#product_cate4').val("");
// 		$('.tab05').show();
// 	}

// 	if (cate==4) {
// 		$('#product_cate4').val($(text).text());
// 	}

// 	if (idx=='jo_myeong' || idx=='bock_gi' || idx=='smart_baesun' || idx=='si-jang') {
// 		$('#product_cate1').val($(text).text());
// 		$('#product_cate2').val("");
// 		$('.tab03').hide();
// 		$('.tab04').show();
// 		$('.tab05').hide();
// 	}else{
// 		$('.tab0'+(cate+2)).show();
// 	}

	
// 	$('.cate'+(cate+1)).hide();
// 	$('.'+idx).show();

// }

function file_change(lang,cnt,idx){

	var lang_chk = lang;
	
	var file_name = $(idx).val();
	file_name = file_name.split('\\');
	file_name = file_name[file_name.length-1];
	if (lang_chk=='kr') {
    	$('#layer_img_title_chk_'+cnt).val(file_name);
	}else{
		$('#layer_img_title_chk_en_'+cnt).val(file_name);
	}
}
</script>

</head>
<body>
    <div id="product-edit" class="popup-wrap">
    	<h1>제품 정보 수정</h1>
        <form id="productForm" name="productForm" action="product_proc.php" method="post">
            <input type="hidden" name="idx" value="<?php echo $_GET['idx']?>">
            <input type="hidden" id="layer_type" name="layer_type">
            <input type="hidden" id="layer_title" name="layer_title">
            <input type="hidden" id="layer_title_en" name="layer_title_en">
            <input type="hidden" id="layer_conts" name="layer_conts">
            <input type="hidden" id="layer_conts_en" name="layer_conts_en">
            <input type="hidden" id="layer_img_arr" name="layer_img_arr">
            <input type="hidden" id="layer_img_arr_en" name="layer_img_arr_en">
            <input type="hidden" id="thumb_img_arr" name="thumb_img_arr">
            <div class="section">
                <h2 class="popup-tit">카테고리 선택</h2>
                <div class="basic-info">
                    <div class="category-wrapper">
						<select  id="product_cate1" name="product_cate1">
                			<option value="">선택해주세요.</option>
                			<?php
                			for ($i = 0; $i < sql_count($type1_result); $i++) {      
                			    $cate1_row = sql_fetch($type1_result);
                			?>
                			<option value="<?php echo $cate1_row['kor_title']?>"><?php echo $cate1_row['kor_title']?></option>
                			<?php 
                			}
                			?>
                		</select>
                			
                		<select  id="product_cate2" name="product_cate2">
                			<option value="">선택해주세요.</option>
                			<?php
                			for ($i = 0; $i < sql_count($type2_result); $i++) {      
                			    $cate2_row = sql_fetch($type2_result);
                			?>
                			
                			<option value="<?php echo $cate2_row['kor_title']?>"><?php echo $cate2_row['kor_title']?></option>
                			<?php 
                			}
                			?>
                		</select>
                	
                		<select  id="product_cate3" name="product_cate3">
                			<option value="">선택해주세요.</option>
                			<?php
                			for ($i = 0; $i < sql_count($type3_result); $i++) {      
                			    $cate3_row = sql_fetch($type3_result);
                			?>
                			<option value="<?php echo $cate3_row['kor_title']?>"><?php echo $cate3_row['kor_title']?></option>
                			<?php 
                			}
                			?>
                		</select>
                		
                		<select  id="product_cate4" name="product_cate4">
                			<option value="">선택해주세요.</option>
                			<?php
                			for ($i = 0; $i < sql_count($type4_result); $i++) {      
                			    $cate4_row = sql_fetch($type4_result);
                			?>
                			<option value="<?php echo $cate4_row['kor_title']?>"><?php echo $cate4_row['kor_title']?></option>
                			<?php 
                			}
                			?>
                		</select>
                		
                		<select  id="product_cate5" name="product_cate5">
                			<option value="">선택해주세요.</option>
                			<?php
                			for ($i = 0; $i < sql_count($type5_result); $i++) {      
                			    $cate5_row = sql_fetch($type5_result);
                			?>
                			<option value="<?php echo $cate5_row['kor_title']?>"><?php echo $cate5_row['kor_title']?></option>
                			<?php 
                			}
                			?>
                		</select>
                    </div>
        		</div>
            </div>
            <div class="section">
            	<h2 class="popup-tit">기본 정보</h2>
            	<div class="basic-info">
        			<dl>
        				<dt>모델명</dt>
        				<dd><input type="text"  name="product_model" placeholder="모델명" value="<?php echo $row['product_model']?>"></dd>
        			</dl>
        			<dl>
        				<dt>제품명</dt>
        				<dd><input type="text"  name="product_title" placeholder="제품명" value="<?php echo $row['product_title']?>"></dd>
        			</dl>
        			<dl>
        				<dt>제품명(영문)</dt>
        				<dd><input type="text"  name="product_title_en" placeholder="제품명" value="<?php echo $row['product_title_en']?>"></dd>
        			</dl>
        			<dl>
        				<dt>정격</dt>
        				<dd><input type="text"  name="product_rating" placeholder="정격" value="<?php echo $row['product_rating']?>"></dd>
        			</dl>
        			<dl>
        				<dt>정격(영문)</dt>
        				<dd><input type="text"  name="product_rating_en" placeholder="정격" value="<?php echo $row['product_rating_en']?>"></dd>
        			</dl>
        			<dl>
        				<dt>사이즈</dt>
        				<dd><input type="text"  name="product_size" placeholder="사이즈" value="<?php echo $row['product_size']?>"></dd>
        			</dl>
        			<dl>
        				<dt>사이즈(영문)</dt>
        				<dd><input type="text"  name="product_size_en" placeholder="사이즈" value="<?php echo $row['product_size_en']?>"></dd>
        			</dl>
        			<dl>
        				<dt>인증</dt>
        				<dd><input type="text"  name="product_auth" placeholder="인증" value="<?php echo $row['product_auth']?>"></dd>
        			</dl>
        			<dl>
        				<dt>인증(영문)</dt>
        				<dd><input type="text"  name="product_auth_en" placeholder="인증" value="<?php echo $row['product_auth_en']?>"></dd>
        			</dl>
        			<dl>
        				<dt>인증서</dt>
        				<dd><input type="file" name="product_manual[]" onclick="uploadfile(this,'product_manual')"><br>
        					<input type="text" id="product_auth_file" name="auth_chk" value="<?php echo $row['product_auth_file']?>" readonly="readonly"></dd>
        			</dl>
        			<dl>
        				<dt>매뉴얼</dt>
        				<dd><input type="file" name="product_manual[]" onclick="uploadfile(this,'product_manual')"><br>
        					<input type="text" id="product_manual" name="manual_chk" value="<?php echo $row['product_manual']?>" readonly="readonly"></dd>
        			</dl>
        			<dl>
        				<dt>도면 (DWG)</dt>
        				<dd><input type="file" name="product_map_1[]" onclick="uploadfile(this,'product_map_1')"><?php echo $row['product_map_1']?><br> <!-- 다운로드2-->
        					<input type="text" id="product_map_1" name="map1_chk" value="<?php echo $row['product_map_1']?>" readonly="readonly"></dd>
        			</dl>
        			<dl>
        				<dt>도면 (PDF)</dt>
        				<dd><input type="file" name="product_map_2[]" onclick="uploadfile(this,'product_map_2')"><?php echo $row['product_map_2']?><br> <!-- 다운로드2-->
        					<input type="text" id="product_map_2" name="map2_chk" value="<?php echo $row['product_map_2']?>" readonly="readonly"></dd>
        			</dl>
        			<dl>
        				<dt>섬네일</dt>
        				<dd><input type="file" name="product_thumb[]" onclick="uploadfile(this,'product_thumb')"><?php echo $row['product_thumb']?><br> <!-- 썸네일-->
        					<img src="/img/product/<?php echo $row['product_thumb']?>" style="height:120px;"><br>
        					<input type="text" id="product_thumb" name="thumb_chk" value="<?php echo $row['product_thumb']?>" readonly="readonly"></dd>
        			</dl>

        			<dl>
        				<dt>제품 설명</dt>
        				<dd><textarea name="product_info"><?php echo $row['product_info']?></textarea></dd>
        			</dl>
        			<dl>
        				<dt>제품 설명(영문)</dt>
        				<dd><textarea name="product_info_en"><?php echo $row['product_info_en']?></textarea></dd>
        			</dl>
        			<div id="thumbnail_div">
        			
        			</div>
    			</div>
    	
    			 <!-- 제품 설명 -->
    		</div>
    		
            <div class="section">
            	<h2 class="popup-tit">상세 정보</h2>
        
                <ul id="layer_div">
                
                </ul>
            </div>
            
            <div class="section btn-wrap">
                <input type="button" value="수정" onclick="form_submit('edit')">
                <input type="button" value="삭제" onclick="form_submit('del')">
                <input type="hidden" id="choose" name="choose">
            </div>
        </form>
        
        <!-- 
        <form id="excelForm" name="excelForm" method="post" action="product_excel.php" enctype="multipart/form-data">
        	엑셀 업로드 : <input type='file' name='upload[]' id='upload'>
        	<input type="button" value="저장" onclick="excel_submit()">     		
        </form>
         -->
	</div>
</body>
</html>








