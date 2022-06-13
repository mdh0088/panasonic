<script>

$( document ).ready(function() {
   $('.cate2').hide();
   $('.cate3').hide();
});


var to_link="";

var cate1_url ="";
function show(cate,idx,text){

	var cate_title = $(text).text();
	$(text).parent().prev().text(cate_title);
	
	if (cate_title.indexOf('&')!=-1) {
		cate_title= cate_title.replace('&','@');
	}
	if (cate==1) {
		$('.cate3').hide();
		$('.cate3_hide').show();
		$('.cate2_hide').hide();
		
		$('.cate2_title').text('Solution');
		$('.cate3_title').text('Item');
		cate1_url = cate_title;
	
// 		$('.tab04').hide();
// 		$('.tab05').hide();
	}
	if (cate==2) {
		$('.cate3_hide').hide();
		$('.cate3_title').text('Item');
		cate2_url = cate_title;
		
		$('.tab05').hide();
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

var link = "";
function choose_cate(idx,text,act){

	if (cate1_url=="") {
		alert('제품을 선택해 주세요.');
		return;
	}
	
	
	if (idx.indexOf('&')!=-1) {
		idx= idx.replace('&','@');
	}
	var cate_title = $(text).text();
	$(text).parent().prev().text(cate_title);
	
	if (act=="act") {
    	var lo_link = "http://panasonic.musign.co.kr/product-detail?cate1="+encodeURI(cate1_url)+"&cate2="+encodeURI(cate2_url)+"&cate3=" + encodeURI(idx);
    	$("#product_url").val(lo_link);
	}

}

function page_link(){
	location.href=$("#product_url").val();
}




</script>

<input type="hidden" id="product_url" value="">

<div class="main-search-wrap">
	<div class="main-search">
	
		<div class="search-box product tab02 cate_tab">
			<div class="cate_title cate1_title">Product</div>
			<ul>
				<li class="cate1 baesun" onclick="show(1,'baesun',this);">배선기구</li>
				<li class="cate1 smart_baesun" onclick="show(2,'smart_baesun',this);">스마트 배선기구</li>
				<li class="cate1 gae_bun" onclick="show(1,'gae_bun',this);">계전기 & 분전반</li>
				<li class="cate1 si-jang" onclick="show(2,'si-jang',this);">시장용품</li>
				<li class="cate1 kmew" onclick="show(1,'kmew',this);">KMEW</li>
				<li class="cate1 bock_gi" onclick="show(2,'bock_gi',this);">복지용구</li>
				<li class="cate1 jo_myeong" onclick="show(2,'jo_myeong',this);">조명제어시스템</li>
			</ul>
		</div>
		<div class="search-box solution tab03 cate_tab">
			<div class="cate_title cate2_title">Solution</div>
			<ul>
				<li class="cate2_hide">*이전 항목을 선택해주세요.</li>
			
				<!-- 배선기구 -->
				<li class="cate2 baesun" onclick="show(2,'series',this);">시리즈</li>
				<li class="cate2 baesun" onclick="show(2,'switch_consent',this);">기능형스위치 & 콘센트</li>
				<li class="cate2 baesun" onclick="show(2,'badak',this);">바닥용콘센트</li>
				<li class="cate2 baesun" onclick="show(2,'time_switch',this);">타임스위치</li>
				<!-- 배선기구 -->

				<!-- 계전기분전기 -->
				<li class="cate2 gae_bun" onclick="show(2,'gae',this);">계전기</li>
				<li class="cate2 gae_bun" onclick="show(2,'bun',this);">분전기</li>
				<!-- 계전기분전기 -->	
				
				<!-- kmew -->
				<li class="cate2 kmew" onclick="show(2,'wae',this);">외장재</li>
				<li class="cate2 kmew" onclick="show(2,'jibung',this);">지붕재</li>
				<!-- kmew -->
				
			</ul>
		</div>
		
		<div class="search-box item tab04 cate_tab">
			<div class="cate_title cate3_title">Item</div>
			<ul class="">
				<li class="cate3_hide">*이전 항목을 선택해주세요.</li>
				
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
				<li class="cate3 smart_baesun" onclick="choose_cate('타임키퍼 ll·lll 리모컨 스위치',this,'act');">타임키퍼 Ⅱ·Ⅲ 리모컨 스위치</li>
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
<!-- 		<div class="search-box keyword">
			<div>
				<input type="text" placeholder="Input Keyword">
				<button type="button" class="input-remove">검색 내용 삭제</button>
			</div>
		</div> -->
		<div class="search-box submit">
			<button type="submit" onclick="page_link();">Search</button>
		</div>
	</div>
</div>
