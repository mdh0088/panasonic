<!doctype HTML>
<html>
<head>
<link rel="stylesheet" media="all" href="/admin/css/admin.css">
<script src="/admin/js/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<script>
function form_submit(act)
{
	if(!customerForm.customer_name.value || customerForm.customer_name.value == ""){
		alert("회사명은 필수입니다");
		customerForm.customer_name.focus();
		return;
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
</script>
</head>
<body>
    <div id="product-new" class="popup-wrap">
    	<h1>영업지점 신규등록</h1>
		<form id="customerForm" name="customerForm" action="customer_proc.php" method="post">
            <div class="section">
            	<div class="basic-info">
        			<dl>
        				<dt>회사명</dt>
        				<dd><input type="text" name="customer_name" placeholder="회사명"></dd>
        			</dl>
        			<dl>
        				<dt>지역</dt>
        				<dd>
            				<select id="customer_area" name="customer_area" class="cate" ><!-- 지역 -->
                				<option value="" selected="selected">지역선택</option>
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
        				<dd><input type="text" name="customer_addr" placeholder="주소"></dd>
        			</dl>
        			<dl>
        				<dt>전화</dt>
        				<dd><input type="text" name="customer_phone" placeholder="전화"></dd>
        			</dl>
        			<dl>
        				<dt>팩스</dt>
        				<dd><input type="text" name="customer_fax" placeholder="팩스"></dd>
        			</dl>
    			</div>
    		</div>
            <div class="section btn-wrap">
            	<input type="button" class="blue" value="작성" onclick="form_submit();">
            </div>
		</form>
	</div>


</body>
</html>
