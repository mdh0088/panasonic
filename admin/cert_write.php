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

});






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
    <div id="cert-new" class="popup-wrap">
    	<h1>인증서 신규등록</h1>
		<form id="productCateForm"  name="productCateForm" action="cert_proc.php" method="post" enctype="multipart/form-data">
            <div class="section">
            	<div class="basic-info">
        			<dl>
        				<dt>인증서명</dt>
        				<dd><input type="text" id="cert_title" name="cert_title"></dd>
        			</dl>
        			<dl>
        				<dt>인증 제품</dt>
        				<dd><input type="text" id="cert_kor_title" name="cert_kor_title"></dd>
        			</dl>
        			<dl>
        				<dt>인증서 종류</dt>
        				<dd>
        					<select id="cert_type" name="cert_type">
        						<option value="1">등록증</option>
        						<option value="2">시스템인증</option>
        						<option value="3">KS인증</option>
        						<option value="4">전기용품안전인증</option>
        						<option value="5">자율확인신고증</option>
        						<option value="6">정보통신기기인증</option>
        						<option value="7">기타인증</option>
        					</select>
        				</dd>
        			</dl>
        			<dl>
        				<dt>내용</dt>
        				<dd><textarea id="cert_contents" name="cert_contents"></textarea></dd>
        			</dl>
        			<dl>
        				<dt>파일</dt>
        				<dd><input type="file" id="cert_file" name="cert_file[]"></dd>
        			</dl>
    			</div>
            </div>
            <div class="section btn-wrap">
				<input type="button" class="blue" value="등록" onclick="form_submit();">
        	</div>
		</form>
	</div>
</body>
</html>