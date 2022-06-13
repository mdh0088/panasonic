<?php
require_once ("./include/init.php"); // 페이지 include
require_once ("../wp-load.php");
require_once ("../wp-content/themes/musign/header.php");

if (isset($_REQUEST['cate']) && $_REQUEST['cate'] != '') {
    $query = "select @rownum:=@rownum+1  rnum, a.* from h_cert as a, (SELECT @ROWNUM := 0) R where IsDel = '0' and col3 = '{$_REQUEST['cate']}'";
} else {
    $query = "select @rownum:=@rownum+1  rnum, a.* from h_cert as a, (SELECT @ROWNUM := 0) R where IsDel = '0' ";
}


$query .= "order by reg_date desc";

$result_cnt = sql_query($query);
$page = ($_REQUEST['page']) ? $_REQUEST['page'] : 1;

$list = 8;
$block = 10;
$pageNum = ceil(sql_count($result_cnt) / $list); // 총 페이지
$blockNum = ceil($pageNum / $block); // 총 블록
$nowBlock = ceil($page / $block);

$s_page = ($nowBlock * $block) - ($block - 1);
if ($s_page <= 1) {
    $s_page = 1;
}
$e_page = $nowBlock * $block;
if ($pageNum <= $e_page) {
    $e_page = $pageNum;
}

?>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
var page = "<?php echo $page;?>";
var cate = "<?php echo $_REQUEST['cate'];?>";

$(document).ready(function(){
	$("#p_"+page).parent().addClass('on');
	if(cate != '')
	{
		$("#cate"+cate).addClass("kboard-category-selected");
	}
	else
	{
		$("#cateAll").addClass("kboard-category-selected");
	}
})

function reSelect(act)
{
	$("#page").val(1);
	$("#productForm").submit();
}
function pageMove(page)
{
	$("#page").val(page);
	$("#productForm").submit();
}
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
	/*
	alert('준비중입니다.');
	return;
	*/
	$("#send_value").val(val);
	$("#actionForm").attr("action", "/cert/cert_down.php");
    $("#actionForm").submit();
}

</script>
<form id="actionForm" name="actionForm" method="post" action="">
	<input type="hidden" id="send_type" name="send_type">
	<input type="hidden" id="send_value" name="send_value">
</form>

<form id="productForm" name="productForm" method="get" action="list.php" style="margin:0;">
	<input type="hidden" id="page" name="page" value="<?php echo $page?>">
	<input type="hidden" id="cate" name="cate" value="<?php echo $_REQUEST['cate']?>">
</form>
<form id="printdownForm" name="printdownForm" method="post" action="print_down.php" enctype="multipart/form-data" style="margin:0;">
	<input type="hidden" id="print_idx" name="print_idx" value="">
</form>

<div id="main" class="all_colors" data-scroll-offset="96">

	<div id="sub-top" class="av-layout-grid-container entry-content-wrapper main_color av-flex-cells    avia-builder-el-0  el_before_av_layout_row  avia-builder-el-first  container_wrap fullsize ani-act">
		<div class="flex_cell no_margin av_one_full  avia-builder-el-1  avia-builder-el-no-sibling   av-zero-padding " style="vertical-align: top; padding: 0;">
			<div class="flex_cell_inner">
				<div class="avia-builder-widget-area clearfix  avia-builder-el-2  avia-builder-el-no-sibling ">
					<div id="text-5" class="widget clearfix widget_text">
						<div class="textwidget">
							<div class="subtop-wrap">
								<p>
									Support <small>자료실</small>
								</p>
								<ul>
									<li class="on"><a href="/support/cert">인증서</a></li>
									<li><a href="/support/award">수상경력</a></li>
									<li><a href="/support/news">뉴스</a></li>
									<li><a href="/support/manual">사용 설명서</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="cert-sec01" class="av-layout-grid-container entry-content-wrapper main_color av-flex-cells    avia-builder-el-3  el_after_av_layout_row  avia-builder-el-last  submenu-not-first container_wrap fullsize ani-act">
		<div class="flex_cell no_margin av_one_full  avia-builder-el-4  avia-builder-el-no-sibling   av-zero-padding " style="vertical-align: top; padding: 0;">
			<div class="flex_cell_inner">
				<section class="av_textblock_section " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
					<div class="avia_textblock  " itemprop="text">
						<h1 class="big-txt">DATA</h1>
					</div>
				</section>
				<section class="av_textblock_section " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
					<div class="avia_textblock  " itemprop="text">
						<h2 class="tit">인증서</h2>
					</div>
				</section>
				<section class="av_textblock_section " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
					<div class="avia_textblock  " itemprop="text">
						<div id="kboard-thumbnail-list">
							<!-- 카테고리 시작 -->

							<div class="kboard-category category-pc">
								<ul class="kboard-category-list">
									<li class="" id="cateAll"><a href="list.php">전체</a></li>
									<li id="cate1"><a href="list.php?cate=1">등록증</a></li>
									<li id="cate2"><a href="list.php?cate=2">시스템인증</a></li>
									<li id="cate3"><a href="list.php?cate=3">KS인증</a></li>
									<li id="cate4"><a href="list.php?cate=4">전기용품안전인증</a></li>
									<li id="cate5"><a href="list.php?cate=5">자율확인신고증</a></li>
									<li id="cate6"><a href="list.php?cate=6">정보통신기기인증</a></li>
									<li id="cate7"><a href="list.php?cate=7">기타 인증</a></li>
								</ul>
							</div>

							<ul class="cert-list-new">
                        	<?php
                        
                        $s_point = ($page - 1) * $list;
                        $result = sql_query($query . " limit {$s_point},{$list}");
                        $cal = ($page-1)*8;
                        
                        $paging_num= $pageNum*8-$cal;
                        for ($i = 0; $i < sql_count($result); $i ++) {
                            $row = sql_fetch($result);
                            ?>
    	    	    			<li>
									<div class="cert_wrap">
										<div class="kboard-thumbnail-cut-strings">
											<span class="num"><?php echo $row['rnum']?></span>
											<span class="cert_tit"><?php echo $row['title']?></span>
											<span class="model"><?php echo $row['col1']?></span> 										
										</div>
										<div class="kboard-thumbnail-cut-strings kboard-thumbnail-cut-strings2">
											<span class="date">
												<?php
												$upt_date = $row['col2'];
												if ($row['col2'] !=null) {
												    echo $upt_date;
												}else{
											
												    $upt_date = date('Y-m-d',strtotime($row['reg_date']));
												    echo $upt_date;
												}
												
												
												?></span>
												<div class="cert-btn">
													<a class="print" href="javascript:downloadPrint('<?php echo $row['idx']?>')">인쇄</a>
													<!-- <a class="download" href="/wp-content/uploads/2019/11/<?php //echo $row['filename1']?>" download>다운로드</a> -->
													<a class="download" onclick="actionSubmit('<?php echo $row['filename1']?>')">다운로드</a>
												</div>
												
										</div>
									</div>
									<div class="cont">
										<p>
											<?php echo $row['contents']?>
										</p>	
									</div>
									
								</li>
                        	<?php
                            }
                            ?>
               		        </ul>
							<!-- 리스트 끝 -->

							<!-- 페이징 시작 -->
							<div class="cert-pagination">
								<ul class="cert-pagination-pages">
                    			<?php
                                    if (10 < $page) {
                                ?>
                                    <li class="first-page"><a href="javascript:pageMove(1);">«</a></li>
									<li class="prev-page"><a href="javascript:pageMove(<?=$s_page-1?>);"><</a></li>
                                <?php
                                }
                                $pagingCnt = 0;
                                if ($e_page != 0) {
                                    for ($p = $s_page; $p <= $e_page; $p ++) {
                                        $pagingCnt ++;
                                        ?>
                                        <li><a href="javascript:pageMove(<?=$p?>);" id="p_<?=$p?>" class="p_btn"><?=$p?></a></li>
                                 	    <?php
                                    }
                                } else {
                                    ?>
                                    	<li><a href="javascript:pageMove(1);">1</a></li>
                                    <?php
                                }
                                if ($pageNum != $page && $pageNum > 10) {
                                    if ($pagingCnt > 9) {
                                        if ($e_page + 1 > $pageNum) {
                                            ?>
                                        <li class="next-page"><a href="javascript:pageMove(<?=$pageNum?>);">〉</a></li>
                            			<li class="last-page"><a href="javascript:pageMove(<?=$pageNum?>);">»</a></li>
                                            <?php
                                        } else {
                                            ?>
                                        <li class="next-page"><a href="javascript:pageMove(<?=$e_page+1?>);">></a></li>
                            			<li class="last-page"><a href="javascript:pageMove(<?=$pageNum?>);">»</a></li>
                                            <?php
                                        }
                                    }
                                }
                                ?>
            					</ul>
								<!-- 페이징 끝 -->
							</div>
						</div>				
				</section>
			</div>
		</div>
	</div>
	<!-- close default .container_wrap element -->
<?php require_once ("../wp-content/themes/musign/footer.php");?>
<!-- end main -->
</div>

