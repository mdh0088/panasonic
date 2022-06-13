<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");




$query = "select * from product where product_reco = 'O'";
$result = sql_query($query);
?>
<div class="main-product-wrap">
	<div class="product-slider">
		<ul class="owl-carousel">
			<?php 
			for($i = 0; $i < sql_count($result); $i++)
			{
		    $row = sql_fetch($result);
		    
		    $cate1 = $row['product_cate1'];
		    $cate2 = $row['product_cate2'];
		    if ($cate2=="" || $cate2==null) {
		        $cate2 = $row['product_cate1'];
		    }
		    $cate3 = $row['product_cate3'];
		    if (strpos($cate3,'&')) {
		        $cate3 = str_replace('&','@',$cate3);
		    }
		    
		    
		    ?>
			<li>
				<a href="/product-detail?cate1=<?php echo $cate1?>&cate2=<?php echo $cate2?>&cate3=<?php echo $cate3?>&indi=<?php echo $row['product_indi']?>">
				<!-- <a href="/product-detail?cate1=<?php //echo $cate1?>&cate2=<?php //echo $cate2?>&cate3=<?php //echo $cate3?>&idx=<?php //echo $row['idx']?>&indi=<?php //echo $row['product_indi']?>">-->
					<span class="thumbnail"><img src="/img/product/<?php echo $row['product_thumb']?>" alt="제품 이름"></span>
					<span class="txt">
					<?php 
					if ($_GET['lang']=='en') {
					    $cate3_name = $row['product_cate3_en'];
					    $product_titme = $row['product_title_en'];
					}else{
					    $cate3_name = $row['product_cate3'];
					    $product_titme = $row['product_title'];
					}
					?>
						<span class="brand"><?php echo $cate3_name?></span>
						<strong><?php echo $product_titme?></strong>
						
					</span>
				</a>
			</li>
		    <?php 
			}
			?>
		</ul>
	</div>

</div>

<script>

	//메인 제품 슬라이드
$('#main-sec04 .owl-carousel').addClass('owl-carousel').owlCarousel({
	loop:true,
	nav:true,
	responsive:{
		0:{
			items:2,
			margin:15
		},
		768:{
			items:3,
			margin:15
		},
		990:{
			items:5,
			margin:25
		}
		
	}
});

</script>