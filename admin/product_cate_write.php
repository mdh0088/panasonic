<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");


?>

<!doctype HTML>
<html>
<head>
<link rel="stylesheet" media="all" href="/admin/css/admin.css">
<script src="/admin/js/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<script>

$(document).ready(function(){
	$('#upper_cate3').hide();
	var cate_value = $('#choose_cate1').val();	
	choose_cate(1);
});


var inner="";
var result_cate1="";
var result_cate2="";


function choose_cate(idx){
	
	if (idx==1) {
		$('.no1').hide();
		$('.no2').hide();
	}else if(idx==3){
		$('.no1').show();
		$('.no2').show();
	}else{
		$('.no1').show();
		$('.no2').hide();
	}

	if (idx!=1) {
    	$.ajax({
    		type : "GET", //전송방식을 지정한다 (POST,GET)
    		async : false,
    		url : "/admin/get_cate.php?cate_no="+encodeURI(idx),//호출 URL을 설정한다. GET방식일경우 뒤에 파라티터를 붙여서 사용해도된다.
    		dataType : "text",//호출한 페이지의 형식이다. xml,json,html,text등의 여러 방식을 사용할 수 있다.
    		error : function() 
    		{
    			alert("통신 중 오류가 발생하였습니다.");
    		}, 
    		success : function(data) 
    		{    			
    			$(".no1").empty();
    			$(".no2").empty();
     			result_cate1="";
     			result_cate2="";
    			
     			var result = JSON.parse(data);
     			if (idx==3) {
         			inner = "";
     				for (var i = 0; i < result.length; i++) {
         				if (result[i].result_cate2!="" || result[i].result_cate2!=0) {
             				if (result_cate2.indexOf(result[i].result_cate2)==-1) {
             					result_cate2 += result[i].result_cate2+'@';
							}
						}
     				}
					result_cate2=result_cate2.split('@');
					inner += "<option value=''>카테고리" + idx + " 선택</option>";
					for (var i = 0; i < result_cate2.length-1; i++) {
						inner += "<option value=\""+result_cate2[i]+"\">"+result_cate2[i]+"</option>";
					}

					$('.no2').append(inner);
				}
				
     			inner = "";
     			for (var i = 0; i < result.length; i++) {
     				if (result[i].result_cate1!="" || result[i].result_cate1!=0) {
     					if (result_cate1.indexOf(result[i].result_cate1)==-1) {
         					result_cate1 += result[i].result_cate1+'@';
     					}
     				}
     			}
     			result_cate1=result_cate1.split('@');
     			inner += "<option value=''></option>";			
         		for (var i = 0; i < result_cate1.length-1; i++) {
         			inner += "<option value=\""+result_cate1[i]+"\">"+result_cate1[i]+"</option>";
				}

         		$('.no1').append(inner);
    		}
    	});
	}
	
}


function form_submit(act)
{	
	$("#productCateForm").ajaxSubmit({
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

    <div id="category-new" class="popup-wrap">
    	<h1>카테고리 신규등록</h1>
        <form id="productCateForm" name="productCateForm" action="product_cate_proc.php" method="post">
            <div class="section">
                <div class="basic-info bd-top">
                	<dl>
                		<dt>카테고리</dt>
                		<dd>
                			<select id="choose_cate1" onchange="choose_cate(this.value);" name="type_cate">
                        		<option value="1">카테고리 1</option>
                        		<option value="2">카테고리 2</option>
                        		<option value="3">카테고리 3</option>
                        		<option value="4">카테고리 4</option>
                			</select>
                		</dd>
                	</dl>
                	<dl>
                		<dt>카테고리명(국문)</dt>
                		<dd><input type="text" name="kor_title"></dd>
                	</dl>
                	<dl>
                		<dt>카테고리명(영문)</dt>
                		<dd><input type="text" name="eng_title"></dd>
                	</dl>
                	<dl>
                		<dt>상위 카테고리</dt>
                		<dd>
                			<select class="upper_cate no1" name="result_cate1">
                    		
                        	</select>
                    	
                        	<select class="upper_cate no2" name="result_cate2">
                        		
                        	</select>
                    	</dd>
                	</dl>
                </div>
        	</div>
            <div class="section btn-wrap">
            	<input class="blue" type="button" value="등록" onclick="form_submit();">
    		</div>
        </form>
    </div>
</body>
</html>

