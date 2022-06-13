<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
//$series_query ="SELECT * FROM product LEFT JOIN product_cate AS a ON kor_title=product_cate3 WHERE product_cate2  ='시리즈' GROUP BY product_cate3 ORDER BY a.submit_date asc";
$series_query ="SELECT * FROM product LEFT JOIN product_cate AS a ON kor_title=product_cate3 WHERE product_series ='O'  ORDER BY a.submit_date ASC, product.product_cate4 desc";
$series_result = sql_query($series_query);

$cate1_query = "SELECT * FROM product_cate WHERE cate_type='1'";
$cate1_result = sql_query($cate1_query);

$cate1_query_sec = "SELECT * FROM product_cate WHERE cate_type='1'";
$cate1_result_sec = sql_query($cate1_query_sec);

//SELECT * FROM product WHERE product_cate2  ='시리즈' GROUP BY product_cate3
?>

<style>
.product-thum-list button{
    width:172px; height:172px;
    white-space:normal;
}
.product-thum-list button b{
    margin-bottom:5px;
}
.product-thum-list button strong{
    font-size:16px;
    font-weight:600;
    left:15px;
    top:13px;
}
.product-thum-list button b{
    max-width: 95%;
    line-height: 1.2;
}
.product-thum-list button b:after{
    bottom:0;
    display:none;
}
.product-thum-list .active button b:after{
    display:block;
}
@media only screen and (max-width:1279px){
    #product-list-new .owl-prev, #product-list-new .owl-next{
        top:7%;
    }
}
@media only screen and (max-width: 989px){
    #product-list-new .owl-prev, #product-list-new .owl-next {
        top: 6%;
    }
    .product-thum-list button{
        width:140px; height:140px;
    }
    .product-thum-list button strong{
        left:0;
    }
}
@media only screen and (max-width: 767px){
    .product-thum-list button{
        width:auto; height:auto;
        padding:2px;
    }
    .product-thum-list button strong{
        font-size:14px;
        font-weight:500;
    }
    #product-list-new .flex_column .avia-image-container img{
        width: auto;
        height: 140px;
        max-width: none;
        margin-left: -70%;
    }
}
</style>

<div id="product-list-thumb" class="av-layout-grid-container">
	<div class="flex_cell_inner">
		<div class="product-thum-list">
			<ul>
				<li class="series">
					<button type="button">
					<?php 
					if ($_GET['lang']=='en') {
					    echo "<strong><b>Series</b>Series</strong>";
					}else{
					    echo "<strong><b>Series</b>시리즈</strong>";
					}
					?>					
					</button>
				</li>
			<?php 
			for ($i = 0; $i < sql_count($cate1_result); $i++) {
			    $cate1_row = sql_fetch($cate1_result);
			    
			    $eng_title = $cate1_row['eng_title'];
			    
			    $class_name = 'wiring';
			    if ($eng_title=='Smart_Wiring_Device') {
			        $class_name = 'smart-wiring';
			    }else if($eng_title=='Relay_and_Panel_Board') {
			        $class_name = 'relay';
			    }else if($eng_title=='Market_Products') {
			        $class_name = 'market';
			    }else if($eng_title=='KMEW') {
			        $class_name = 'kmew';
			    }else if($eng_title=='Welfare_Products') {
			        $class_name = 'medicare';
			    }else if($eng_title=='Lighting_Control_System') {
			        $class_name = 'lighting';
			    }
			    
			    if ($_GET['lang']=='en') {
			        $cate1_title = $cate1_row['eng_title'];
			        $cate1_title = str_replace('_',' ',$cate1_title);
			        $cate1_title = str_replace('and','&',$cate1_title);
			    }else{
			        $cate1_title = $cate1_row['kor_title'];
			    }
			  
			    $eng_title = str_replace('_',' ',$eng_title);
			    $eng_title = str_replace('and','&',$eng_title);
			?>
				<li class="<?php echo $class_name?>">
					<button type="button">
						<strong><b><?php echo $eng_title?></b><?php echo $cate1_title?></strong>
					</button>
				</li>
			<?php 
			}
			?>
			</ul>
		</div>
	</div>
</div>
<!-- 전체를 다 넣은 건 아닌데 아무튼 이런 식으로 만들어주세용 -->
<div id="product-list-new" class="av-layout-grid-container">
		<div class="flex_cell_inner owl-carousel">
			<div class="flex_column avia_start_delayed_animation fade-in">
				<ul class="series-list">
				<?php 
				if ($_GET['lang']=='en') {
    				for ($i = 0; $i < sql_count($series_result); $i++) {
    				    $series_row =sql_fetch($series_result);
    				    
    				    $series_kr_title = $series_row['kor_title'];
    				    $series_eng_title = $series_row['eng_title'];
    				    
    				    if ($series_kr_title=='아르체') {
    				        $series_kr_title=$series_row['product_cate4'];
    				        if (strpos($series_kr_title,'L')) {
    				            $series_eng_title=$series_eng_title.'-L';
    				        }else{
    				            $series_eng_title=$series_eng_title.'-S';
    				        }
    				    }
    				?>
    					<li>
    						<a href="/product-detail?lang=en&cate1=<?php echo $series_row['product_cate1_en']?>&cate2=<?php echo $series_row['product_cate2_en']?>&cate3=<?php echo $series_row['product_cate3_en']?>&cate4=<?php echo $series_row['product_cate4_en']?>">
        						<div class="img" style="width:200px;height:200px;">
        							<img src="/img/product/<?php echo $series_row['product_thumb']?>">
        						</div>
        						<div class="txt">
        							<small><?php echo ucfirst($series_eng_title)?></small>
        							<?php 
        							
       
        							
        							echo $series_eng_title;
        							
        							?> Series
        						</div>
    						</a>
    					</li>
    				<?php 
    				}				
				}else{
    				for ($i = 0; $i < sql_count($series_result); $i++) {
    				    $series_row =sql_fetch($series_result);
    				    
    				    $series_kr_title = $series_row['kor_title'];
    				    $series_eng_title = $series_row['eng_title'];
    				    
    				    if ($series_kr_title=='아르체') {
    				        $series_kr_title=$series_row['product_cate4'];
    				        if (strpos($series_kr_title,'L')) {
    				            $series_eng_title=$series_eng_title.'-L';
    				        }else{
    				            $series_eng_title=$series_eng_title.'-S';
    				        }
    				    }
    				?>
    					<li>
    						<a href="/product-detail?cate1=<?php echo $series_row['product_cate1']?>&cate2=<?php echo $series_row['product_cate2']?>&cate3=<?php echo $series_row['product_cate3']?>&cate4=<?php echo $series_row['product_cate4']?>">
        						<div class="img" style="width:200px;height:200px;">
        							<img src="/img/product/<?php echo $series_row['product_thumb']?>">
        						</div>
        						<div class="txt">
        							<small><?php echo ucfirst($series_eng_title)?></small>
        							<?php 
        							
       
        							
        							echo $series_kr_title;
        							
        							?> 시리즈
        						</div>
    						</a>
    					</li>
    				<?php 
    				}
				}
				?>	
				</ul>
			</div>
			
			<?php 
			if ($_GET['lang']=='en') {
    			for ($i = 0; $i < sql_count($cate1_result_sec); $i++) {
    			    $cate1_row_sec = sql_fetch($cate1_result_sec);
    			    $eng_title = $cate1_row_sec['eng_title'];
    			    $eng_title = str_replace('_',' ',$eng_title);
    			    $eng_title = str_replace('and','&',$eng_title);
    			    
    			    $cate2_query = "SELECT * FROM product_cate WHERE upper_cate = '{$cate1_row_sec['kor_title']}' AND eng_title != 'series' ";
    			    $cate2_result = sql_query($cate2_query);
    			   
    			?>
    			<div class="flex_column avia_start_delayed_animation fade-in">
    				<div class="avia-image-container avia-align-center">
    					<div class="av-image-caption-overlay">
    						<div class="av-image-caption-overlay-position">
    							<div class="av-image-caption-overlay-center" style="color: #ffffff;">
    								<p>
    									<span class="small-txt"><?php echo $eng_title?></span><br> <?php echo $eng_title?>
    								</p>
    							</div>
    						</div>
    					</div>
    					<img src="/wp-content/uploads/2019/11/<?php echo $cate1_row_sec['eng_title']?>.jpg" alt="">
    				</div>
    				<div class="depth-wrap">
    					<ul class="depth1">
    					<?php 
    					
    					for ($j = 0; $j < sql_count($cate2_result); $j++) {
    					    $cate2_row = sql_fetch($cate2_result);
    					    
    					    $cate3_query ="SELECT * FROM product_cate WHERE upper_cate = '{$cate2_row['kor_title']}'";
    					    $cate3_result = sql_query($cate3_query);
    
    					    if ($cate2_row['cate_type']=='2') {
    					        $cate2_title = $cate2_row['eng_title'];
    					        $cate2_title = str_replace('_',' ',$cate2_title);
    					        $cate2_title = str_replace('and','&',$cate2_title);
    					?>
    						<li><strong><?php echo $cate2_title?></strong>
    							<ul class="depth2">
    							<?php 
        							for ($k = 0; $k < sql_count($cate3_result); $k++) {
        							    $cate3_row = sql_fetch($cate3_result);
        							    $cate1 = $cate1_row_sec['eng_title'];
        							    
        							    $cate2 = $cate2_row['eng_title'];
        							    
        							    $cate3 = $cate3_row['eng_title'];
        							    if ($cate2==$cate3) {
        							        $cate2=$cate1;
        							    }
        							    $cate1 = str_replace('_',' ',$cate1);
        							    $cate1= str_replace('and','@',$cate1);

        							    $cate2 = str_replace('_',' ',$cate2);
        							    $cate2 = str_replace('and','@',$cate2);
        							    
        							    
        							    $cate3_title = $cate3_row['eng_title'];
        							    $cate3_title = str_replace('_',' ',$cate3_title);
        							    $cate3_title = str_replace('and','&',$cate3_title);
        							?>
        								<li><a href="/product-detail/?lang=en&cate1=<?php echo $cate1?>&amp;cate2=<?php echo $cate2?>&amp;cate3=<?php echo $cate3?>"><?php echo $cate3_title?></a></li>
        							<?php 
        							}
    							
    							?>
    							</ul>
    						</li>
    					<?php 
    					    }else{
    					        $cate1 = $cate1_row_sec['eng_title'];
    					        $cate2 = $cate2_row['eng_title'];
    					        
    					        $cate1 = str_replace('_',' ',$cate1);
    					        $cate1= str_replace('and','@',$cate1);
    					        
    					        $cate2_ver2 = str_replace('_',' ',$cate2);
    					        $cate2_ver2 = str_replace('and','&',$cate2_ver2);
    					?>
    						<li>
    						<a href="/product-detail/?lang=en&cate1=<?php echo $cate1?>&amp;cate2=<?php echo $cate1?>&amp;cate3=<?php echo $cate2?>">
    						<?php echo $cate2_ver2?>
    						</a>
    						</li>
    					<?php        
    					    }
    					}
    					?>
    
    					</ul>
    				</div>
    			</div>
    			<?php 
                }
			}else{
   			for ($i = 0; $i < sql_count($cate1_result_sec); $i++) {
    			    $cate1_row_sec = sql_fetch($cate1_result_sec);
    			    $eng_title = $cate1_row_sec['eng_title'];
    			    $eng_title = str_replace('_',' ',$eng_title);
    			    $eng_title = str_replace('and','&',$eng_title);
    			    
    			    $cate2_query = "SELECT * FROM product_cate WHERE upper_cate = '{$cate1_row_sec['kor_title']}' AND eng_title != 'series' ";
    			    $cate2_result = sql_query($cate2_query);
    			   
    			?>
    			<div class="flex_column avia_start_delayed_animation fade-in">
    				<div class="avia-image-container avia-align-center">
    					<div class="av-image-caption-overlay">
    						<div class="av-image-caption-overlay-position">
    							<div class="av-image-caption-overlay-center" style="color: #ffffff;">
    								<p>
    									<span class="small-txt"><?php echo $eng_title?></span><br> <?php echo $cate1_row_sec['kor_title']?>
    								</p>
    							</div>
    						</div>
    					</div>
    					<img src="/wp-content/uploads/2019/11/<?php echo $cate1_row_sec['eng_title']?>.jpg" alt="">
    				</div>
    				<div class="depth-wrap">
    					<ul class="depth1">
    					<?php 
    					
    					for ($j = 0; $j < sql_count($cate2_result); $j++) {
    					    $cate2_row = sql_fetch($cate2_result);
    					    
    					    $cate3_query ="SELECT * FROM product_cate WHERE upper_cate = '{$cate2_row['kor_title']}'";
    					    $cate3_result = sql_query($cate3_query);
    
    					    if ($cate2_row['cate_type']=='2') {
    					?>
    						<li><strong><?php echo $cate2_row['kor_title']?></strong>
    							<ul class="depth2">
    							<?php 
        							for ($k = 0; $k < sql_count($cate3_result); $k++) {
        							    $cate3_row = sql_fetch($cate3_result);
        							    $cate1 = $cate1_row_sec['kor_title'];
        							    $cate2 = $cate2_row['kor_title'];
        							    $cate3 = $cate3_row['kor_title'];
        							    if ($cate2==$cate3) {
        							        $cate2=$cate1;
        							    }
        							    $cate2 = str_replace('&','@',$cate2);
        							    $cate3 = str_replace('&','@',$cate3);
        							?>
        								<li><a href="/product-detail/?cate1=<?php echo$cate1?>&amp;cate2=<?php echo $cate2?>&amp;cate3=<?php echo $cate3?>"><?php echo $cate3_row['kor_title']?></a></li>
        							<?php 
        							}
    							
    							?>
    							</ul>
    						</li>
    					<?php 
    					    }else{
    					        $cate1 = $cate1_row_sec['kor_title'];
    					        $cate2 = $cate2_row['kor_title'];
    					        $cate2 = str_replace('&','@',$cate2);
    					?>
    						<li>
    						<a href="/product-detail/?cate1=<?php echo$cate1?>&amp;cate2=<?php echo $cate1?>&amp;cate3=<?php echo $cate2?>">
    						<?php echo $cate2_row['kor_title']?>
    						</a>
    						</li>
    					<?php        
    					    }
    					}
    					?>
    
    					</ul>
    				</div>
    			</div>
			
			<?php 
			     }
			}
			?>
		</div>
</div>