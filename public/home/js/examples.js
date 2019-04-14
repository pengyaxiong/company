$(document).ready(function() {
    var textarea = $('.u-textarea');
    $('#fullpage').fullpage({
        anchors: ['firstPage', 'secondPage', '3rdPage','4Page','5Page','6Page'],
        sectionsColor: ['#fff', '#fff', '#fff','#fff','#fff','#fff','#fff','#333333'],
        navigation: true,
        scrollOverflow:true,
        navigationTooltips: ['首页','什么是游学', '为什么出国游学','如何选择游学项目', '如何选择可靠的游学机构','为什么要选择我们','我们的优势'],
        afterRender:function(){
            $('.triple h3').addClass('fadeInUp');
            setTimeout(function(){
                $('.sprite-ban_nav_bg').addClass('flipInX');
            },1000);
        },
        onLeave:function(index,nextIndex ,direction ){
            if(nextIndex!=1){
                $('.header').hide();
                $('.nav').addClass("fixed");
                $('.nav').css('margin-top','0');
            }else{
                $('.header').show();
                $('.nav').removeClass("fixed");
                $('.nav').css('margin-top','115px');
            }
            // console.log(nextIndex)
        },
        afterLoad: function(anchorLink,index){
            textarea.removeClass('scaleInX');
            $("#section6 li").removeClass('bounceIn');
            $('.u-reason').removeClass('zoomIn');
            $(".turnInDown").removeClass('turnInDown');
            $('.sprite-ban_nav_bg').removeClass('flipInX');
            $('.fadeInUp').removeClass('fadeInUp');
            $('.fadeInLeft').removeClass('fadeInLeft');
            $('.fadeInRight').removeClass('fadeInRight');
            $('.section_m').hide();

            if(index==1){
                $('.triple h3').addClass('fadeInUp');
                setTimeout(function(){
                    $('.sprite-ban_nav_bg').addClass('flipInX');
                },500);
            }
            if(index==2){
                $('#section1').find(textarea).addClass('scaleInX');
                setTimeout(function(){
                    $('.what h3').addClass('fadeInUp');
                },800);
                setTimeout(function(){
                    $('.what p').addClass('fadeInUp');
                    $('http://www.sanyi.org/js/.u-textarea .more').addClass('fadeInUp');
                },1000);

            }
            if(index==3){
                $('#section2').find(textarea).addClass('scaleInX');
                setTimeout(function(){
                    $('.why h3').addClass('fadeInUp');
                },800);
                setTimeout(function(){
                    $('.why p').addClass('fadeInUp');
                },1000)
            }
            if(index==4){
                $('#section3 .section_m').fadeIn();
                setTimeout(function(){
                    $('.howTo h3').addClass('fadeInUp');
                },600);
                setTimeout(function(){
                    $('.howTo .list_nav').addClass('fadeInUp');
                },500);
                setTimeout(function(){
                   $(".howTo li").each(function (index){
                        (function (_this, _time){
                            setTimeout(function (){
                                _this.addClass('turnInDown');
                            }, _time);
                        })($(this), 100*index);
                    });
               },1000)


            }
            if(index==5){
                $('.how h3').addClass('fadeInUp');

                setTimeout(function(){
                    $('.how .list_nav').addClass('fadeInUp');
                },600);
                setTimeout(function(){
                    $(".how li").each(function (index){
                    (function (_this, _time){
                        setTimeout(function (){
                            _this.addClass('turnInDown');
                        }, _time);
                    })($(this), 100*index);
                });
                },600);

                var pageH = $("#fullpage").innerHeight();

                if(pageH < 800){
                    console.dir("aaa");
                    setTimeout(function (){
                        console.dir("演示~~~~~");
                        $(".fp-section").eq(4).css("overflow", "auto");
                        $(".fp-section").eq(4).find(".fp-tableCell").height(800);
                    }, 800);
                }
            }
            if(index==6){
                $('#section5 h3').addClass('fadeInUp');


                setTimeout(function(){
                    $('.u-reason li:lt(3)').addClass('fadeInLeft');
                    $('.u-reason li:gt(2)').addClass('fadeInRight');
                },500)

            }
            if(index==7){
                $('#section6 h3').addClass('fadeInUp');

                setTimeout(function(){
                    $("#section6 li").each(function (index){
                        (function (_this, _time){
                            setTimeout(function (){
                                _this.addClass('bounceIn');
                            }, _time);
                        })($(this), 250*index);
                    });
                },500)

            }
        }
    });


});