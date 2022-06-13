<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$query = "SELECT * FROM customer WHERE idx = {$_GET['idx']}";
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
function form_submit(act)
{
	if(act == 'edit'){
		console.log("수정 실행");
		$('#choose').val('edit');
	}
	if(act == 'del'){
		var yn = confirm("삭제하시겠습니까?");
		if(!yn){
			alert("취소되었습니다.");
			return;
		}
		console.log("삭제 실행");
		$('#choose').val('del');
	}

	$("#customerForm").ajaxSubmit({
		success : function(data)
		{
			console.log(data);
			var result = JSON.parse(data);
			if(result.isSuc == "success")
			{
				alert(result.msg);
				opener.document.location.reload();
				self.close();
			}
			else
			{
				alert(result.msg);
			}
		}
	});
}
//select 초기값
$(document).ready(function(){
	$("select option[value='<?php echo $row['customer_area']?>']").attr("selected", true);
});
</script>
</head>
<body>
    <div id="product-new" class="popup-wrap">
    	<h1>영업지점 수정</h1>
        <form id="customerForm" name="customerForm" action="customer_proc.php" method="post">
        	<input type="hidden" id="idx" name="idx" value="<?php echo $row['idx']?>">
        	<input type="hidden" id="choose" name="choose">
            <div class="section">
            	<div class="basic-info">
        			<dl>
        				<dt>회사명</dt>
        				<dd><input type="text" name="customer_name" placeholder="회사명" value="<?php echo $row['customer_name']?>"></dd>
        			</dl>
        			<dl>
        				<dt>지역</dt>
        				<dd>
            				<select id="customer_area" name="customer_area" class="cate" ><!-- 지역 -->
                				<option value="">지역선택</option>
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
						</dd>
        			</dl>
        			<dl>
        				<dt>주소</dt>
        				<dd><input type="text" name="customer_addr" placeholder="주소" value="<?php echo $row['customer_addr']?>"></dd>
        			</dl>
        			<dl>
        				<dt>전화</dt>
        				<dd><input type="text" name="customer_phone" placeholder="전화" value="<?php echo $row['customer_phone']?>"></dd>
        			</dl>
        			<dl>
        				<dt>팩스</dt>
        				<dd><input type="text" name="customer_fax" placeholder="팩스" value="<?php echo $row['customer_fax']?>"></dd>
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
