<?php 
require_once($_SERVER['DOCUMENT_ROOT']. "/admin/include/init.php");

$idx = 0;
if(isset($_GET['idx']))
{
    $idx = $_GET['idx']; 
}
else if(isset($_POST['idx']))
{
    $idx = $_POST['idx'];
}
$query = "SELECT * FROM award WHERE 1";
# 검색 #
if(isset($_POST['search_name']) && $_POST['search_name'] != null && $_POST['search_name'] != "")
{
    $query .= " AND (award_title LIKE '%{$_POST['search_name']}%' OR award_from LIKE '%{$_POST['search_name']}%')";
}

$result = sql_query($query);
?>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<script type="text/javascript">
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

//체크박스
function chk()
{
	if(document.getElementById("allChk").checked == true)
	{
		$(".check").prop("checked", true);
	}
	else
	{
		$(".check").prop("checked", false);
	}
}
//신규작성시 팝업
function winOpen(url)
{
	var name = "popup";
	var option = "width = 800, height = 800, top = 10, left = 200, location = no, scrollbars = yes";
	window.open(url, name, option);
}
//검색
function reSelect(act)
{
	if(act == 'search')
	{
		$("#awardForm").submit();
	}
}
</script>
<form id="awardForm" name="awardForm" method="post" action="award_list.php">
	<input type="text" id="search_name" name="search_name" placeholder="수상명, 수상처 검색" onkeydown="">
	<input type="button" value="검색" onclick="reSelect('search');">
</form>
총 <?php echo sql_count($result)?>개의 결과가 있습니다.

<a href="javascript:winOpen('award.php');"><input type="button" value="신규작성"></a>
<input type="button" value="엑셀 다운" onclick="downloadExcel()">
<form id="excelForm" name="excelForm" method="post" action="award_excel.php" enctype="multipart/form-data">
	엑셀 업로드 : <input type='file' name='upload[]' id='upload'>
	<input type="button" value="저장" onclick="excel_submit()">     		
</form>

<table border="1">
	<tr>
		<td><input type="checkbox" onclick="javascript:chk();" id="allChk"></td>
		<td>수상명</td>
		<td>수상처</td>
		<td>내용</td>
		<td>수상일</td>
		<td>이미지</td>
	</tr>
	<?php 
	for($i = 0; $i < sql_count($result); $i++){
	    $row = sql_fetch($result);
	?>
	<tr>
		<td><input type="checkbox" class="check num<?php echo ($i+1)?>" value="<?php echo $row['idx']?>"></td>
		<td><a href="javascript:winOpen('award_edit.php?idx=<?php echo $row['idx']?>');"><?php echo $row['award_title']?></a></td>
		<td><?php echo $row['award_from']?></td>
		<td><?php echo $row['award_conts']?></td>
		<td><?php echo $row['award_when']?></td>
		<td><?php echo $row['award_img']?></td>
	</tr>
	<?php
	}
	?>
</table>
<form id="exceldownForm" name="exceldownForm" method="post" action="./award_excel_down.php" enctype="multipart/form-data">
    <input type="hidden" id="excel_idx" name="excel_idx" value="">
</form>