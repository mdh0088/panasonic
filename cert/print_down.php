<!DOCTYPE html>
<?php
require_once("./include/init.php"); //페이지 include

$idx = $_REQUEST['print_idx'];
//echo $idx;
$query = "select * from h_cert where idx = {$idx}";
$result = sql_query($query);
$row = sql_fetch($result);

?>
<html>
<head>
<title>PANASONIC</title>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
function afterPrint()
{
// 	self.close();
}
$(document).ready(function(){
    window.print();
    window.onafterprint = afterPrint();
})
</script>
</head>
<body>
<img src="/cert/file/<?php echo $row['filename1']?>" alt="" class="contents-thumbnail" style="max-width: 210mm;max-height:297mm;">
</body>
</html>