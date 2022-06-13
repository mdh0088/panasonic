<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$query="select * from product where idx = 5";
$result = sql_query($query);
$row = sql_fetch($result);



$arr_layer_type = explode('@', $row['layer_type']);
$arr_layer_title = explode('@', $row['layer_title']);
$arr_layer_conts = explode('@', $row['layer_conts']);
$arr_layer_img = explode('@', $row['layer_img']);



$cate4_query = "select * from product where product_cate3='{$row['product_cate3']}'";
$cate4_result = sql_query($cate4_query);
$cate4_arr=array();

$cate4="";
$chk_cate4="";
$cnt=0;
for ($i = 0; $i < sql_count($cate4_result); $i++) {
    $cate4_row = sql_fetch($cate4_result);
    
    $cate4=$cate4_row['product_cate4'];
    if ($cate4!=$chk_cate4) {
        $cate4_arr[$cnt]=$cate4;
        $cnt=$cnt+1;
    }
    $chk_cate4=$cate4;
}
$first_cate3 = $row['product_cate3'];
$first_cate4 = $cate4_arr[0];

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

	$('.tab03').hide();
	$('.tab04').hide();
	$('.tab05').hide();

	$('.main_title').text(main_title_arr[0]);
	$('.main_model').text(main_model_arr[0]);
	$('.main_rating').text(main_rating_arr[0]);
	$('.main_size').text(main_size_arr[0]);
	$('.main_auth').text(main_auth_arr[0]);
	
	$('.main_manual').attr('href',main_manual_arr[0]);
	$('.main_map_pdf').attr('href',main_map_arr[0]+'.pdf');
	$('.main_map_dwg').attr('href',main_map_arr[0]+'.dwg');
	$('.main_auth_file').attr('href',main_auth_arr[0]);
	
	
	getData(first_cate3,first_cate4);


//	var get_num=0;
// 	$('.owl-next').click(function(){
// 		get_num = $('.active').find('img').attr('data-number');
// 		$('.main_title').text(main_title_arr[get_num]);
// 		$('.main_model').text(main_model_arr[get_num]);
// 		$('.main_rating').text(main_rating_arr[get_num]);
// 		$('.main_size').text(main_size_arr[get_num]);
// 		$('.main_auth').text(main_auth_arr[get_num]);
		
// 		$('.main_manual').attr('href',main_manual_arr[get_num]);
// 		$('.main_map_pdf').attr('href',main_map_arr[get_num]+'.pdf');
// 		$('.main_map_dwg').attr('href',main_map_arr[get_num]+'.dwg');
// 		$('.main_auth_file').attr('href',main_auth_arr[get_num]);
// 	});

// 	$('.owl-prev').click(function(){
// 		get_num = $('.active').find('img').attr('data-number');
// 		$('.main_title').text(main_title_arr[get_num]);
// 		$('.main_model').text(main_model_arr[get_num]);
// 		$('.main_rating').text(main_rating_arr[get_num]);
// 		$('.main_size').text(main_size_arr[get_num]);
// 		$('.main_auth').text(main_auth_arr[get_num]);
		
// 		$('.main_manual').attr('href',main_manual_arr[get_num]);
// 		$('.main_map_pdf').attr('href',main_map_arr[get_num]+'.pdf');
// 		$('.main_map_dwg').attr('href',main_map_arr[get_num]+'.dwg');
// 		$('.main_auth_file').attr('href',main_auth_arr[get_num]);
// 	});

	//var a = $(".active").find('li').find('img').attr('alt');
});
} ) ( jQuery);

// 	$(".active").find('li').find('img').attr('alt').change(function(){
// 		alert(1);
// 	});

(function($) { 
$(window).load(function(){

});
} ) ( jQuery);

function show(cate,idx,text){
alert($(text).text());
	if (cate==1) {
		$('.tab04').hide();
		$('.tab05').hide();
	}else if (cate==2) {
		$('.tab05').hide();
	}
	
	$('.tab0'+(cate+2)).show();
	$('.cate'+(cate+1)).hide();
	$('.'+idx).show();
}

function getData(cate3,cate4){

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
				inner += "<li>";
				inner += "<a href='#'>";
				inner += "<i><img src='/img/product/main_img_03-01.png'></i>";
				inner += "<strong>"+result[i].product_title+"</strong>";
				inner += "</a>";
				inner += "</li>";
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
			<div>제품 구분 선택</div>
			<ul>
				<li class="cate01 baesun" onclick="show(1,'baesun',this);">배선기구</li>
				<li class="cate01 smart_baesun" onclick="show(1,'smart_baesun');">스마트 배선기구</li>
				<li class="cate01 gae_bun" onclick="show(1,'gae_bun');">계전기 & 분전반</li>
				<li class="cate01 si-jang" onclick="show(1,'si-jang');">시장용품</li>
				<li class="cate01 kmew" onclick="show(1,'kmew');">KMEW</li>
				<li class="cate01 bock_gi" onclick="show(1,'bock_gi');">복지용구</li>
				<li class="cate01 jo_myeong" onclick="show(1,'jo_myeong');">조명제어시스템</li>
			</ul>
		</div>
		
		
		<div class="tab tab03 cate_tab">
		 
			<div>제품 항목 선택</div>
			<ul>
			<!-- 
				<!-- 배선기구 -->
				<li class="cate2 baesun" onclick="show(2,'series');">시리즈</li>
				<li class="cate2 baesun" onclick="show(2,'switch_consent');">기능형스위치&콘센트</li>
				<li class="cate2 baesun" onclick="show(2,'time_switch');">타임스위치</li>
				<!-- 배선기구 -->
				
				<!-- 스마트배선기구 -->
				<li class="cate2 smart_baesun">거실통합형 스마트 스위치</li>
				<li class="cate2 smart_baesun">지능형 디밍패턴 스위치</li>
				<li class="cate2 smart_baesun">홈네트워크&일괄소등 스위치</li>
				<li class="cate2 smart_baesun">대기전력 자동차단 스위치</li>
				<li class="cate2 smart_baesun">타임키퍼Ⅱ·Ⅲ 리모컨 스위치</li>
				<li class="cate2 smart_baesun">센서스위치</li>
				<!-- 스마트배선기구 -->
				
				<!-- 계전기분전기 -->
				<li class="cate2 gae_bun">계전기</li>
				<li class="cate2 gae_bun">분전반</li>
				<!-- 계전기분전기 -->
				
				<!-- 시장용품 -->
				<li class="cate2 si-jang">멀티탭</li>
				<li class="cate2 si-jang">노출형 콘센트</li>
				<li class="cate2 si-jang">산업용 자재</li>
				<li class="cate2 si-jang">소형 스위치/기타 노출 자재</li>
				<li class="cate2 si-jang">LED조광기</li>
				<!-- 시장용품 -->
				
				<!-- KMEW -->
				<li class="cate2 kmew">외장재</li>
				<li class="cate2 kmew">지붕재</li>
				<!-- KMEW -->
				
				<!-- 복지용구 -->
				<li class="cate2 bock_gi">목욕의자</li>
				<li class="cate2 bock_gi">플라스틱 이동변기</li>
				<li class="cate2 bock_gi">목재형 이동변기</li>
				<!-- 복지용구 -->
				
				<!-- 조명제어시스템 -->
				<li class="cate2 jo_myeong">전선관</li>
				<li class="cate2 jo_myeong">풀투웨이(자체 페이지 링크)</li>
				<!-- 조명제어시스템 -->
				
			</ul>
		</div>
		
		
		
		
		<div class="tab tab04 cate_tab">
			<div>제품 항목 선택</div>
			<ul>
				<!-- 시리즈 -->
				<li class="cate3 series" onclick="show(3,'platima');">플레티마</li>
				<li class="cate3 series" onclick="show(3,'pione');">피오네</li>
				<li class="cate3 series" onclick="show(3,'haieo');">하이어</li>
				<li class="cate3 series" onclick="show(3,'aleuche');">아르체</li>
				<li class="cate3 series" onclick="show(3,'paleutenon');">파르테논</li>
				<li class="cate3 series" onclick="show(3,'haijen');">하이젠</li>
				<li class="cate3 series" onclick="show(3,'liche');">리체</li>
				<li class="cate3 series" onclick="show(3,'lipaleu');">리파르</li>
				<li class="cate3 series" onclick="show(3,'lijen');">리젠</li>
				<li class="cate3 series" onclick="show(3,'vegawide');">베가와이드</li>
				<li class="cate3 series" onclick="show(3,'laon');">라온</li>
				<!-- 시리즈 -->
				
				
				<!-- 기능형스위치콘센트 -->
				<li>대기 전력 자동 차단 콘센트</li>
				<li>애어컨 실외기용 스위치</li>
				<li>방우형 제품</li>
				<li>화장대용 콘센트</li>
				<li>슬라이드 커버 콘센트</li>
				<li>결로 방지 콘센트</li>
				<li>USB 충전 콘센트</li>
				<li>플러그 자동 분리 콘센트</li>
				<li>TV전용 통합 콘센트</li>
				<li>스위치 부착형 콘센트</li>
				<li>플로어 콘센트</li>
				<li>가구장 콘센트</li>
				<li>안전형 콘센트</li>
				<li>LED 홈 보안등</li>
				<!-- 기능형스위치콘센트 -->
			</ul>
		</div>
		
		
		<div class="tab tab05 cate_tab">
			<div>제품 항목 선택</div>
			<ul>
				<!-- 플레티마 -->
				<li class="cate4 platima">콘센트</li>
				<li class="cate4 platima">스위치</li>
				<!-- 플레티마 -->
			</ul>
		</div>
		
	</div>
</div>
<div class="product-detail-wrap">
	<div class="product-summary">
		<section class="clearfix">
			<h1><?php echo $row['product_cate3']." ".$row['product_cate2']?></h1>
			<div class="thumbnail">
				<ul class="owl-carousel">
					<?php 
					$main_thumb_arr = explode('@',$main_thumb);
					for ($i = 0; $i < count($main_thumb_arr); $i++) {
					?>
					<li><img src="/img/product/detail_thum.png" alt="" data-number="<?php echo $i?>"></li>
					<?php 
					   }					
					?>
				</ul>
			</div>
			
			<div class="txt">
				<h2><?php echo $row['product_cate3']?><strong class="main_title"></strong></h2>
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
					<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
					<a class="main_manual" href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
					<a class="main_map_pdf" href="#" class="left"><i><img src="/img/summary_icon03.png" alt=""></i>PDF</a>
					<a class="main_map_dwg" href="#" class="right"><i><img src="/img/summary_icon04.png" alt=""></i>DWG</a>
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
		for ($i = 0; $i < count($cate4_arr); $i++) {
		?>
			<button type="button" onclick="getData('<?php echo $row['product_cate3']?>','<?php echo $cate4_arr[$i]?>')"><?php echo $cate4_arr[$i]; ?></button>
		<?php 
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
<!--  			<article class="detail01">
				<div class="txt">
					<h1><strong>디자인</strong>과 <strong>품질</strong>에 동시에 만족한다!</h1>
					<h2><strong>2009 iF</strong> <br>디자인어워드 수상</h2>
					<p>국내 배선기구업계 최초 2009 iF 디자인어워드 수상 <br>디자인경쟁력 강화 </p>
				</div>
				<div class="img">
					<img src="/img/logo_big.png" alt="logo" class="logo-back">
					<img src="/img/product/detail_thum.png" alt="">
				</div>
			</article>
			<article class="detail02">
				<div class="txt">
					<h1>헤어라인 패턴이 적용된 <br><strong>알루미늄 플레이드</strong></h1>
					<p>한국의 고급주거환경에 적합하도록 모던&럭셔리를 주 컨셉으로 <br>디자인된 플래티마 시리즈 </p>
				</div>
				<div class="img">
					<img src="/img/product/detail_intro01.jpg" alt="">
				</div>
			</article>
			<article class="detail03">
				<div class="txt">
					<h1>일반 스위칭방식과 다른 <br><strong>Push ON/OFF</strong></h1>
					<p>한국의 고급주거환경에 적합하도록 모던&럭셔리를 주 컨셉으로 <br>디자인된 플래티마 시리즈 </p>
				</div>
				<div class="img">
					<img src="/img/product/detail_intro02.jpg" alt="">
				</div>
			</article> -->
			<?php 
			for($i = 0; $i < count($arr_layer_type); $i++)
			{
		    ?>
			    <article class="<?php echo 'detail0'.$arr_layer_type[$i]?>">
			    <div class="txt">
			    <h1><?php echo $arr_layer_title[$i]?></h1>
			    <p><?php echo $arr_layer_conts[$i]?></p>
			    </div>
			    <div class="img">
			    <img src="<?php echo '/img/product/'.$arr_layer_img[$i]?>" alt="">
			    </div>
			    </article>
		    <?php
			}
			?>
		</div>
	</section>
	<section class="detail-section last">
		<div class="img">
			<img src="/img/product/detail_intro03.jpg" alt="">
		</div>
		<div class="txt">
			<p><strong>파나소닉 자체 기준(테스트) 만족품 </strong>
			핵심부품인 스위치 몸체가 국내 생산품이 아닌 파나소닉제품(일본국내생산품) 적용. <br>
			국내품질기준인 KS보다 더 엄격한, 일본의 JIS, 그 JIS보다 더 엄격한 <br>
			파나소닉 자체 기준(테스트) 만족품
			</p>
		</div>
	</section>
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
		get_num = $('.active').find('img').attr('data-number');
		$('.main_title').text(main_title_arr[get_num]);
		$('.main_model').text(main_model_arr[get_num]);
		$('.main_rating').text(main_rating_arr[get_num]);
		$('.main_size').text(main_size_arr[get_num]);
		$('.main_auth').text(main_auth_arr[get_num]);
		$('.main_manual').attr('href',main_manual_arr[get_num]);
		$('.main_map_pdf').attr('href',main_map_arr[get_num]+'.pdf');
		$('.main_map_dwg').attr('href',main_map_arr[get_num]+'.dwg');
		$('.main_auth_file').attr('href',main_auth_arr[get_num]);
    }
	
	//아이콘 마우스호버
	$('.product-summary .btn a').mouseover(function(){
		var hr = $(this).find('img').attr('src').split('.');
		$(this).find('img').attr('src', hr[0] + '_w.' + hr[1]);
	});
	$('.product-summary .btn a').mouseout(function(){
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