<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/Mobile_Detect.php");

$detect = new Mobile_Detect;

if (isset($_GET['cate1'])) {
    $cate1=$_GET['cate1'];
}


if (isset($_GET['cate3'])) {
    $cate = $_GET['cate3'];
    if (strpos($cate,'@')) {
        $cate = str_replace('@','&',$cate);
    }
}

// if ( $detect->isMobile() ) {
//     $is_mobile ='Y';
// }else{
//     $is_mobile ='N';
// }

$banner_query ="select * from product_banner where cate3 ='{$cate}'";
$banner_result = sql_query($banner_query);
if (sql_count($banner_result) > 1) {
    for ($i = 0; $i < sql_count($banner_result); $i++) {
        $banner_row = sql_fetch($banner_result);
        if ( $detect->isMobile() ) {
            //$is_mobile ='Y';
            $banner .= $banner_row['cate4'].'@'.$banner_row['banner_mo'].'$';
        }else{
            //$is_mobile ='N';
            $banner .= $banner_row['cate4'].'@'.$banner_row['banner'].'$';
        }
   }
}else{
    $banner_row = sql_fetch($banner_result);
    $banner = $banner_row['banner'];
    if ( $detect->isMobile() ) {
        //$is_mobile ='Y';
        $banner = $banner_row['banner_mo'];
    }else{
        //$is_mobile ='N';
        $banner = $banner_row['banner'];
    }
}


// if (isset($_GET['cate2'])) {
//     $cate = $_GET['cate2'];
// }
// if (isset($_GET['cate1'])) {
//     $cate = $_GET['cate1'];
// }

if ($cate1 == 'KMEW') {
    $query="select * from kmew where product_cate3 ='{$cate}' limit 1";
}else{
    $query="select * from product where product_cate3 ='{$cate}' limit 1";
}

$result = sql_query($query);
$row = sql_fetch($result);


$arr_layer_type = explode('@', $row['layer_type']);
$arr_layer_title = explode('@', $row['layer_title']);
$arr_layer_conts = explode('@', $row['layer_conts']);
$arr_layer_img = explode('@', $row['layer_img']);


if ($cate1 == 'KMEW') {
    $cate4_query = "SELECT DISTINCT product_cate4 FROM kmew WHERE product_cate3 ='{$row['product_cate3']}' AND product_cate4 != '' ";
    $first_cate4_query = "SELECT DISTINCT product_cate4 FROM kmew WHERE product_cate3 ='{$row['product_cate3']}' AND product_cate4 != '' ";
}
else{
    $cate4_query = "SELECT DISTINCT product_cate4 FROM product WHERE product_cate3 ='{$row['product_cate3']}' AND product_cate4 != '' ";
    $first_cate4_query = "SELECT DISTINCT product_cate4 FROM product WHERE product_cate3 ='{$row['product_cate3']}' AND product_cate4 != '' ";
}
$cate4_result = sql_query($cate4_query);

$first_cate4_result = sql_query($first_cate4_query);
$first_cate4_row= sql_fetch($first_cate4_result);

$first_cate3 = $row['product_cate3'];
$first_cate4 =$first_cate4_row['product_cate4'];

// $main_thumb = preg_replace('/\r\n|\r|\n/','',$row['product_thumb']);
// $main_model =  preg_replace('/\r\n|\r|\n/','',$row['product_model']);
// $main_title = preg_replace('/\r\n|\r|\n/','', $row['product_title']);
// $main_rating = preg_replace('/\r\n|\r|\n/','',$row['product_rating']);
// $main_size =  preg_replace('/\r\n|\r|\n/','',$row['product_size']);
// $main_auth =  preg_replace('/\r\n|\r|\n/','',$row['product_auth']);
// $main_manual =  preg_replace('/\r\n|\r|\n/','',$row['product_manual']);
// $main_map_1 =  preg_replace('/\r\n|\r|\n/','',$row['product_map_1']);
// $main_map_2 =  preg_replace('/\r\n|\r|\n/','',$row['product_map_2']);



if (isset($_GET['idx'])) {
    $idx=$_GET['idx'];
}else{
    $idx=0;
}

if(isset($_GET['indi']) && $_GET['indi']=='O') {
    $chk_indi=$_GET['indi'];
}else{
    $chk_indi='X';
}
?>
<script>



var first_cate3 = '<?php echo $first_cate3?>';
var first_cate4 = '<?php echo $first_cate4?>';

//var main_thumb_arr = '<?php //echo $main_thumb?>';
// main_thumb_arr = main_thumb_arr.split('@');

//var main_model_arr = '<?php //echo $main_model?>';

// main_model_arr = main_model_arr.split('@');

//var main_title_arr = '<?php //echo $main_title?>';
// main_title_arr = main_title_arr.split('@');

//var main_rating_arr = '<?php //echo $main_rating?>';
// main_rating_arr = main_rating_arr.split('@');

//var main_size_arr = '<?php //echo $main_size?>';
// main_size_arr = main_size_arr.split('@');

//var main_auth_arr = '<?php //echo $main_auth?>';
// main_auth_arr = main_auth_arr.split('@');

//var main_manual_arr = '<?php //echo $main_manual?>';
// main_manual_arr = main_manual_arr.split('@');

//var main_map_1_arr = '<?php //echo $main_map_1?>';
// main_map_1_arr = main_map_1_arr.split('@');

//var main_map_2_arr = '<?php //echo $main_map_2?>';
// main_map_2_arr = main_map_2_arr.split('@');

var get_cate1='<?php echo $_GET['cate1']?>';
var get_cate2='<?php echo $_GET['cate2']?>';
var get_cate3='<?php echo $cate?>';

var cate1_url='';
var cate2_url='';
var cate3_url='';
var img_width=0;
var img_height=0;
var now_banner ="";
var banner = '<?php echo $banner?>';
var confirm_indi = '<?php echo $row['product_indi']?>';

var img_chk="";
var manual_chk="";
var map_1_chk="";
var map_2_chk="";
var auth_chk="";

var get_idx='<?php echo $idx?>';
var get_indi='<?php echo $chk_indi?>';


var kmew_chk = '<?php echo $row['product_cate1']?>';

(function($) { 
$(document).ready(function(){

	
	

	pop_close();
	
	
	$('.tab03').hide();
	$('.tab04').hide();
	

// 	$('.main_title').text(main_title_arr[0]);
// 	$('.main_model').text(main_model_arr[0]);
// 	$('.main_rating').text(main_rating_arr[0]);
// 	$('.main_size').text(main_size_arr[0]);
// 	$('.main_auth').text(main_auth_arr[0]);

// 	$('.main_thumb').attr('href','/img/product/'+main_thumb_arr[0]);
// 	$('.main_manual').attr('href','/img/product_manual/'+main_manual_arr[0]);
// 	$('.main_map_pdf').attr('href','/img/product_map/'+main_map_2_arr[0]);
// 	$('.main_map_dwg').attr('href','/img/product_map/'+main_map_1_arr[0]);
// 	$('.main_auth_file').attr('href',main_auth_arr[0]);
	if (confirm_indi=="O") {
		getindi(first_cate3,first_cate4);
	}else{
    	getData(first_cate3,first_cate4);
	}

//	$('.cate01.baesun').trigger('click');
// 	$('.cate2.series').trigger('click');
	
// 	var cate3_class = "";
	if (get_cate1.indexOf('@')!=-1) {
		get_cate1=get_cate1.replace('@','&');
	}

	if (get_cate2.indexOf('@')!=-1) {
		get_cate2=get_cate2.replace('@','&');
	}
	$('.cate1').each(function(){ 
		if ($(this).text()==get_cate1) {
			get_cate1 = $(this).attr('class').split(" ");
			show(2,get_cate1[1],this);
			
		}
	})
	

	$('.cate2').each(function(){ 
		if ($(this).text()==get_cate2) {
			$('.tab03').show();
			get_cate2_arr = $(this).attr('class').split(" ");	
			$(".cate1."+get_cate2_arr[1]+"").trigger('click');
			$(this).trigger('click');
			//show(2,get_cate2[1],this)
			$('.cate1_ul').hide();;
			$('.cate2_ul').hide();
		}
	})
	
	$('.cate3').each(function(){  
		if ($(this).text()==get_cate3) {
			$('.tab04').show();
			choose_cate(get_cate3,this);//act파라메터가 없어서 그냥 카테고리3의 text바꾸기용
		}
	})
	
	//팝업 외의 영역 클릭 시 팝업 종료
	$('#product-popup').click(function(e){
		if($(e.target).is('#product-popup'))
			pop_close();
	});
	//alert(cate3_class[0]);
	//$("."+cate3_class[0]+"."+cate3_class[1]+"").trigger('click');
	
});
} ) ( jQuery);

(function($) { 
$(window).load(function(){
    	if (get_idx > 0 && get_indi=='X') {
    		pop_up(get_idx,kmew_chk);
    	}
	});
}) (jQuery);

function pop_close(){
	$('#product-popup').hide();
}

function file_down(file,directory){
	
	if (file.indexOf('&')!=-1) {
		file= file.replace('&','@');
	}
	$.ajax({
		type : "GET", //전송방식을 지정한다 (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/file_down.php?filename="+encodeURI(file)+"&directory="+encodeURI(directory),//호출 URL을 설정한다. GET방식일경우 뒤에 파라티터를 붙여서 사용해도된다.
		dataType : "text",//호출한 페이지의 형식이다. xml,json,html,text등의 여러 방식을 사용할 수 있다.
		error : function() 
		{
			alert("통신 중 오류가 발생하였습니다.");
		}, 
		success : function(data) 
		{
			console.log(data);
		}
	});
}

function pop_up(idx,kmew_chk){
	$('#product-popup').show();
	

	$.ajax({
		type : "GET", //전송방식을 지정한다 (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/get_pop_contents.php?idx="+encodeURI(idx)+"&kmew_chk="+encodeURI(kmew_chk),//호출 URL을 설정한다. GET방식일경우 뒤에 파라티터를 붙여서 사용해도된다.
		dataType : "text",//호출한 페이지의 형식이다. xml,json,html,text등의 여러 방식을 사용할 수 있다.
		error : function() 
		{
			alert("통신 중 오류가 발생하였습니다.");
		}, 
		success : function(data) 
		{
			$(".pop_contents").empty();
			$(".pop_img").empty();
			var result = JSON.parse(data);

			
			img_width = result[0].img_width;
			img_height = result[0].img_height;

    			var cate = result[0].product_cate3;
    			if (result[0].product_cate3 =='' || result[0].product_cate3 ==null) {
    				cate = result[0].product_cate2;
    			}
    
    			if (result[0].product_cate2 =='' || result[0].product_cate2 ==null) {
    				cate = result[0].product_cate1;
    			}
    
    			if (img_width==img_height) {
    				$("#pop_thumbnail").removeClass();
    				$("#pop_thumbnail").addClass("thumbnail");
    			}else if (img_width-img_height > 0) {
    				$("#pop_thumbnail").removeClass("vertical");
    				$("#pop_thumbnail").addClass("horizontal");
    			}else if (img_width-img_height < 0) {
    				$("#pop_thumbnail").removeClass("horizontal");
    				$("#pop_thumbnail").addClass("vertical");
    			}
    			
			if (kmew_chk!='KMEW') {	
    			img_chk=result[0].product_img;
    			manual_chk=result[0].product_manual;
    			map_1_chk=result[0].product_map_1;
    			map_2_chk=result[0].product_map_2;
    			auth_chk=result[0].product_auth;
    			
    			chk_length = img_chk.length + manual_chk.length + map_1_chk.length + map_2_chk.length + auth_chk.length;
    			
    			inner = "<li>";
    			inner +="<img src='/img/product/"+result[0].product_thumb+"' alt='product photo'></li>";
    			$('.pop_img').append(inner);
    			
    			inner = "<h2 class=''>"+cate+"<strong>"+result[0].product_model+"</strong></h2>";
    			inner += "<dl>";
    			inner += "<dt>Model Name</dt>";
    			inner += "<dd>"+result[0].product_model+"</dd>";
    			inner += "</dl>";
    
    			inner += "<dl>";
    			inner += "<dt>Product Name</dt>";
    			inner += "<dd>"+result[0].product_title+"</dd>";
    			inner += "</dl>";
    
    			inner += "<dl>";
    			inner += "<dt>Rating</dt>";
    			inner += "<dd>"+result[0].product_rating+"</dd>";
    			inner += "</dl>";
    
    			inner += "<dl>";
    			inner += "<dt>Size</dt>";
    			inner += "<dd>"+result[0].product_size+"</dd>";
    			inner += "</dl>";
    
    			inner += "<dl>";
    			inner += "<dt>CERTIFICATION</dt>";
    			inner += "<dd>"+result[0].product_auth+"</dd>";
    			inner += "</dl>";
    
    			inner += "<div class='btn'>";
    			if (chk_length<10) {
    				inner += "<a href='javascript:return false;'><i><img src='/img/summary_icon06.png' alt=''></i>자료없음</a>";
    			}else{
    				if (img_chk.indexOf('.png')!=-1 || img_chk.indexOf('.jpg')!=-1 || img_chk.indexOf('.PNG')!=-1 || img_chk.indexOf('.JPG')!=-1) {
    					//inner += "<a href='/img/product/"+result[0].product_thumb+"' download><i><img src='/img/summary_icon01.png' alt=''></i>이미지</a>";
    					inner += "<a onclick='actionSubmit(\""+result[0].product_thumb+"\",\"product\")'><i><img src='/img/summary_icon01.png' alt=''></i>이미지</a>";
    				}
    				if (manual_chk.indexOf('.pdf')!=-1 || manual_chk.indexOf('.jpg')!=-1 || manual_chk.indexOf('.PDF')!=-1 || manual_chk.indexOf('.JPG')!=-1) {
    					//inner += "<a href='/img/product_manual/"+result[0].product_manual+"'download><i><img src='/img/summary_icon02.png' alt=''></i>설명서</a>";
    					inner += "<a onclick='actionSubmit(\""+result[0].product_manual+"\",\"product_manual\")'><i><img src='/img/summary_icon02.png' alt=''></i>설명서</a>";
    				}
    				if (map_1_chk.indexOf('.pdf')!=-1 || map_1_chk.indexOf('.PDF')!=-1) {
            			//inner += "<a href='/img/product_map/"+result[0].product_map_2+"' class='left' download><i><img src='/img/summary_icon03-2.png' alt=''></i><span>도면</span></a>";
            			inner += "<a onclick='actionSubmit(\""+result[0].product_map_2+"\",\"product_map\")'><i><img src='/img/summary_icon03-2.png' alt=''></i><span>도면</span></a>";
            			//inner += "<a href='/img/product_map/"+result[0].product_map_1+"' class='right' download><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
            			inner += "<a onclick='actionSubmit(\""+result[0].product_map_1+"\",\"product_map\")'><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
        			}
    				if (auth_chk!="" && auth_chk!=null) {
    					inner += "<a onclick='imsi();'><i><img src='/img/summary_icon05.png' alt=''></i>인증서</a>";
    					
    				}
    			}
    			inner += "</div>";
			}else{
    			inner = "<li>";
    			inner +="<img src='/img/product/"+result[0].product_thumb+"' alt='product photo'></li>";
    			$('.pop_img').append(inner);
    			
    			inner = "<h2 class=''>"+cate+"<strong>"+result[0].product_model+"</strong></h2>";
    			inner += "<dl>";
    			inner += "<dt>Model Name</dt>";
    			inner += "<dd>"+result[0].product_model+"</dd>";
    			inner += "</dl>";
    
    			inner += "<dl>";
    			inner += "<dt>Product Name</dt>";
    			inner += "<dd>"+result[0].product_title+"</dd>";
    			inner += "</dl>";
    
    			inner += "<dl>";
    			inner += "<dt>Size</dt>";
    			inner += "<dd>"+result[0].product_size+"</dd>";
    			inner += "</dl>";
    			
    			inner += "<dl>";
    			inner += "<dt>Number of sheets per 3.3㎡</dt>";
    			inner += "<dd>"+result[0].product_ea+"</dd>";
    			inner += "</dl>";
    
    
    			inner += "<dl>";
    			inner += "<dt>Weight per sheet</dt>";
    			inner += "<dd>"+result[0].product_weight+"</dd>";
    			inner += "</dl>";

			}
			

			$('.pop_contents').append(inner);
			
			$('.product-summary .owl-carousel').owlCarousel({
				items:1,
				nav:true,
				loop:true
			});
			
			
		}
	});
}

function show(cate,idx,text){

	var cate_title = $(text).text();
	$(text).parent().prev().text(cate_title);
	
	if (cate_title.indexOf('&')!=-1) {
		cate_title= cate_title.replace('&','@');
	}
	if (cate==1) {
		$('.cate3_title').text('제품 구분 선택');
		cate1_url = cate_title;
		$("#product_url").val(product_url);
		$('.tab04').hide();
		
	}
	if (cate==2) {
		$('.cate3_title').text('제품 구분 선택');
		cate2_url = cate_title;
		$("#product_url").val(product_url);
		
	}

	if (idx=='jo_myeong' || idx=='bock_gi' || idx=='smart_baesun' || idx=='si-jang') {
		cate1_url = cate_title;
		$("#product_url").val(product_url);
		$('.tab03').hide();
		$('.tab04').show();
	}else{
		$('.tab0'+(cate+2)).show();
	}
	
	$('.cate'+(cate+1)).hide();
	$('.'+idx).show();


}

function choose_cate(idx,text,act){
	if (idx.indexOf('&')!=-1) {
		idx= idx.replace('&','@');
	}
	var cate_title = $(text).text();
	$(text).parent().prev().text(cate_title);
	

	
	if (act=="act") {
	var lo_link = "http://panasonic.musign.co.kr/product-detail?cate1="+encodeURI(cate1_url)+"&cate2="+encodeURI(cate2_url)+"&cate3=" + encodeURI(idx);
	location.href=lo_link;
	}

}


function getData(cate3,cate4,val){

	
	if (banner!="") {
    	if (banner.indexOf('@')!=-1) {
    		banner_arr = banner.split('$');
     		for (var i = 0; i < banner_arr.length-1; i++) {
     			now_banner  = banner_arr[i];
    			now_banner = now_banner.split('@');
    			if (now_banner[0]==cate4) {
    				$('.banner').attr('src','/img/product_banner/'+now_banner[1]);
    				break;
    			}
     		}
    	}else{
    		$('.banner').attr('src','/img/product_banner/'+banner);
    	}
	}

	
	if (cate3.indexOf('&')!=-1) {
		cate3= cate3.replace('&','@');
	}

	if (cate4.indexOf('&')!=-1) {
		cate4= cate4.replace('&','@');
	}

	
	if (val) {
		$('.btn').removeClass('on');		
	}
	
	$(val).addClass('on');
	$.ajax({
		type : "GET", //전송방식을 지정한다 (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/getCate4.php?cate3="+encodeURI(cate3)+"&cate4="+encodeURI(cate4)+"&kmew_chk="+kmew_chk,//호출 URL을 설정한다. GET방식일경우 뒤에 파라티터를 붙여서 사용해도된다.
		dataType : "text",//호출한 페이지의 형식이다. xml,json,html,text등의 여러 방식을 사용할 수 있다.
		error : function() 
		{
			alert("통신 중 오류가 발생하였습니다.");
		}, 
		success : function(data) 
		{
			
			
			$(".sub_products").empty();
			var result = JSON.parse(data);
			inner = "";
			for (var i = 0; i < result.length; i++) {
				img_width = result[i].img_width;
				img_height = result[i].img_height;

				
				//var thumb_title = result[i].product_thumb;
// 				if (thumb_title.indexOf('png')==-1 && thumb_title.indexOf('jpg')==-1) {
// 				}else{
    				if (img_width===img_height) {
    					inner += "<li>";
					}else if (img_width-img_height > 0) {
						inner += "<li class='horizontal'>";
					}else if (img_width-img_height < 0) {
						inner += "<li class='vertical'>";
					}
					if (kmew_chk!='KMEW') {
    					if (result[i].product_rating.indexOf('http')!=-1) {
    						inner += "<a onclick='location.href=\""+result[i].product_rating+"\"'>";
    					}else{
    	    				inner += "<a onclick='pop_up("+result[i].idx+")'>";
    					}
					}else{
						inner += "<a onclick='pop_up("+result[i].idx+",\""+kmew_chk+"\")'>";
					}
    				inner += "<i><img src='/img/product/"+result[i].product_thumb+"'></i>";
					inner += "<strong>"+result[i].product_title+"</strong>";
    				inner += "</a>";
    				inner += "</li>";
				//}
			}
			$('.sub_products').append(inner);
			

		}
	});
}




var chk_length =0;
function getindi(cate3,cate4,val){

	if (banner!="") {
    	if (banner.indexOf('@')!=-1) {
    		banner_arr = banner.split('$');
     		for (var i = 0; i < banner_arr.length-1; i++) {
     			now_banner  = banner_arr[i];
    			now_banner = now_banner.split('@');
    			if (now_banner[0]==cate4) {
    				$('.banner').attr('src','/img/product_banner/'+now_banner[1]);
    				break;
    			}
     		}
    	}else{
    			$('.banner').attr('src','/img/product_banner/'+banner);
    	}	
	}

	if (cate3.indexOf('&')!=-1) {
		cate3= cate3.replace('&','@');
	}

	if (cate4.indexOf('&')!=-1) {
		cate4= cate4.replace('&','@');
	}
	
	if (val) {
		$('.btn').removeClass('on');		
	}
	$(val).addClass('on');
	
	$.ajax({
		type : "GET", //전송방식을 지정한다 (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/getCate4.php?cate3="+encodeURI(cate3)+"&cate4="+encodeURI(cate4),//호출 URL을 설정한다. GET방식일경우 뒤에 파라티터를 붙여서 사용해도된다.
		dataType : "text",//호출한 페이지의 형식이다. xml,json,html,text등의 여러 방식을 사용할 수 있다.
		error : function() 
		{
			alert("통신 중 오류가 발생하였습니다.");
		}, 
		success : function(data) 
		{
			
			$(".sub_products").empty();
			var result = JSON.parse(data);
			
			inner = "";
			for (var i = 0; i < result.length; i++) {
				img_width = result[i].img_width;
				img_height = result[i].img_height;

				img_chk=result[i].product_img;
				manual_chk=result[i].product_manual;
				map_1_chk=result[i].product_map_1;
				map_2_chk=result[i].product_map_2;
				auth_chk=result[i].product_auth;

				chk_length = img_chk.length + manual_chk.length + map_1_chk.length + map_2_chk.length + auth_chk.length;
				//var thumb_title = result[i].product_thumb;
// 				if (thumb_title.indexOf('png')==-1 && thumb_title.indexOf('jpg')==-1) {
// 				}else{
    				if (img_width===img_height) {
    					inner += "<li class=clearfix>";
					}else if (img_width-img_height > 0) {
						inner += "<li class='clearfix horizontal'>";
					}else if (img_width-img_height < 0) {
						inner += "<li class='clearfix vertical'>";
					}
					inner += "<div class='thumbnail'>";
					inner += "<img src='/img/product/"+result[i].product_thumb+"' alt='product photo'></i>";
					inner += "</div>";

					inner += "<div class='txt'>";
					inner += "<h2>"+result[i].product_model+"</h2>";
					
					inner += "<dl>";
					inner += "<dt>Product Name</dt>";
					inner += "<dd>"+result[i].product_title+"</dd>";
					inner += "</dl>";

					inner += "<dl>";
					inner += "<dt>Rating</dt>";
					inner += "<dd>"+result[i].product_rating+"</dd>";
					inner += "</dl>";

					inner += "<dl>";
					inner += "<dt>Size</dt>";
					inner += "<dd>"+result[i].product_size+"</dd>";
					inner += "</dl>";

					inner += "<dl>";
					inner += "<dt>CERTIFICATION</dt>";
					if (auth_chk.indexOf('@')!=-1) {
						auth_chk_arr=auth_chk.split('@');
						inner += "<dd><img src='/img/ks_mark.png' alt='' style='width:15px; height:15px;'>"+auth_chk_arr[1]+"</dd>";
					}else{
						inner += "<dd>"+auth_chk+"</dd>";
					}
					
					inner += "</dl>";
					inner += "<div class='btn'>";
					//	if (map_chk.indexOf('.pdf')!=-1 || map_chk.indexOf('.PDF')!=-1) {
					//  inner += "<a href='#'><i><img src='/img/summary_icon06.png' alt=''></i>설명서 없음</a>";
					if (chk_length<10) {
						inner += "<a href='javascript:return false;'><i><img src='/img/summary_icon06.png' alt=''></i>자료없음</a>";
					}else{
    					if (img_chk.indexOf('.png')!=-1 || img_chk.indexOf('.jpg')!=-1 || img_chk.indexOf('.PNG')!=-1 || img_chk.indexOf('.JPG')!=-1) {
        					//inner += "<a href='/img/product/"+img_chk+"' download><i><img src='/img/summary_icon01.png' alt=''></i>이미지</a>";
        					inner += "<a onclick='actionSubmit(\""+img_chk+"\",\"product\")'><i><img src='/img/summary_icon01.png' alt=''></i>이미지</a>";
        				}
    					if (manual_chk.indexOf('.pdf')!=-1 || manual_chk.indexOf('.jpg')!=-1 || manual_chk.indexOf('.PDF')!=-1 || manual_chk.indexOf('.JPG')!=-1) {
        					//inner += "<a href='/img/product_manual/"+manual_chk+"' download><i><img src='/img/summary_icon02.png' alt=''></i>설명서</a>";
        					inner += "<a onclick='actionSubmit(\""+manual_chk+"\",\"product_manual\")'><i><img src='/img/summary_icon02.png' alt=''></i>설명서</a>";
        				}
    					if (map_1_chk.indexOf('.pdf')!=-1 || map_1_chk.indexOf('.PDF')!=-1) {
        					//inner += "<a href='/img/product_map/"+map_1_chk+"' class='left' download><i><img src='/img/summary_icon03-2.png' alt=''></i><span>도면</span></a>";
        					inner += "<a onclick='actionSubmit(\""+map_1_chk+"\",\"product_map\")'><i><img src='/img/summary_icon03-2.png' alt=''></i><span>도면</span></a>";
        					//inner += "<a href='/img/product_map/"+map_2_chk+"' class='right' download><i><img src='/img/summary_icon04-2.png' alt=''></i>이미지</a>";
        					inner += "<a onclick='actionSubmit(\""+map_2_chk+"\",\"product_map\")'><i><img src='/img/summary_icon04-2.png' alt=''></i>이미지</a>";
    					}
    					if (auth_chk!="" && auth_chk!=null) {
        					inner += "<a onclick='imsi();'><i><img src='/img/summary_icon05.png' alt=''></i>인증서</a>";
						}
					}
        			inner += "</li>";
					inner += "</div>";	
					inner += "</div>";	
				//}
			}
			$('.sub_products').append(inner);
		}
	});
}
	
function imsi(){
	alert('준비중입니다.');
}

function actionSubmit(val, type){
	
	$("#send_type").val(type);
	$("#send_value").val(val);
	$("#actionForm").attr("action", "http://panasonic.musign.co.kr/wp-content/themes/musign/include/file_down.php");
    $("#actionForm").submit();
}

</script>
<form id="actionForm" name="actionForm" method="post" action="">
	<input type="hidden" id="send_type" name="send_type">
	<input type="hidden" id="send_value" name="send_value">
</form>


<input type="hidden" id="product_url" value="http://panasonic.musign.co.kr/product-detail">

<div class="product-tab">
	<div class="clearfix">
		<div class="tab tab01">
			<a href="/product-intro">모든 제품군 보기</a>
		</div>
		
		<div class="tab tab02 cate_tab">
			<div class="cate1_title">제품 구분 선택</div>
			<ul class="cate1_ul">
				<li class="cate1 baesun" onclick="show(1,'baesun',this);">배선기구</li>
				<li class="cate1 smart_baesun" onclick="show(2,'smart_baesun',this);">스마트 배선기구</li>
				<li class="cate1 gae_bun" onclick="show(1,'gae_bun',this);">계전기 & 분전반</li>
				<li class="cate1 si-jang" onclick="show(2,'si-jang',this);">시장용품</li>
				<li class="cate1 kmew" onclick="show(1,'kmew',this);">KMEW</li>
				<li class="cate1 bock_gi" onclick="show(2,'bock_gi',this);">복지용구</li>
				<li class="cate1 jo_myeong" onclick="show(2,'jo_myeong',this);">조명제어시스템</li>
			</ul>
		</div>
		
		
		<div class="tab tab03 cate_tab">
		 
			<div class="cate2_title">제품 항목 선택</div>
			<ul class="cate2_ul">
				<!-- 배선기구 -->
				<li class="cate2 baesun" onclick="show(2,'series',this);">시리즈</li>
				<li class="cate2 baesun" onclick="show(2,'switch_consent',this);">기능형스위치 & 콘센트</li>
				<li class="cate2 baesun" onclick="show(2,'badak',this);">바닥용콘센트</li>
				<li class="cate2 baesun" onclick="show(2,'time_switch',this);">타임스위치</li>
				<!-- 배선기구 -->

				<!-- 계전기분전기 -->
				<li class="cate2 gae_bun" onclick="show(2,'gae',this);">계전기</li>
				<li class="cate2 gae_bun" onclick="show(2,'bun',this);">분전반</li>
				<!-- 계전기분전기 -->	
				
				<!-- kmew -->
				<li class="cate2 kmew" onclick="show(2,'wae',this);">외장재</li>
				<li class="cate2 kmew" onclick="show(2,'jibung',this);">지붕재</li>
				<!-- kmew -->
				
				
			</ul>
		</div>
		
		<div class="tab tab04 cate_tab">
			<div class="cate3_title">제품 항목 선택</div>
			<ul class="cate3_ul">
				<!-- 시리즈 -->
				<li class="cate3 series" onclick="choose_cate('플래티마',this,'act');">플래티마</li>
				<li class="cate3 series" onclick="choose_cate('피오네',this,'act');">피오네</li>
				<li class="cate3 series" onclick="choose_cate('하이어',this,'act');">하이어</li>
				<li class="cate3 series" onclick="choose_cate('아르체',this,'act');">아르체</li>
				<li class="cate3 series" onclick="choose_cate('파르테논',this,'act');">파르테논</li>
				<li class="cate3 series" onclick="choose_cate('리젠',this,'act');">리젠</li>
				<li class="cate3 series" onclick="choose_cate('리파르',this,'act');">리파르</li>
				<li class="cate3 series" onclick="choose_cate('베가와이드',this,'act');">베가와이드</li>
				<li class="cate3 series" onclick="choose_cate('라온',this,'act');">라온</li>
				<!-- 시리즈 -->		
				
				<!-- 기능형스위치콘센트 -->
				<li class="cate3 switch_consent" onclick="choose_cate('대기전력 자동차단 콘센트',this,'act');">대기전력 자동차단 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('에어컨 실외기용 스위치',this,'act');">에어컨 실외기용 스위치</li>
				<li class="cate3 switch_consent" onclick="choose_cate('방우형 콘센트 & 스위치',this,'act');">방우형 콘센트 & 스위치</li>
				<li class="cate3 switch_consent" onclick="choose_cate('스위치부 가로형 콘센트',this,'act');">스위치부 가로형 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('슬라이드 커버 콘센트',this,'act');">슬라이드 커버 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('결로방지 콘센트',this,'act');">결로방지 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('USB 충전 콘센트',this,'act');">USB 충전 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('플러그 자동분리 콘센트',this,'act');">플러그 자동분리 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('TV전용 통합 콘센트',this,'act');">TV전용 통합 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('스위치 부착형 콘센트',this,'act');">스위치 부착형 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('안전형 콘센트',this,'act');">안전형 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('LED 홈 보안등',this,'act');">LED 홈 보안등</li>
				<!-- 기능형스위치콘센트 -->
				
				<!-- 바닥용콘센트 -->
				<li class="cate3 badak" onclick="choose_cate('플로어 콘센트',this,'act');">플로어 콘센트</li>
				<li class="cate3 badak" onclick="choose_cate('가구장 콘센트',this,'act');">가구장 콘센트</li>
				<!-- 바닥용콘센트 -->
				
				<!-- 타입 스위치 -->
				<li class="cate3 time_switch" onclick="choose_cate('타임스위치 기계식',this,'act');">타임스위치 기계식</li>
				<!-- 타입 스위치 -->
				
				<!-- 계전기 -->
				<li class="cate3 gae" onclick="choose_cate('배선 차단기',this,'act');">배선 차단기</li>
				<li class="cate3 gae" onclick="choose_cate('누전 차단기',this,'act');">누전 차단기</li>
				<li class="cate3 gae" onclick="choose_cate('기타 계전기',this,'act');">기타 계전기</li>
				<!-- 계전기 -->
				
				<!-- 분전기 -->
				<li class="cate3 bun" onclick="choose_cate('HB 타입',this,'act');">HB 타입</li>
				<li class="cate3 bun" onclick="choose_cate('C2 타입',this,'act');">C2 타입</li>
				<!-- 분전기 -->
				
				<!-- 시장용품 -->
				<li class="cate3 si-jang" onclick="choose_cate('멀티탭',this,'act');">멀티탭</li>
				<li class="cate3 si-jang" onclick="choose_cate('노출형 콘센트',this,'act');">노출형 콘센트</li>
				<li class="cate3 si-jang" onclick="choose_cate('산업용 자재',this,'act');">산업용 자재</li>
				<li class="cate3 si-jang" onclick="choose_cate('소형 스위치 & 기타 노출 자재',this,'act');">소형 스위치 & 기타 노출 자재</li>
				<li class="cate3 si-jang" onclick="choose_cate('LED 조광기',this,'act');">LED 조광기</li>
				<!-- 시장용품 -->
				
				
				<!-- 스마트배선기구 -->
				<li class="cate3 smart_baesun" onclick="choose_cate('거실 통합형 스마트 스위치',this,'act');">거실 통합형 스마트 스위치</li>
				<li class="cate3 smart_baesun" onclick="choose_cate('지능형 디밍패턴 스위치',this,'act');">지능형 디밍패턴 스위치</li>
				<li class="cate3 smart_baesun" onclick="choose_cate('홈 네트워크 & 일괄소등 스위치',this,'act');">홈 네트워크 & 일괄소등 스위치</li>
				<li class="cate3 smart_baesun" onclick="choose_cate('대기전력 자동차단 스위치',this,'act');">대기전력 자동차단 스위치</li>
				<li class="cate3 smart_baesun" onclick="choose_cate('타임키퍼 ll·lll 리모컨 스위치',this,'act');">타임키퍼 ll·lll 리모컨 스위치</li>
				<li class="cate3 smart_baesun" onclick="choose_cate('센서 스위치',this,'act');">센서 스위치</li>
				<!-- 스마트배선기구 -->
				
				
				<!-- 복지용구 -->
				<li class="cate3 bock_gi" onclick="choose_cate('목욕의자',this,'act');">목욕의자</li>
				<li class="cate3 bock_gi" onclick="choose_cate('플라스틱 이동변기',this,'act');">플라스틱 이동변기</li>
				<li class="cate3 bock_gi" onclick="choose_cate('목재형 이동변기',this,'act');">목재형 이동변기</li>
				<!-- 복지용구 -->
				
				<!-- 조명제어시스템 -->
				<li class="cate3 jo_myeong" onclick="choose_cate('전선관',this,'act');">전선관</li>
				<li class="cate3 jo_myeong" onclick="choose_cate('Full To Way',this,'act');">Full To Way</li>
				<!-- 조명제어시스템 -->
				
				<!-- 외장재 -->
				<li class="cate3 wae" onclick="choose_cate('네오록·친수16',this,'act');">네오록·친수16</li>
				<li class="cate3 wae" onclick="choose_cate('세라딜·친수14',this,'act');">세라딜·친수14</li>
				<li class="cate3 wae" onclick="choose_cate('세라딜V14',this,'act');">세라딜V14</li>
				<li class="cate3 wae" onclick="choose_cate('SOLIDO',this,'act');">SOLIDO</li>
				<!-- 외장재 -->
				
				<!-- 지붕재 -->
				<li class="cate3 jibung" onclick="choose_cate('ROOGA',this,'act');">ROOGA</li>
				<li class="cate3 jibung" onclick="choose_cate('Color BEST',this,'act');">Color BEST</li>
				<!-- 지붕재 -->
				
				
			</ul>
		</div>
	</div>
</div>
<?php 
if ($row['product_indi']=='O') {
?>
    <div class="product-detail-wrap product-detail-card-wrap">
<?php 
}else{
?>
    <div class="product-detail-wrap">
<?php 
}
?>
	<div class="product-banner-wrap">
		<img class="banner">
	</div>
	
	<section class="detail-section lineup">
		<h1>제품 라인업</h1>
		
		<?php 
		if ($row['product_indi']=='O' && strlen($row['product_info']) > 5) {
		   
		 ?>
		 	<p class="color-b indi_spec"><?php echo $row['product_info']?></p>
		 <?php 
		}else if($row['product_indi']!='O'){
		?>
			<p class="color-b">*상세스펙을 보시려면 제품을 클릭하세요.</p>
		<?php 
		}
		?>
		<div class="tab">
		<?php 
		if ($row['product_indi']=='O') {
		    for ($i = 0; $i < sql_count($cate4_result); $i++) {
		        $cate4_row = sql_fetch($cate4_result);
		        if ($i==0) {
		            ?>
    		    <button type="button" class="btn on" onclick="getindi('<?php echo $row['product_cate3']?>','<?php echo $cate4_row['product_cate4']?>',this)"><?php echo $cate4_row['product_cate4']; ?></button>  
    		      <?php 
    		  }else{   
                 ?>
    			<button type="button" class="btn" onclick="getindi('<?php echo $row['product_cate3']?>','<?php echo $cate4_row['product_cate4']?>',this)"><?php echo $cate4_row['product_cate4']; ?></button>
    		<?php 
    		  }
    		}		
		}
		else{
    		for ($i = 0; $i < sql_count($cate4_result); $i++) {
                 $cate4_row = sql_fetch($cate4_result);   
    		  if ($i==0) {
    		      ?>
    		    <button type="button" class="btn on" onclick="getData('<?php echo $row['product_cate3']?>','<?php echo $cate4_row['product_cate4']?>',this)"><?php echo $cate4_row['product_cate4']; ?></button>  
    		      <?php 
    		  }else{   
                 ?>
    			<button type="button" class="btn" onclick="getData('<?php echo $row['product_cate3']?>','<?php echo $cate4_row['product_cate4']?>',this)"><?php echo $cate4_row['product_cate4']; ?></button>
    		<?php 
    		  }
    		}		
		}
		?>
		</div>
		<div id="tab-content" class="tab-content">
			<ul class="sub_products">

			</ul>
		</div>
	</section>
	<?php 
	$num_check = explode('@',$row['layer_type']);
	
	if ($row['layer_type']!="" && $row['layer_type']!="-" && $row['layer_type']!=null && is_numeric($num_check[0])) {
	?>
	<section class="detail-section intro">
		<h1>제품 소개</h1>
		<div class="intro-wrap">

			<?php 
			for($i = 0; $i < count($arr_layer_type); $i++)
			{
			    if ($arr_layer_type[$i]==4) {
			 ?>
            	<section class="detail-section last <?php echo $class?>">
            		<div class="img">
            			 <img src="<?php echo '/img/product/'.$arr_layer_img[$i]?>" alt="">
            		</div>
            		<div class="txt">
            			<p>
            			<?php 
    			    	if (strpos($row['layer_title'],'@')==false && $i==0) {
    			    	?>
            			<strong><?php echo $arr_layer_title[0]?> </strong>
						<?php 
    			    	}else if(strpos($row['layer_title'],'@')!==false){
    			    	 ?>
    			    	 <strong><?php echo $arr_layer_title[$i]?> </strong>
						<?php  
    			    	}
        			    ?>
            			<?php echo $arr_layer_conts[$i]?>
            			</p>
            		</div>
            	</section>
			 <?php 
			    }else if ($arr_layer_type[$i]==1) {
			    ?>
			      <section class="detail-section detail01 <?php echo $class?>">
            		
            		<div class="txt">
            			<h1>
            			<?php 
    			    	if (strpos($row['layer_title'],'@')==false && $i==0) {
    			    	?>
            			<?php echo $arr_layer_title[0]?>
						<?php 
    			    	}else if(strpos($row['layer_title'],'@')!==false){
    			    	 ?>
    			    	<?php echo $arr_layer_title[$i]?>
						<?php  
    			    	}
        			    ?>
            			</h1>
            		</div>
            		
            		<div class="img">
            			 <img src="<?php echo '/img/product/'.$arr_layer_img[$i]?>" alt="">
            		</div>
            		
            		<div class="txt">
            			<p>
            			<?php echo $arr_layer_conts[$i]?>
            			</p>
            		</div>
            		
            	</section>
			   <?php      
			    }else{
			        if ($i==0) {
    			        $imagesize = getimagesize("http://panasonic.musign.co.kr/img/product/{$arr_layer_img[$i]}");
    			        $width=$imagesize[0];
    			        $height=$imagesize[1];
    			        if ($width===$height) {
    			            $class='';
    			        }else if ($width-$height > 0) {
    			            $class='horizontal';
    			        }else if ($width-$height < 0) {
    			            $class='vertical';
    			        }
			        }else{
			            $class='';
			        }
		    ?>
			    <article class="<?php echo 'detail0'.$arr_layer_type[$i].' '.$class?>">
    			    <div class="txt">
    			    	<?php 
    			    	if (strpos($row['layer_title'],'@')==false && $i==0) {
    			    	?>
        			    <h1><?php echo $arr_layer_title[0]?></h1>
        			    <?php 
    			    	}else if(strpos($row['layer_title'],'@')!==false){
    			    	 ?>
    			    	  <h1><?php echo $arr_layer_title[$i]?></h1>
    			    	<?php  
    			    	}
        			    ?>
        			    <p><?php echo $arr_layer_conts[$i]?></p>
    			    </div>
    			    <div class="img">
        			    <img src="<?php echo '/img/product/'.$arr_layer_img[$i]?>" alt="">
    			    </div>
			    </article>
		    <?php
			    }
			}
			?>
		</div>
	</section>
	<?php 
	}
	?>
</div>


<!-- 팝업 추가 -->
<div id="product-popup">
	<div class="popup-wrap">		
		<div class="product-summary">
			<section class="clearfix">
				<div class="thumbnail" id="pop_thumbnail">
					<ul class="owl-carousel pop_img">

					</ul>
				</div>
				<div class="txt pop_contents">

				</div>
			</section>
		</div>	
		<a class="close-btn" onclick="pop_close();">Close</a>
	</div>
</div>




<script>
$('html, body').hide();
$(document).ready(function(){

	//제품 상단 이미지 슬라이드
// 	$('.product-summary .owl-carousel').owlCarousel({
// 		items:1,
// 		nav:true,
// 		loop:true,
// 		//onDragged: callback,
// 		onChanged: callback		
// 	});
	
// 	var get_num=0;
	
//     function callback(event) {
// 		get_num = $('.active').find('img').attr('data-number');
		
// 		$('.main_title').text(main_title_arr[get_num]);
// 		$('.main_model').text(main_model_arr[get_num]);
// 		$('.main_rating').text(main_rating_arr[get_num]);
// 		$('.main_size').text(main_size_arr[get_num]);
// 		$('.main_auth').text(main_auth_arr[get_num]);
// 		$('.main_thumb').attr('href','/img/product/'+main_thumb_arr[get_num]);
// 		$('.main_manual').attr('href','/img/product_manual/'+main_manual_arr[get_num]);
// 		$('.main_map_pdf').attr('href','/img/product_map/'+main_map_2_arr[get_num]);
// 		$('.main_map_dwg').attr('href','/img/product_map/'+main_map_1_arr[get_num]);
// 		$('.main_auth_file').attr('href',main_auth_arr[get_num]);
//     }
	
	//아이콘 마우스호버
	$(document).on('mouseover', '.product-summary .btn a, .product-detail-card-wrap .lineup .btn a', function(e){
		var hr = $(this).find('img').attr('src').split('.');
		$(this).find('img').attr('src', hr[0] + '_w.' + hr[1]);
	});
	
	$(document).on('mouseout', '.product-summary .btn a, .product-detail-card-wrap .lineup .btn a', function(e){
		var hr = $(this).find('img').attr('src').split('_w');
		$(this).find('img').attr('src', hr[0] + hr[1]);
	});
	
	//탭 클릭
	$('.product-tab .tab').on({
		mouseenter: function(e){
			if(!$(this).hasClass('drop')){			
            	$('.product-tab .tab').removeClass('drop');
            	$('.product-tab .tab ul').fadeOut(200);
            	$(this).addClass('drop').find('ul').fadeIn(200);
        	}	
		},
		mouseleave: function(){	
        	$('.product-tab .tab').removeClass('drop');
        	$('.product-tab .tab ul').fadeOut(200);
		}
	})

	//탭에 내용물이 없는 경우 탭 영역 DOM 삭제
	if($('.lineup .tab').children().length == 0)
		$('.lineup .tab').remove();
	
})
window.onload = function(){
	$('html, body').fadeIn(300);
}
</script>