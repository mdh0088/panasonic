(function($) { 

	$(window).ready(function(){
		img_event();
		$(window).scroll(function(e){
			var s = $(window).scrollTop();	// 현재 window scrollTop
			if(s>50){
				img_event();
			}
		})
		function img_event(){
			$(".img-ani").each(function(){
				var w_t = $(window).scrollTop() + $(window).height();
				var i_t = $(this).offset().top;
				if(w_t > i_t + 200){
					$(this).addClass("img-aniload");
				}
			})
		}

		img_event_remove();

		
		


		/******************************************
		* 이미지 effect remove event
		* img_event() 가 적용되었던 요소들을 초기화 시켜주겠습니다.
		******************************************/
		function img_event_remove(){
			$(".img-ani").removeClass("img-aniload");
		}
	})

	

	
	/* 200715 웹표준 수정 hwa0 */
	$(window).ready(function(){
		$(".series-list img, .history-wrap img, .main-slide-img img, #product-detail img").attr("alt","panasonic");
		$("a").attr("title","panasonic");
		
		setTimeout(function(){
			$("#main-sec01 .ls-bottom-slidebuttons a").text("mainbtn");
			$("#main-sec01 .ls-bottom-slidebuttons a").attr("title","panasonic");
			$(".sub_products img").attr("alt","panasonic");
			$("#global a").attr("title","파나소닉 글로벌 홈페이지 새창으로 이동");
			$("#menu-language a").attr("title","파나소닉 영문페이지로 이동");
			$(".ls-wrapper img").attr("alt","panasonic main slide")
		},500);
	})

	
} ) ( jQuery);