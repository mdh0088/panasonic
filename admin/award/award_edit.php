<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$query = "SELECT * FROM award WHERE idx = {$_GET['idx']}";
$result = sql_query($query);
$row = sql_fetch($result);

?>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<script>
function form_submit(act)
{
	if(act == 'edit'){
		console.log("수정 실행");
		$('#choose').val('edit');
	}
	if(act == 'del'){
		console.log("삭제 실행");
		$('#choose').val('del');
	}

	$("#awardForm").ajaxSubmit({
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

<form id="awardForm" name="awardForm" action="award_proc.php" method="post">
<input type="hidden" id="idx" name="idx" value="<?php echo $row['idx']?>">
<table border="1">
	<tr>
		<td>
			<input type="text" name="award_title" placeholder="수상명" value="<?php echo $row['award_title']?>"><br><!-- 수상명 -->
			<input type="text" name="award_from" placeholder="수상처(받은곳)" value="<?php echo $row['award_from']?>"><br><!-- 수상처 -->
			<input type="text" name="award_when" placeholder="받은일자" value="<?php echo $row['award_when']?>"><br><!-- 받은일자 -->
			이미지 : <input type="file" name="award_img[]"><!-- 다운로드 -->
		</td>
	</tr>
	<tr>
		<td>
			상세내용<br>
			<textarea name="award_conts"><?php echo $row['award_conts']?></textarea><!-- 상세내용 -->
		</td>
	</tr>
</table>

<input type="button" value="수정" onclick="form_submit('edit');">
<input type="button" value="삭제" onclick="form_submit('del');">
<input type="hidden" id="choose" name="choose">
</form>