<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<script>
function form_submit(act)
{
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
<table border="1">
	<tr>
		<td>
			<input type="text" name="award_title" placeholder="수상명"><br><!-- 수상명 -->
			<input type="text" name="award_from" placeholder="수상처(받은곳)"><br><!-- 수상처 -->
			<input type="text" name="award_when" placeholder="받은일자"><br><!-- 받은일자 -->
			이미지 : <input type="file" name="award_img[]"><!-- 다운로드 -->
		</td>
	</tr>
	<tr>
		<td>
			상세내용<br>
			<textarea name="award_conts"></textarea><!-- 상세내용 -->
		</td>
	</tr>
</table>

<div id="layer_div">

</div>

<input type="button" value="작성" onclick="form_submit();">
</form>