<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/admin/include/init.php");
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
$query = "SELECT * FROM customer WHERE 1";
# 검색 #
if(isset($_POST['search_name']) && $_POST['search_name'] != null && $_POST['search_name'] != "")
{
    if(isset($_POST['search_cate']) && $_POST['search_cate'] != null && $_POST['search_cate'] != ""){
        $query .= " AND {$_POST['search_cate']} LIKE '%{$_POST['search_name']}%'";
    }else{
        $query .= " AND (customer_name LIKE '%{$_POST['search_name']}%'
                    OR customer_area LIKE '%{$_POST['search_name']}%'
                    OR customer_phone LIKE '%{$_POST['search_name']}%'
                    OR customer_fax LIKE '%{$_POST['search_name']}%')";
    }
}
else if(isset($_GET['cateArea']) && $_GET['cateArea'] != null && $_GET['cateArea'] != "")
{
    $query .= " AND customer_area = '{$_GET['cateArea']}'";
}

$result = sql_query($query);
?>
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
	if (excel_idx_arr.length <= 2) {
		alert('지점을 선택해주세요.');
		return;
	}
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
		$("#customerForm").submit();
	}
	else if(act == 'area')
	{
		$("#customerFormCate").submit();
	}
}
//카테고리 선택시 value 유지
$(document).ready(function(){
	$("select option[value='<?php echo $_GET['cateArea']?>']").attr("selected", true);
});


function file_change(idx){
	var file_name = $(idx).val();
	file_name = file_name.split('\\');
	file_name = file_name[file_name.length-1];
	$('#upload-name').val(file_name);
}
</script>
<div id="main" class="container">
	<div class="search">
        <form id="customerForm" name="customerForm" method="post" action="customer_list.php">
        	<select id="search_cate" name="search_cate">
        		<option value="">전체</option>
        		<option value="customer_name">회사명</option>
        		<option value="customer_addr">주소</option>
        	</select> 
        	<input type="text" id="search_name" name="search_name" placeholder="검색">
        	<input type="button" value="검색" onclick="reSelect('search');">
        </form>
    </div>
    <div class="category">
    	<div class="btn-wrap excel">
            <input type="button" value="선택 지점 엑셀 다운로드" onclick="downloadExcel()">
            <form id="excelForm" name="excelForm" method="post" action="customer_excel.php" enctype="multipart/form-data">
            	<label class="upload-label">엑셀업로드<input type='file' name='upload[]' id='upload' onchange="file_change(this);"></label>
            	<input type="text" id="upload-name" value="파일 선택" readonly>
            	<input type="button" class="upload-save" value="저장" onclick="excel_submit()">     		
            </form>
    	</div>
    </div>
    <div class="clearfix">
		<p class="sort-result">총 <strong><?php echo sql_count($result)?></strong>개의 결과가 있습니다.</p>
		<div class="btn-wrap">
            <form id="customerFormCate" name="customerFormCate" method="get" action="customer_list.php">
            	<select id="cateArea" name="cateArea" class="cate" onchange="reSelect('area');"><!-- 지역 -->
            		<option value="">모든지역</option>
            		<option value="서울">서울</option>
            		<option value="인천">인천</option>
            		<option value="경기">경기</option>
            		<option value="강원">강원</option>
            		<option value="충북">충북</option>
            		<option value="충남">충남</option>
            		<option value="대전">대전</option>
            		<option value="전북">전북</option>
            		<option value="전남">전남</option>
            		<option value="광주">광주</option>
            		<option value="경북">경북</option>
            		<option value="경남">경남</option>
            		<option value="대구">대구</option>
            		<option value="울산">울산</option>
            		<option value="부산">부산</option>
            		<option value="제주">제주</option>
            	</select>
            </form>
            <a href="javascript:winOpen('customer.php');" class="new-btn"><input class="blue" type="button" value="신규작성"></a>
		</div>
    
    </div>
    
    <table border="1">
    	<tr>
    		<td><input type="checkbox" onclick="javascript:chk();" id="allChk"></td>
    		<td>회사명</td>
    		<td>지역</td>
    		<td>주소</td>
    		<td>구글맵 링크</td>
    		<td>전화</td>
    		<td>팩스</td>
    	</tr>
    	<?php 
    	for($i = 0; $i < sql_count($result); $i++){
    	    $row = sql_fetch($result);
    	?>
    	<tr>
    		<td><input type="checkbox" class="check num<?php echo ($i+1)?>" value="<?php echo $row['idx']?>"></td>
    		<td><a href="javascript:winOpen('customer_edit.php?idx=<?php echo $row['idx']?>');"><?php echo $row['customer_name']?></a></td>
    		<td><?php echo $row['customer_area']?></td>
    		<td><?php echo $row['customer_addr']?></td>
    		<td><a class="normal-link" href="https://www.google.co.kr/maps/search/<?php echo $row['customer_addr']?>%20<?php echo $row['customer_name']?>" target="_blank">링크(새창보기)</a></td>
    		<td><?php echo $row['customer_phone']?></td>
    		<td><?php echo $row['customer_fax']?></td>
    	</tr>
    	<?php
    	}
    	?>
    </table>
    <form id="exceldownForm" name="exceldownForm" method="post" action="./customer_excel_down.php" enctype="multipart/form-data">
        <input type="hidden" id="excel_idx" name="excel_idx" value="">
    </form>
</div>