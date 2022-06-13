<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$type1_query="select * from product_cate where cate_type='1' and eng_title='KMEW' ";
$type2_query="select * from product_cate where cate_type='2' and kmew_chk ='O' ";
$type3_query="select * from product_cate where cate_type='3' and kmew_chk ='O' ";
$type4_query="select * from product_cate where cate_type='4' and kmew_chk ='O' ";
$type5_query="select * from product_cate where cate_type='5' and kmew_chk ='O' ";

$type1_result=sql_query($type1_query);
$type2_result=sql_query($type2_query);
$type3_result=sql_query($type3_query);
$type4_result=sql_query($type4_query);
$type5_result=sql_query($type5_query);

?>
<!doctype HTML>
<html>
<head>
<link rel="stylesheet" media="all" href="/admin/css/admin.css">
<script src="/admin/js/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<script>
$(document).ready(function(){
	add_layer();
	//add_thumbnail();
	$('.tab03').hide();
	$('.tab04').hide();
	$('.tab05').hide();
});


var add_thumb_cnt =1;
function add_thumbnail()
{
	var inner="";
	inner +="<div id='product_thumb_div"+add_thumb_cnt+"'>"
	inner +="이미지"+add_thumb_cnt+" : <input type='file' class='product_thumb' id='product_thumb"+add_thumb_cnt+"' name='product_thumb[]' placeholder='이미지'>";
	if (add_thumb_cnt==1) {
		inner +="<input type='button' onclick='add_thumbnail();' value='추가'>";
	}else{
		inner +="<input type='button' onclick='del_img("+add_thumb_cnt+");' value='삭제'>";
	}
	inner += "<br>";
	inner += "</div>";
	$("#thumbnail_div").append(inner);
	add_thumb_cnt++;
}

function del_img(idx){
	$("#product_thumb_div"+idx).remove();
}

var add_layer_cnt =1;
function add_layer()
{
	var inner ="";

	inner +="<li id='layer_"+add_layer_cnt+"'><h3>" + add_layer_cnt + "번 영역</h3>";
	inner +="<div class='detail-info'>";
	inner +="<dl><dt>타입</dt>";
	inner +="<dd><select name='layer_type_sub' id='layer_type_"+add_layer_cnt+"'>";
	inner +="<option value=''>없음</option>";
	inner +="<option value='1'>1</option>";
	inner +="<option value='2'>2</option>";
	inner +="<option value='3'>3</option>";
	inner +="</select></dd></dl>";
	inner +="<dl><dt>이미지</dt>";
	inner +="<dd><input type='file' class='layer_img' name='layer_img[]' id='layer_img_"+add_layer_cnt+"'></dd></dl>";
	inner +="<dl><dt>이미지(영문)</dt>";
	inner +="<dd><input type='file' class='layer_img_en' name='layer_img_en[]' id='layer_img_"+add_layer_cnt+"_en'></dd></dl>";
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


var img_val ="";
function form_submit(act)
{	
    var layer_type_list = document.getElementsByName("layer_type_sub");	
    $("#layer_type").val("");
    for (var i = 0; i < layer_type_list.length; i++)
    {
    	document.getElementById("layer_type").value += $("#"+layer_type_list[i].id).val()+"@";
    }

    var layer_img_list = document.getElementsByName("layer_img_sub");	
    $("#layer_img").val("");
    for (var i = 0; i < layer_img_list.length; i++)
    {
        var fileValue = $("#layer_img_"+(i+1)).val().split("\\");
        var fileName = fileValue[fileValue.length-1];
    	//document.getElementById("layer_title").value += $("#"+layer_title_list[i].id).val()+"@";
        document.getElementById("layer_img").value += fileName+"@";
    	//document.getElementById("layer_img").value += $("#"+layer_img_list[i].id).val()+"@";
    }

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

// 	$("#product_cate1").val($(".cate1").val());
	

	var	thumb_img = document.getElementsByClassName("product_thumb");
	$("#thumb_img_arr").val("");

	for (var i = 0; i < thumb_img.length; i++) 
	{
		img_val = $("#"+thumb_img[i].id).val();
		img_val = img_val.substring(12);
		//document.getElementById("shop_img_arr").value += $("#"+shop_img[i].id).val() + "@";
		document.getElementById("thumb_img_arr").value += img_val + "@";
	}

	var value_chk = document.getElementById("thumb_img_arr").value.split("@");
	if (value_chk[0]=="") {
		document.getElementById("thumb_img_arr").value="";
	}

	var img_value='';
	$('.layer_img').each(function(){ 
         var fileValue = $(this).val().split("\\");
         var fileName = fileValue[fileValue.length-1];
         img_value = img_value+fileName+'@';
	})
	$('#layer_img_arr').val(img_value);

	
	var img_value_en='';
	$('.layer_img_en').each(function(){ 
        var fileValue = $(this).val().split("\\");
        var fileName = fileValue[fileValue.length-1];
        img_value_en = img_value_en+fileName+'@';
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




</script>

</head>
<body>
    <div id="kmew-new" class="popup-wrap">
    	<h1>KMEW 신규등록</h1>

        <form id="productForm" name="productForm" action="product_proc.php" method="post">
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
        				<dd><input type="text"  name="product_model" placeholder="모델명"></dd>
        			</dl>
        			<dl>
        				<dt>제품명</dt>
        				<dd><input type="text"  name="product_title" placeholder="제품명"></dd>
        			</dl>
        			<dl>
        				<dt>제품명(영문)</dt>
        				<dd><input type="text"  name="product_title_en" placeholder="제품명"></dd>
        			</dl>
        			<dl>
        				<dt>수량</dt>
        				<dd><input type="text"  name="product_ea" placeholder="수량"></dd>
        			</dl>
        			<dl>
        				<dt>수량(영문)</dt>
        				<dd><input type="text"  name="product_ea_en" placeholder="수량"></dd>
        			</dl>
        			<dl>
        				<dt>사이즈</dt>
        				<dd><input type="text"  name="product_size" placeholder="사이즈"></dd>
        			</dl>
        			<dl>
        				<dt>중량</dt>
        				<dd><input type="text"  name="product_weight" placeholder="중량"></dd>
        			</dl>
        			<dl>
        				<dt>중량(영문)</dt>
        				<dd><input type="text"  name="product_weight_en" placeholder="중량"></dd>
        			</dl>
        			<dl>
        				<dt>섬네일</dt>
        				<dd><input type="file" name="product_thumb[]"></dd>
        			</dl>
    			</div>
    		</div>
    			 <!-- 제품 설명 -->
			<!-- <div id="thumbnail_div">
			
			</div> -->

    		
            <div class="section">
            	<h2 class="popup-tit">상세 정보</h2>
                <ul id="layer_div">
                
	            </ul>
            </div>
            <div class="section btn-wrap">
	        	<input type="button" class="blue" value="등록" onclick="form_submit()">
        	</div>
        </form>
    </div>


</body>
</html>

