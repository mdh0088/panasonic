<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
$query = "select * from h_cert where idx = '{$_GET['idx']}'";
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


$(document).ready(function(){
	var cert_type = "<?php echo $row['col3']?>";
	$("#cert_type").val(cert_type);
});


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


function file_change(idx){
	
	var file_name = $(idx).val();
	file_name = file_name.split('\\');
	file_name = file_name[file_name.length-1];

    $('#cert_chk').val(file_name);

}
</script>
</head>
<body>
    <div id="cert-edit" class="popup-wrap">
    	<h1>인증서 수정</h1>
        <form id="productCateForm"  name="productCateForm" action="cert_proc.php" method="post" enctype="multipart/form-data">
        	<input type="hidden" id="idx" name="idx" value="<?php echo $_GET['idx']?>">
        	<input type="hidden" id="choose" name="choose">
            <div class="section">
            	<div class="basic-info">
        			<dl>
        				<dt>인증서명</dt>
        				<dd><input type="text" id="cert_title" name="cert_title" value="<?php echo $row['title']?>"></dd>
        			</dl>
        			<dl>
        				<dt>인증제품</dt>
        				<dd><input type="text" id="cert_kor_title" name="cert_kor_title" value="<?php echo $row['col1']?>"></dd>
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
        				<dd><textarea name="contents"><?php echo $row['contents']?></textarea></dd>
        			</dl>
        			<dl>
        				<dt>파일</dt>
        				<dd>
        					<input type="file" id="cert_file" name="cert_file[]" onchange="file_change(this);"><Br>
            				<input type="text" id="cert_chk" name="cert_chk" value="<?php echo $row['filename1']?>">
        				</dd>
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