<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");

$type1_query="select * from product_cate where cate_type='1' ";
$type2_query="select * from product_cate where cate_type='2' ";
$type3_query="select * from product_cate where cate_type='3' ";

$type1_result=sql_query($type1_query);
$type2_result=sql_query($type2_query);
$type3_result=sql_query($type3_query);

?>


<script>
var lang = '<?php echo $_GET['lang']?>';
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
	if (idx=='Lighting_Control_System' || idx=='Welfare_Products' || idx=='Smart_Wiring_Device' || idx=='Market_Products') {
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
    	var lo_link = "/product-detail?lang="+lang+"&cate1="+encodeURI(cate1_url)+"&cate2="+encodeURI(cate2_url)+"&cate3=" + encodeURI(idx);
    	$("#product_url").val(lo_link);
	}

}

function page_link(){
	location.href=$("#product_url").val();
}

/*
function actionSubmit(val){
	$("#send_value").val(val);
	$("#actionForm").attr("action", "/wp-content/themes/musign/include/main_down.php");
    $("#actionForm").submit();
}
*/
</script>
<form id="actionForm" name="actionForm" method="post" action="">
	<input type="hidden" id="send_type" name="send_type">
	<input type="hidden" id="send_value" name="send_value">
</form>
<input type="hidden" id="product_url" value="">

<div class="main-search-wrap">
	<div class="main-search">
	
		<div class="search-box product tab02 cate_tab">
			<div class="cate_title cate1_title">Product</div>
			<ul>
			<?php 
			for ($i = 0; $i < sql_count($type1_result); $i++) {
			    $type1_row=sql_fetch($type1_result);
			    $confirm_query = "SELECT *, cate_type-(SELECT cate_type FROM product_cate WHERE  upper_cate ='{$type1_row['kor_title']}' LIMIT 1 )
                                 AS chk FROM product_cate WHERE idx ='{$type1_row['idx']}' ";
			    $confirm_result = sql_query($confirm_query);
			    $confirm_row = sql_fetch($confirm_result);
			    
			    $kor_title = $confirm_row['kor_title'];
			    $eng_title = $confirm_row['eng_title'];
			    $cate_type = $confirm_row['chk']*-1;
			    
			    if ($_GET['lang']=='en') {
			        $cate1_title=$confirm_row['eng_title'];
			        $cate1_title = str_replace('_',' ',$cate1_title);
			        $cate1_title = str_replace('and','&',$cate1_title);
			    }else{
			        $cate1_title=$confirm_row['kor_title'];
			    }
			?>
				<li class="cate1 <?php echo $eng_title?>" onclick="show(<?php echo $cate_type?>,'<?php echo $eng_title?>',this);"><?php echo $cate1_title?></li>			
			<?php 
			}			
			?>
			</ul>
		</div>
		<div class="search-box solution tab03 cate_tab">
			<div class="cate_title cate2_title">Solution</div>
			<ul>
				<?php 
				if ($_GET['lang']=='en') {
				    echo "<li class='cate2_hide'>*Please select a previous item.</li>";
				}else{
				    echo "<li class='cate2_hide'>*이전 항목을 선택해주세요.</li>";
				}
				?>
				<?php 
				for ($i = 0; $i < sql_count($type2_result); $i++) {
				    $type2_row=sql_fetch($type2_result);
				    $confirm_query = "select * from product_cate where kor_title='{$type2_row['upper_cate']}' ";
				    $confirm_result = sql_query($confirm_query);
				    $confirm_row = sql_fetch($confirm_result);
				    
				    $kor_title = $type2_row['kor_title'];
				    $eng_title = $type2_row['eng_title'];
				    $cate_type = $type2_row['cate_type'];
				    $upper_cate = $confirm_row['eng_title'];
				    
				    if ($_GET['lang']=='en') {
				        $cate2_title=$type2_row['eng_title'];
				        $cate2_title = str_replace('_',' ',$cate2_title);
				        $cate2_title = str_replace('and','&',$cate2_title);
				    }else{
				        $cate2_title=$type2_row['kor_title'];
				    }
				    
				?>
    				<li class="cate2 <?php echo $upper_cate?>" onclick="show(<?php echo $cate_type?>,'<?php echo $eng_title?>',this);"><?php echo $cate2_title?></li>
				<?php 
				}
				?>
				
			</ul>
		</div>
		
		<div class="search-box item tab04 cate_tab">
			<div class="cate_title cate3_title">Item</div>
			<ul class="">
				<?php 
				if ($_GET['lang']=='en') {
				    echo "<li class='cate2_hide'>*Please select a previous item.</li>";
				}else{
				    echo "<li class='cate2_hide'>*이전 항목을 선택해주세요.</li>";
				}
				?>
				<?php 
				for ($i = 0; $i < sql_count($type3_result); $i++) {
				    $type3_row=sql_fetch($type3_result);
				    $confirm_query = "select * from product_cate where kor_title='{$type3_row['upper_cate']}' ";
				    $confirm_result = sql_query($confirm_query);
				    $confirm_row = sql_fetch($confirm_result);
				    
				    $kor_title = $type3_row['kor_title'];
				    $eng_title = $type3_row['eng_title'];
				    $cate_type = $type3_row['cate_type'];
				    $upper_cate = $confirm_row['eng_title'];
				    
				    if ($_GET['lang']=='en') {
				        $cate3_title=$type3_row['eng_title'];
				        $cate3_title_conv = str_replace('_',' ',$cate3_title);
				        $cate3_title_conv = str_replace('and','&',$cate3_title_conv);
				    }else{
				        $cate3_title=$type3_row['kor_title'];
				        $cate3_title_conv=$type3_row['kor_title'];
				    }
				    
				?>
				<li class="cate3 <?php echo $upper_cate?>" onclick="choose_cate('<?php echo $cate3_title?>',this,'act');"><?php echo $cate3_title_conv?></li>				
				<?php 
				}
				?>
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
