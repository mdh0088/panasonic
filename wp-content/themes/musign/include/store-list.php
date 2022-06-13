<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/admin/include/init.php");
?>

<script>
var inner ="";
$(document).ready(function(){
	var area ='서울';
	get_place_data(area);
	$('.store-dot').eq(0).addClass('active');
	$('.store-list .owl-item.active article:first-child').addClass('active');

	//리스트 동작
	$(document).on('click mouseover', '.store-list article', function(){
		$('.store-list article').removeClass('active');
		$(this).addClass('active');
	});
});

function get_place_data(area){
	$.ajax({
		type : "GET", //전송방식을 지정한다 (POST,GET)
		async : false,
		url : "/wp-content/themes/musign/include/getData.php?area="+encodeURI(area),//호출 URL을 설정한다. GET방식일경우 뒤에 파라티터를 붙여서 사용해도된다.
		dataType : "text",//호출한 페이지의 형식이다. xml,json,html,text등의 여러 방식을 사용할 수 있다.
		error : function() 
		{
			alert("통신 중 오류가 발생하였습니다.");
		}, 
		success : function(data) 
		{
			var owl = $(".owl-carousel");
			owl.empty();
			owl.owlCarousel('destroy');
			var result = JSON.parse(data);
			inner = "";
			var loop_cnt = result.length;
			if(loop_cnt%4 > 0){
				loop_cnt = parseInt(result.length/4)+1;
			}else{
				loop_cnt = parseInt(result.length/4);
			}
			var n = 0;
			for (var z = 0; z < loop_cnt; z++) {
				inner += "<div class='list'>";
				for(var i = n; i < n+4; i++){ //지점수가 맞게 안나눠지면 안나옴 원래 n+4였는데 지점수가 9니까 8까지만 나옴 참고 수정
						if(i == result.length){
							break;
						}
						inner += "<article>";
						inner += "<h4><strong>"+result[i].customer_name+"</strong></h4>";
						inner += "<div class='contents'>";
						inner += "<dl>";
						inner += "<dt>Address</dt>";
						inner += "<dd>"+result[i].customer_addr+"</dd>";
						inner += "<dt>Tel</dt>";
						inner += "<dd>"+result[i].customer_phone+"</dd>";
						inner += "<dt>Fax</dt>";
						inner += "<dd>"+result[i].customer_fax+"</dd>";
						inner += "</dl>";
						inner += "<a href='https://www.google.co.kr/maps/search/"+result[i].customer_addr+"%20"+result[i].customer_name+"' target='_blank' class='location-btn'>위치보기</a>";
						inner += "</div>";
						inner += "</article>";
				}
				inner += "</div>";
				n += 4;
			}
			owl.append(inner);
    		owl.owlCarousel({
    			items:1,
    			nav:true
    		});
    		$('.store-list .owl-item.active article:first-child').addClass('active');
    		$('.store-dot li').removeClass('active');
    		$('.store-dot li').each(function(){
        		var txt = $(this).text();
        		if(area === txt)
            		$(this).addClass('active');
        	});
		}
	});
}
</script>

<div class="store-list-wrap">
	<div class="store-map">
		<div class="map">
			<img src="/img/store_map.jpg" alt="한국지도">
			<ul class="store-dot">
				<li class="seoul"><button type="button" onclick="get_place_data('서울')">서울</button></li>
				<li class="inchoen"><button type="button" onclick="get_place_data('인천')">인천</button></li>
				<li class="gyeonggi"><button type="button" onclick="get_place_data('경기')">경기</button></li>
				<li class="gangwon"><button type="button" onclick="get_place_data('강원')">강원</button></li>
				<li class="deajeon"><button type="button" onclick="get_place_data('대전')">대전</button></li>
				<li class="chungbuk"><button type="button" onclick="get_place_data('충북')">충북</button></li>
				<li class="chungnam"><button type="button" onclick="get_place_data('충남')">충남</button></li>
				<li class="gwangju"><button type="button" onclick="get_place_data('광주')">광주</button></li>
				<li class="jeonbuk"><button type="button" onclick="get_place_data('전북')">전북</button></li>
				<li class="jeonnam"><button type="button" onclick="get_place_data('전남')">전남</button></li>
				<li class="daegu"><button type="button" onclick="get_place_data('대구')">대구</button></li>
				<li class="gyeongbuk"><button type="button" onclick="get_place_data('경북')">경북</button></li>
				<li class="gyeongnam"><button type="button" onclick="get_place_data('경남')">경남</button></li>
				<li class="busan"><button type="button" onclick="get_place_data('부산')">부산</button></li>
				<li class="ulsan"><button type="button" onclick="get_place_data('울산')">울산</button></li>
				<li class="jeju"><button type="button" onclick="get_place_data('제주')">제주</button></li>
			</ul>
		</div>
	</div><!-- //오른쪽 맵 -->
	<div class="store-list owl-carousel">
	</div><!-- //왼쪽 리스트 -->
</div>