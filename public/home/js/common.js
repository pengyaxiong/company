
var pageAction = (function() {

		_fn = {
			// 首页顶部幻灯片切换
			slide:function() {
				var $tabParent = $('.banner_btn'),
				  $tabs = $tabParent.children('li');
				var $paneParent = $('.banner_pic');
				$.slides({
					tabParent: $tabParent,
     				paneParent: $paneParent,
					activeClass: 'btn_select',
					duration:400,
					autoslideInterval:10000,
					autoslide:true,
					onSlideEnd: function(currentIndex, prevIndex){
						// $(".ban1_txt h4,.ban1_p,.ban1_title").addClass("fadeInUp");
						$(".banner1 p").addClass("fadeIn");
						// $(".banner2 div").fadeIn();
						// $(".banner3 div").fadeIn();
						setTimeout(function(){
							$(".banner2 p").addClass("fadeIn");
							$(".banner3 p").addClass("fadeIn");
							$(".banner4 p").addClass("fadeIn");
						},500)


					}
				});
	        $(".ban1_txt h4,.ban1_p,.ban1_title").addClass("fadeInUp");
			},

			// 首页底部最新新闻切换
			slide3:function(){
				$(".lt_silde li").clone().appendTo(".lt_silde ul");
				var ul_size = $(".lt_silde li").length;
				var ul_width = ul_size*1100;
				$(".lt_silde ul").css("width",ul_width);
				var i = 0;
				var lock = true;
				$(".lt_prev").click(function(){
					if(lock){
						lock = false;
						i-- ;
						if(i<0){
							$('.lt_silde ul').css('left',-ul_size/2*1100+'px');
							i=ul_size/2-1;
							}
						$(".lt_silde ul").animate({
							left: '+=1100'
						},500,function(){
							lock = true;
						})
					}

				})
				$(".lt_next").click(function(){
					if(lock){
						lock = false;
						i++;
							if(i>ul_size/2){
								$('.lt_silde ul').css('left',0+'px');
								i=1;
							}
							$(".lt_silde ul").animate({
								left: '-=1100'
							},500,function(){
								lock = true;
							})
					}

				})
			},

			// 活动页底部幻灯片切换
			slide2:function(){
				$(".silde_con li").clone().appendTo(".silde_con ul");
				var ul_size = $(".silde_con li").length;
				var ul_width = ul_size*366;
				$(".silde_main ul").css("width",ul_width);
				var i = 0;
				var lock = true;
				$(".prev").click(function(){
					if(lock){
						lock = false;
						i-- ;
						if(i<0){
							$('.silde_con ul').css('left',-ul_size/2*366+'px');
							i=ul_size/2-1;
							}
						$(".silde_con ul").animate({
							left: '+=366'
						},500,function(){
							lock = true;
						})
					}

				})
				$(".next").click(function(){
					if(lock){
						lock = false;
						i++;
							if(i>ul_size/2){
								$('.silde_con ul').css('left',0+'px');
								i=1;
							}
							$(".silde_con ul").animate({
								left: '-=366'
							},500,function(){
								lock = true;
							})
					}

				})
			},


			// 顶部条滚动隐藏
			topbar:function(){
				$(window).scroll(function(){
				    var top = parseInt($(window).scrollTop());
				    if(top>115){
				    	$(".nav").addClass("fixed");
				    	$(".placeholder").removeClass("invisible");
				    }else{
				    	$(".nav").removeClass("fixed");
				    	$(".placeholder").addClass("invisible");
				    }
				  })

			},

			// 图文详情页右侧input信息提示
			tips:function(){
				$(".tips_set i").hover(function(){
					
					$(this).parent('.input_box').next(".tips_con").show();
					$(this).parent('.input_box').nextAll(".arrow").show();
				},function(){
					$(this).parent('.input_box').next(".tips_con").hide();
					$(this).parent('.input_box').nextAll(".arrow").hide();
				})
			},

			// 首页主推项目
			itemHover:function(){
				$(".item").hover(function(){
						$(this).find("img").stop(true,true).fadeIn('fast');
						// $(this).find("a").addClass("hover");
				},function(){
						$(this).find("img").stop(true,true).fadeOut('fast');
						// $(this).find("a").removeClass("hover");
				});
			},
			// 新闻内页时间轴
			timeLine:function(){
				$(".time_end").next(".news_list_warp").find(".news_list").each(function(){
					var index = $(this).index(),
						jo = index%2;
						if(jo==0){
							$(this).css('float','left');
							$(this).find(".arrow_line").css('margin','14px 0 0 -98px');
							$(this).find(".time_point").css('right','-187px');
							$(this).find(".arrow_line").addClass("sprite-arrow_line_left");
						}else{
							$(this).css('float','right');

							$(this).find(".arrow_line").css('margin','14px 0 0 71px');
							$(this).find(".time_point").css('left','-187px');
							$(this).find(".arrow_line").addClass("sprite-arrow_line_right");
						}
				});
				$(".time_end").each(function(){
					$(this).next(".news_list_warp").find(".news_list").eq(1).css("margin-top",'246px');
				})
				
				$(".time_point").hover(function(){
					$(this).addClass("hover");
					$(this).parent(".news_list").addClass("hover");
				},function(){
					$(this).removeClass("hover");
					$(this).parent(".news_list").removeClass("hover");
				});
				$(".news_list").hover(function () {
					$(this).addClass("hover");
					$(this).find(".time_point").addClass("hover");
				},function(){
					$(this).removeClass("hover");
					$(this).find(".time_point").removeClass("hover");
				});
			},

			// banner文字css3效果
			fadeInCss:function(){
				$('.banner_label p').addClass('fadeInUp')
			}


		},

		//公有方法
		fn = {
		},

		//初始化
		init = function() {
			// _fn.slide();
			//_fn.slide2();
			//_fn.slide3();
			_fn.topbar();
			_fn.tips();
			_fn.itemHover();
			//_fn.timeLine();
			_fn.fadeInCss();
			
		};
	return {
		fn: fn,
		init: init
	}
})();

$(function() {
	pageAction.init();
//baidu tongji start
});
