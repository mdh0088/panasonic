<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/header.php");
$query ="select * from h_cert where isDel='0' order by idx";
$result = sql_query($query);
?>

<!doctype HTML>
<html>
<head>
<link rel="stylesheet" media="all" href="/admin/css/admin.css">
<script src="/admin/js/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
<link rel="stylesheet" href="/admin/include/css/admin.css">

<script>

function winOpen(url)
{
    var name = "popup";
    var option = "width = 800, height = 800, top = 10, left = 200, location = no, scrollbars=yes";
    window.open(url, name, option);
}
</script>

</head>
<body>
    <div id="main" class="container">
    	<div class="search">
    		<h1>인증서 관리</h1>
    	</div>
        <div class="btn-wrap">
        	<a href="javascript:winOpen('cert_write.php');" class="new-btn"><input class="blue" type="button" value="인증서 등록"></a>
        </div>
    	
    	<table border="1">
    		<tr>
    			<td>No</td>
    			<td>인증서명</td>
    			<td>인증제품</td>
    			<td>내용</td>
    			<td>파일이름</td>
    		<tr>
    		
    		<?php 
    		for ($i = 0; $i < sql_count($result); $i++) {
    		    $row = sql_fetch($result);
    		?>
    		<tr>
    			<td><?php echo $i+1?></td>
    			<td><a href="javascript:winOpen('cert_edit.php?idx=<?php echo $row['idx']?>');"><?php echo $row['title']?></a></td>
    			<td><a href="javascript:winOpen('cert_edit.php?idx=<?php echo $row['idx']?>');"><?php echo $row['col1']?></a></td>
    			<td><?php echo $row['contents']?></td>
    			<td><?php echo $row['filename1']?></td>
    		</tr>
    		<?php 
    		}	
    		?>
    	</table>
    </div>
</body>
</html>