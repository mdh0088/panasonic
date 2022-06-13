<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$query1 = "select * from product_cate where 1 and cate_type = 1 order by submit_date desc";
$result1 = sql_query($query1);
$query2 = "select * from product_cate where 1 and cate_type = 2 order by submit_date desc";
$result2 = sql_query($query2);
$query3 = "select * from product_cate where 1 and cate_type = 3 order by submit_date desc";
$result3 = sql_query($query3);
$query4 = "select * from product_cate where 1 and cate_type = 4 order by submit_date desc";
$result4 = sql_query($query4);

?>

<!doctype HTML>
<html>
<head>
<link rel="stylesheet" media="all" href="/admin/css/admin.css">
<script src="/admin/js/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<script>
function set_edit(idx){
	$("#choose_cate1").find("option").attr("selected", false);
	$.ajax({
		type: "GET",
		async: false,
		url: "/admin/get_cate_edit.php?idx="+idx,
		dataType: "json",
		error: function(){
			alert("통신 중 오류가 발생하였습니다");
		},
		success: function(data){
			$("input[name=idx]").val(data.idx);
			$("#choose_cate1 option[value='"+data.cate_type+"'").attr('selected', 'selected');
			$("input[name=kor_title]").val(data.kor_title);
			$("input[name=eng_title]").val(data.eng_title);
			choose_cate(data.cate_type);
			if (data.cate_type==1) {
				$('.no1').val("");
				$('.no1').hide();
				$('.no2').val("");
				$('.no2').hide();
			}else if(data.cate_type==3){
				$(".no1 option[value='"+data.upper_cate+"'").attr('selected', 'selected');
				$('.no1').show();
				$(".no2 option[value='"+data.upper_cate+"'").attr('selected', 'selected');
				$('.no2').show();
			}else{
				$(".no1 option[value='"+data.upper_cate+"'").attr('selected', 'selected');
				$('.no1').show();
				$('.no2').val("");
				$('.no2').hide();
			}
			$("input[name=kor_title]").focus();
		}
	});
	dimShow();
}

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

	if(idx != 1){
		$.ajax({
			type: "GET",
			async: false,
			url: "/admin/get_cate.php?cate_no="+encodeURI(idx),
			dataType: "text",
			error: function(){
				alert("통신 중 오류가 발생하였습니다.");
			},
			success: function(data){
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
					inner += "<option value=''></option>";
					for (var i = 0; i < result_cate2.length-1; i++) {
						inner += "<option value="+result_cate2[i]+">"+result_cate2[i]+"</option>";
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
         			inner += "<option value="+result_cate1[i]+">"+result_cate1[i]+"</option>";
				}

         		$('.no1').append(inner);
			}//success END
		});//ajax END
	}//if END
}

function form_submit(act)
{
	if (act=='edit') {
		$('#choose').val('edit');
	}
	
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
function form_submit_del(idx){
	$("#choose").val('del');
	$("input[name=idx]").val(idx);
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

function dimShow(){
	$('.dim-wrap').fadeIn(200).focus();
}
function dimHide(){
	$('.dim-wrap').fadeOut(200).blur();
	$('.category-list').focus();
}

</script>

</head>
<body>
    <div id="category-edit" class="popup-wrap">
    	<h1>카테고리 관리</h1>
        <!-- 리스트 -->
        <div class="section">
            <h2 class="popup-tit">카테고리1</h2>
            <div class="basic-info">
            	<ul class="category-list">
                    <?php 
                    for($i = 0; $i < sql_count($result1); $i++){
                    $row1 = sql_fetch($result1);
                    ?>
                    <li>
                    	<dl>
                    		<dt>카테고리명(국문)</dt>
                    		<dd><?php echo $row1['kor_title']?></dd>
                    	</dl>
                    	<dl>
                    		<dt>카테고리명(영문)</dt>
                    		<dd><?php echo $row1['eng_title']?></dd>
                    	</dl>
                    	<dl>
                    		<dt>상위 카테고리</dt>
                    		<dd><?php echo $row1['upper_cate']?></dd>
                    	</dl>
                    	<!-- <span><?php echo "카테고리: cate".$row1['cate_type']?></span>  -->
                    	<div class="category-btn">
    	                	<input type="button" onclick="set_edit('<?php echo $row1['idx']?>');" value="수정">
        	            	<input type="button" onclick="form_submit_del(<?php echo $row1['idx']?>)" value="삭제">
                    	</div>
                    </li>
                    <?php
                    }
                    ?>
            	</ul>
            </div>
        </div>
        <div class="section">
            <h2 class="popup-tit">카테고리2</h2>
            <div class="basic-info">
            	<ul class="category-list">
                    <?php 
                    for($i = 0; $i < sql_count($result2); $i++){
                    $row2 = sql_fetch($result2);
                    ?>
                    <li>
                    	<dl>
                    		<dt>카테고리명(국문)</dt>
                    		<dd><?php echo $row2['kor_title']?></dd>
                    	</dl>
                    	<dl>
                    		<dt>카테고리명(영문)</dt>
                    		<dd><?php echo $row2['eng_title']?></dd>
                    	</dl>
                    	<dl>
                    		<dt>상위 카테고리</dt>
                    		<dd><?php echo $row2['upper_cate']?></dd>
                    	</dl>
                    	<!-- <span><?php echo "카테고리: cate".$row2['cate_type']?></span>  -->
                    	<div class="category-btn">
                        	<input type="button" onclick="set_edit('<?php echo $row2['idx']?>');" value="수정">
                        	<input type="button" onclick="form_submit_del(<?php echo $row2['idx']?>)" value="삭제">
                    	</div>
                    </li>
                    <?php
                    }
                    ?>
            	</ul>
            </div>
        </div>
        <div class="section">
            <h2 class="popup-tit">카테고리3</h2>
            <div class="basic-info">
            	<ul class="category-list">
                    <?php 
                    for($i = 0; $i < sql_count($result3); $i++){
                    $row3 = sql_fetch($result3);
                    ?>
                    <li>
                    	<dl>
                    		<dt>카테고리명(국문)</dt>
                    		<dd><?php echo $row3['kor_title']?></dd>
                    	</dl>
                    	<dl>
                    		<dt>카테고리명(영문)</dt>
                    		<dd><?php echo $row3['eng_title']?></dd>
                    	</dl>
                    	<dl>
                    		<dt>상위 카테고리</dt>
                    		<dd><?php echo $row3['upper_cate']?></dd>
                    	</dl>
                    	<!-- <span><?php echo "카테고리: cate".$row3['cate_type']?></span>  -->
                    	<div class="category-btn">
                        	<input type="button" onclick="set_edit('<?php echo $row3['idx']?>');" value="수정">
                        	<input type="button" onclick="form_submit_del(<?php echo $row3['idx']?>)" value="삭제">
                    	</div>
                    </li>
                    <?php
                    }
                    ?>
            	</ul>
            </div>
        </div>
        <div class="section">
            <h2 class="popup-tit">카테고리4</h2>
            <div class="basic-info">
            	<ul class="category-list">
                    <?php 
                    for($i = 0; $i < sql_count($result4); $i++){
                    $row4 = sql_fetch($result4);
                    ?>
                    <li>
                    	<dl>
                    		<dt>카테고리명(국문)</dt>
                    		<dd><?php echo $row4['kor_title']?></dd>
                    	</dl>
                    	<dl>
                    		<dt>카테고리명(영문)</dt>
                    		<dd><?php echo $row4['eng_title']?></dd>
                    	</dl>
                    	<dl>
                    		<dt>상위 카테고리</dt>
                    		<dd><?php echo $row4['upper_cate']?></dd>
                    	</dl>
                    	<!-- <span><?php echo "카테고리: cate".$row4['cate_type']?></span>  -->
                    	<div class="category-btn">
                        	<input type="button" onclick="set_edit('<?php echo $row4['idx']?>');" value="수정">
                        	<input type="button" onclick="form_submit_del(<?php echo $row4['idx']?>)" value="삭제">
                    	</div>
                    </li>
                    <?php
                    }
                    ?>
            	</ul>
            </div>
        </div>
        
        <!-- 수정 -->
        <div class="dim-wrap">
        	<div class="dim-layer basic-info">
        		<h2>카테고리 수정</h2>
                <form id="productCateForm" name="productCateForm" action="product_cate_proc.php" method="post">
                	<input type="hidden" id="choose" name="choose">
                	<input type="hidden" name="idx">
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
                	<div class="btn-wrap">
                		<input type="button" value="수정" onclick="form_submit('edit');">
                		<button type="button" class="close-btn" onclick="dimHide();">닫기</button>
                	</div>
                </form>
            </div>
        </div>
        <!-- 수정 끝 -->
    </div>
    <!-- 리스트 끝 -->
</body>
</html>
