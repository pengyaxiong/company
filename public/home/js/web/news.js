var news = null;
function News() {
};
News.prototype = {
	defaults : {
		topYear : 0,
		pages : Infinity,
		pageNum : 2,
		footerHeight : 0,
		lastPageLoadOver : true,
	},
	initEvents : function() {
		this.defaults.footerHeight = $(".copyright").height();
		this.defaults.topYear=$(".time_end")[0].innerHTML;
		this.scroll();
		this.mobileTouch();
		this.click();	
	},
	clickFun:function(){
		if (news.defaults.lastPageLoadOver) {			
			if(news.isMoreLastPage()){
				$(".conLoad").unbind("click",news.clickFun);
			}else{				
				news.show();
			}
		}
	},
	click:function(){
		$(".conLoad").bind("click",news.clickFun);
	},
	mobileTouch : function() {
		if (this.ispc()) {
			return;
		} else {
			$(window).unbind("scroll", news.scroll);
			$(document).bind("touchmove", news.mobileTouchFun);
		}

	},
	mobileTouchFun : function(event) {
		if (news.defaults.lastPageLoadOver) {
			var pageY = event.originalEvent.touches[0].pageY;
			var documentHeight = $(document).height();
			if (pageY > documentHeight*0.85) {
				
				if (news.isMoreLastPage()) {
					$(document).unbind("touchmove", news.mobileTouchFun);
				}else{
					news.show();
				}
			}
		}
	},
	ispc : function() {
		var userAgentInfo = navigator.userAgent;
		var Agents = new Array("Android", "iPhone", "SymbianOS",
				"Windows Phone", "iPad", "iPod");
		var flag = true;
		for (var v = 0; v < Agents.length; v++) {
			if (userAgentInfo.indexOf(Agents[v]) > 0) {
				flag = false;
				break;
			}
		}
		return flag;
	},
	scrollFun : function() {
		if (news.defaults.lastPageLoadOver) {
			if ($(window).scrollTop() >= ($(document).height()-$(window).height()-news.defaults.footerHeight+75)) {
				
				if (news.isMoreLastPage()) {
					$(window).unbind("scroll", news.scrollFun);
				}else{
					news.show();
				}
			}
		}
	},
	scroll : function() {
		$(window).bind("scroll", news.scrollFun);
	},
	show : function() {
		news.defaults.lastPageLoadOver = false;
		$(".time_loading").fadeIn();
		util.ajax("api/web/news.htm?pageNum=" + news.defaults.pageNum, "GET",
				null, news.showCallBack);
	},
	showCallBack : function(data) {
		$(".time_loading").fadeOut();
		var value = data.value;
		for (var i = 0, l = value.length; i < l; i++) {

				if (news.getYearByDate(value[i].detailTime) != news.defaults.topYear) {
					news.defaults.topYear = news
							.getYearByDate(value[i].detailTime);
					news.buildTopYear(news.defaults.topYear);
					news.buildDiv(news.defaults.topYear);
				}
				
				news.buildNews(value[i]);
			
		}
		_fn.timeLine();
		news.defaults.pageNum++;
		news.defaults.pages = data.message;
		news.defaults.lastPageLoadOver = true;
	},
	isMoreLastPage : function() {
		if(news.defaults.pageNum>news.defaults.pages){
			$(".conLoad").css("background-image","url(../images/comLoad.png)");
			return true;
		}else{
			return false;
		}
	},
	getYearByDate : function(time) {
		var date = new Date(time);
		return date.getFullYear();
	},
	buildDiv : function(year) {
		var array = [];
		array.push("<div class='news_list_warp clearfix' id='news_");
		array.push(year);
		array.push("'></div>");
		$(".news_wrap .time_news").append(array.join(""));
	},
	buildTopYear : function(year) {
		var array = [];
		array.push("<div class='time_end sprite sprite-year_bg'>");
		array.push(year);
		array.push("</div>");
		$(".news_wrap .time_news").append(array.join(""));
	},
	getDetailUrl : function(type, id) {
		if (type == 0) {
			return "act_" + id + ".htm";
		} else if (type == 1) {
			return "news_" + id + ".htm";
		}
	},
	buildNews : function(_news) {
		var array = [];
		array.push("<div class='news_list'>");
		array.push("<a href='");
		array.push(news.getDetailUrl(_news.jumpType, _news.jumpId));
		array.push("' style='display: block'><h3>");
		array.push(_news.title);
		array.push("</h3><span class='news_time'>");
		array.push(util.getTime(_news.detailTime, 0));
		array.push("</span>");
		array.push("<img width='313' height='180' src='");
		array.push(_news.imgUrl);
		array.push("' alt='");
		array.push(_news.imgTitle);
		array.push("'/>");
		array.push("<p>");
		array.push(_news.subTitle);
		array.push("</p>");
		array.push("<span class='news_btn'>点击查看</span>");
		array
				.push("<div class='time_point'><span class='sprite arrow_line'></span>");
		array.push("<span class='time_date'>");
		array.push(util.getTime(_news.detailTime, 1));
		array.push("</span></div></a>");
		$("#news_" + news.getYearByDate(_news.detailTime)).append(
				array.join(""));
	}
};
$(function() {
	news = new News();
	news.initEvents();
});