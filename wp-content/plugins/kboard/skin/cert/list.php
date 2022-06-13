<div id="kboard-thumbnail-list">
	<!-- 카테고리 시작 -->
	<?php
	if($board->use_category == 'yes'){
		if($board->isTreeCategoryActive()){
			$category_type = 'tree-select';
		}
		else{
			$category_type = 'default';
		}
		$category_type = apply_filters('kboard_skin_category_type', $category_type, $board, $boardBuilder);
		echo $skin->load($board->skin, "list-category-{$category_type}.php", $vars);
	}
	?>
	<!-- 카테고리 끝 -->
	
	<!-- 리스트 시작 -->
	
	<ul class="cert-list">
    	<?php while($content = $list->hasNextNotice()):?>
    	<li class="kboard-list-notice<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
    		<div class="kboard-list-title">
				<?php if($content->getThumbnail(199, 260)):?>
				<div class="kboard-mobile-contents">
					<img src="<?php echo $content->getThumbnail(199, 260)?>" alt="<?php echo esc_attr($content->title)?>" class="contents-thumbnail">
				</div>
				<?php endif?>
    			<div class="kboard-thumbnail-cut-strings">
    				<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
    				<span class="txt">Certification</span>
    				<strong><?php echo $content->title?></strong>
    				<span class="model"><?php echo $content->option->{'base-model'}?></span>
    				<span class="date"><?php echo $content->option->{'cert-date'}?></span>
    			</div>
                <div class="cert-btn">
                	<a class="print" href="#">인쇄</a>	 	 
                	<a class="download" href="#" download="">다운로드</a>
                </div>
    		</div>
    	</li>
    	<?php endwhile?>
    	<?php while($content = $list->hasNext()):?>
    	<li class="<?php if($content->uid == kboard_uid()):?>kboard-list-selected<?php endif?>">
    		<div class="kboard-list-title">
				<?php if($content->getThumbnail(199, 260)):?>
				<div class="kboard-mobile-contents">
					<img src="<?php echo $content->getThumbnail(199, 260)?>" alt="<?php echo esc_attr($content->title)?>" class="contents-thumbnail">
				</div>
				<?php endif?>
    			<div class="kboard-thumbnail-cut-strings">
    				<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
    				<span class="txt">Certification</span>
    				<strong><?php echo $content->title?></strong>
    				<span class="model"><?php echo $content->option->{'base-model'}?></span>
    				<span class="date"><?php echo $content->option->{'cert-date'}?></span>
    			</div>	 	 
                <div class="cert-btn">
                	<a class="print" href="#">인쇄</a>	 	 
                	<a class="download" href="#" download="">다운로드</a>
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
	
	<!-- 검색폼 시작 -->
	<div class="kboard-search">
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected<?php endif?>><?php echo __('Content', 'kboard')?></option>
				<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected<?php endif?>><?php echo __('Author', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo esc_attr(kboard_keyword())?>">
			<button type="submit" class="kboard-thumbnail-button-small"><?php echo __('Search', 'kboard')?></button>
		</form>
	</div>
	<!-- 검색폼 끝 -->
	
	<?php if($board->isWriter()):?>
	<!-- 버튼 시작 -->
	<div class="kboard-control">
		<a href="<?php echo $url->getContentEditor()?>" class="kboard-thumbnail-button-small"><?php echo __('New', 'kboard')?></a>
	</div>
	<!-- 버튼 끝 -->
	<?php endif?>
	
</div>