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

if ($_GET['lang']=='en') {
    $conver_query ="select * from product_cate where eng_title='{$cate}' limit 1";
    $conver_result = sql_query($conver_query);
    $conver_row = sql_fetch($conver_result);
    $eng_cate  = $cate;
    $cate = $conver_row['kor_title'];
}



// if ( $detect->isMobile() ) {
//     $is_mobile ='Y';
// }else{
//     $is_mobile ='N';
// }


$pc_chk="Y";
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
        $pc_chk="N";
        $banner = $banner_row['banner'];
    }else if ($detect->isMobile()) {
        
        $pc_chk="N";
        $banner = $banner_row['banner_mo'];
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
$arr_layer_img = explode('@', $row['layer_img']);
if ($_GET['lang']=='en') {
    $arr_layer_title = explode('@', $row['layer_title_en']);
    $arr_layer_conts = explode('@', $row['layer_conts_en']);
}else{
    $arr_layer_title = explode('@', $row['layer_title']);
    $arr_layer_conts = explode('@', $row['layer_conts']);
}


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
if (isset($_GET['cate4'])) {
    $first_cate4 = $_GET['cate4'];
}




// if ($_GET['lang']=='en') {
//     $frist_4_eng_query = "select * from product_cate where kor_title='{$first_cate4}' LIMIT 1 ";
//     $frist_4_eng_result = sql_query($frist_4_eng_query);
//     $first_4_eng_row = sql_fetch($frist_4_eng_result);

//     $first_cate4=$first_4_eng_row['eng_title'];

//     $frist_3_eng_query = "select * from product_cate where kor_title='{$first_cate3}' LIMIT 1 ";
//     $frist_3_eng_result = sql_query($frist_3_eng_query);
//     $first_3_eng_row = sql_fetch($first_cate4_result);

//     $first_cate3=$first_3_eng_row['eng_title'];
// }


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
var lang = '<?php echo $_GET['lang']?>';
var pc_chk = '<?php echo $pc_chk?>';
var first_cate3 = '<?php echo $first_cate3?>';
var first_cate4 = '<?php echo $first_cate4?>';

var get_cate1='<?php echo $_GET['cate1']?>';
var get_cate2='<?php echo $_GET['cate2']?>';
var get_cate3='<?php echo $cate?>';
var get_eng_cate3='<?php echo $eng_cate?>';
var cate ='';
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
var auth_file_chk="";

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
			$('.cate1_ul').hide();
			$('.cate2_ul').hide();
		}
	})
	$('.cate3').each(function(){  
			//get_eng_cate3
			
		if (lang=='en') {
			get_eng_cate3 = get_eng_cate3.replace('_',' ');
			get_eng_cate3 = get_eng_cate3.replace('and','&');
			if ($(this).text()==get_eng_cate3) {
				//$('.tab04').show(); 20200107 ????????????
				$('.cate3_ul').hide();
				choose_cate(get_cate3,this);//act??????????????? ????????? ?????? ????????????3??? text????????????
			}
		}else{
    		if ($(this).text()==get_cate3) {
    			//$('.tab04').show(); 20200107 ????????????
    			$('.cate3_ul').hide();
    			choose_cate(get_cate3,this);//act??????????????? ????????? ?????? ????????????3??? text????????????
    		}
		}
	})
	//?????? ?????? ?????? ?????? ??? ?????? ??????
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
		type : "GET", //??????????????? ???????????? (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/file_down.php?filename="+encodeURI(file)+"&directory="+encodeURI(directory),//?????? URL??? ????????????. GET??????????????? ?????? ??????????????? ????????? ??????????????????.
		dataType : "text",//????????? ???????????? ????????????. xml,json,html,text?????? ?????? ????????? ????????? ??? ??????.
		error : function() 
		{
			alert("?????? ??? ????????? ?????????????????????.");
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
		type : "GET", //??????????????? ???????????? (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/get_pop_contents.php?idx="+encodeURI(idx)+"&kmew_chk="+encodeURI(kmew_chk),//?????? URL??? ????????????. GET??????????????? ?????? ??????????????? ????????? ??????????????????.
		dataType : "text",//????????? ???????????? ????????????. xml,json,html,text?????? ?????? ????????? ????????? ??? ??????.
		error : function() 
		{
			alert("?????? ??? ????????? ?????????????????????.");
		}, 
		success : function(data) 
		{
			$(".pop_contents").empty();
			$(".pop_img").empty();
			var result = JSON.parse(data);

			
			img_width = result[0].img_width;
			img_height = result[0].img_height;

				if (lang=='en') {
					cate = result[0].product_cate3_en;
					if (cate=="Arche") {
						cate=result[0].product_cate4_en;
					}
				}else{
        			cate = result[0].product_cate3;
        			if (cate=="?????????") {
						cate=result[0].product_cate4;
					}
				}

				
				
    			if (result[0].product_cate3 =='' || result[0].product_cate3 ==null) {
    				if (lang=='en') {
        				cate = result[0].product_cate2_en;
    				}else{
        				cate = result[0].product_cate2;
    				}
    			}
    
    			if (result[0].product_cate2 =='' || result[0].product_cate2 ==null) {
    				if (lang=='en') {
        				cate = result[0].product_cate1_en;
    				}else{
    					cate = result[0].product_cate1;
    				}
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
    			if (lang=='en') {
        			auth_chk=result[0].product_auth_en;					
				}else{
        			auth_chk=result[0].product_auth;
				}
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
    			if (lang=='en') {
        			inner += "<dd>"+result[0].product_title_en+"</dd>";					
				}else{
					inner += "<dd>"+result[0].product_title+"</dd>";		
				}
    			inner += "</dl>";
    
    			inner += "<dl>";
    			inner += "<dt>Rating</dt>";
    			if (lang=='en') {
        			inner += "<dd>"+result[0].product_rating_en+"</dd>";
    			}else{
    				inner += "<dd>"+result[0].product_rating+"</dd>";
    			}
    			inner += "</dl>";
    
    			inner += "<dl>";
    			inner += "<dt>Size</dt>";
    			
    			if (lang=='en') {
        			inner += "<dd>"+result[0].product_size_en+"</dd>";
    			}else{
    				inner += "<dd>"+result[0].product_size+"</dd>";
    			}
    			
    			inner += "</dl>";
    
    			inner += "<dl>";
    			inner += "<dt>CERTIFICATION</dt>";
    			if (auth_chk.indexOf('@')!=-1) {
					auth_chk_arr=auth_chk.split('@');
					//console.log(auth_chk_arr[0]);
					if (auth_chk_arr[0].indexOf('KS')) {
						inner += "<dd><img src='/img/icon_kc.png' alt='' style='width:15px; height:15px;'>"+auth_chk_arr[1]+"</dd>";
					} 
					if (auth_chk_arr[0].indexOf('KC')) {
						inner += "<dd><img src='/img/icon_ks.png' alt='' style='width:15px; height:15px;'>"+auth_chk_arr[1]+"</dd>";
					}
				}else{
					inner += "<dd>"+auth_chk+"</dd>";
				}
    			
    			inner += "</dl>";
    
    			inner += "<div class='btn'>";
    			
    			if (chk_length<10) {
        			if (lang=='en') {
        				inner += "<a href='javascript:return false;'><i><img src='/img/summary_icon06.png' alt=''></i>No Data</a>";						
					}else{
						inner += "<a href='javascript:return false;'><i><img src='/img/summary_icon06.png' alt=''></i>????????????</a>";
					}
    			}else{
        			if (lang=='en') {
        				if (img_chk.indexOf('.png')!=-1 || img_chk.indexOf('.jpg')!=-1 || img_chk.indexOf('.PNG')!=-1 || img_chk.indexOf('.JPG')!=-1) {
        					inner += "<a onclick='actionSubmit(\""+result[0].product_thumb+"\",\"product\")'><i><img src='/img/summary_icon01.png' alt=''></i>Image</a>";
        				}
        				if (manual_chk.indexOf('.pdf')!=-1 || manual_chk.indexOf('.jpg')!=-1 || manual_chk.indexOf('.PDF')!=-1 || manual_chk.indexOf('.JPG')!=-1 || manual_chk.indexOf('.zip')!=-1) {
        					//inner += "<a href='/img/product_manual/"+result[0].product_manual+"'download><i><img src='/img/summary_icon02.png' alt=''></i>?????????</a>";
        					inner += "<a onclick='actionSubmit(\""+result[0].product_manual+"\",\"product_manual\")'><i><img src='/img/summary_icon02.png' alt=''></i>Manual</a>";
        				}
        				if (map_1_chk.indexOf('.dwg')!=-1 || map_1_chk.indexOf('.DWG')!=-1) {
                			//inner += "<a href='/img/product_map/"+result[0].product_map_2+"' class='left' download><i><img src='/img/summary_icon03-2.png' alt=''></i><span>??????</span></a>";
                			inner += "<a class='left' onclick='actionSubmit(\""+result[0].product_map_2+"\",\"product_map\")'><i><img src='/img/summary_icon03-2.png' alt=''></i><span>Map</span></a>";
                			//inner += "<a href='/img/product_map/"+result[0].product_map_1+"' class='right' download><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
                			inner += "<a class='right' onclick='actionSubmit(\""+result[0].product_map_1+"\",\"product_map\")'><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
            			}
        				if (auth_chk!="" && auth_chk!=null) {
        					if (result[0].product_auth_file==null || result[0].product_auth_file=="" ) {
    							inner += "<a onclick='imsi();'><i><img src='/img/summary_icon05.png' alt=''></i>Certification</a>";
    						}else{
        						inner += "<a onclick='cert_actionSubmit(\""+result[0].product_auth_file+"\");'><i><img src='/img/summary_icon05.png' alt=''></i>Certification</a>";
    						}
        				}
					}else{
        				if (img_chk.indexOf('.png')!=-1 || img_chk.indexOf('.jpg')!=-1 || img_chk.indexOf('.PNG')!=-1 || img_chk.indexOf('.JPG')!=-1) {
        					inner += "<a onclick='actionSubmit(\""+result[0].product_thumb+"\",\"product\")'><i><img src='/img/summary_icon01.png' alt=''></i>?????????</a>";
        				}
        				if (manual_chk.indexOf('.pdf')!=-1 || manual_chk.indexOf('.jpg')!=-1 || manual_chk.indexOf('.PDF')!=-1 || manual_chk.indexOf('.JPG')!=-1 || manual_chk.indexOf('.zip')!=-1) {
        					//inner += "<a href='/img/product_manual/"+result[0].product_manual+"'download><i><img src='/img/summary_icon02.png' alt=''></i>?????????</a>";
        					inner += "<a onclick='actionSubmit(\""+result[0].product_manual+"\",\"product_manual\")'><i><img src='/img/summary_icon02.png' alt=''></i>?????????</a>";
        				}
        				if (map_1_chk.indexOf('.dwg')!=-1 || map_1_chk.indexOf('.DWG')!=-1) {
                			//inner += "<a href='/img/product_map/"+result[0].product_map_2+"' class='left' download><i><img src='/img/summary_icon03-2.png' alt=''></i><span>??????</span></a>";
                			inner += "<a class='left' onclick='actionSubmit(\""+result[0].product_map_2+"\",\"product_map\")'><i><img src='/img/summary_icon03-2.png' alt=''></i><span>??????</span></a>";
                			//inner += "<a href='/img/product_map/"+result[0].product_map_1+"' class='right' download><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
                			inner += "<a class='right' onclick='actionSubmit(\""+result[0].product_map_1+"\",\"product_map\")'><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
            			}
        				if (auth_chk!="" && auth_chk!=null) {
        					if (result[0].product_auth_file==null || result[0].product_auth_file=="" ) {
    							//inner += "<a onclick='imsi();'><i><img src='/img/summary_icon05.png' alt=''></i>?????????</a>";
    						}else{
        						inner += "<a onclick='cert_actionSubmit(\""+result[0].product_auth_file+"\");'><i><img src='/img/summary_icon05.png' alt=''></i>?????????</a>";
    						}
        				}
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
    			
    			if (lang=='en') {
    				inner += "<dd>"+result[0].product_title_en+"</dd>";
				}else{
        			inner += "<dd>"+result[0].product_title+"</dd>";
				}
				
    			inner += "</dl>";
    
    			inner += "<dl>";
    			inner += "<dt>Size</dt>";
        		inner += "<dd>"+result[0].product_size+"</dd>";
    			inner += "</dl>";
    			
    			inner += "<dl>";
    			inner += "<dt>Sheets/3.3???</dt>";
    			if (lang=='en') {
        			inner += "<dd>"+result[0].product_ea_en+"</dd>";
    			}else{
        			inner += "<dd>"+result[0].product_ea+"</dd>";
    			}
    			inner += "</dl>";
    
    
    			inner += "<dl>";
    			inner += "<dt>Weight/sheet</dt>";
    			if (lang=='en') {
        			inner += "<dd>"+result[0].product_weight_en+"</dd>";
    			}else{
        			inner += "<dd>"+result[0].product_weight+"</dd>";
        		}
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
		if (lang=='en') {
    		$('.cate2_title').text('Select product item');
    		$('.cate3_title').text('Select product item');
		}else{
    		$('.cate2_title').text('?????? ?????? ??????');
    		$('.cate3_title').text('?????? ?????? ??????');
		}
		cate1_url = cate_title;
		$("#product_url").val(product_url);
		$('.tab04').hide();
		
	}
	if (cate==2) {
		if (lang=='en') {
			$('.cate3_title').text('Select product item');
		}else{
    		$('.cate3_title').text('?????? ?????? ??????');
		}
		cate2_url = cate_title;
		$("#product_url").val(product_url);
		
	}

	if (chk_idx=='Lighting_Control_System' || chk_idx=='Welfare_Products' || chk_idx=='Smart_Wiring_Device' || chk_idx=='Market_Products') {
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
function winOpen(url)
{
    var name = "popup";
    var option = "width = 800, height = 800, top = 10, left = 200, location = no, scrollbars=yes";
    window.open(url, name, option);
}
function choose_cate(idx,text,act){
	
	if (idx.indexOf('&')!=-1) {
		idx= idx.replace('&','@');
	}
	var cate_title = $(text).text();
	
	$(".cate3_title").text(cate_title);
	
	if (act=="act") {
	var lo_link = "/product-detail?lang="+lang+"&cate1="+encodeURI(cate1_url)+"&cate2="+encodeURI(cate2_url)+"&cate3=" + encodeURI(idx);
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
    	$(val).addClass('on');
	}else{
		$('.btn').each(function(){
			var thistxt = $(this).text();
			if (thistxt==cate4) {
				$('.btn').removeClass('on');		
		    	$(this).addClass('on');
			}
		})
		
	}

	$.ajax({
		type : "GET", //??????????????? ???????????? (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/getCate4.php?cate3="+encodeURI(cate3)+"&cate4="+encodeURI(cate4)+"&kmew_chk="+kmew_chk,//?????? URL??? ????????????. GET??????????????? ?????? ??????????????? ????????? ??????????????????.
		dataType : "text",//????????? ???????????? ????????????. xml,json,html,text?????? ?????? ????????? ????????? ??? ??????.
		error : function() 
		{
			alert("?????? ??? ????????? ?????????????????????.");
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
    						//<a href="javascript:winOpen('product.php');">
        					inner += "<a href='javascript:winOpen(\""+result[i].product_rating+"\");'>";
    						//inner += "<a onclick='location.href=\""+result[i].product_rating+"\"'>";
    					}else{
    	    				inner += "<a onclick='pop_up("+result[i].idx+")'>";
    					}
					}else{
						inner += "<a onclick='pop_up("+result[i].idx+",\""+kmew_chk+"\")'>";
					}
    				inner += "<i><img src='/img/product/"+result[i].product_thumb+"'></i>";
    				if (lang=='en') {
    					inner += "<strong>"+result[i].product_title_en+"</strong>";						
					}else{
						inner += "<strong>"+result[i].product_title+"</strong>";
					}
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
		type : "GET", //??????????????? ???????????? (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/getCate4.php?cate3="+encodeURI(cate3)+"&cate4="+encodeURI(cate4),//?????? URL??? ????????????. GET??????????????? ?????? ??????????????? ????????? ??????????????????.
		dataType : "text",//????????? ???????????? ????????????. xml,json,html,text?????? ?????? ????????? ????????? ??? ??????.
		error : function() 
		{
			alert("?????? ??? ????????? ?????????????????????.");
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
				auth_file_chk = result[i].product_auth_file;
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
					if (lang=='en') {
						inner += "<dd>"+result[i].product_title_en+"</dd>";
					}else{
    					inner += "<dd>"+result[i].product_title+"</dd>";
					}
					inner += "</dl>";

					inner += "<dl>";
					inner += "<dt>Rating</dt>";
					if (lang=='en') {
    					inner += "<dd>"+result[i].product_rating_en+"</dd>";
					}else{
						inner += "<dd>"+result[i].product_rating+"</dd>";
					}
					inner += "</dl>";

					inner += "<dl>";
					inner += "<dt>Size</dt>";
					if (lang=='en') {
						inner += "<dd>"+result[i].product_size_en+"</dd>";
					}else{
						inner += "<dd>"+result[i].product_size+"</dd>";
					}
					inner += "</dl>";

					inner += "<dl>";
					inner += "<dt>CERTIFICATION2</dt>";

	    			if (auth_chk.indexOf('@')!=-1) {
						auth_chk_arr=auth_chk.split('@');
						//console.log(auth_chk_arr[0]);
						
						console.log("result[i].product_auth :"+result[i].product_auth);
						console.log("auth_chk_arr[0] : "+auth_chk_arr[0]);
						console.log("auth_chk_arr[1] : "+auth_chk_arr[1]);
						
						if (auth_chk_arr[1].indexOf('KS')==true && auth_chk_arr[1].indexOf('KC')==true) {
							inner += "<dd><img src='/img/icon_kc.png' alt='' style='width:15px; height:15px;'><img src='/img/icon_ks.png' alt='' style='width:15px; height:15px;'>"+auth_chk_arr[1]+"</dd>";
							console.log(1);
						}						
						else if (auth_chk_arr[0].indexOf('KS')) {
							inner += "<dd><img src='/img/icon_kc.png' alt='' style='width:15px; height:15px;'>"+auth_chk_arr[1]+"</dd>";
							console.log(2);
						}
						else if (auth_chk_arr[0].indexOf('KC')) {
							inner += "<dd><img src='/img/icon_ks.png' alt='' style='width:15px; height:15px;'>"+auth_chk_arr[1]+"</dd>";
						}
					}else{
						inner += "<dd>"+auth_chk+"</dd>";
					}
					
// 					if (auth_chk.indexOf('@')!=-1) {
// 						auth_chk_arr=auth_chk.split('@');
// 						inner += "<dd><img src='/img/ks_mark.png' alt='' style='width:15px; height:15px;'>"+auth_chk_arr[1]+"</dd>";
// 					}else{
// 						inner += "<dd>"+auth_chk+"</dd>";
// 					}
					
					inner += "</dl>";
					inner += "<div class='btn'>";
					//	if (map_chk.indexOf('.pdf')!=-1 || map_chk.indexOf('.PDF')!=-1) {
					//  inner += "<a href='#'><i><img src='/img/summary_icon06.png' alt=''></i>????????? ??????</a>";
					if (chk_length<10) {
						if (lang=='en') {
    						inner += "<a href='javascript:return false;'><i><img src='/img/summary_icon06.png' alt=''></i>No Data</a>";							
						}else{
    						inner += "<a href='javascript:return false;'><i><img src='/img/summary_icon06.png' alt=''></i>????????????</a>";
						}
					}else{
						if (lang=='en') {
        					if (img_chk.indexOf('.png')!=-1 || img_chk.indexOf('.jpg')!=-1 || img_chk.indexOf('.PNG')!=-1 || img_chk.indexOf('.JPG')!=-1) {
            					//inner += "<a href='/img/product/"+img_chk+"' download><i><img src='/img/summary_icon01.png' alt=''></i>?????????</a>";
            					inner += "<a onclick='actionSubmit(\""+img_chk+"\",\"product\")'><i><img src='/img/summary_icon01.png' alt=''></i>Image</a>";
            				}
        					if (manual_chk.indexOf('.pdf')!=-1 || manual_chk.indexOf('.jpg')!=-1 || manual_chk.indexOf('.PDF')!=-1 || manual_chk.indexOf('.JPG')!=-1) {
            					//inner += "<a href='/img/product_manual/"+manual_chk+"' download><i><img src='/img/summary_icon02.png' alt=''></i>?????????</a>";
            					inner += "<a onclick='actionSubmit(\""+manual_chk+"\",\"product_manual\")'><i><img src='/img/summary_icon02.png' alt=''></i>Manual</a>";
            				}
    
    
            				if (map_1_chk.indexOf('.dwg')!=-1 || map_1_chk.indexOf('.DWG')!=-1) {
                    			//inner += "<a href='/img/product_map/"+result[0].product_map_2+"' class='left' download><i><img src='/img/summary_icon03-2.png' alt=''></i><span>??????</span></a>";
                    			inner += "<a class='left' onclick='actionSubmit(\""+map_2_chk+"\",\"product_map\")'><i><img src='/img/summary_icon03-2.png' alt=''></i><span>Map</span></a>";
                    			//inner += "<a href='/img/product_map/"+result[0].product_map_1+"' class='right' download><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
                    			inner += "<a class='right' onclick='actionSubmit(\""+map_1_chk+"\",\"product_map\")'><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
                			}
                			
        					if (auth_chk!="" && auth_chk!=null) {
        						//inner += "<a onclick='imsi();'><i><img src='/img/summary_icon05.png' alt=''></i>?????????</a>";
        						if (result[i].product_auth_file==null || result[i].product_auth_file=="" ) {
        							inner += "<a onclick='imsi();'><i><img src='/img/summary_icon05.png' alt=''></i>Certification</a>";
    							}else{
            						inner += "<a onclick='cert_actionSubmit(\""+result[i].product_auth_file+"\");'><i><img src='/img/summary_icon05.png' alt=''></i>Certification</a>";
    							}
    						}
							
						}else{
        					if (img_chk.indexOf('.png')!=-1 || img_chk.indexOf('.jpg')!=-1 || img_chk.indexOf('.PNG')!=-1 || img_chk.indexOf('.JPG')!=-1) {
            					//inner += "<a href='/img/product/"+img_chk+"' download><i><img src='/img/summary_icon01.png' alt=''></i>?????????</a>";
            					inner += "<a onclick='actionSubmit(\""+img_chk+"\",\"product\")'><i><img src='/img/summary_icon01.png' alt=''></i>?????????</a>";
            				}
        					if (manual_chk.indexOf('.pdf')!=-1 || manual_chk.indexOf('.jpg')!=-1 || manual_chk.indexOf('.PDF')!=-1 || manual_chk.indexOf('.JPG')!=-1) {
            					//inner += "<a href='/img/product_manual/"+manual_chk+"' download><i><img src='/img/summary_icon02.png' alt=''></i>?????????</a>";
            					inner += "<a onclick='actionSubmit(\""+manual_chk+"\",\"product_manual\")'><i><img src='/img/summary_icon02.png' alt=''></i>?????????</a>";
            				}


        					
            				if (map_1_chk.indexOf('.dwg')!=-1 || map_1_chk.indexOf('.DWG')!=-1) {
                    			//inner += "<a href='/img/product_map/"+result[0].product_map_2+"' class='left' download><i><img src='/img/summary_icon03-2.png' alt=''></i><span>??????</span></a>";
                    			inner += "<a class='left' onclick='actionSubmit(\""+map_2_chk+"\",\"product_map\")'><i><img src='/img/summary_icon03-2.png' alt=''></i><span>??????</span></a>";
                    			//inner += "<a href='/img/product_map/"+result[0].product_map_1+"' class='right' download><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
                    			inner += "<a class='right' onclick='actionSubmit(\""+map_1_chk+"\",\"product_map\")'><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
                			}
        					if (auth_chk!="" && auth_chk!=null) {
        						//inner += "<a onclick='imsi();'><i><img src='/img/summary_icon05.png' alt=''></i>?????????</a>";
        						if (result[i].product_auth_file==null || result[i].product_auth_file=="" ) {
        							//inner += "<a onclick='imsi();'><i><img src='/img/summary_icon05.png' alt=''></i>?????????</a>";
    							}else{
            						inner += "<a onclick='cert_actionSubmit(\""+result[i].product_auth_file+"\");'><i><img src='/img/summary_icon05.png' alt=''></i>?????????</a>";
    							}
    						}
						}
					}
        			inner += "</li>";
					inner += "</div>";	
					inner += "</div>";	
				//}
				if(result[i].product_title == "??????????????? 3??? (?????????)"){
    				console.log("========================?????????================================");
    				console.log(map_1_chk);
    				console.log("========================================================");
				}
				if(result[i].product_title == "??????????????? 3??? (?????????)"){
    				console.log("========================?????????================================");
    				console.log(map_1_chk);
    				console.log("========================================================");
				}
			}
			$('.sub_products').append(inner);
		}
	});
}
	
function imsi(){
	alert('??????????????????.');
}

function cert_actionSubmit(val, type){
	/*
	alert('??????????????????.');
	return;	
	*/
	$("#cert_send_value").val(val);
	$("#cert_actionForm").attr("action", "/cert/cert_down.php");
    $("#cert_actionForm").submit();
}

function actionSubmit(val, type){
	$("#send_type").val(type);
	$("#send_value").val(val);
	$("#actionForm").attr("action", "/wp-content/themes/musign/include/file_down.php");
    $("#actionForm").submit();
}

</script>
<form id="cert_actionForm" name="cert_actionForm" method="post" action="">
	<input type="hidden" id="cert_send_type" name="send_type">
	<input type="hidden" id="cert_send_value" name="send_value">
</form>


<form id="actionForm" name="actionForm" method="post" action="">
	<input type="hidden" id="send_type" name="send_type">
	<input type="hidden" id="send_value" name="send_value">
</form>


<input type="hidden" id="product_url" value="/product-detail">

<div class="product-tab">
	<div class="clearfix">
		<div class="tab tab01">
		<?php 
		  if ($_GET['lang']=='en') {
		      echo "<a href='/product-intro'>View all product</a>";
		  }else{
		      echo "<a href='/product-intro'>?????? ????????? ??????</a>";
		  }
		?>
		</div>
		
		<div class="tab tab02 cate_tab">
    		<?php 
    		  if ($_GET['lang']=='en') {
    		      echo "<div class='c_title cate1_title'>Select Product Category</div>";
    		  }else{
    		      echo "<div class='c_title cate1_title'>?????? ?????? ??????</div>";
    		  }
    		?>
			<ul class="cate_ul cate1_ul">
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
			    
			    if ($_GET['lang']=='en') {
			        $cate1_title=$confirm_row['eng_title'];
			        $cate1_title = str_replace('_',' ',$cate1_title);
			        $cate1_title = str_replace('and','&',$cate1_title);
			    }else{
			        $cate1_title=$confirm_row['kor_title'];
			    }
			?>
				<li class="cate1 <?php echo $eng_title?>" onclick="show(<?php echo $cate_type?>,'<?php echo $eng_title?>',this);"><?php echo $cate1_title?></li>			
			<?php 
			}			
			?>

			</ul>
		</div>
		
		<div class="tab tab03 cate_tab">
			<div class="c_title cate2_title">?????? ?????? ??????</div>
			<ul class="cate_ul cate2_ul">
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
				    
				    if ($_GET['lang']=='en') {
				        $cate2_title=$type2_row['eng_title'];
				        $cate2_title = str_replace('_',' ',$cate2_title);
				        $cate2_title = str_replace('and','&',$cate2_title);
				    }else{
				        $cate2_title=$type2_row['kor_title'];
				    }
				    
				?>
    				<li class="cate2 <?php echo $upper_cate?>" onclick="show(<?php echo $cate_type?>,'<?php echo $eng_title?>',this);"><?php echo $cate2_title?></li>
				<?php 
				}
				?>
			</ul>	
		</div>
		
		<div class="tab tab04 cate_tab">
		<?php 
		if ($_GET['lang']=='en') {
		    echo "<div class='c_title cate3_title'>Select product item</div>";
		}else{
		    echo "<div class='c_title cate3_title'>?????? ?????? ??????</div>";
		}
		?>
			<ul class="cate_ul cate3_ul">
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
				    
				    if ($_GET['lang']=='en') {
				        $cate3_title=$type3_row['eng_title'];
				        $cate3_title_conv = str_replace('_',' ',$cate3_title);
				        $cate3_title_conv = str_replace('and','&',$cate3_title_conv);
				    }else{
				        $cate3_title=$type3_row['kor_title'];
				        $cate3_title_conv=$type3_row['kor_title'];
				    }
				?>
				<li class="cate3 <?php echo $upper_cate?>" onclick="choose_cate('<?php echo $cate3_title?>',this,'act');"><?php echo $cate3_title_conv?></li>				
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
		<?php
		if ($_GET['lang']=='en') {
           echo "<h1>Product Line Up</h1>";
		}else{
		   echo "<h1>?????? ?????????</h1>";
		}
		?>
		<?php 
		if ($row['product_indi']=='O' && strlen($row['product_info']) > 5) {
		   
		 ?>
		 	<p class="color-b indi_spec"><?php echo $row['product_info']?></p>
		 <?php 
		}else if($row['product_indi']!='O'){
		    if ($_GET['lang']=='en') {
		        echo "<p class='color-b'>*Click on a product to see detailed specifications.</p>";
		    }else{
    			echo "<p class='color-b'>*??????????????? ???????????? ????????? ???????????????.</p>";
		    }

		}
		?>
		<div class="tab">
		<?php 
		if ($row['product_indi']=='O') {
		    for ($i = 0; $i < sql_count($cate4_result); $i++) {
		        $cate4_row = sql_fetch($cate4_result);
		        if ($_GET['lang']=='en') {
		            $cate_4_eng_query = "select * from product_cate where kor_title='{$cate4_row['product_cate4']}' LIMIT 1 ";
		            $cate_4_eng_result = sql_query($cate_4_eng_query);
		            $cate_4_eng_row = sql_fetch($cate_4_eng_result);
		            
		            $cate4_eng = $cate_4_eng_row['eng_title'];
		            $cate4_eng = str_replace('_'," ",$cate4_eng);
		            $cate4_eng = str_replace('and','&',$cate4_eng);
		        }else{
		            $cate4_eng = $cate4_row['product_cate4'];
		        }
		        if ($i==0) {
		            ?>
    		    <button type="button" class="btn on" onclick="getindi('<?php echo $row['product_cate3']?>','<?php echo $cate4_row['product_cate4']?>',this)"><?php echo $cate4_eng; ?></button>  
    		      <?php 
    		  }else{   
                 ?>
    			<button type="button" class="btn" onclick="getindi('<?php echo $row['product_cate3']?>','<?php echo $cate4_row['product_cate4']?>',this)"><?php echo $cate4_eng; ?></button>
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
            if ($_GET['lang']=='en') {
                $cate_4_eng_query = "select * from product_cate where kor_title='{$cate4_row['product_cate4']}' LIMIT 1 ";
                
                $cate_4_eng_result = sql_query($cate_4_eng_query);
                $cate_4_eng_row = sql_fetch($cate_4_eng_result);
                             
                $cate4_eng = $cate_4_eng_row['eng_title'];
                $cate4_eng = str_replace('_'," ",$cate4_eng);
                $cate4_eng = str_replace('and','&',$cate4_eng);
                
            }else{
                $cate4_eng = $cate4_row['product_cate4'];
            }
                 
    		  if ($i==0) {
    		     
    		      ?>
    		    <button type="button" class="btn on" onclick="getData('<?php echo $row['product_cate3']?>','<?php echo $cate4_row['product_cate4']?>',this)"><?php echo $cate4_eng; ?></button>  
    		      <?php 
    		  }else{
                 ?>
    			<button type="button" class="btn" onclick="getData('<?php echo $row['product_cate3']?>','<?php echo $cate4_row['product_cate4']?>',this)"><?php echo $cate4_eng; ?></button>
    		<?php 
    		  }
    		}
		}
		?>
		
		
		
		</div>
		<div id="tab-content" class="tab-content">
		<!-- 
			<ul class="test1">
				<li><button>?????????</button></li>
				<li>?????????</button>
					<ul>
						<li><button>????????? ????????????1</button></li>
						<li><button>????????? ????????????2</button></li>
						<li><button>????????? ????????????3</button></li>												
					</ul>
				</li>
				<li><button>?????????</button></li>								
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
	<?php 
	if ($_GET['lang']=='en') {
	    echo "<h1>Catalog</h1>";
	    echo "<p class='color-b'>*To learn more about exterior materials, please refer to the catalog.</p>";
	    echo "<div class='btn-wrap'>";
	    echo "<a onclick='actionSubmit(\"2021_KMEW_catalog_kr.pdf\",\"catalog\")'>Download KMEW Catalog</a>";
	    echo "<a href='https://www.kmew.co.jp/global/korea/' target='_blank' class='site'>KMEW Site (Kor)</a>";
	    echo "</div>";
	}else{
	    echo "<h1>????????????</h1>";
	    echo "<p class='color-b'>*???????????? ?????? ????????? ??????????????? ??????????????? ??????????????????.</p>";
	    echo "<div class='btn-wrap'>";
	    echo "<a onclick='actionSubmit(\"2021_KMEW_catalog_kr.pdf\",\"catalog\")'>KMEW ???????????? ????????????</a>";
	    echo "<a href='https://www.kmew.co.jp/global/korea/' target='_blank' class='site'>?????? KMEW ????????? (?????????)</a>";
	    echo "</div>";
	}
	?>
<!-- 		<h1>????????????</h1> -->
<!-- 		<p class="color-b">*???????????? ?????? ????????? ??????????????? ??????????????? ??????????????????.</p> -->
<!-- 		<div class="btn-wrap"> -->
<!-- 		<a onclick='actionSubmit("2019 KMEW catalog.pdf","catalog")'>KMEW ???????????? ????????????</a>  -->
<!-- 			<a href="https://www.kmew.co.jp/global/korea/" target="_blank" class="site">?????? KMEW ????????? (?????????)</a> -->
<!-- 		</div> -->
	</section>
	<?php 	
	}
	?>
	
	<section class="detail-section intro">
	<?php 
    	if ($_GET['lang']=='en') {
    	    echo "<h1>Introduction of Product</h1>";
    	}else{
    	    echo "<h1>?????? ??????</h1>";
    	}
	?>
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
    			        $imagesize = getimagesize("/img/product/{$arr_layer_img[$i]}");
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


<!-- ?????? ?????? -->
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

	//?????? ?????? ????????? ????????????
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
	
	//????????? ???????????????
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
	//??? ??????
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
	
	$('.tab02').click(function(){
		$('.cate1_ul').show();
	});
	
	$('.tab03').click(function(){
		$('.cate2_ul').show();
	});
	
	$('.tab04').click(function(){
		$('.cate3_ul').show();
	});
	
	
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

	//?????? ???????????? ?????? ?????? ??? ?????? DOM ??????
	if($('.lineup .tab').children().length == 0)
		$('.lineup .tab').remove();
	
})
window.onload = function(){
	$('html, body').fadeIn(300);
}
</script>