<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$idx = 0;
if(isset($_GET['idx']))
{
    $idx = $_GET['idx'];
}
else if(isset($_POST['idx']))
{
    $idx = $_POST['idx'];
}

$query="select * from product where 1";

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
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
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


</script>
<form id="productForm" name="productForm" method="post" action="product_list.php">
 	<input type="hidden" id="sort_cate" name="sort_cate" value="">
    <input type="hidden" id="sort_type" name="sort_type" value="<?php echo $_POST['sort_type'];?>">
    <input type="hidden" id="order_by" name="order_by" value="<?php echo $_POST['order_by'];?>">
    <input type="text" id="search_name" name="search_name" class="bor-none" placeholder="제품 검색" onkeydown="javascript:enter_check();">
    <input type="button" class="search" value="검색" onclick="reSelect('search');">   
</form>
총 <?php echo sql_count($result)?>개의 제품이 있습니다.


<a href="javascript:winOpen('product.php');"><input type="button" value="신규등록"></a>
<input type="button" value="엑셀 다운" onclick="downloadExcel()">
<form id="excelForm" name="excelForm" method="post" action="product_excel.php" enctype="multipart/form-data">
	엑셀 업로드 : <input type='file' name='upload[]' id='upload'>
	<input type="button" value="저장" onclick="excel_submit()">     		
</form>
<form id="lecForm" name="lecForm" method="post" action="./lec_action.php" enctype="multipart/form-data">
	<input type="hidden" id="lec_idx" name="lec_idx" value="">
	<input type="hidden" id="lec_action" name="lec_action" value="">
</form>
<table border="1">
	<tr>
		<td><input type="checkbox" onclick="javascript:chk();" id="allChk"></td>
		<td>카테고리1</td> 
		<td>카테고리2</td> 
		<td>카테고리3(제목)</td> 
		<td>썸네일 이미지</td> 
		<td>모델명</td> 
		<td>제품명</td> 
		<td>정격</td> 
		<td>사이즈</td>
		<td>인증</td> 
		<td>설명서</td>
		<td>도면</td>
		<td>재퓸이미지</td>
		<td>제품설명</td>
		<td>레이어타입</td>
		<td>레이어타이틀</td>
		<td>레이어본문</td>
		<td>레이어이미지</td>
		<td>추천물품</td>
	</tr>

	<?php 
	for ($i = 0; $i < sql_count($result); $i++) {
	    $row=sql_fetch($result);
	?>
		<tr>
			<td><input type="checkbox" class="check num<?php echo ($i+1)?>" value="<?php echo $row['idx']?>"></td>
    		<td><?php echo $row['product_cate1']?></td> 
    		<td><?php echo $row['product_cate2']?></td> 
    		<td><?php echo $row['product_cate3']?></td> 
    		<td><img alt="" src="/img/<?php echo $row['product_thumb']?>"></td> 
    		<td><?php echo $row['product_model']?></td> 
    		<td><a href="javascript:winOpen('product_edit.php?idx=<?php echo $row['idx']?>');" ><?php echo $row['product_title']?></a></td> 
    		<td><?php echo $row['product_rating']?></td> 
    		<td><?php echo $row['product_size']?></td>
    		<td><?php echo $row['product_auth']?></td> 
    		<td><a href="/manual/<?php echo $row['product_manual']?>"><?php echo $row['product_manual']?></a></td>
    		<td><a href="/map/<?php echo $row['product_map']?>"><?php echo $row['product_map']?></a></td>
    		<td><img alt="" src="/img/<?php echo $row['product_img']?>"></td>
    		<td><?php echo $row['product_info']?></td>
    		<td><?php echo $row['layer_type']?></td>
    		<td><?php echo $row['layer_title']?></td>
    		<td><?php echo $row['layer_conts']?></td>
    		<td><img alt="" src="/img/<?php echo $row['layer_img']?>"></td>
    		<td><?php echo $row['product_reco']?></td>
		</tr>
	<?php 
	}	
	?>
</table>


<form id="exceldownForm" name="exceldownForm" method="post" action="./product_excel_down.php" enctype="multipart/form-data">
    <input type="hidden" id="excel_idx" name="excel_idx" value="">
</form>






