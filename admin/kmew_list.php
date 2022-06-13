<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/header.php");

$idx = 0;
if(isset($_GET['idx']))
{
    $idx = $_GET['idx'];
}
else if(isset($_POST['idx']))
{
    $idx = $_POST['idx'];
}

$query="select * from kmew where 1";

if(isset($_POST['search_name']) && $_POST['search_name'] != null && $_POST['search_name'] != "")
{
    $query .= " and (product_title like '%{$_POST['search_name']}%' or idx like '%{$_POST['search_name']}%' or product_model like '%{$_POST['search_name']}%')";
}

if(isset($_POST['sort_type']) && $_POST['sort_type'] != null && $_POST['sort_type'] != "" && isset($_POST['order_by']) && $_POST['order_by'] != null && $_POST['order_by'] != "")
{
    $query .= " order by {$_POST['sort_type']} {$_POST['order_by']}";
}
else
{
    $query .= " order by idx";
}

$result = sql_query($query);
?>


<script>
function chk()
{
    if(document.getElementById("allChk").checked == true)
   	{
    	$(".check").prop("checked",true);
  
   	}
    else
   	{
    	$(".check").prop("checked",false);

   	}    	
}

function winOpen(url)
{
    var name = "popup";
    var option = "width = 800, height = 800, top = 10, left = 200, location = no, scrollbars=yes";
    window.open(url, name, option);
}

function excel_submit()
{
	if($("#upload").val() == '')
	{
		alert("파일이 등록되지 않았습니다.");
		$("#upload").focus();
		return;
	}

	$("#excelForm").ajaxSubmit({
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

function downloadExcel()
{
	var excel_idx=0+'@';
	$(".check").each(function(){
		if ( $(this).prop("checked")) {
			excel_idx =excel_idx+ $(this).val()+'@';
		}
	})
	var excel_idx_arr = excel_idx.split('@');
	
	if (excel_idx_arr.length <= 2) {
		alert('제품을 선택해주세요.');
		return;
	}
	
	for (var i = 1; i < excel_idx_arr.length-1; i++) {
		$('#excel_idx').val($('#excel_idx').val()+excel_idx_arr[i]+'@')
	}
	$("#exceldownForm").submit();
	
	$('#excel_idx').val('');
}

var chk_cnt=0;
function reSelect(act)
{
	if (act=='search') {
		var main_cate = $('.act').attr('id'); //클릭한 주제
		var sub_cate=0+'@';
		$(".subcheck").each(function(){
			if ( $(this).prop("checked")) {
				sub_cate =sub_cate+ $(this).val()+'@';
				chk_cnt = chk_cnt+1;
			}
		})
		
		
		if (chk_cnt==0) {
			$('#sort_cate').val($('#'+main_cate).val());
		}else{
			var sub_cate_arr = sub_cate.split('@');
			for (var i = 1; i < sub_cate_arr.length-1; i++) {
			$('#sort_cate').val($('#sort_cate').val()+sub_cate_arr[i]+'@')
			}
		}
		
	}

	if(act.indexOf("sort_") > -1)
	{
		var sort_type = act.replace("sort_", "");
		$("#sort_type").val(sort_type);

		var order_by = "";
		if($("#"+act).html() == '<img src="./photo/icon_down.png">')
		{
			order_by = "desc";
		}
		else if($("#"+act).html() == '<img src="./photo/icon_up.png">')
		{
			order_by = "asc";
		}
		$("#order_by").val(order_by);		
	}
	$("#productForm").submit();
}



function lec_action(act)
{
	var chk_cnt=0;
	$(".check").each(function(){
		if ( $(this).prop("checked")) {
			chk_cnt++;
		}
	})

	var con = confirm("저장하시겠습니까?");
	if(con)
	{
    	var lec_idx=0+'@';
    	$(".check").each(function(){
    		if ( $(this).prop("checked")) {
    			lec_idx =lec_idx+ $(this).val()+'@';
    		}
    	})
    	var lec_idx_arr = lec_idx.split('@');
    	for (var i = 1; i < lec_idx_arr.length-1; i++) {
    		$('#lec_idx').val($('#lec_idx').val()+lec_idx_arr[i]+'@')
    	}
    
    	$("#lec_action").val(act);
    	$("#lecForm").ajaxSubmit({
        	success: function(data)
        	{
        		var result = JSON.parse(data);
        		if(result.isSuc == "success")
        		{
        			alert(result.msg);
        			window.location.reload();
        		}
        		else
        		{
        			alert(result.msg);
        		}
        	}
        });
	}

}

function file_change(idx){
	var file_name = $(idx).val();
	file_name = file_name.split('\\');
	file_name = file_name[file_name.length-1];
	$('#upload-name').val(file_name);
}

</script>

<div id="main" class="container">
    <div class="search">
        <form id="productForm" name="productForm" method="post" action="product_list.php">
         	<input type="hidden" id="sort_cate" name="sort_cate" value="">
            <input type="hidden" id="sort_type" name="sort_type" value="<?php echo $_POST['sort_type'];?>">
            <input type="hidden" id="order_by" name="order_by" value="<?php echo $_POST['order_by'];?>">
            <input type="text" id="search_name" name="search_name" class="bor-none" placeholder="제품 검색" onkeydown="javascript:enter_check();">
            <input type="button" class="search" value="검색" onclick="reSelect('search');">   
        </form>
    </div>
    <div class="category-btn clearfix">
            <div class="btn-wrap excel">            
				<input type="button" value="선택 제품 엑셀 다운로드" onclick="downloadExcel()">
                <form id="excelForm" name="excelForm" method="post" action="kmew_excel.php" enctype="multipart/form-data">
                	<label class="upload-label">엑셀업로드<input type='file' name='upload[]' id='upload' onchange="file_change(this);"></label>
                	<input type="text" id="upload-name" value="파일 선택" readonly>
                	<input type="button" class="upload-save" value="저장" onclick="excel_submit()">     		
                </form>
            </div>
            <div class="btn-wrap">
                <a href="javascript:winOpen('product_cate_edit.php');"><input type="button" value="카테고리 관리"></a>
                <a href="javascript:winOpen('product_cate_write.php');"><input type="button" value="카테고리 등록"></a>
            </div>
    </div>
    <div class="clearfix">
		<p class="sort-result">총 <strong><?php echo sql_count($result)?></strong>개의 제품이 있습니다.</p>
        <div class="btn-wrap">
        	<a class="new-btn" href="javascript:winOpen('kmew_write.php');"><input type="button" class="blue" value="신규등록"></a>
        </div>

<!-- 
<input class="g-btn" type="button" value="선정 취소" onclick="lec_action('clear')">
<input class="g-btn" type="button" value="추천제품 선정" onclick="lec_action('reco')">
<input class="g-btn" type="button" value="단일제품 선정" onclick="lec_action('specialty')">
 -->
 	</div>

    <table border="1" class="product-list">
    	<colgroup>
    		<!-- <col width="50"> -->
    		<col width="180">
    		<col width="180">
    		<col width="180">
    		<col width="180">
    		<col width="180">
    		<col width="15%">
    		<col>
    	</colgroup>
    	<thead>
        	<tr>
        		<th><input type="checkbox" onclick="javascript:chk();" id="allChk"></th>
        		<th>카테고리1</th> 
        		<th>카테고리2</th> 
        		<th>카테고리3(제목)</th> 
        		<th>카테고리4</th> 
        		<th>카테고리5</th> 
        <!-- 		<th>다운로드 이미지</th> -->
        		<th>썸네일 이미지</th> 
        		<th>모델명</th> 
        		<th>제품명</th> 
        <!-- 		<th>사이즈</th>
        		<th>수량</th>
        		<th>중량</th>
        		<th>레이어타입</th>
        		<th>레이어타이틀</th>
        		<th>레이어본문</th>
        		<th>레이어이미지</th> -->
        	</tr>
    	</thead>
    	<tbody>
    
    	<?php 
    	for ($i = 0; $i < sql_count($result); $i++) {
    	    $row=sql_fetch($result);
    	?>
    		<tr>
    			<td><input type="checkbox" class="check num<?php echo ($i+1)?>" value="<?php echo $row['idx']?>"></td>
        		<td><?php echo $row['product_cate1']?></td> 
        		<td><?php echo $row['product_cate2']?></td> 
        		<td><?php echo $row['product_cate3']?></td> 
        		<td><?php echo $row['product_cate4']?></td>
        		<td><?php echo $row['product_cate5']?></td>
    <!--     		<td><a href=""><img alt="" src="/img/<?php echo $row['product_img']?>"></a></td>  -->  		
        		<td><img alt="" src="/img/product/<?php echo $row['product_thumb']?>" style="width: 100px; height:100px;"></td> 
        		<td><?php echo $row['product_model']?></td> 
        		<td class="text-left name"><a href="javascript:winOpen('kmew_edit.php?idx=<?php echo $row['idx']?>');" ><?php echo $row['product_title'].'/'.$row['product_title_en']?></a></td> 
    <!--     		<td><?php echo $row['product_size']?></td>
        		<td><?php echo $row['product_ea']?></td>
        		<td><?php echo $row['product_weight']?></td>
        		<td><?php echo $row['layer_type']?></td>
        		<td><?php echo $row['layer_title']?></td>
        		<td><?php echo $row['layer_conts']?></td>
        		<td><?php echo str_replace("@","<br>",$row['layer_img'])?></td> -->
    		</tr>
    	<?php 
    	}	
    	?>
    	</tbody>
    </table>
</div>

<form id="exceldownForm" name="exceldownForm" method="post" action="./kmew_excel_down.php" enctype="multipart/form-data">
    <input type="hidden" id="excel_idx" name="excel_idx" value="">
</form>

<form id="lecForm" name="lecForm" method="post" action="./product_action.php" enctype="multipart/form-data">
	<input type="hidden" id="lec_idx" name="lec_idx" value="">
	<input type="hidden" id="lec_action" name="lec_action" value="">
</form>





