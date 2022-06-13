<div class="product-tab">
	<div class="clearfix">
		<div class="tab tab01">
			<a href="/product-intro">모든 제품군 보기</a>
		</div>
		
		<div class="tab tab02 cate_tab">
			<div class="cate1_title">제품 구분 선택</div>
			<ul class="cate1_ul">
				<li class="cate01 baesun" onclick="show(1,'baesun',this);">배선기구</li>
				<li class="cate01 smart_baesun" onclick="show(2,'smart_baesun',this);">스마트 배선기구</li>
				<li class="cate01 gae_bun" onclick="show(1,'gae_bun',this);">계전기 & 분전반</li>
				<li class="cate01 si-jang" onclick="show(2,'si-jang',this);">시장용품</li>
				<li class="cate01 kmew" onclick="show(2,'kmew',this);">KMEW</li>
				<li class="cate01 bock_gi" onclick="show(2,'bock_gi',this);">복지용구</li>
				<li class="cate01 jo_myeong" onclick="show(2,'jo_myeong',this);">조명제어시스템</li>
			</ul>
		</div>
		
		
		<div class="tab tab03 cate_tab">
		 
			<div class="cate2_title">제품 항목 선택</div>
			<ul class="cate2_ul">
			
				<!-- 배선기구 -->
				<li class="cate2 baesun" onclick="show(2,'series',this);">시리즈</li>
				<li class="cate2 baesun" onclick="show(2,'switch_consent',this);">기능형스위치 & 콘센트</li>
				<li class="cate2 baesun" onclick="show(2,'time_switch',this);">타임스위치</li>
				<!-- 배선기구 -->

				<!-- 계전기분전기 -->
				<li class="cate2 gae_bun" onclick="show(2,'gae',this);">계전기</li>
				<li class="cate2 gae_bun" onclick="show(2,'bun',this);">분전반</li>
				<!-- 계전기분전기 -->	
				
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
				<li class="cate3 switch_consent" onclick="choose_cate('플로어 콘센트',this,'act');">플로어 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('가구장 콘센트',this,'act');">가구장 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('안전형 콘센트',this,'act');">안전형 콘센트</li>
				<li class="cate3 switch_consent" onclick="choose_cate('LED 홈 보안등',this,'act');">LED 홈 보안등</li>
				<!-- 기능형스위치콘센트 -->
				
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
				
				<!-- KMEW -->
				<li class="cate3 kmew" onclick="choose_cate('외장재',this,'act');">외장재</li>
				<li class="cate3 kmew" onclick="choose_cate('지붕재',this,'act');">지붕재</li>
				<!-- KMEW -->
				
				<!-- 복지용구 -->
				<li class="cate3 bock_gi" onclick="choose_cate('목욕의자',this,'act');">목욕의자</li>
				<li class="cate3 bock_gi" onclick="choose_cate('플라스틱 이동변기',this,'act');">플라스틱 이동변기</li>
				<li class="cate3 bock_gi" onclick="choose_cate('목재형 이동변기',this,'act');">목재형 이동변기</li>
				<!-- 복지용구 -->
				
				<!-- 조명제어시스템 -->
				<li class="cate3 jo_myeong" onclick="choose_cate('전선관',this,'act');">전선관</li>
				<li class="cate3 jo_myeong" onclick="choose_cate('Full To Way',this,'act');">Full To Way(자체 페이지 링크)</li>
				<!-- 조명제어시스템 -->
				
			</ul>
		</div>
	</div>
</div>

<div class="product-detail-card-wrap">
	<h1>제품 라인업</h1>
	<div class="card-tab">
		<a href="#" class="act">홈 네트워크 스위치</a>
		<a href="#">일괄소등 스위치</a>
	</div>
	<div class="card-tab-content">
		<section class="product-detail-card-tab">
			<p>본 제품은 백열등,형광등 및 각종 조명을 제어할 수 있으며, 세대기와 통신하여 스위치 원격 제어/일괄소등 동작이 가능합니다.<br>
			수동 또는 홈네트워크(RS485통신)을 통한 원격제어가 가능하며, 안정성과 디자인 또한 뛰어난 제품입니다.</p>
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					<div class="btn">
						<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
						<a href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
						<a href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
						<a href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
						<a href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
					</div>
				</div>
			</article>
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					<div class="btn">
						<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
						<a href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
						<a href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
						<a href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
						<a href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
					</div>
				</div>
			</article>
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					<div class="btn">
						<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
						<a href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
						<a href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
						<a href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
						<a href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
					</div>
				</div>
			</article>
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					<div class="btn">
						<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
						<a href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
						<a href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
						<a href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
						<a href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
					</div>
				</div>
			</article>
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					<div class="btn">
						<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
						<a href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
						<a href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
						<a href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
						<a href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
					</div>
				</div>
			</article>
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					<div class="btn">
						<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
						<a href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
						<a href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
						<a href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
						<a href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
					</div>
				</div>
			</article>
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					<div class="btn">
						<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
						<a href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
						<a href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
						<a href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
						<a href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
					</div>
				</div>
			</article>
		</section>
		<section class="product-detail-card-tab">
			<p>본 제품은 백열등,형광등 및 각종 조명을 제어할 수 있으며, 세대기와 통신하여 스위치 원격 제어/일괄소등 동작이 가능합니다.<br>
			수동 또는 홈네트워크(RS485통신)을 통한 원격제어가 가능하며, 안정성과 디자인 또한 뛰어난 제품입니다.</p>
			
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					-
					
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					
					<div class="btn">
						<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
						<a href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
						<a href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
						<a href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
						<a href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
					</div>
				</div>
			</article>
			
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					<div class="btn">
						<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
						<a href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
						<a href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
						<a href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
						<a href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
					</div>
				</div>
			</article>
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					<div class="btn">
						<a href="#"><i><img src="/img/summary_icon01.png" alt=""></i>이미지</a>
						<a href="#"><i><img src="/img/summary_icon02.png" alt=""></i>설명서</a>
						<a href="#" class="left"><i><img src="/img/summary_icon03-2.png" alt=""></i><span>도면</span></a>
						<a href="#" class="right"><i><img src="/img/summary_icon04-2.png" alt=""></i></a>
						<a href="#"><i><img src="/img/summary_icon05.png" alt=""></i>인증서</a>
					</div>
				</div>
			</article>
			<article class="clearfix">
				<div class="thumbnail">
					<img src="/img/product/detail_thum.png" alt="product photo">
				</div>
				<div class="txt">
					<h2>WRP 3851</h2>
					<dl>
						<dt>Product Name</dt>
						<dd>단로스위치 2구</dd>
					</dl>
					<dl>
						<dt>Rating</dt>
						<dd>16A, 250V~</dd>
					</dl>
					<dl>
						<dt>Size</dt>
						<dd>80mm X 125mm</dd>
					</dl>
					<dl>
						<dt>CERTIFICATION</dt>
						<dd>KS C 8309 제493호</dd>
					</dl>
					<div class="btn no-btn">
						<a href="#"><i><img src="/img/summary_icon06.png" alt=""></i>설명서 없음 / 도면 없음 </a>
					</div>
				</div>
			</article>
		</section>
	</div>
</div>

<script>
$(document).ready(function(){
	//탭 작동
	$('.card-tab-content > section:not(:first-child)').hide();
	$('.card-tab a').eq(0).addClass('act');
	$('.card-tab a').click(function(){
		var i = $(this).index();
		$('.card-tab a').removeClass('act');
		$('.card-tab-content > section').hide();
		$('.card-tab-content > section').eq(i).show();
		$(this).addClass('act');
	})
	
	//아이콘 마우스호버
	$(document).on('mouseover', '.product-detail-card-tab .btn a', function(e){
		var hr = $(this).find('img').attr('src').split('.');
		$(this).find('img').attr('src', hr[0] + '_w.' + hr[1]);
	});
	
	$(document).on('mouseout', '.product-detail-card-tab .btn a', function(e){
		var hr = $(this).find('img').attr('src').split('_w');
		$(this).find('img').attr('src', hr[0] + hr[1]);
	});
});
</script>