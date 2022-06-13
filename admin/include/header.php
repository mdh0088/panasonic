  <?php
session_start();

require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );

$user = new WP_User(get_current_user_id());

if($user->roles[0]==""){?>

	<script>
	//	alert("로그인을 먼저해 주세요.");
	//	location.href="http://pessda.panasonic.co.kr/thanks";
	</script>

<?//exit;
}
?>
<!doctype HTML>
<html>
<head>
<link rel="stylesheet" media="all" href="/admin/css/admin.css">
<script src="/admin/js/jquery-1.11.3.min.js"></script>
<script src="https://malsup.github.io/min/jquery.form.min.js"></script>
 
<script>
	window.onload = function(){
		getUrl();
	}
 function getUrl(){
	var u = window.location.href.split('admin/');
	$('#gnb a').each(function(){
		var link = $(this).attr('href');
		if(link.indexOf(u[1]) > -1){
			$(this).parent().addClass('on');
		}
	});
 }
</script>
</head>
<body>
<?php 
// if(!isset($_SESSION['login_id']))
// {
//     echo "<script>location.replace('/admin/login.php');</script>";
//     exit;
// }
?>
<!-- 
<a href="/admin/logout.php" style="color:red; font-size: 16px;  height:45px; line-height:45px;" >로그아웃</a></li>
 -->

<div id="header" class="header-wr">
	<div class="container">
    	<div class="logo">
    		<a href="/admin/product_list.php"><img src="/wp-content/uploads/2019/10/logo.png" alt="메인 로고"></a>
    	</div>
    	<ul id="gnb">
    		<li><A href="/admin/product_list.php">제품 관리</a></li>
    		<li><A href="/admin/kmew_list.php">KMEW 관리</a></li>
    		<li><A href="/admin/product_banner_list.php">배너 관리</a></li>
    		<li><A href="/admin/cert_list.php">인증서 관리</a></li>
    		<li><A href="/admin/customer/customer_list.php">영업지점 관리</a></li>
    	</ul>
	</div>
</div>