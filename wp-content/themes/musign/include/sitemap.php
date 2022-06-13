<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
$depth1_query = "select * from product_cate where cate_type='1' ";
$depth1_result = sql_query($depth1_query);


?>
<script>


</script>

<?php 
if ($_GET['lang']=='en') {
?>
    <div class="sitemap-wrap">
    	<h1>Site Map</h1>
    	<div class="sitemap-section">
    		<h2>Main</h2>
            <ul class='depth1' >
                <li><a href="/?lang=en">Main</a></li>
            </ul>
    	</div>
    	
    	<div class="sitemap-section product">
          	 <h2>Product</h2>
            <ul class='depth1' >
                <li>Series
                    <ul class='depth2' >
                    <?php 
                    $series_query = "SELECT * FROM product_cate WHERE upper_cate = '시리즈'";
                    $series_result = sql_query($series_query);
                    
                    for ($s = 0; $s < sql_count($series_result); $s++) {
                        $series_row = sql_fetch($series_result);
                        $series_title = $series_row['eng_title'];
                    ?>
                		<li><a href="/product-detail?lang=en&cate1=Wiring Device&cate2=Series&cate3=<?php echo $series_title?>"><?php echo $series_title?></a></li>
                	<?php 
                    }
                	?>
                	
                	</ul>
                </li>
        
        		
               	
        <?php 
        for ($i = 0; $i < sql_count($depth1_result); $i++) {
            $depth1_row = sql_fetch($depth1_result);
            $depth1_kr = $depth1_row['kor_title'];
            $depth1_title = $depth1_row['eng_title'];
            $depth1_title_conv = str_replace('_',' ',$depth1_title);
            $depth1_title_conv_2 = str_replace('and','&',$depth1_title_conv);
            $depth1_title_conv = str_replace('and','@',$depth1_title_conv);
            
            $depth2_query = "SELECT * FROM product_cate WHERE upper_cate = '{$depth1_kr}' AND eng_title!='Series'";
            $depth2_result = sql_query($depth2_query);
        ?>
                    <li><?php echo $depth1_title_conv_2?>
                   		<ul class='depth2' >
                   		
                    <?php 
                    for ($j = 0; $j < sql_count($depth2_result); $j++) {
                        $depth2_row = sql_fetch($depth2_result);
                        $depth2_kr = $depth2_row['kor_title'];
                        $depth2_title = $depth2_row['eng_title'];
                        $depth2_conv = str_replace('and','@',$depth2_title);
                        $depth2_conv_2 = str_replace('_',' ',$depth2_conv);  
                        
                        $depth2_conv_for_show = str_replace('_',' ',$depth2_title);
                        $depth2_conv_for_show = str_replace('and','&',$depth2_conv_for_show);
                        
                        
                        $depth3_query = "SELECT * FROM product_cate WHERE upper_cate = '{$depth2_kr}' and cate_type!=4";
                        $depth3_result = sql_query($depth3_query);
                        if ($depth2_row['cate_type']=='2') {
                    ?>
                                <li><?php echo $depth2_conv_for_show?>
                                	
                                 <ul class='depth3'>
                                	<?php 
                                	for ($k = 0; $k < sql_count($depth3_result); $k++) {
                                	    $depth3_row = sql_fetch($depth3_result);
                                	    $depth3_kr = $depth3_row['kor_title'];
                                	    $depth3_title = $depth3_row['eng_title'];
                                	    //$depth3_conv = str_replace('_',' ',$depth3_title);
                                	    //$depth3_conv = str_replace('and','@',$depth3_title);
                                	    $depth3_conv_2 = str_replace('and','&',$depth3_title);
                                	    $depth3_conv_2 = str_replace('_',' ',$depth3_conv_2);
                                	    
                                	    
                                	?>
                                	<li><a href="/product-detail?lang=en&cate1=<?php echo $depth1_title_conv?>&cate2=<?php echo $depth2_conv_2?>&cate3=<?php echo $depth3_title?>"><?php echo $depth3_conv_2?></a> </li>
                                    <?php 
                                	}
                                	?>
                                  </ul>	
                                
                                </li>
                    <?php 
                        }else{
                    ?>        
                    			<li><a href="/product-detail?lang=en&cate1=<?php echo $depth1_title_conv?>&cate2=<?php echo $depth1_title_conv?>&cate3=<?php echo $depth2_conv?>"><?php echo $depth2_conv_for_show?></a> </li>
                    <?php 
                }
                        }
                    ?>    		
                     </ul>	
            	 </li>
        <?php 
            }
        ?>
              </ul>	
    	</div>
    	<div class="sitemap-section">
    		<h2>Data Room</h2>
            <ul class='depth1' >
                <li><a href="/cert/list_en.php?lang=en">Certificates</a></li>
                <li><a href="/award?lang=en">Awards</a></li>
                <li><a href="/news?lang=en">News</a></li>
			</ul>
    	</div>
    	
    	<div class="sitemap-section">
    		<h2>Company</h2>
            <ul class='depth1' >
                <li><a href="/about-us/ceo?lang=en">Greetings from C.E.O</a></li>
                <li><a href="/about-us/vision?lang=en">Company Vision </a></li>
                <li><a href="/about-us/history?lang=en">Company History </a></li>
                <li><a href="/about-us/eco?lang=en">Environmental Activities</a></li>
                <li><a href="/about-us/contact?lang=en">Directions</a></li>
			</ul>
    	</div>
    	
    	<div class="sitemap-section">
    		<h2>Customer Service</h2>
            <ul class='depth1' >
                <li><a href="/customer?lang=en">Customer Consultation & After Sales Service</a></li>
			</ul>
    	</div>
    	
    	<div class="sitemap-section">
    		<h2>Legal Notice</h2>
            <ul class='depth1' >
                <li><a href="/legal-notice?lang=en">Legal Notice</a></li>
			</ul>
    	</div>
    </div>

<?php 
}else{
?>
    <div class="sitemap-wrap">
    	<h1>사이트맵</h1>
    	<div class="sitemap-section">
    		<h2>메인</h2>
            <ul class='depth1' >
                <li><a href="/">메인</a></li>
            </ul>
    	</div>
    	
    	<div class="sitemap-section product">
          	<h2>제품소개</h2>
            <ul class='depth1' >
                <li>시리즈    
                    <ul class='depth2' >
                    <?php 
                    $series_query = "SELECT * FROM product_cate WHERE upper_cate = '시리즈'";
                    $series_result = sql_query($series_query);
                    
                    for ($s = 0; $s < sql_count($series_result); $s++) {
                        $series_row = sql_fetch($series_result);
                        $series_title = $series_row['kor_title'];
                    ?>
                		<li><a href="/product-detail?lang=&cate1=배선기구&cate2=시리즈&cate3=<?php echo $series_title?>"><?php echo $series_title?></a></li>
                	<?php 
                    }
                	?>
                	
                	</ul>
            	</li>
               	
        <?php 
        for ($i = 0; $i < sql_count($depth1_result); $i++) {
            $depth1_row = sql_fetch($depth1_result);
            $depth1_title = $depth1_row['kor_title'];
            $depth1_title_conv = str_replace('&','@',$depth1_title);
            
            $depth2_query = "SELECT * FROM product_cate WHERE upper_cate = '{$depth1_title}' AND eng_title!='Series'";
            $depth2_result = sql_query($depth2_query);
        ?>
                <li><?php echo $depth1_title?>
               		<ul class='depth2' >
                    <?php 
                    for ($j = 0; $j < sql_count($depth2_result); $j++) {
                        $depth2_row = sql_fetch($depth2_result);
                        $depth2_title = $depth2_row['kor_title'];
                        $depth2_conv = str_replace('&','@',$depth2_title);
                        
                        $depth3_query = "SELECT * FROM product_cate WHERE upper_cate = '{$depth2_title}' and cate_type!=4";
                        $depth3_result = sql_query($depth3_query);
                        if ($depth2_row['cate_type']=='2') {
                    ?>
                            <li><?php echo $depth2_title?>
                                <ul class='depth3'>
                                   	<?php 
                                   	for ($k = 0; $k < sql_count($depth3_result); $k++) {
                                   	    $depth3_row = sql_fetch($depth3_result);
                                   	    $depth3_title = $depth3_row['kor_title'];
                                   	    $depth3_conv = str_replace('&','@',$depth3_title);
                                   	    
                                   	?>
                                       	<li><a href="/product-detail?lang=&cate1=<?php echo $depth1_title_conv?>&cate2=<?php echo $depth2_conv?>&cate3=<?php echo $depth3_conv?>"><?php echo $depth3_title?></a> </li>
                                        <?php 
                                    	}
                                    	?>
                                  </ul>	
                              </li>
                    <?php 
                        }else{
                    ?>        
                			<li><a href="/product-detail?lang=&cate1=<?php echo $depth1_title_conv?>&cate2=<?php echo $depth1_title_conv?>&cate3=<?php echo $depth2_conv?>"><?php echo $depth2_title?></a> </li>
                    <?php 
                        }
                    }
                    ?>    		
                    </ul>
                </li>	
        <?php 
            }
        ?>
          </ul>
    	</div>
    	<div class="sitemap-section">
    		<h2>자료실</h2>
            <ul class='depth1' >
                <li><a href="/cert/list.php">인증서</a></li>
                <li><a href="/cert/award">수상경력</a></li>
                <li><a href="/cert/news">뉴스</a></li>
			</ul>
    	</div>
    	<div class="sitemap-section">
    		<h2>회사소개</h2>
            <ul class='depth1' >
                <li><a href="/about-us/ceo">CEO 소개</a></li>
                <li><a href="/about-us/vision">회사 비전</a></li>
                <li><a href="/about-us/history">회사연혁</a></li>
                <li><a href="/about-us/eco">환경 활동</a></li>
                <li><a href="/about-us/contact">오시는 길</a></li>
			</ul>
    	</div>
    	<div class="sitemap-section">
    		<h2>고객지원</h2>
            <ul class='depth1' >
                <li><a href="/customer">고객지원</a></li>
			</ul>
    	</div>
    	
    	<div class="sitemap-section">
    		<h2>법적고지</h2>
            <ul class='depth1' >
                <li><a href="/legal-notice">법적고지</a></li>
			</ul>
    	</div>
    </div>
<?php 
}
?>
