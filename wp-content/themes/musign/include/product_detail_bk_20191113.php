<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
if (isset($_GET['cate3'])) {
    $cate = $_GET['cate3'];
}
if (isset($_GET['cate2'])) {
    $cate = $_GET['cate2'];
}
if (isset($_GET['cate1'])) {
    $cate = $_GET['cate1'];
}


$query="select * from product where product_cate3 ='{$cate}' limit 1";
$result = sql_query($query);
$row = sql_fetch($result);


$arr_layer_type = explode('@', $row['layer_type']);
$arr_layer_title = explode('@', $row['layer_title']);
$arr_layer_conts = explode('@', $row['layer_conts']);
$arr_layer_img = explode('@', $row['layer_img']);

$cate4_query = "SELECT DISTINCT product_cate4 FROM product WHERE product_cate3 ='{$row['product_cate3']}' AND product_cate4 != '' ";
$cate4_result = sql_query($cate4_query);

$first_cate4_query = "SELECT DISTINCT product_cate4 FROM product WHERE product_cate3 ='{$row['product_cate3']}' AND product_cate4 != '' ";
$first_cate4_result = sql_query($first_cate4_query);
$first_cate4_row= sql_fetch($first_cate4_result);

$first_cate3 = $row['product_cate3'];
$first_cate4 =$first_cate4_row['product_cate4'];

$main_thumb = preg_replace('/\r\n|\r|\n/','',$row['product_thumb']);
$main_model =  preg_replace('/\r\n|\r|\n/','',$row['product_model']);
$main_title = preg_replace('/\r\n|\r|\n/','', $row['product_title']);
$main_rating =  preg_replace('/\r\n|\r|\n/','',$row['product_rating']);
$main_size =  preg_replace('/\r\n|\r|\n/','',$row['product_size']);
$main_auth =  preg_replace('/\r\n|\r|\n/','',$row['product_auth']);
$main_manual =  preg_replace('/\r\n|\r|\n/','',$row['product_manual']);
$main_map =  preg_replace('/\r\n|\r|\n/','',$row['product_map']);
?>
<script>
var first_cate3 = '<?php echo $first_cate3?>';
var first_cate4 = '<?php echo $first_cate4?>';

var main_thumb_arr = '<?php echo $main_thumb?>';
main_thumb_arr = main_thumb_arr.split('@');

var main_model_arr = '<?php echo $main_model?>';
main_model_arr = main_model_arr.split('@');

var main_title_arr = '<?php echo $main_title?>';
main_title_arr = main_title_arr.split('@');

var main_rating_arr = '<?php echo $main_rating?>';
main_rating_arr = main_rating_arr.split('@');

var main_size_arr = '<?php echo $main_size?>';
main_size_arr = main_size_arr.split('@');

var main_auth_arr = '<?php echo $main_auth?>';
main_auth_arr = main_auth_arr.split('@');

var main_manual_arr = '<?php echo $main_manual?>';
main_manual_arr = main_manual_arr.split('@');

var main_map_arr = '<?php echo $main_map?>';
main_map_arr = main_map_arr.split('@');

(function($) { 
$(document).ready(function(){
	pop_close();
	$('.tab03').hide();
	$('.tab04').hide();
	$('.tab05').hide();

	$('.main_title').text(main_title_arr[0]);
	$('.main_model').text(main_model_arr[0]);
	$('.main_rating').text(main_rating_arr[0]);
	$('.main_size').text(main_size_arr[0]);
	$('.main_auth').text(main_auth_arr[0]);

	$('.main_thumb').attr('href','/img/product/'+main_thumb_arr[0]);
	$('.main_manual').attr('href',main_manual_arr[0]);
	$('.main_map_pdf').attr('href',main_map_arr[0]+'.pdf');
	$('.main_map_dwg').attr('href',main_map_arr[0]+'.dwg');
	$('.main_auth_file').attr('href',main_auth_arr[0]);
	
	
	getData(first_cate3,first_cate4);

});
} ) ( jQuery);

(function($) { 
$(window).load(function(){
	});
}) (jQuery);

function pop_close(){
	$('#product-popup').hide();
}

function pop_up(idx){
	$('#product-popup').show();

	$.ajax({
		type : "GET", //전송방식을 지정한다 (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/get_pop_contents.php?idx="+idx,//호출 URL을 설정한다. GET방식일경우 뒤에 파라티터를 붙여서 사용해도된다.
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

			var map_arr = result[0].product_map.split('@');
			
			var cate = result[0].product_cate3;
			if (result[0].product_cate3 =='' || result[0].product_cate3 ==null) {
				cate = result[0].product_cate2;
			}

			if (result[0].product_cate2 =='' || result[0].product_cate2 ==null) {
				cate = result[0].product_cate1;
			}
			inner = "<li><img src='/img/product/"+result[0].product_thumb+"' alt='product photo'></li>"
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
			inner += "<a href='/img/product/"+result[0].product_thumb+"'><i><img src='/img/summary_icon01.png' alt=''></i>이미지</a>";
			inner += "<a href='/img/product_manual/"+result[0].product_manual+"'><i><img src='/img/summary_icon02.png' alt=''></i>설명서</a>";
			inner += "<a href='/img/product_map/"+map_arr_1[0]+".pdf' class='left'><i><img src='/img/summary_icon03-2.png' alt=''></i><span>도면</span></a>";
			inner += "<a href='/img/product_map/"+map_arr_2[0]+".dwg' class='right'><i><img src='/img/summary_icon04-2.png' alt=''></i></a>";
			inner += "<a href='#'><i><img src='/img/summary_icon05.png' alt=''></i>인증서</a>";
			inner += "</div>";
			
			$('.pop_contents').append(inner);
		}
	});
}

function show(cate,idx,text){
	var cate_title = $(text).text();
	$(text).parent().prev().text(cate_title);
	
	if (cate==1) {
		$('.tab04').hide();
		$('.tab05').hide();
	}else if (cate==2) {
		$('.tab05').hide();
	}

	if (idx=='kmew' || idx=='jo_myeong' || idx=='bock_gi' || idx=='smart_baesun' || idx=='si-jang') {
		$('.tab03').hide();
		$('.tab04').show();
		
	}else{
		$('.tab0'+(cate+2)).show();
	}
	$('.cate'+(cate+1)).hide();
	$('.'+idx).show();

}

function choose_cate(idx,text){
	var cate_title = $(text).text();
	$(text).parent().prev().text(cate_title);
	location.href="http://panasonic.musign.co.kr/product-detail?cate3=" + idx;
}

function getData(cate3,cate4,val){
	if (val) {
		$('.btn').removeClass('on');		
	}
	$(val).addClass('on');
	
	$.ajax({
		type : "GET", //전송방식을 지정한다 (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/getCate4.php?cate3="+cate3+"&cate4="+cate4,//호출 URL을 설정한다. GET방식일경우 뒤에 파라티터를 붙여서 사용해도된다.
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

				var thumb_title = result[i].product_thumb;
				
				if (thumb_title.indexOf('png')==-1 && thumb_title.indexOf('jpg')==-1) {
					
				}else{
    				inner += "<li>";
    				inner += "<a onclick='pop_up("+result[i].idx+")'>";
    				inner += "<i><img src='/img/product/"+result[i].product_thumb+"'></i>";
    				inner += "<strong>"+result[i].product_title+"</strong>";
    				inner += "</a>";
    				inner += "</li>";
				}
			}
			$('.sub_products').append(inner);

		}
	});
}

</script>

<div class="product-tab">
	<div class="clearfix">
		<div class="tab tab01">
			<a href="/product-intro">모든 제품군 보기</a>
		</div>
		
		<div class="tab tab02 cate_tab">
			<div class="cate_title">제품 구분 선택</div>
			<ul>
				<li class="cate01 baesun" onclick="show(1,'baesun',this);">배선기구</li>
				<li class="cate01 smart_baesun" onclick="show(2,'smart_baesun',this);">스마트 배선기구</li>
				<li class="cate01 gae_bun" onclick="show(1,'gae_bun',this);">계전기&분전기</li>
				<li class="cate01 si-jang" onclick="show(2,'si-jang',this);">시장용품</li>
				<li class="cate01 kmew" onclick="show(2,'kmew',this);">KMEW</li>
				<li class="cate01 bock_gi" onclick="show(2,'bock_gi',this);">복지용구</li>
				<li class="cate01 jo_myeong" onclick="show(2,'jo_myeong',this);">조명제어시스템</li>
			</ul>
		</div>
		
		
		<div class="tab tab03 cate_tab">
		 
			<div class="cate_title">제품 항목 선택</div>
			<ul>
				<!-- 배선기구 -->
				<li class="cate2 baesun" onclick="show(2,'series',this);">시리즈</li>
				<li class="cate2 baesun" onclick="show(2,'switch_consent',this);">기능형스위치&콘센트</li>
				<li class="cate2 baesun" onclick="show(2,'time_switch',this);">타임스위치</li>
				<!-- 배선기구 -->

				<!-- 계전기분전기 -->
				<li class="cate2 gae_bun" onclick="show(2,'gae',this);">계전기</li>
				<li class="cate2 gae_bun" onclick="show(2,'bun',this);">분전기</li>
				<!-- 계전기분전기 -->	
			</ul>
		</div>
		
		<div class="tab tab04 cate_tab">
			<div>제품 항목 선택</div>
			<ul>
				<!-- 시리즈 -->
				<li class="cate3 series" onclick="choose_cate('플래티마',t,this">플래티마</li>
				<li class="cate3 series" onclick="choose_cate('피오네',t,this">피오네</li>
				<li class="cate3 series" onclick="choose_cate('하이어',t,this">하이어</li>
				<li class="cate3 series" onclick="choose_cate('아르체',t,this">아르체</li>
				<li class="cate3 series" onclick="choose_cate('파르테논',',this)>파르테논</li>
				<li class="cate3 series" onclick="choose_cate('리파르',',this)>리파르</li>
				<li class="cate3 series" onclick="choose_cate('리젠',',this)>리젠</li>
				<li class="cate3 series" onclick="choose_cate('베가와이드',this);">베가와이드</li>
				<li class="cate3 series" onclick="choose_cate('',this)s);">라온</li>
				<!-- 시리즈 -->		
				
				<!-- 기능형스위치콘센트 -->
				',this)ss="cate3 switch_consent" onclick="choose_cate('대기전력 자동차단스위치',this);',this) 자동 차단 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('에어컨 실외기용스위치',this);">애어컨 실외기용 스위치</li>
				<li class="ca',this)tch_consent" onclick="choose_cate('방우형 콘센트&스위치',this);">방우형 콘센트&스위치</li>
				<li class="cate3 ',this)consent" onclick="choose_cate('스위치부 가로형 콘센트',this);">스위치부 가로형 콘센트</li>
				<li class="',this)witch_consent" onclick="choose_cate('슬라이드 커버 콘센트',this);">슬라이드 커버 콘센트</li>
				<li',this)"cate3 switch_consent" onclick="choose_cate('결로 방지 콘센트',this);">결로 방지 콘센트</li>
				<li ',this)cate3 switch_consent" onclick="choose_cate('USB 충전 콘센트',this);">USB 충전 콘센트</li>
				<li ',this)cate3 switch_consent" onclick="choose_cate('플러그 자동 분리 콘센트',this);">플러그 자동 분리 콘센트</li>
	',this)class="cate3 switch_consent" onclick="choose_cate('TV전용 통합 콘센트',this);">TV전용 통합 콘센트</li>
		',this)lass="cate3 switch_consent" onclick="choose_cate('스위치 부착형 콘센트',this);">스위치 부착형 콘센트</li>
				',this)ss="cate3 switch_consent" onclick="choose_cate('플로어 콘센트',this);">플로어 콘센트</li>
				<li clas',this)3 switch_consent" onclick="choose_cate('가구장 콘센트',this);">가구장 콘센트</li>
				<li class="c',this)itch_consent" onclick="choose_cate('안전형 콘센트',this);">안전형 콘센트</li>
				<li class="c',this)itch_consent" onclick="choose_cate('LED 홈 보안등',this);">LED 홈 보안등</li>
				<!-- 기능형',this)-->
				
				<!-- 타입 스위치 -->
				<li class="cate3 time_switch" onclick="choose_cat',this)치 기계식',this);">타임스위치 기계식</li>
				<!-- 타입 스위치 -->
				
				<!-- 계전기 -->
				<li class="cate3 gae" onclick="choose_cate('배선 차단기'',this)">배선 차단기</li>
				<li class="cate3 gae" onclick="choose_cate('누전 차단기',this);">누전 차단기</li>
				<li class="cate3 g',this)lick="choose_cate('기타 계전기',this);">기타 계전기</li>
				<!-- 계전기 -->
				',this)!-- 분전기 -->
				<li class="cate3 bun" onclick="choose_cate('HB 타입',th',this)B 타입</li>
				<li class="cate3 bun" onclick="choose_cate('C2 타입',this);">C2 타입</li>
				<!-- 분전기 -->
				
',this)- 시장용품 -->
				<li class="cate3 si-jang" onclick="choose_cate('멀티탭',this);">멀티탭</li>
				<li class="cate3 si-jang" onclick="choose_cate('노출형 콘센트',this);">노출형 콘센트</li>
				<li class="ca',this)jang" onclick="choose_cate('산업용 자재',this);">산업용 자재</li>
				<li class="',this)i-jang" onclick="choose_cate('소형 스위치/기타 노출자재',this);">소형 스위치/기타 노출 자재</li>
',this)i class="cate3 si-jang" onclick="choose_cate('LED조광기',this);">LED조광기</li>
				<!-',this)-->
				
				
				<!-- 스마트배선기구 -->
				<li class="cate3 smart_baesun" onclick="',this)cate('거실통합형 스마트 스위치',this);">거실통합형 스마트 스위치</li>
				<li class="cate3 smart_baesun" onclick="choose_cate('지능형 디밍패턴 스위치',this);">지능형 디밍패턴 스위',this
				<li class="cate3 smart_baesun" onclick="choose_cate('홈네트워크&일괄소등 스위치',this);">홈네트워크&일괄소등',this)i>
				<li class="cate3 smart_baesun" onclick="choose_cate('대기전력 자동차단 스위치',this);">대기전력 자동차단',this)i>
				<li class="cate3 smart_baesun" onclick="choose_cate('타임키퍼Ⅱ·Ⅲ 리모컨 스위치',this);">타임키퍼Ⅱ·Ⅲ ',this)</li>
				<li class="cate3 smart_baesun" onclick="choose_cate('센서스위치',this);">센서스위치</li>
				',this)트배선기구 -->
				
				<!-- KMEW -->
				<li class="cate3 kmew" onclick="choose_cate('외장',this));">외장재</li>
				<li class="cate3 kmew" onclick="choose_cate('지붕재',this);">지붕재</li>
				<!-- KMEW -->
				
			',this)지용구 -->
				<li class="cate3 bock_gi" onclick="choose_cate('목욕의자',this);">목욕의자</li>
				<li class="cate3 bock_gi" onclick="choose_cate('플라스틱 이동변기',this);">플라스틱 이동변기</li>
				<li clas',this)3 bock_gi" onclick="choose_cate('목재형 이동변기',this);">목재형 이동변기</li>
				<!-- ',this)>
				
				<!-- 조명제어시스템 -->
				<li class="cate3 jo_myeong" onclick="choose_',this)선관',this);">전선관</li>
				<li class="cate3 jo_myeong" onclick="choose_cate('Full To Way',this);">Full To Way(자체 페이지 링크)</l',this)	<!-- 조명제어시스템 -->
				
			</ul>
		</div>
		
	</div>
</div>
<div class=',this)t-detail-wrap">
	<div class="product-summary">
		<section class="clearfix">
			<h1><?php echo $row['product_cate3']." ".$row['product_cate2']?></h1>
			<div class="thumbnail">
				<ul class="owl-carousel">
					<?php 
					$main_thumb_arr = explode('@',$main_thumb);
					for ($i = 0; $i < count($main_thumb_arr); $i++) {
					?>
					<li><img src="/img/product/<?php echo $main_thumb_arr[$i]?>" alt="" data-number="<?php echo count($main_thu					<li><img src="/img/product/<?php echo $main_thumb_arr[$i]?>" alt="" data-number="<?php echo count($main_thumb_arr)-($i+1)echo $row['product_cate3']?><strong class="main_title"></strong></h2>
				<dl>
					<dt>Model Name</dt>
					<dd class="main_model"><?php echo $row['product_model']?></dd>
				</dl>
				<dl>
					<dt>Product Name</dt>
					<dd class="main_title"><?php echo $row['product_title']?></dd>
				</dl>
				<dl>
					<dt>Rating</dt>
					<dd class="main_rating"><?php echo $row['product_rating']?></dd>
				</dl>
				<dl>
					<dt>Size</dt>
					<dd class="main_size"><?php echo $row['product_size']?></dd>
				</dl>
				<dl>
					<dt>CERTIFICATION</dt>
					<dd class="main_auth"><?php echo $row['product_auth']?></dd>
				</dl>
				<div class="btn">
					<a class="main_thumb" href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
					<a class="main_manualclass="main_thumb" src="/img/summary_icon02.png" alt=""></i>설명서</a>
					<a class="main_map_pdf left" href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
					<a class="main_map_dwg right" href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
					<a class="main_auth_file" href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
				</div>
			</div>
			
		</section>
	</div>
	<section class="detail-section lineup">
		<h1>제품 라인업</h1>
		<p class="color-b">*상세스펙을 보시려면 제품을 클릭하세요.</p>
		<div class="tab">
		<?php 
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
		?>
		
		</div>
		<div class="tab-content">
			<ul class="sub_products">

			</ul>
		</div>
	</section>
	<section class="detail-section intro">
		<h1>제품 소개</h1>
		<div class="intro-wrap">

			<?php 
			for($i = 0; $i < count($arr_layer_type); $i++)
			{
			    if ($i==1) {
			 ?>
            	<section class="detail-section last">
     
			    if ($i==1) {
			 ?>
            	<section class="detail-section last">
            		<div class="img">
            			 <img src="<?php echo '/img/product/'.$arr_layer_img[$i]?>" alt="">
            		</div>
            		<div class="txt">
            			<p><strong><?php echo $arr_layer_title[$i]?> </strong>
            			<?php echo $arr_layer_conts[$i]?>
            			</p>
            		</div>
            	</section>
			 <?p    hp 
			    }else{
			                
		    ?>
			    <article class="<?php echo         'detail0'.$arr_layer_type[$i]?>">
			    <div cl    ass="txt">
			        <h1><?php echo $arr_la        yer_title[$i]?></h1>
			    <p><?php echo $arr_layer_conts[$i]?></p>
			       ">    
			    <img src="<?php echo '/img/product/'.$arr_layer_img[$i]?>" alt="">
			    <?php 
			    
			    ?>
			    </div>
			    </article>
		    <?php
			    }up">
	<div class="popup-wrap">		
		<div class="product-summary">
			<section class="clearfix">
				<div class="thumbnail">
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
$(document).ready(function(){

	//제품 상단 이미지 슬라이드
	$('.product-summary .owl-carousel').owlCarousel({
		items:1,
		nav:true,
		loop:true,
		//onDragged: callback,
		onChanged: callback		
	});
	
	var get_num=0;
	
    function callback(event) {
		get_num = $('.active').find('img').attr('data-n0mber');
		
		$('.main_title').text(main_title_arr[get_num]);
		$('.main_model').text(main_mo
		
		get_num]);
		$('.main_rating').text(main_rating_arr[get_num]);
		$('.main_size').text(main_size_arr[get_num]);
		$('.main_auth').text(main_auth_arr[get_num]);
		$('.main_thumb').attr('href','/img/product/'+main_thumb_arr[get_num]);
		$('.main_m
		$('.main_thumb').attr('href','/img/product/'+main_thumb_arr[get_num]);('.main_map_pdf').attr('href','/im'/img/product_manual/'+p_arr[get_num]+'.pdf');
		$('.main_map_dwg').attr('href','/i'/img/product_map/'+n_map_arr[get_num]+'.dwg');
		$('.main_auth_file').attr('href',m'/img/product_map/'+]);
    }
	
	//아이콘 마우스호버
	$(document).on('mouseover', '.product-summary .btn a', function(e){
		var hr = $(this).find('img').attr('src').split('.');
		$(this).find('img').attr('src', hr[0] + '_w.' + hr[1]);
	});
	$(document).on('mouseout', '.product-summary .btn a', function(e){
		var hr = $(this).find('img').attr('src').split('_w');
		$(this).find('img').attr('src', hr[0] + hr[1]);
	});
	
	//탭 클릭
	$('.product-tab .tab').click(function(){
		var menu = $(this).find('ul');
		if($(this).hasClass('drop')){
			$('.product-tab .tab').removeClass('drop');
			$('.product-tab .tab ul').slideUp(500);
		}else{			
			$('.product-tab .tab').removeClass('drop');
			$('.product-tab .tab ul').slideUp(500);
			$(this).addClass('drop').find('ul').slideDown(500);
		}
	})
})
</script>