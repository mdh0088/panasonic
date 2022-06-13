<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

header('Content-Type: text/html; charset=utf-8');
   
    # 문자열 변환 작업 #
    $customer_name = htmlspecialchars(addslashes($_POST['customer_name']));
    $customer_area = htmlspecialchars(addslashes($_POST['customer_area']));
    $customer_addr = htmlspecialchars(addslashes($_POST['customer_addr']));
    $customer_phone = htmlspecialchars(addslashes($_POST['customer_phone']));
    $customer_fax = htmlspecialchars(addslashes($_POST['customer_fax']));
    
    
    if (!preg_match("/[!#$%^&*()?+=\/]/",$customer_area) )
    {
        ?>
        {
        	"isSuc":"fail",
        	"msg":"잘못된 접근입니다."
        }
        <?php 
        exit;
    }
    
    if (!preg_match("/[!#$%^&*()?+=\/]/",$customer_addr) ) 
    {
        ?>
        {
        	"isSuc":"fail",
        	"msg":"잘못된 접근입니다."
        }
        <?php 
        exit;
    }
    
    
    # 수정 #
    if($_POST['choose'] == "edit")
    {
        $query = "UPDATE customer
        SET
        customer_name = '{$customer_name}',
        customer_area = '{$customer_area}',
        customer_addr = '{$customer_addr}',
        customer_phone = '{$customer_phone}',
        customer_fax = '{$customer_fax}'
        WHERE 
        idx = '{$_POST['idx']}'
        ";
    }
    # 삭제 #
    else if($_POST['choose'] == "del")
    {
        $query = "DELETE FROM customer WHERE idx = '{$_POST['idx']}'";
    }
    # 작성 #
    else
    {
        $query = "INSERT INTO customer
        SET
        customer_name = '{$customer_name}',
        customer_area = '{$customer_area}',
        customer_addr = '{$customer_addr}',
        customer_phone = '{$customer_phone}',
        customer_fax = '{$customer_fax}'
        ";
    }
    sql_query($query);
    ?>
{
	"isSuc":"success",
	"msg":"처리되었습니다."
}