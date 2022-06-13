<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/wp-load.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$limit_cnt=10;
$cert_limit_cnt=10;

$keyword = $_GET['keyword'];

$product_cnt_query = "SELECT count(*) as cnt FROM product 
WHERE ";
if (strpos($keyword,' ')!==false) {
    $keyword_arr = explode(' ',$keyword);
    for ($i = 0; $i < count($keyword_arr); $i++) {
        if ($i==0) {
            $product_cnt_query .="CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_model,product_title,product_rating,product_auth) LIKE '%{$keyword_arr[$i]}%'";
        }else{
            $product_cnt_query .=" or CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_model,product_title,product_rating,product_auth) LIKE '%{$keyword_arr[$i]}%'";
        }
    }
}else{
    
    $product_cnt_query .=" CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_model,product_title,product_rating,product_auth) LIKE '%{$keyword}%' ";
}

$product_cnt_result = sql_query($product_cnt_query);
$product_cnt_row = sql_fetch($product_cnt_result);

$kmew_cnt_query = "select count(*) as cnt from kmew 
where ";
if (strpos($keyword,' ')!==false) {
    for ($i = 0; $i < count($keyword_arr); $i++) {
        if ($i==0) {
            $kmew_cnt_query .=" CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_model,product_title,product_ea,product_weight) LIKE '%{$keyword_arr[$i]}%'";
        }else{
            $kmew_cnt_query .=" or CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_model,product_title,product_ea,product_weight) LIKE '%{$keyword_arr[$i]}%'";
        }
    }
}else{
    
    $kmew_cnt_query .=" CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_model,product_title,product_ea,product_weight) LIKE '%{$keyword}%' ";
}

$kmew_cnt_result = sql_query($kmew_cnt_query);
$kmew_cnt_row = sql_fetch($kmew_cnt_result);


$total_page = ($product_cnt_row['cnt']*1)+($kmew_cnt_row['cnt']*1);
if (isset($_REQUEST['temp_page'])) {
    $page = $_REQUEST['temp_page'];
}else{
    $page=1;
}

$limit =$limit_cnt;
$search = ($page-1)*$limit;


// $product_query = "SELECT * FROM product WHERE product_cate1 LIKE '%{$keyword}%' or product_cate2 LIKE '%{$keyword}%' 
// or product_cate3 LIKE '%{$keyword}%' or product_cate4 LIKE '%{$keyword}%' or product_model LIKE '%{$keyword}%' 
// or product_title LIKE '%{$keyword}%' or product_rating LIKE '%{$keyword}%' or product_auth LIKE '%{$keyword}%'
// or product_manual like '%{$keyword}%' or product_map_1 LIKE '%{$keyword}%' or product_map_2 LIKE '%{$keyword}%' LIMIT {$search}, {$limit} ";


$product_query = "SELECT product.idx,product.product_cate1, product.product_cate2, product.product_cate3, product.product_cate4, product.product_thumb,
product.product_model, product.product_title, product.product_size, product.product_rating AS search1, product.product_auth AS search2
FROM product  
WHERE ";
if (strpos($keyword,' ')!==false) {
    for ($i = 0; $i < count($keyword_arr); $i++) {
        if ($i==0) {
            $product_query .="CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_thumb,product_model,product_title,product_size,product_rating,product_auth) lIKE '%{$keyword_arr[$i]}%'";
        }else{
            $product_query .=" or CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_thumb,product_model,product_title,product_size,product_rating,product_auth) lIKE '%{$keyword_arr[$i]}%'";
        }
    }
}else{
    
    $product_query .=" CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_thumb,product_model,product_title,product_size,product_rating,product_auth) lIKE '%{$keyword}%'";  
}
$product_query .=" UNION ALL

SELECT kmew.idx,kmew.product_cate1, kmew.product_cate2, kmew.product_cate3, kmew.product_cate4, kmew.product_thumb,
kmew.product_model, kmew.product_title, kmew.product_size, kmew.product_ea AS search1, kmew.product_weight AS search2
FROM kmew  
WHERE ";
if (strpos($keyword,' ')!==false) {
    for ($i = 0; $i < count($keyword_arr); $i++) {
        if ($i==0) {
            $product_query .=" CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_thumb,product_model,product_title,product_size,product_ea,product_weight) LIKE '%{$keyword_arr[$i]}%' ";
        }else{
            $product_query .=" or CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_thumb,product_model,product_title,product_size,product_ea,product_weight) LIKE '%{$keyword_arr[$i]}%' ";
        }
    }
}else{
    $product_query .=" CONCAT(product_cate1,product_cate2,product_cate3,product_cate4,product_thumb,product_model,product_title,product_size,product_ea,product_weight) LIKE '%{$keyword}%' ";
}
$product_query .=" LIMIT {$search}, {$limit} ";

echo $product_query;

$product_result = sql_query($product_query);
$cert_cnt_query = "SELECT count(*) as cnt FROM h_cert WHERE IsDel='0' and (title LIKE '%{$keyword}%' OR contents LIKE '%{$keyword}%'
 OR filename1 LIKE '%{$keyword}%' OR col1 LIKE '%{$keyword}%' OR col4 LIKE '%{$keyword}%') ";

$cert_cnt_result = sql_query($cert_cnt_query);
$cert_cnt_row = sql_fetch($cert_cnt_result);

$cert_total_page = $cert_cnt_row['cnt'];
if (isset($_REQUEST['cert_temp_page'])) {
    $cert_page = $_REQUEST['cert_temp_page'];
}else{
    $cert_page=1;
}

$cert_limit =$cert_limit_cnt;
$cert_search = ($cert_page-1)*$cert_limit;


$cert_query = "SELECT * FROM h_cert WHERE IsDel='0' and (title LIKE '%{$keyword}%' OR contents LIKE '%{$keyword}%'
 OR filename1 LIKE '%{$keyword}%' OR col1 LIKE '%{$keyword}%' OR col4 LIKE '%{$keyword}%') LIMIT {$cert_search}, {$cert_limit} ";

$cert_result = sql_query($cert_query);





?>
<script>

function downloadPrint(idx)
{
	$("#print_idx").val(idx);
	var pop_title = "popupOpener";
    window.open("", pop_title);
    var frmData = document.printdownForm;
    frmData.target = pop_title;
    frmData.submit();
}

function actionSubmit(val, type){
	$("#send_value").val(val);
	$("#actionForm").attr("action", "/cert/cert_down.php");
    $("#actionForm").submit();
}
</script>

<form id="actionForm" name="actionForm" method="post" action="">
	<input type="hidden" id="send_type" name="send_type">
	<input type="hidden" id="send_value" name="send_value">
</form>

<form id="printdownForm" name="printdownForm" method="post" action="/cert/print_down.php" enctype="multipart/form-data" style="margin:0;">
	<input type="hidden" id="print_idx" name="print_idx" value="">
</form>

<div id="result-product" class="search-tab-wrap">
    <h3>제품검색</h3>
 	<p>입력하신 '<strong><?php echo $keyword?></strong>' 키워드로 총 <strong><?php echo $total_page;?></strong>개의 제품이 검색되었습니다.</p>
    <ul class="clearfix">
    	<?php 
    	for ($i = 0; $i < sql_count($product_result); $i++) {
    	    $product_row=sql_fetch($product_result);
    	    if (isset($product_row['product_cate1']) && $product_row['product_cate1']!="" && $product_row['product_cate1']!=null) {
    	       $cate_url= "cate1=".$product_row['product_cate1'].'&';
    	    }
    	    
    	    if (isset($product_row['product_cate2']) && $product_row['product_cate2']!="" && $product_row['product_cate2']!=null) {
    	        $cate_url .= "cate2=".$product_row['product_cate2'].'&';
    	    }else{
    	        $cate_url .= "cate1=".$product_row['product_cate1'].'&';
    	    }
    	    
    	    if (isset($product_row['product_cate3']) && $product_row['product_cate3']!="" && $product_row['product_cate3']!=null) {
    	        $cate_url .= "cate3=".$product_row['product_cate3'].'&';
    	    }
    	    
    	    $indi_cofirm = $product_row['product_indi'];
    	    if ($product_row['product_cate3']=='전선관' || $product_row['product_cate3']=='Full To Way') {
    	        $indi_cofirm='O'; //강제로 값을 넣음(특이 케이스)
    	    }
    	    $cate_url .= 'idx='.$product_row['idx'].'&indi='.$indi_cofirm;
    	    
    	?>
        <li>
        <?php 
       //echo filesize("/product-detail?".$cate_url);
        ?>
            <div class="thumbnail"><a href="/product-detail?<?php echo $cate_url?>" target="productDetail">
            <?php 
            $is_file_exist = file($_SERVER['DOCUMENT_ROOT']."/img/product/{$product_row['product_thumb']}");
            if (!$is_file_exist) {
                $product_row['product_thumb']='detail_imsi.png';
            }
            ?>
            <img src="/img/product/<?php echo $product_row['product_thumb']?>" alt="<?php echo $product_row['product_title']?>" ></a></div>
            <div class="txt">
            	<ol>
            		<li><?php echo $product_row['product_cate1']?></li>
            		<?php 
            		if (isset($product_row['product_cate2']) && $product_row['product_cate2']!="" && $product_row['product_cate2']!=null) {
            		?>
            		<li><?php echo $product_row['product_cate2']?></li>
            		<?php 
            		}
            		?>
            		
            		<li><?php echo $product_row['product_cate3']?></li>
            		
            		<?php 
            		if (isset($product_row['product_cate4']) && $product_row['product_cate4']!="" && $product_row['product_cate4']!=null) {
            		?>
            		<li><?php echo $product_row['product_cate4']?></li>
            		<?php 
            		}
            		?>
            		
            	</ol>
        		<a href="/product-detail?<?php echo $cate_url?>">
            		<strong><?php echo $product_row['product_model']?></strong>
            		<?php echo $product_row['product_title']?>
        		</a>
        		
        		
            </div>
        </li>
       	<?php 
    	}       	
       	?>
    </ul>
    <div class="pro-pagenation">
			<?php
				$total_page = ceil($total_page / $limit);
				$prev = intval(($page - 1) / 10) * 10;
				
				$next_prev_page = $prev+11;
				$prev_prev_page = $prev-9;
				
				if($page > 1){
					if($page - 1 == 0){
					    $prev_page = 1;
					} else {
						$prev_page = $page - 1;
					}
					
					if ($prev==0) {
					    $prev_prev_page=1;
					}
					?>
					<a href="/search-result/?temp_page=1&keyword=<?php echo $keyword?>">《</a>
					<a href="/search-result/?temp_page=<?php echo $prev_prev_page?>&keyword=<?php echo $keyword?>">〈</a>
					<?php 
				}
				
				if($total_page == 0) $total_page = 1;
				
			
				$ps_num = $prev + 1;
				if($ps_num + 9 < $total_page) {
					$pe_num = $ps_num + 9;
				} else {
					$pe_num = $total_page;
				}
				for ($i = $ps_num; $i < $pe_num+1; $i++) {
					if($i == $page){
			 ?>
			<?php echo "<strong><span>".$i."</span></strong>"?>
			 <?php 
				} else {   
			 ?>
				<!-- <a href="/wp-content/themes/musign/shop_info/brand_store.php?page=<?php echo $i?>"><?php echo $i?></a> -->
				<a href="/search-result/?temp_page=<?php echo $i?>&keyword=<?php echo $keyword?>"><?php echo $i?></a>
			<?php    
					}
				}
			 
				if($page + 1 > $total_page){$next_page = $total_page;}else{$next_page = $page + 1;}
				if($total_page > $page){
				    
				    if ($next_prev_page > $total_page) {
				        $next_prev_page =$total_page;
				      }
			?>
				<a href="/search-result/?temp_page=<?php echo $next_prev_page?>&keyword=<?php echo $keyword?>">〉</a>
				<a href="/search-result/?temp_page=<?php echo $total_page?>&keyword=<?php echo $keyword?>">》</a>
				
			<?php 
				}
			?>
	</div>
    
    
    
</div>
<div id="result-certification" class="search-tab-wrap">
    <h3>인증서 검색</h3>
    <p>입력하신 '<strong>검색어</strong>' 키워드로 총 <strong><?php echo $cert_cnt_row['cnt'];?></strong>개의 인증서가 검색되었습니다.</p>
    <ul class="clearfix">
    	<?php 
    	for ($i = 0; $i < sql_count($cert_result); $i++) {
    	    $cert_row=sql_fetch($cert_result);
    	?>
    	<!-- 
        <li>
            <div class="thumbnail"><a href="/cert/list.php?cate=<?php //echo $cert_row['col4']?>" target="certList"><img src="/wp-content/uploads/2019/11/<?php echo $cert_row['filename1']?>" alt="<?php echo $cert_row['title']?>"></a></div>
            <div class="txt">
            	<small>certification</small>
        		<a href="/cert/list.php?cate=<?php //echo $cert_row['col4']?>" target="certList">
        			<strong><?php //echo $cert_row['title']?></strong>
        		</a>
            </div>
        </li>
         -->
        
    	<li>
			<div class="thumbnail">
				<img src="/wp-content/uploads/2019/11/<?php echo $cert_row['filename1']?>" alt="">
			</div>
			<div class="txt">
				<small>Certification</small> <strong><?php echo $cert_row['title']?></strong>
			</div>
			<div class="cert-btn">
				<a class="print" href="javascript:downloadPrint('<?php echo $cert_row['idx']?>')">인쇄</a>
				<!-- <a class="download" href="/wp-content/uploads/2019/11/<?php //echo $row['filename1']?>" download>다운로드</a> -->
				<a class="download" onclick="actionSubmit('<?php echo $cert_row['filename1']?>')">다운로드</a>
			</div>
		</li>
		
       <?php 
    	}
       ?>
    </ul>
    
    <div class="pro-pagenation">
			<?php
			$cert_total_page = ceil($cert_total_page / $cert_limit);
			$prev = intval(($cert_page - 1) / 10) * 10;
				
				$next_prev_page = $prev+11;
				$prev_prev_page = $prev-9;
				
				if($cert_page > 1){
				    if($cert_page - 1 == 0){
					    $prev_page = 1;
					} else {
					    $prev_page = $cert_page - 1;
					}
					
					if ($prev==0) {
					    $prev_prev_page=1;
					}
					?>
					<a href="/search-result/?cert_temp_page=1&keyword=<?php echo $keyword?>">《</a>
					<a href="/search-result/?cert_temp_page=<?php echo $prev_prev_page?>&keyword=<?php echo $keyword?>">〈</a>
					<?php 
				}
				
				if($cert_total_page == 0) $cert_total_page = 1;
				
			
				$ps_num = $prev + 1;
				if($ps_num + 9 < $cert_total_page) {
					$pe_num = $ps_num + 9;
				} else {
				    $pe_num = $cert_total_page;
				}
				for ($i = $ps_num; $i < $pe_num+1; $i++) {
				    if($i == $cert_page){
			 ?>
			<?php echo "<strong><span>".$i."</span></strong>"?>
			 <?php 
				} else {   
			 ?>
				<!-- <a href="/wp-content/themes/musign/shop_info/brand_store.php?page=<?php echo $i?>"><?php echo $i?></a> -->
				<a href="/search-result/?cert_temp_page=<?php echo $i?>&keyword=<?php echo $keyword?>"><?php echo $i?></a>
			<?php    
					}
				}
			 
				if($cert_page + 1 > $cert_total_page){$next_page = $cert_total_page;}else{$next_page = $cert_page + 1;}
				if($cert_total_page > $cert_page){
				    
				    if ($next_prev_page > $cert_total_page) {
				        $next_prev_page =$cert_total_page;
				      }
			?>
				<a href="/search-result/?cert_temp_page=<?php echo $next_prev_page?>&keyword=<?php echo $keyword?>">〉</a>
				<a href="/search-result/?cert_temp_page=<?php echo $cert_total_page?>&keyword=<?php echo $keyword?>">》</a>
				
			<?php 
				}
			?>
	</div>    
</div>






