<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once("./include/db.php");


session_start();
function alert($data)
{
    echo "<script>alert('{$data}');</script>";
}
function console($data)
{
    echo "<script>console.log('{$data}');</script>";
}
?>
