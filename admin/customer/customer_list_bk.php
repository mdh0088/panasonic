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
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<script type="text/javascript">
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
$(document).ready(function(){
	$("select option[value='<?php echo $_GET['cateArea']?>']").attr("selected", true);
});

</script>
<form id="customerForm" name="customerForm" method="post" action="customer_list.php">
	<select id="search_cate" name="search_cate">
		<option value="customer_name">회사명</option>
		<option value="customer_addr">주소</option>
	</select> 
	<input type="text" id="search_name" name="search_name" placeholder="검색">
	<input type="button" value="검색" onclick="reSelect('search');">
</form>
총 <?php echo sql_count($result)?>개의 결과가 있습니다.
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
<a href="javascript:winOpen('customer.php');"><input type="button" value="신규작성"></a>

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
		<td><a href="https://www.google.co.kr/maps/search/<?php echo $row['customer_addr']?>%20<?php echo $row['customer_name']?>" target="_blank">링크</a></td>
		<td><?php echo $row['customer_phone']?></td>
		<td><?php echo $row['customer_fax']?></td>
	</tr>
	<?php
	}
	?>
</table>