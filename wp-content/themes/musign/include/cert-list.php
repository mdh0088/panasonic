<?php
 if (isset($_REQUEST['cate']) && $_REQUEST['cate'] != '') {
    $query = "select * from h_cert where IsDel = '0' and col3 = '{$_REQUEST['cate']}'";
} else {
    $query = "select * from h_cert where IsDel = '0' ";
}

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

<script>
var page = "<?php echo $page;?>";
var cate = "<?php echo $_REQUEST['cate'];?>";

$(document).ready(function(){
	console.log(page);
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
</script>
<form id="productForm" name="productForm" method="get" action="list.php" style="margin:0;">
	<input type="hidden" id="page" name="page" value="<?php echo $page?>">
	<input type="hidden" id="cate" name="cate" value="<?php echo $_REQUEST['cate']?>">
</form>
<form id="printdownForm" name="printdownForm" method="post" action="print_down.php" enctype="multipart/form-data" style="margin:0;">
	<input type="hidden" id="print_idx" name="print_idx" value="">
</form>


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
<!-- 카테고리 끝 -->
<!-- 리스트 시작 -->
<ul class="cert-list">
<?php

$s_point = ($page - 1) * $list;
$result = sql_query($query . " limit {$s_point},{$list}");
for ($i = 0; $i < sql_count($result); $i ++) {
    $row = sql_fetch($result);
    ?>
<li>
	<div class="kboard-mobile-contents">
		<img src="/cert/file/<?php echo $row['filename1']?>" alt="" class="contents-thumbnail">
	</div>
	<div class="kboard-thumbnail-cut-strings">
		<span class="txt">Certification</span> <strong><?php echo $row['title']?></strong>
		<span class="model"><?php echo $row['col1']?></span> <span
			class="date"><?php echo $row['col2']?></span>
	</div>
	<div class="cert-btn">
		<a class="print" href="javascript:downloadPrint('<?php echo $row['idx']?>')">인쇄</a>
		<a class="download" href="/cert/file/<?php echo $row['filename1']?>" download>다운로드</a>
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