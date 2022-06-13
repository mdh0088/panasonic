<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
$query = "select * from product_banner where idx = '{$_GET['idx']}'";
$result = sql_query($query);
$row = sql_fetch($result);
?>

<!doctype HTML>
<html>
<head>
<link rel="stylesheet" media="all" href="/admin/css/admin.css">
<script src="/admin/js/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<script>
var cate3 = '<?php echo $row['cate3']?>';
var cate4 = '<?php echo $row['cate4']?>';

$(document).ready(function(){
	
	
	var cate_value = $('#choose_cate1').val();	
	choose_cate(3);
	$("select#cate3 option[value='" + cate3 + "']").attr('selected', 'selected');
	choose_cate(4,cate3);
	$("select#cate4 option[value='" + cate4 + "']").attr('selected', 'selected');
	
});


var inner="";
var result_cate="";
var result_cate2="";

function choose_cate(cate_num,idx){
	
	if (cate_num==4 && idx!="") {
		if (idx.indexOf('&')!=-1) {
			idx=idx.replace('&','@');
		}
		$('#cate4_area').show();
	}else{
		$('#cate4_area').hide();
	}
	

	
	if (idx!=1) {
		
    	$.ajax({
    		type : "GET", //전송방식을 지정한다 (POST,GET)
    		async : false,
    		url : "/admin/get_banner_cate.php?cate_no="+encodeURI(cate_num)+"&cate3_title="+encodeURI(idx),//호출 URL을 설정한다. GET방식일경우 뒤에 파라티터를 붙여서 사용해도된다.
    		dataType : "text",//호출한 페이지의 형식이다. xml,json,html,text등의 여러 방식을 사용할 수 있다.
    		error : function() 
    		{
    			alert("통신 중 오류가 발생하였습니다.");
    		}, 
    		success : function(data) 
    		{    			
    			
     			result_cate="";
     			result_cate2="";
    			
     			var result = JSON.parse(data);
     			
     			if (cate_num==3 && idx==null) {
         			inner = "";
     				for (var i = 0; i < result.length; i++) {
         				if (result[i].result_cate!="" || result[i].result_cate!=0) {
             				if (result_cate.indexOf(result[i].result_cate)==-1) {
             					result_cate += result[i].result_cate+'@';
							}
						}
     				}
					result_cate=result_cate.split('@');
					inner += "<option value=''></option>";
					for (var i = 0; i < result_cate.length-1; i++) {
						inner += "<option value='"+result_cate[i]+"'>"+result_cate[i]+"</option>";
					}

					$('#cate3').append(inner);
				}else if(cate_num==4) {
					
					$("#cate4").empty();
					inner = "";
     				for (var i = 0; i < result.length; i++) {
         				if (result[i].result_cate2!="" || result[i].result_cate2!=0) {
             				if (result_cate2.indexOf(result[i].result_cate2)==-1) {
             						result_cate2 += result[i].result_cate2+'@';
							}
						}
     				}
					result_cate2=result_cate2.split('@');
					inner += "<option value=''></option>";
					for (var i = 0; i < result_cate2.length-1; i++) {
						inner += "<option value='"+result_cate2[i]+"'>"+result_cate2[i]+"</option>";
					}

					$('#cate4').append(inner);
					
				}

				

				
//      			inner = "";
//      			for (var i = 0; i < result.length; i++) {
//      				if (result[i].result_cate1!="" || result[i].result_cate1!=0) {
//      					if (result_cate1.indexOf(result[i].result_cate1)==-1) {
//          					result_cate1 += result[i].result_cate1+'@';
//      					}
//      				}
//      			}
//      			result_cate1=result_cate1.split('@');
//      			inner += "<option value=''></option>";			
//          		for (var i = 0; i < result_cate1.length-1; i++) {
//          			inner += "<option value="+result_cate1[i]+">"+result_cate1[i]+"</option>";
// 				}

//          		$('.no1').append(inner);
    		}
    	});
	}
}


function form_submit(act)
{	
	$('#choose').val(act);
	$("#productCateForm").ajaxSubmit({
		success: function(data)
		{
			console.log(data);
    		var result = JSON.parse(data);
    		if(result.isSuc == "success")
    		{
    			alert(result.msg);
    			if (act=='del') {
    				location.href='/admin/product_banner_list.php';
				}else{
    			location.reload();
				}
    		}
    		else
    		{
    			alert(result.msg);
    		}
		}	
	});
}

function file_change(way,idx){
	var file_name = $(idx).val();
	file_name = file_name.split('\\');
	file_name = file_name[file_name.length-1];
	$('#'+way+'_banner_check').val(file_name);

}

</script>
</head>
<body>
    <div id="banner-edit" class="popup-wrap">
    	<h1>배너 수정</h1>
        <form id="productCateForm"  name="productCateForm" action="product_banner_proc.php" method="post" enctype="multipart/form-data">
        	<input type="hidden" id="idx" name="idx" value="<?php echo $_GET['idx']?>">
        	<input type="hidden" id="choose" name="choose">
            <div class="section">
            	<div class="basic-info">
            		<div id="cate3_area">
            			<dl>
            				<dt>카테고리 3</dt>
            				<dd><select id="cate3" name="cate3" onchange="choose_cate(4,this.value);"></select> </dd>
            			</dl>
        			</div>
                	<div id="cate4_area">
            			<dl>
            				<dt>카테고리 4</dt>
            				<dd><select id="cate4" name="cate4"></select></dd>
            			</dl>
                	</div>
        			<dl>
        				<dt>내용</dt>
        				<dd><textarea name="contents"><?php echo $row['contents']?></textarea></dd>
        			</dl>
        			<dl>
        				<dt>배너(pc)</dt>
        				<dd><input type="file" id="banner_pc" name="banner_pc[]" onchange="file_change('pc',this);"><Br>
                    	<img src="/img/product_banner/<?php echo $row['banner']?>" style="height:120px;"><br>
                    	<input type="text" id="pc_banner_check" name="pc_banner_check" value="<?php echo $row['banner']?>" readonly></dd>
        			</dl>
        			<dl>
        				<dt>배너(mobile)</dt>
        				<dd><input type="file" id="banner_mob" name="banner_mob[]" onchange="file_change('mob',this);"><Br>
                    	<img src="/img/product_banner/<?php echo $row['banner_mo']?>" style="height:200px;"><br>
                    	<input type="text" id="mob_banner_check" name="mob_banner_check" value="<?php echo $row['banner_mo']?>" readonly></dd>
        			</dl>
    			</div>
            </div>
            <div class="section btn-wrap">
            	<input type="button" value="수정" onclick="form_submit('edit');">
            	<input type="button" value="삭제" onclick="form_submit('del');">
        	</div>
        </form>
	</div>
</body>
</html>