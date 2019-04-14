/**
 * @Author LUOZHITAO
 * 参考配置：代码前端的cf变量
 * 使用方法： var slidesApi = $.slides(config);
 */

;(function($){

  $.slides = function(userConfig){

    // 检查配置
    var cf = userConfig || {};
    cf = {
      tabParent: cf.tabParent || $(''),             // [必填]标签直属父容器
      paneParent: cf.paneParent || $(''),           // [必填]面板直属父容器
      tabSelector: cf.tabSelector || 'li',
      paneSelector: cf.paneSelector || 'li',
      btnPrev: cf.btnPrev || '',
      btnNext: cf.btnNext || '',
      activeClass: cf.activeClass || 'active',
      triggerType: cf.triggerType || 'click',
      initActiveIndex: cf.initActiveIndex || 0,
      duration: cf.duration || 300,
      autoslide: undefined !== cf.autoslide ? cf.autoslide : false,
      autoslideInterval: cf.autoslideInterval || 2000,
      onSlideStart: cf.onSlideStart || function(){},
      onSlideEnd: cf.onSlideEnd || function(){}
    };

    // 缓存节点
    var
      $tabs = cf.tabParent.children(cf.tabSelector),
      $panes = cf.paneParent.children(cf.paneSelector),
      tabCount = $tabs.length,
      currentIndex = cf.initActiveIndex,
      prevIndex = null,
      paneWidth = $panes.outerWidth(true),
      sliding = false;

    // 当窗口改变大小时自动改变
    $(window).bind('resize', function(){
      paneWidth = $panes.outerWidth(true);
    });

    // 载入时给每个tabs绑定对应的索引和pane
    // 显示初始面板
    for(var i=0, j=tabCount, tab; j>i; i++){
      tab = $tabs[i];
      tab._index = i;
      tab._pane = $panes[i];
      if(cf.initActiveIndex === i){
        $(tab).addClass(cf.activeClass);
        $(tab._pane).show().addClass(cf.activeClass);
      }else{
        $(tab).removeClass(cf.activeClass);
        $(tab._pane).hide().removeClass(cf.activeClass);
      }
    }

    // 浏览功能
    var slideTo = function(tab, callback){
      var t = tab, $t = $(tab);

      if(currentIndex === t._index){return;}

      // 统一处理节点
      $tabs.removeClass(cf.activeClass);
      $t.addClass(cf.activeClass);
      $panes.removeClass(cf.activeClass);
      $(t._pane).addClass(cf.activeClass);

      // 记录数据
      prevIndex = currentIndex;
      currentIndex = t._index;

      // 要浏览较后的面板
      if(prevIndex < currentIndex){
        $(t._pane).show();
        cf.onSlideStart();

        sliding = true;
        cf.paneParent.animate({
          'left': paneWidth*-1+'px'
        }, cf.duration, function(){
          $($tabs[prevIndex]._pane).hide();
          cf.paneParent.css('left', 0);

          sliding = false;
          if(callback){callback(currentIndex, prevIndex);}
          cf.onSlideEnd(currentIndex, prevIndex);
        });
      }
      // 要浏览较前的面板
      else if(prevIndex > currentIndex){
        $(t._pane).show();
        cf.onSlideStart();
        cf.paneParent.css('left', paneWidth*-1+'px');

        sliding = true;
        cf.paneParent.animate({
          'left' : 0
        }, cf.duration, function(){
          $($tabs[prevIndex]._pane).hide();

          sliding = false;
          if(callback){callback(currentIndex, prevIndex);}
          cf.onSlideEnd(currentIndex, prevIndex);
        });
      }
    },

    // 从最后一个切换到第一个(平滑处理)
    slideFromLastToFirst = function(callback){
      // 统一处理节点
      $tabs.removeClass(cf.activeClass).eq(0).addClass(cf.activeClass);
      $panes.removeClass(cf.activeClass).eq(0).addClass(cf.activeClass);

      // 记录数据
      prevIndex = tabCount -1;
      currentIndex = 0;

      // 复制首个节点并添加进去
      var
        $firstPane = $panes.eq(0), firstPaneCopy;
      firstPaneCopy = $firstPane[0].cloneNode(true);
      cf.paneParent.append(firstPaneCopy);

      $firstPane.show();
      $(firstPaneCopy).show();
      cf.onSlideStart();

      sliding = true;
      cf.paneParent.css('left', paneWidth*-1+'px').animate({
        'left': paneWidth*-2+'px'
      }, cf.duration, function(){
        cf.paneParent.css('left', 0);
        $(firstPaneCopy).remove();
        $panes.eq(tabCount-1).hide();

        sliding = false;
        if(callback){callback();}
        cf.onSlideEnd(currentIndex, prevIndex);
      });
    },

    // 从第一个切换到最后一个(反向)
    slideFromFirstToLast = function(callback){
      // 统一处理节点
      $tabs.removeClass(cf.activeClass).eq(tabCount-1).addClass(cf.activeClass);
      $panes.removeClass(cf.activeClass).eq(tabCount-1).addClass(cf.activeClass);

      // 记录数据
      prevIndex = 0;
      currentIndex = tabCount -1;

      // 复制最后一个节点并添加进去
      var
        $lastPane = $panes.eq(tabCount-1), lastPaneCopy;
      lastPaneCopy = $lastPane[0].cloneNode(true);
      cf.paneParent.prepend(lastPaneCopy);

      $lastPane.show();
      $(lastPaneCopy).show();
      cf.onSlideStart();

      sliding = true;
      cf.paneParent.css('left', paneWidth*-1+'px').animate({
        'left': 0
      }, cf.duration, function(){
        $(lastPaneCopy).remove();
        $panes.eq(0).hide();

        sliding = false;
        if(callback){callback();}
        cf.onSlideEnd(currentIndex, prevIndex);
      });
    };

    // 监听Tabs上的事件
    if('click' === cf.triggerType){
      cf.tabParent.delegate(cf.tabSelector, cf.triggerType, function(){
        if(!sliding){slideTo(this);}
      });
    }
    else if('mouseover' === cf.triggerType || 'mouseenter' === cf.triggerType || 'mousemove' === cf.triggerType){
      var timerMouseover;
      cf.tabParent.delegate(cf.tabSelector, 'mousemove', function(){
        var self = this;
        if(timerMouseover){timerMouseover = clearTimeout(timerMouseover);}

        timerMouseover = setTimeout(function(){
          if(!sliding){slideTo(self);}
        }, 50);
      });
    }

    // 自动切换
    var timerAutoSlide, enableAuto, clearAuto;

    if(cf.autoslide){
      enableAuto = function(){
        timerAutoSlide = setInterval(function(){
          if(!sliding){
            if(currentIndex === tabCount - 1){
              slideFromLastToFirst();
            }else{
              slideTo($tabs[currentIndex+1]);
            }
          }
        }, cf.autoslideInterval);
      };

      clearAuto = function(){
        if(timerAutoSlide){timerAutoSlide = clearInterval(timerAutoSlide);}
      };

      cf.tabParent.bind('mouseover', function(){
        clearAuto();
      }).bind('mouseout', function(){
        enableAuto();
      });

      cf.paneParent.bind('mouseover', function(){
        clearAuto();
      }).bind('mouseout', function(){
        enableAuto();
      });

      enableAuto();
    }


    // 上一个/下一个 切换功能
    if(cf.btnPrev){
      $(cf.btnPrev).bind('click', function(){
        if(sliding){return;}
        if(cf.autoslide){clearAuto();}
        if(0 === currentIndex){
          // slideTo($tabs[ tabCount - 1 ], function(){if(cf.autoslide){enableAuto();} });
          slideFromFirstToLast(function(){if(cf.autoslide){enableAuto();}});
        }else{
          slideTo($tabs[ currentIndex - 1 ], function(){if(cf.autoslide){enableAuto();} });
        }
      });
    }
    if(cf.btnNext){
      $(cf.btnNext).bind('click', function(){
        if(sliding){return;}
        if(cf.autoslide){ clearAuto();}
        if(tabCount - 1 === currentIndex){
          // slideTo($tabs[0], function(){ if(cf.autoslide){enableAuto();} });
          slideFromLastToFirst(function(){if(cf.autoslide){enableAuto();}});
        }else{
          slideTo($tabs[ currentIndex + 1 ], function(){ if(cf.autoslide){enableAuto();} });
        }
      });
    }

    // 返回API
    return {
      getTabs: function(){
        return $tabs;
      },
      getPanes: function(){
        return $panes;
      },
      teardown: null // 待补充
    };
  };

})(jQuery);
