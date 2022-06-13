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


$pc_chk="N";
$banner_query ="select * from product_banner where cate3 ='{$cate}'";
$banner_result = sql_query($banner_query);
if (sql_count($banner_result) > 1) {
    for ($i = 0; $i < sql_count($banner_result); $i++) {
        $banner_row = sql_fetch($banner_result);
        if ( $detect->isTablet() ) {
            //$is_mobile ='Y';
            $banner .= $banner_row['cate4'].'@'.$banner_row['banner'].'$';
        }else if ($detect->isMobile()) {
            $banner .= $banner_row['cate4'].'@'.$banner_row['banner_mo'].'$';
        }else{
            //$is_mobile ='N';
            $banner .= $banner_row['cate4'].'@'.$banner_row['banner'].'$';
        }
   }
}else{
    $banner_row = sql_fetch($banner_result);
    $banner = $banner_row['banner'];
    if ( $detect->isTablet()) {
        
        //$is_mobile ='Y';
        $banner = $banner_row['banner'];
    }else if ($detect->isMobile()) {
       
        $banner = $banner_row['banner_mo'];
    }else{
        $pc_chk="Y";
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

for($i = 0; $i < count($arr_layer_type); $i++)
{
    $arr_layer_type[$i]= trim($arr_layer_type[$i]);
    $arr_layer_title[$i]= trim($arr_layer_title[$i]);
    $arr_layer_conts[$i]= trim($arr_layer_conts[$i]);
    $arr_layer_img[$i]= trim($arr_layer_img[$i]);
}

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




$type1_query="select * from product_cate where cate_type='1' ";
$type2_query="select * from product_cate where cate_type='2' ";
$type3_query="select * from product_cate where cate_type='3' ";

$type1_result=sql_query($type1_query);
$type2_result=sql_query($type2_query);
$type3_result=sql_query($type3_query);




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
var pc_chk = '<?php echo $pc_chk?>';
var first_cate3 = '<?php echo $first_cate3?>';
var first_cate4 = '<?php echo $first_cate4?>';

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

	if (confirm_indi=="O") {
		getindi(first_cate3,first_cate4);
	}else{
    	getData(first_cate3,first_cate4);
	}

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
			//console.log(data);
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
    			
    			manual_chk=result[0].product_manual;
    			map_1_chk=result[0].product_map_1;
    			map_2_chk=result[0].product_map_2;
    			auth_chk=result[0].product_auth;
    			
    			chk_length =  manual_chk.length + map_1_chk.length + map_2_chk.length + auth_chk.length;
    			
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
    			inner += "<dt>Sheets/3.3㎡</dt>";
    			inner += "<dd>"+result[0].product_ea+"</dd>";
    			inner += "</dl>";
    
    
    			inner += "<dl>";
    			inner += "<dt>Weight/sheet</dt>";
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

var chk_idx="";
function show(cate,idx,text){
	chk_idx=idx;
	var cate_title = $(text).text();
	$(text).parent().prev().text(cate_title);
	
	if (cate_title.indexOf('&')!=-1) {
		cate_title= cate_title.replace('&','@');
	}
	if (cate==1) {
		$('.cate2_title').text('제품 구분 선택');
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

	if (chk_idx=='jo_myeong' || chk_idx=='bock_gi' || chk_idx=='smart_baesun' || chk_idx=='si-jang') {
		cate1_url = cate_title;
		$("#product_url").val(product_url);
		$('.tab03').hide();
		$('.tab04').show();
	}else{
		$('.tab0'+(cate+2)).show();
	}
	
	$('.cate'+(cate+1)).hide();
	$('.'+chk_idx).show();


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

				
				manual_chk=result[i].product_manual;
				map_1_chk=result[i].product_map_1;
				map_2_chk=result[i].product_map_2;
				auth_chk=result[i].product_auth;

				chk_length = manual_chk.length + map_1_chk.length + map_2_chk.length + auth_chk.length;
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
	$("#actionForm").attr("action", "/wp-content/themes/musign/include/file_down.php");
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
			<?php 
			for ($i = 0; $i < sql_count($type1_result); $i++) {
			    $type1_row=sql_fetch($type1_result);
			    $confirm_query = "SELECT *, cate_type-(SELECT cate_type FROM product_cate WHERE  upper_cate ='{$type1_row['kor_title']}' LIMIT 1 )
                                 AS chk FROM product_cate WHERE idx ='{$type1_row['idx']}' ";
			    $confirm_result = sql_query($confirm_query);
			    $confirm_row = sql_fetch($confirm_result);
			    
			    $kor_title = $confirm_row['kor_title'];
			    $eng_title = $confirm_row['eng_title'];
			    $cate_type = $confirm_row['chk']*-1;
			    
			    
			?>
				<li class="cate1 <?php echo $eng_title?>" onclick="show(<?php echo $cate_type?>,'<?php echo $eng_title?>',this);"><?php echo $kor_title?></li>			
			<?php 
			}			
			?>

			</ul>
		</div>
		
		
		<div class="tab tab03 cate_tab">
		 
			<div class="cate2_title">제품 항목 선택</div>
			<ul class="cate2_ul">
				<?php 
				for ($i = 0; $i < sql_count($type2_result); $i++) {
				    $type2_row=sql_fetch($type2_result);
				    $confirm_query = "select * from product_cate where kor_title='{$type2_row['upper_cate']}' ";
				    $confirm_result = sql_query($confirm_query);
				    $confirm_row = sql_fetch($confirm_result);
				    
				    $kor_title = $type2_row['kor_title'];
				    $eng_title = $type2_row['eng_title'];
				    $cate_type = $type2_row['cate_type'];
				    $upper_cate = $confirm_row['eng_title'];
				    
				?>
    				<li class="cate2 <?php echo $upper_cate?>" onclick="show(<?php echo $cate_type?>,'<?php echo $eng_title?>',this);"><?php echo $kor_title?></li>
				<?php 
				}
				?>
				
				
			</ul>
		</div>
		
		<div class="tab tab04 cate_tab">
			<div class="cate3_title">제품 항목 선택</div>
			<ul class="cate3_ul">
				<?php 
				for ($i = 0; $i < sql_count($type3_result); $i++) {
				    $type3_row=sql_fetch($type3_result);
				    $confirm_query = "select * from product_cate where kor_title='{$type3_row['upper_cate']}' ";
				    $confirm_result = sql_query($confirm_query);
				    $confirm_row = sql_fetch($confirm_result);
				    
				    $kor_title = $type3_row['kor_title'];
				    $eng_title = $type3_row['eng_title'];
				    $cate_type = $type3_row['cate_type'];
				    $upper_cate = $confirm_row['eng_title'];
				    
				?>
				<li class="cate3 <?php echo $upper_cate?>" onclick="choose_cate('<?php echo $kor_title?>',this,'act');"><?php echo $kor_title?></li>				
				<?php 
				}
				?>
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
                 
                 $cate5_query = "SELECT DISTINCT product_cate4,product_cate5 FROM product WHERE product_cate3 ='{$row['product_cate3']}' AND product_cate4 = '{$cate4_row['product_cate4']}' AND product_cate5 != '' ";
                 $cate5_result = sql_query($cate5_query);
                 
//                  if (sql_count($cate5_result)>1) {
//                      for ($i = 0; $i < sql_count($cate5_result); $i++) {
//                          $cate5_row = sql_fetch($cate5_result);
//                          echo $cate5_row['product_cate5'].'<br>';
//                      }
//                  }
       
                 
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
		<!-- 
			<ul class="test1">
				<li><button>스위치</button></li>
				<li>콘센트</button>
					<ul>
						<li><button>콘센트 하위메뉴1</button></li>
						<li><button>콘센트 하위메뉴2</button></li>
						<li><button>콘센트 하위메뉴3</button></li>												
					</ul>
				</li>
				<li><button>일반형</button></li>								
			</ul>
			 -->
			<ul class="sub_products">
				
			</ul>
		</div>

	</section>
	<?php 
	$num_check = explode('@',$row['layer_type']);
	
	if ($row['layer_type']!="" && $row['layer_type']!="-" && $row['layer_type']!=null && is_numeric($num_check[0])) {
	?>
	<?php 
	if ($row['product_cate1']=='KMEW') {
	?>
	<section class="detail-section catalog">
		<h1>카다로그</h1>
		<p class="color-b">*외장재에 대해 자세히 알고싶으면 카다로그를 참고해주세요.</p>
		<div class="btn-wrap">
			<a onclick='actionSubmit()'>KMEW 카다로그 다운로드</a>
			<a href="https://www.kmew.co.jp/global/korea/" target="_blank" class="site">KMEW 사이트</a>
		</div>
	</section>
	<?php 	
	}
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
		if($(this).find('img').attr('src').indexOf('_w') > -1){
    		var hr = $(this).find('img').attr('src').split('_w');
    		$(this).find('img').attr('src', hr[0] + hr[1]);
		}else if($(this).find('img').attr('src').indexOf('_w') < 0){
    		var hr = $(this).find('img').attr('src').split('.');
    		$(this).find('img').attr('src', hr[0] + '_w.' + hr[1]);
		}
	});
	
	$(document).on('mouseout', '.product-summary .btn a, .product-detail-card-wrap .lineup .btn a', function(e){
		if($(this).find('img').attr('src').indexOf('_w') > -1){
    		var hr = $(this).find('img').attr('src').split('_w');
    		$(this).find('img').attr('src', hr[0] + hr[1]);
		}
	});

var chk_class="";
var upper_class="";
	//탭 클릭
// 	$('.product-tab .tab').on({
// 		mouseenter: function(e){
// 			if(!$(this).hasClass('drop')){			
//             	$('.product-tab .tab').removeClass('drop');
//             	$('.product-tab .tab ul').fadeOut(200);
//             	$(this).addClass('drop').find('ul').fadeIn(200);
//         	}	
// 		},
		
// 		mouseleave: function(){	
//         	$('.product-tab .tab').removeClass('drop');
//         	$('.product-tab .tab ul').fadeOut(200);
// 		}
// 	})
	
	
	$('.tab li').click(function(){
		if(pc_chk!='Y') {
    		chk_class=$(this).attr('class');
			$('.product-tab .tab').removeClass('drop');
    		$('.product-tab .tab ul').fadeOut(200);
    		
    		if (chk_class.indexOf('cate1')!=-1) {
    			if (chk_idx=='jo_myeong' || chk_idx=='bock_gi' || chk_idx=='smart_baesun' || chk_idx=='si-jang') {
    				$('.tab04').addClass('drop').find('ul').fadeIn(200);
    			}else{
        			$('.tab03').addClass('drop').find('ul').fadeIn(200);
    			}
    			
    		}else if (chk_class.indexOf('cate2')!=-1) {
    				
    			$('.tab04').addClass('drop').find('ul').fadeIn(200);
    		}
		}
	});
	
	$('.product-tab .tab').on({
		mouseenter: function(e){
			if(!$(this).hasClass('drop')){	
            	$('.product-tab .tab').removeClass('drop');
            	$('.product-tab .tab ul').fadeOut(200);
            	$(this).addClass('drop').find('ul').fadeIn(200);
        	}	
		},
			
    		mouseleave: function(){
        		if (pc_chk=='Y') {
                	$('.product-tab .tab').removeClass('drop');
                	$('.product-tab .tab ul').fadeOut(200);
				}
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