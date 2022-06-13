<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/admin/include/init.php");

$query = "SELECT * FROM customer WHERE 1";

if(isset($_GET['cate']) && $_GET['cate'] != null && $_GET['cate'] != "")
{
    $query .= " AND customer_area = '{$_GET['cate']}'";
?>
<script>
$(document).ready(function(){
	//1103
	var offset = $(".store-list-wrap").offset();
	$('html, body').animate({ scrollTop : offset.top - 60 }, 0);
});
</script>
<?php
}
else
{
    $query .= " AND customer_area = '서울'";
}

$result = sql_query($query);
?>

<script>
function chang_place(place){
	location.href = "/customer?cate="+place;
}
</script>
<div class="store-list-wrap">
	<div class="store-map">
		<div class="map">
			<img src="/img/store_map.jpg" alt="한국지도">
			<ul class="store-dot">
				<li class="seoul"><button type="button" onclick="chang_place('서울')">서울</button></li>
				<li class="inchoen"><button type="button" onclick="chang_place('인천')">인천</button></li>
				<li class="gyeonggi"><button type="button" onclick="chang_place('경기')">경기</button></li>
				<li class="gangwon"><button type="button" onclick="chang_place('강원')">강원</button></li>
				<li class="deajeon"><button type="button" onclick="chang_place('대전')">대전</button></li>
				<li class="chungbuk"><button type="button" onclick="chang_place('충북')">충북</button></li>
				<li class="chungnam"><button type="button" onclick="chang_place('충남')">충남</button></li>
				<li class="gwangju"><button type="button" onclick="chang_place('광주')">광주</button></li>
				<li class="jeonbuk"><button type="button" onclick="chang_place('전북')">전북</button></li>
				<li class="jeonnam"><button type="button" onclick="chang_place('전남')">전남</button></li>
				<li class="daegu"><button type="button" onclick="chang_place('대구')">대구</button></li>
				<li class="gyeongbuk"><button type="button" onclick="chang_place('경북')">경북</button></li>
				<li class="gyeongnam"><button type="button" onclick="chang_place('경남')">경남</button></li>
				<li class="busan"><button type="button" onclick="chang_place('부산')">부산</button></li>
				<li class="ulsan"><button type="button" onclick="chang_place('울산')">울산</button></li>
				<li class="jeju"><button type="button" onclick="chang_place('제주')">제주</button></li>
			</ul>
		</div>
	</div><!-- //오른쪽 맵 -->
	
	<div class="store-list owl-carousel">
	<?php 
	$n = 0;
	for($i = 0; $i < sql_count($result); $i++){
	?>
    	<div class="list">
		<?php 
		for($i = $n; $i < $n+4; $i++){ 
		    if($i == sql_count($result)){
    	       break;
    	    }
    	    $row = sql_fetch($result);
    	?>
        	<article>
				<h4><strong><?php echo $row['customer_name']?></strong></h4>
				<div class="contents">
					<dl>
						<dt>Address</dt>
						<dd><?php echo $row['customer_addr']?></dd>
						<dt>Tel</dt>
						<dd><?php echo $row['customer_phone']?></dd>
						<dt>Fax</dt>
						<dd><?php echo $row['customer_fax']?></dd>
					</dl>
					<a href="https://www.google.co.kr/maps/search/<?php echo $row['customer_addr']?>%20<?php echo $row['customer_name']?>" target="_blank" class="location-btn">위치보기</a>
				</div>
    		</article>
    	<?php 
        }
        $n = $n+4;
    	?>
		</div>
	<?php
	}
	?>
	</div><!-- //왼쪽 리스트 -->
</div>

<script>
$(document).ready(function(){
	$('.owl-carousel').owlCarousel({
		items:1,
		nav:true
	});
});


</script>