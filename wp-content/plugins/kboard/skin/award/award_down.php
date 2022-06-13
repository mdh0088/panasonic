<?
require($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");


$filename = $_POST['send_value'];
$file_real_name = $_POST['real_name'];

$file_dir = $_SERVER['DOCUMENT_ROOT'].$filename;  

header('Content-Type: application/x-octetstream');
header('Content-Length: '.filesize($file_dir));
header('Content-Disposition: attachment; filename='.$file_real_name);
header('Content-Transfer-Encoding: binary');

$fp = fopen($file_dir, "r");
fpassthru($fp);
fclose($fp);
?>