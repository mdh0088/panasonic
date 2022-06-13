<?
require($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");


$filename = $_POST['send_value'];
//$filename = iconv("utf8","euckr",$filename);


$file_dir = $_SERVER['DOCUMENT_ROOT']."/down/".$filename;  

header('Content-Type: application/x-octetstream');
header('Content-Length: '.filesize($file_dir));
header('Content-Disposition: attachment; filename='.iconv("utf8","euckr",$filename));
header('Content-Transfer-Encoding: binary');

$fp = fopen($file_dir, "r");
fpassthru($fp);
fclose($fp);
?>



