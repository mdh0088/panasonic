<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/db.php");

session_start();
sql_query("set names utf8;");
function alert($data)
{
    echo "<script>alert('{$data}');</script>";
}
function console($data)
{
    echo "<script>console.log('{$data}');</script>";
}
?>
