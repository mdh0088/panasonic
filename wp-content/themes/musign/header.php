<?php

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    header('Strict-Transport-Security: max-age=31536000');
}

// Adds X-XSS-Protection to HTTP header, so that page prevents XSS



if (isset($_SERVER['HTTP_HOST'])) { // 실제 웹서버에서 접근할 때 적용
    
    
    
    header('X-XSS-Protection:1; mode=block'); // IE8+
    

    
    header('X-Content-Type-Options: nosniff');
    
    
    
    header('Content-Security-Policy: policy');
    
    
    
    header('Cache-Control: no-cache');
    
}





    
    
header('X-Frame-Options:SAMEORIGIN');

	if ( !defined('ABSPATH') ){ die(); }
	
	global $avia_config;

	$style 					= $avia_config['box_class'];
	$responsive				= avia_get_option('responsive_active') != "disabled" ? "responsive" : "fixed_layout";
	$blank 					= isset($avia_config['template']) ? $avia_config['template'] : "";	
	$av_lightbox			= avia_get_option('lightbox_active') != "disabled" ? 'av-default-lightbox' : 'av-custom-lightbox';
	$preloader				= avia_get_option('preloader') == "preloader" ? 'av-preloader-active av-preloader-enabled' : 'av-preloader-disabled';
	$sidebar_styling 		= avia_get_option('sidebar_styling');
	$filterable_classes 	= avia_header_class_filter( avia_header_class_string() );
	$av_classes_manually	= "av-no-preview"; /*required for live previews*/
	$av_classes_manually   .= avia_is_burger_menu() ? " html_burger_menu_active" : " html_text_menu_active";
	
	$uri=getenv("QUERY_STRING");
	
    $chk = 1;
    foreach ($_GET as $uri => $value)
    {       
        if(preg_match("/[!#$%^&*()?+=\/]/",$value)) $chk=0; 
    }
    if ($chk != 1) {
        echo "<script> alert('잘못된 경로입니다.'); location.href='/';</script>";
        exit;
    }

	
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo "html_{$style} ".$responsive." ".$preloader." ".$av_lightbox." ".$filterable_classes." ".$av_classes_manually ?> ">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
/*
 * outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
 * located in framework/php/function-set-avia-frontend.php
 */
 if (function_exists('avia_set_follow')) { echo avia_set_follow(); }

?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="/wp-content/themes/musign/js/animation.js"></script>
<link rel="stylesheet" href="/wp-content/themes/musign/css/animation.css">
<script src="/wp-content/themes/musign/js/owl.carousel.min.js"></script>
<link rel="stylesheet" href="/wp-content/themes/musign/js/owl.carousel.min.css">
<script src="/wp-content/themes/musign/js/masonry.pkgd.min.js"></script>



<script>

var lang = '<?php echo $_GET['lang']?>';
	(function($) { 
 		$(function() {
 	 		$(document).ready(function(){
 	 	 		//헤더 메뉴 삽입
 	 	 		if (lang=='en') {
					$('li#menu-item-search').before('<li id="menu-language" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-top-level menu-item-top-level-5"><a href="/">한국어</a></li>');
				}else{
     	 	 		$('li#menu-item-search').before('<li id="menu-language" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-top-level menu-item-top-level-5"><a href="/?lang=en">English</a></li>');
				}
 				
 	 	 		$('html:lang(ko-KR) #top #menu-item-search .avia_hidden_link_text').text('검색');
 	 	 		//$('li#menu-item-search').after('<li id="global" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-top-level menu-item-top-level-5"><a href="https://www.panasonic.com/global/" target="_blank">Panasonic Global</a></li>');

				//메인 제품 검색
				$('.search-box > div').on('click mouseenter', function(){
					var list = $(this).next('ul');
					var box = $(this).parent();
					if(!box.hasClass('act')){
						$('.search-box').removeClass('act');
						$('.search-box > div + ul').slideUp(200);
    					box.addClass('act');
    					list.slideDown(200);
					}
				});
				$(document).on('mouseleave', '.main-search', function(){
					$('.search-box').removeClass('act');
					$('.search-box > div + ul').slideUp(200);
				});

				//서브메뉴 on
				var l = window.location;
				var locationTarget = l.href.replace(l.origin,'');
				$('#sub-top li a').each(function(){
					var at = $(this).attr('href');
					if(locationTarget.indexOf(at) > -1)
						$(this).parent().addClass('on');
				});

				//비전 동영상
				$('#main_player .top_img, #main_player .top_img img').click(function(){
					$('#main_player').addClass('on');
				});

				//환경활동 eco idea 인터랙션
				$('.eco-idea-wrap li').eq(0).addClass('act');
				$('.eco-idea-wrap li').on('mouseover click', function(){
					$('.eco-idea-wrap li').removeClass('act');
					$(this).addClass('act');
				});

				//load more 텍스트 바꿈
				$('.av-masonry-pagination').text('view');

				//인증서 작동
				var certLoadNum = 4; //공개할 때 단위
				$('#cert-sec02 .av-layout-tab').each(function(){
					var column = $(this).find('.flex_column');
					$(this).find('.flex_column:lt(8)').addClass('on');
					$(this).find('.flex_column:not(".on")').hide();
					if(column.length <= certLoadNum * 2)
						$(this).find('button').hide();
				});
				$('#cert-sec02 button').click(function(){ //view버튼 클릭
					var tab = $(this).closest('.av-layout-tab');
					var viewNum = tab.find('.flex_column.on').length;
					for(i = 0; i < certLoadNum; i++){
						tab.find('.flex_column').eq(viewNum + i).addClass('on').slideDown(800);
					}
					viewNum = tab.find('.flex_column.on').length;
					if(viewNum = tab.find('.flex_column').length)
						$(this).hide();
				});
				

				//제품 인트로 작동
				listLayout();
				function listLayout(){ //Masonry 레이아웃 적용
    				$('#product-list .flex_cell_inner').masonry({
    					itemSelector: '.flex_column'
    				});
				}
				/* $('.depth1 > li > strong').click(function(){ //메뉴 클릭 동작
					var menu = $(this).parent();
					var subMenu = $(this).next('.depth2');
					var box = $(this).closest('.flex_column');
					if(subMenu.length > 0){
						if(menu.hasClass('act')){
							box.removeClass('on');
							subMenu.slideUp(500);
							menu.removeClass('act');
						}else{
							$('#product-list .flex_column').removeClass('on').find('.depth1 > li').removeClass('act').find('.depth2').slideUp(500);
							box.addClass('on');
							subMenu.slideDown(500);
							menu.addClass('act');
						}
					}
					setTimeout(function(){
						listLayout()
					},500); //메뉴 동작으로 크기가 변하므로 레이아웃 재배치
				}); */

				//제품 인트로 작동(수정) 19.11.22

				if($(document).find('#product-list-new').length > 0){
					var cateName = window.location.hash.split('#');
					$('.product-thum-list button').each(function(){
						var i = $(this).parent().index();
						var buttonText = $(this).find('b').text().toLowerCase().replace(/ /gi, "-").replace('&', '-');  
						console.log(i + buttonText);
						$('#product-list-new .flex_column').eq(i).attr('data-hash',buttonText);
					}); 
				}
				$('#product-list-new .flex_cell_inner').addClass('owl-carousel').owlCarousel({
					items:1,
					nav:true,
					dotsContainer:'.product-thum-list ul',
					//animateIn:'fadeIn',
					//animateOut:'fadeOut',
			        URLhashListener:true,
			        startPosition: 'URLHash'
				});
				$('.product-thum-list button strong').click(function(){
					$('#product-list-new .flex_cell_inner.owl-carousel').trigger('to.owl.carousel', [$(this).closest('li').index()]);
				});

 	 		});
 	 		$(window).load(function(){
 	 			scrollAni();
 	 		});
 	 		$(window).scroll(function(){
 	 	 		scrollAni();
 	 		});
 	 		function scrollAni(){
 	 	 		var sTop = $(window).scrollTop();
 	 	 		var h = $(window).height();
 	 	 		//스크롤 애니메이션
 	 	 		$('.av-layout-grid-container, .intro-wrap article, .intro .detail-section').each(function(){
 	 	 	 		var boxTop = $(this).offset().top;
 	 	 	 		if(boxTop - h * 0.6 < sTop){
 	 	 	 	 		$(this).addClass('ani-act');
 	 	 	 		}
 	 	 		});
 	 		}
 	 		
			//메인 슬라이드 스타트
 	 		$(window).load(function(){
 	 	 		setTimeout(function(){
 	 	 			$('#main-sec01 .ls-wp-container').each(function(){
 	 	 	 			$(this).find('.ls-wrapper.ls-in-out').eq(0).addClass('active');
 	 	 			});
 	 	 		},500);
 	 		});
		}); 
		
		$(window).load(function(){
			$(".owl-prev span").text("이전으로");
			$(".owl-next span").text("다음으로");
			$("#menu-item-search > a").attr("title","선택하여 검색해주세요.");
			$("#customer-sec03 .avia-builder-el-14 a").attr("title","파나소닉 코리아 새창으로 이동");
			$("#customer-sec03 .avia-builder-el-19 a").attr("title","파나소닉디바이스 세일즈코리아 새창으로 이동");
		}); 

		$(window).load(function(){
			$(".cate_tab > ul.cate_ul li").each(function(){
				var li = $(this);
				var txt = li.text();
				li.html('<a href="#" title="'+txt+'">'+txt+'</a>');
			});
			$(".cate_tab").each(function(){
				var tit = $(this).find(".c_title");
				var txt02 = tit.text();

				tit.html('<a href="#" title="'+txt02+'">'+txt02+'</a>');
			});

		});

		$(window).ready(function(){
			var $gnbmenu = $(".av-main-nav-wrap > ul > li > a"); 
			var $submenu = $(".av-main-nav-wrap ul.sub-menu > li > a"); 
			var $prodmenu = $(".cate_tab > ul.cate_ul > li > a"); 

			$gnbmenu.removeClass("on"); 
			$submenu.removeClass("on"); 
			$prodmenu.removeClass("on"); 
			
			$gnbmenu.keyup(function(){ 
				$(this).addClass("on"); 
				$gnbmenu.not($(this)).removeClass("on"); 				
			});
			$submenu.keyup(function(){ 
				$(this).addClass("on"); 
				$submenu.not($(this)).removeClass("on"); 				
			});
			$prodmenu.keyup(function(){ 
				$(this).addClass("on"); 
				$prodmenu.not($(this)).removeClass("on"); 				
			});

		});



	} ) ( jQuery);

function actionSubmit(val){
	$("#send_value").val(val);
	$("#actionForm").attr("action", "/wp-content/themes/musign/include/main_down.php");
    $("#actionForm").submit();
}


/*****************************************
 * 팝업 쿠키
 *****************************************/
//1. 쿠키 만들기
	function setCookie(name, value, expiredays) {
	var today = new Date();
	    today.setDate(today.getDate() + expiredays);
 
	    document.cookie = name + '=' + escape(value) + '; path=/; expires=' + today.toGMTString() + ';'
	} 
//2. 쿠키 가져오기
	function getCookie(name) 
	{ 
		var cName = name + "="; 
		var x = 0; 
		var i =0;
		while (i <= document.cookie.length ) 
		{ 
			var y = (x+cName.length); 
			if ( document.cookie.substring( x, y ) == cName ) 
			{ 
				if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 ) 
					endOfCookie = document.cookie.length;
				return unescape( document.cookie.substring( y, endOfCookie ) ); 
			} 
			x = document.cookie.indexOf( " ", x ) + 1; 
			if ( x == 0 ) 
				break; 
		} 
		return ""; 
	} 
 
   window.onload = function(){ 
	   if($('body').hasClass('home')){
		   console.log('aa');
	         var sdate1 = new Date("2021-08-19T09:00:00+09:00");
	         var edate1 = new Date("2021-10-14T23:59:59+09:00");
	         console.log(sdate1, edate1)
	         if(Date.now() >= Date.parse(sdate1)){
				//3. 사용 
					$(window).ready(function(){
						  if(getCookie("notToday")!="Y"){
							$("#main_popup").show('fade');
						} 
					});
				//4. 오늘하루 그만보기
					$(document).on('click', '.close_popup_day', function(){
						var	notToday = getCookie("notToday");
						if(notToday){
							$(this).closest(".main_popup").hide('fade');
						}else{
							setCookie('notToday','Y', 1);
							$(this).closest(".main_popup").hide('fade');
						}
					});
				//5. 그냥닫기
					$(document).on('click', '.event-pop', function(){
						$("#main_popup").hide('fade');
					});

	         }
	         if(Date.now() >= Date.parse(edate1)){
	            $("#main_popup_bg").hide();
	         }

	   }
	   
   }
</script>

<!-- mobile setting -->
<?php

if( strpos($responsive, 'responsive') !== false ) echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
?>


<!-- Scripts/CSS and wp_head hook -->
<?php
/* Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */

wp_head();

?>

<link rel="stylesheet" href="/wp-content/themes/musign/css/mu_layout.css">
<link rel="stylesheet" href="/wp-content/themes/musign/css/responsive.css">
</head>




<body id="top" <?php body_class($style." ".$avia_config['font_stack']." ".$blank." ".$sidebar_styling); avia_markup_helper(array('context' => 'body')); ?>>

<style>
html:lang(en-US) #main_popup_bg, html:lang(en-US) #main_popup_bg02, html:lang(en-US) #main_popup_bg03{
	display:none !important;
}
#main_popup_bg, #main_popup_bg02, #main_popup_bg03{
	display:none;
	position: fixed;
    top:20%;
    left: 8%;
    z-index: 9999999999;
    width: 100%;
    max-width: 470px;
}
#main_popup_bg02{
    /* left:38%; */
    top:9%;
    max-width:none;
}
#main_popup_bg03{
    top:30%; left:60%;
}
.home #main_popup_bg, .home #main_popup_bg02, .page-id-94 #main_popup_bg03{
	display:block;
}
#main_popup a, #main_popup02 a, #main_popup03 a{
    display:block;
    font-size:0;
}
.popup_bottom{
	background: #000;
    padding: 9px 5px 5px;
}
.close_popup_day, .close_popup_day02 , .close_popup_day03{
    font-size: 13px;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    background: url(/img/popup_check.png) left 1px no-repeat;
    background-size: 17px;
    padding-left: 26px;
    margin-left: 7px;
    vertical-align: top;
}
.event-pop, .event-pop02, .event-pop03 {
    position: absolute;
    right: 18px;
    bottom: 9px;
    cursor: pointer;
    padding-right: 20px;
    background: url(/img/popup_close.png) right 2px no-repeat;
    background-size: 14px;
    font-size: 13px;
    color: #fff;
}
#kboard-default-document .kboard-content{
	float:none;
}
@media screen and (max-width:1680px) {
    #main_popup_bg, #main_popup_bg02, #main_popup_bg03{
        max-width:32%;
    }    
    #main_popup_bg02 {
        left: 41%;
    }
}
@media screen and (max-width:989px) {
    #main_popup_bg03{
        max-width:350px;
        left:50%;
    }
}
@media screen and (max-width:767px) {
	#main_popup_bg, #main_popup_bg02, #main_popup_bg03{
		max-width:80%;
		left:10%;
	}
	#main_popup_bg{
		 top: 11%;
	}
	#main_popup_bg02{
		 /* top: 70%; */
	}
	#main_popup_bg02 .main_popup > img{
	   width:100% !important;
	}
	#main_popup_bg03{
		 top: 11%;
	}
}

</style>


<div id="main_popup_bg">
	<div id="main_popup" class="main_popup" style="position: absolute; z-index:10000; display:none; top:20%;">		
		<a href="/notice/?uid=833&mod=document"><img src="/img/popup/notice_211001_popup.jpg" style="width:100%;height:auto;display:block;" alt="인증서 다운로드 서비스 일시 중지 안내"/></a>
		<div class="popup_bottom">
			<span class="close_popup_day">오늘하루 열지 않기</span>
			<div class="event-pop">팝업 닫기</div>			
		</div>
		
	</div> 
</div> 

<ul id="skipNavi">
  <li><a href="#main">본문으로 가기</a></li>
</ul>

	<?php 
		
	if("av-preloader-active av-preloader-enabled" === $preloader)
	{
		echo avia_preload_screen(); 
	}
		
	?>

	<div id='wrap_all'>

	<?php 
	if(!$blank) //blank templates dont display header nor footer
	{ 
		 //fetch the template file that holds the main menu, located in includes/helper-menu-main.php
         get_template_part( 'includes/helper', 'main-menu' );

	} ?>
		
	<div id='main' class='all_colors' data-scroll-offset='<?php echo avia_header_setting('header_scroll_offset'); ?>'>

	<?php 
		
		if(isset($avia_config['temp_logo_container'])) echo $avia_config['temp_logo_container'];
		do_action('ava_after_main_container'); 
		
	?>
