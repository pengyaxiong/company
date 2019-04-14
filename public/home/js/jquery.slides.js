/**
 * @Author LUOZHITAO
 * �ο����ã�����ǰ�˵�cf����
 * ʹ�÷����� var slidesApi = $.slides(config);
 */

;(function($){

  $.slides = function(userConfig){

    // �������
    var cf = userConfig || {};
    cf = {
      tabParent: cf.tabParent || $(''),             // [����]��ǩֱ��������
      paneParent: cf.paneParent || $(''),           // [����]���ֱ��������
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

    // ����ڵ�
    var
      $tabs = cf.tabParent.children(cf.tabSelector),
      $panes = cf.paneParent.children(cf.paneSelector),
      tabCount = $tabs.length,
      currentIndex = cf.initActiveIndex,
      prevIndex = null,
      paneWidth = $panes.outerWidth(true),
      sliding = false;

    // �����ڸı��Сʱ�Զ��ı�
    $(window).bind('resize', function(){
      paneWidth = $panes.outerWidth(true);
    });

    // ����ʱ��ÿ��tabs�󶨶�Ӧ��������pane
    // ��ʾ��ʼ���
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

    // �������
    var slideTo = function(tab, callback){
      var t = tab, $t = $(tab);

      if(currentIndex === t._index){return;}

      // ͳһ����ڵ�
      $tabs.removeClass(cf.activeClass);
      $t.addClass(cf.activeClass);
      $panes.removeClass(cf.activeClass);
      $(t._pane).addClass(cf.activeClass);

      // ��¼����
      prevIndex = currentIndex;
      currentIndex = t._index;

      // Ҫ����Ϻ�����
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
      // Ҫ�����ǰ�����
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

    // �����һ���л�����һ��(ƽ������)
    slideFromLastToFirst = function(callback){
      // ͳһ����ڵ�
      $tabs.removeClass(cf.activeClass).eq(0).addClass(cf.activeClass);
      $panes.removeClass(cf.activeClass).eq(0).addClass(cf.activeClass);

      // ��¼����
      prevIndex = tabCount -1;
      currentIndex = 0;

      // �����׸��ڵ㲢��ӽ�ȥ
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

    // �ӵ�һ���л������һ��(����)
    slideFromFirstToLast = function(callback){
      // ͳһ����ڵ�
      $tabs.removeClass(cf.activeClass).eq(tabCount-1).addClass(cf.activeClass);
      $panes.removeClass(cf.activeClass).eq(tabCount-1).addClass(cf.activeClass);

      // ��¼����
      prevIndex = 0;
      currentIndex = tabCount -1;

      // �������һ���ڵ㲢��ӽ�ȥ
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

    // ����Tabs�ϵ��¼�
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

    // �Զ��л�
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


    // ��һ��/��һ�� �л�����
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

    // ����API
    return {
      getTabs: function(){
        return $tabs;
      },
      getPanes: function(){
        return $panes;
      },
      teardown: null // ������
    };
  };

})(jQuery);
