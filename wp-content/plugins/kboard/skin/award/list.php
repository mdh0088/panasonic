<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>

function actionSubmit(val){
	
	var filename = val.split('/');
	var filename_length= filename.length-1;
	
 	$("#send_value").val(val);
	$("#real_name").val(filename[filename_length]);
	$("#actionForm").attr("action", "http://panasonic.musign.co.kr/wp-content/plugins/kboard/skin/award/award_down.php");
    $("#actionForm").submit();
}
</script>
<form id="actionForm" name="actionForm" method="post" action="">
	<input type="hidden" id="send_value" name="send_value">
	<input type="hidden" id="real_name" name="real_name">
</form>
<div id="kboard-thumbnail-list">
	<!-- 리스트 시작 -->
	<ul>
    	<?php while($content = $list->hasNextNotice()):?>
    	<li class="kboard-list-notice<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
    		<div class="kboard-list-title">
				<?php if($content->getThumbnail(736, 375)):?>
				<div class="kboard-mobile-contents">
					<img src="<?php echo $content->getThumbnail(736, 375)?>" alt="<?php echo esc_attr($content->title)?>" class="contents-thumbnail">
				</div>
				<?php endif?>
    			<div class="kboard-thumbnail-cut-strings">
    				<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
    				<span class="category"><?php echo $content->category1?></span>
    				<strong><?php echo $content->title?></strong>
    				<span class="date"><?php echo $content->option->{'award-date'}?></span>
    			</div>
    			<div class="award-btn">
    				<div class="cell">
    					<a href="#" class="print-btn"><img src="/img/award_icon01.png" alt="Print"></a>
    					<a href="#" class="down-btn" download><img src="/img/award_icon02.png" alt="Download"></a>
    				</div>
    			</div>
    		</div>
    	</li>
    	<?php endwhile?>
    	<?php while($content = $list->hasNext()):?>
    	<li class="<?php if($content->uid == kboard_uid()):?>kboard-list-selected<?php endif?>" style="position:relative;">
    		<div class="kboard-list-title">
				<?php if($content->getThumbnail(736, 375)):?>
				<div class="kboard-mobile-contents">
					<img src="<?php echo $content->getThumbnail(736, 375)?>" alt="<?php echo esc_attr($content->title)?>" class="contents-thumbnail">
				</div>
				<?php endif?>
    			<div class="kboard-thumbnail-cut-strings">
    				<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
    				<span class="category"><?php echo $content->category1?></span>
    				<strong><?php echo $content->title?></strong>
    				<span class="date"><?php echo $content->option->{'award-date'}?></span>
    			</div>
    			<div class="award-btn">
    				<div class="cell">
    					<a href="#" class="print-btn"><img src="/img/award_icon01.png" alt="Print"></a>
    					<!-- <a href="<?php //echo $content->attach->file1[0]; ?>" class="down-btn asd" download><img src="/img/award_icon02.png" alt="Download"></a> -->
    					<a onclick="actionSubmit('<?php echo $content->attach->file1[0];?>')" class="down-btn" download><img src="/img/award_icon02.png" alt="Download"></a>
    				</div>
    			</div>
    		</div>
    	</li>
    	<?php $boardBuilder->builderReply($content->uid)?>
    	<?php endwhile?>
	</ul>
	<!-- 리스트 끝 -->
	
	<!-- 페이징 시작 -->
	<div class="kboard-pagination">
		<ul class="kboard-pagination-pages">
			<?php echo kboard_pagination($list->page, $list->total, $list->rpp)?>
		</ul>
	</div>
	<!-- 페이징 끝 -->
		
	<?php if($board->isWriter()):?>
	<!-- 버튼 시작 -->
	<div class="kboard-control">
		<a href="<?php echo $url->getContentEditor()?>" class="kboard-thumbnail-button-small"><?php echo __('New', 'kboard')?></a>
	</div>
	<!-- 버튼 끝 -->
	<?php endif?>
</div>

<script>
    //수상경력 다운로드 버튼 작동
    $('#award-sec01 li .print-btn').click(function(e){
    	e.preventDefault();
    	var downLink = $(this).next('.down-btn').attr('onclick').split("('")[1].split("')");
    	console.log(downLink[0]);
    	VoucherPrint(downLink[0]);
    });
    
    function VoucherSourcetoPrint(source) {
    	return "<html><head><script>function step1(){\n" +
    			"setTimeout('step2()', 10);}\n" +
    			"function step2(){window.print();window.close()}\n" +
    			"</scri" + "pt></head><body onload='step1()'>\n" +
    			"<img src='" + source + "'  style='max-width:100%'/></body></html>";
    }
    function VoucherPrint(source) {
    	Pagelink = "about:blank";
    	var pwa = window.open(Pagelink, "_new");
    	pwa.document.open();
    	pwa.document.write(VoucherSourcetoPrint(source));
    	pwa.document.close();
    }
</script>