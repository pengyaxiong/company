@extends('layouts.home.partials.base')
@section('css')
    <style>
        .banner1 {
            background: url("../home/images/sy_b_2019yxj.jpg") no-repeat center center;
        }
        .banner2 {
            background: url("../home/images/sy_b_mb.jpg") no-repeat center center;
        }
        .banner3 {
            background: url("../home/images/sy_feedbacks.jpg") no-repeat center center;
        }
        .banner4 {
            background: url("../home/images/sy_b3.jpg") no-repeat center center;
        }
        .feat_main .item_US_A_pic {
            display: block;
            width: 182px;
            height: 182px;
            background: url("../home/images/thumbnails_teen_EU_A.jpg") no-repeat;
            margin: 0 92px;
        }
        .sy_wrap h3 {
            font-size: 30px;
            text-align: center;
            height: 35px;
            text-indent: initial;
            margin: 0 auto;
        }
    </style>
@endsection
@section('content')
    <div class="banner sy_banner">
        <ul class="banner_pic">
            <li class="banner1">
                <a href="2019youxuejie.html" target="_blank">
                    <div class="ban1_txt">
                        <p>三一全球游学节</p>
                    </div>
                </a>
            </li>
            <li class="banner2">
                <a href="membership.html"target="_blank">
                    <div class="ban2_txt">
                        <p>领取各类会员专享福利</p>
                    </div>
                </a>
            </li>
            <li class="banner3">
                <a href="feedbacks.html" target="_blank">
                    <div class="ban3_txt">
                        <p>过往用户反馈</p>
                    </div>
                </a>
            </li>
            <li class="banner4">
                <a href="about.htm" target="_blank">
                    <div class="ban4_txt">
                        <p>三一游学互联网平台新模式</p>
                    </div>
                </a>
            </li>
        </ul>
        <ul class="banner_btn">
            <li class="btn1 btn_select"><a href="javascript:void(0)" target="_blank">三一游学节</a></li>
            <li class="btn2"><a href="javascript:void(0)" target="_blank">会员专享福利</a></li>
            <li class="btn3"><a href="javascript:void(0)" target="_blank">过往用户反馈</a></li>
            <li class="btn4"><a href="javascript:void(0)" target="_blank">游学新模式</a></li>
        </ul>
    </div>
    <div class="sy_wrap">
        <!-- 美国游学主推项目 -->
        <div class="ft_items">
            <div class="feat_main clearfix">
                <h3 class="">美国游学|美国夏令营|美国夏校</h3>
                <div class="item item_US_A_1">
                    <a class="item_US_A_pic" href="act_367.htm" target="_blank">
                        <img class="per_hover" src="/home/images/per_circle.png">
                    </a>
                    <h4><a href="act_367.htm" target="_blank">耶鲁大学 Yale University<br/>学术夏校10-12年级</a></h4>
                    <p><a href="act_367.htm" target="_blank">
                            耶鲁大学是美国名校联盟“常青藤（Ivy League）”的成员，也是美国历史上建立的第三所大学。耶鲁大学共走出了包括比尔·克林顿、乔治·布什在内的5位美国总统、19位美国最高法院大法官、16位亿万富翁。截至2017年，耶鲁大学的教授和校友获得了58个诺贝尔奖和5个菲尔兹奖。
                        </a></p>
                </div>
                <div class="item item_US_A_11">
                    <a class="item_US_A_pic" href="act_336.htm" target="_blank">
                        <img class="per_hover" src="/home/images/per_circle.png" >
                    </a>
                    <h4><a href="act_336.htm" target="_blank">美国名校安多佛菲利普斯中学夏校<br/>Phillips Academy Andover</a></h4>
                    <p><a href="act_336.htm" target="_blank">
                            菲利普斯安多佛中学创立于1778年，是美国最古老的中学之一，也是美国十大小常春藤联盟之一。其学生学业成绩非常优秀，平均SAT成绩高达2076分（满分2400分），进入美国常春藤、斯坦福等世界名校的学生的比例达到30%以上，被Best Colleges被评为美国排名前3的大学预科中学。美国两位前总统大小布什均从该校毕业。
                        </a></p>
                </div>
                <div class="item item_US_B_1">
                    <a class="item_US_B_pic" href="act_71.htm" target="_blank">
                        <img class="per_hover" src="/home/images/per_circle.png">
                    </a>
                    <h4><a href="act_71.htm" target="_blank">加州大学洛杉矶分校 UCLA<br/>语言+文化+大学生活体验营</a></h4>
                    <p><a href="act_71.htm" target="_blank">
                            加州大学洛杉矶分校 (UCLA)成立于1919年，是美国一流的综合大学，近年来更是在美国公立大学排名中高居第1名，常年稳坐泰晤士报全球大学排行榜前15名，并且在2016年US News全球大学排名中位列全球第8。作为美国申请人数最多的大学，是全美高中生梦寐以求的名校之一。
                        </a></p>
                    <a href="teenUS.html" class="index_clickmore" target="_blank"><font size="3">更多美国游学项目</font></a>
                </div>
            </div>
        </div>

        <!-- 最新活动 -->
        <div class="up_events">
            <h2 class="sprite sprite-sy_title2">最新活动</h2>
            <div class="ue_set clearfix"><div class='ue_news'><a href="act_535.htm" tppabs="http://www.sanyi.org/act_535.htm"><img width='480' height='189' src="img/section/20170724/1500863019701114293.jpg" tppabs="http://www.sanyi.org/img/section/20170724/1500863019701114293.jpg" alt=''/><span class='ue_title'>三一游学2018年小小写手全国有奖征文比赛全面启动！</span><p>“用笔尖勾勒足迹，用文字描述青春”暑期有奖征文活动全面启动，一等奖得主将获得英国百年名校招生官推荐信！顶级招生官推荐信+万元豪礼，等你来“写”！</p><br/><span class='ue_news_click'>点击查看</span></a></div><div class='ue_news'><a href="act_185.htm" tppabs="http://www.sanyi.org/act_185.htm"><img width='480' height='189' src="img/section/20180706/1530876683295888260.jpeg" tppabs="http://www.sanyi.org/img/section/20180706/1530876683295888260.jpeg" alt='getonline'/><span class='ue_title'>送福利啦！三一游学平台隆重上线！</span><p>跳过中介、直连名校，三一游学平台隆重上线！上百个各国夏校，价格完全透明，0服务费！</p><br/><span class='ue_news_click'>点击查看</span></a></div></div>
        </div>
        <div class="lt_news clearfix">
            <h2 class="sprite sprite-sy_title3">最新新闻</h2>
            <div class="lt_silde">
                <ul><li class='lt_set clearfix'><a href="news_12.htm" tppabs="http://www.sanyi.org/news_12.htm"><img width='257' height='185' src="img/section/20170304/1488584463465899148.png" tppabs="http://www.sanyi.org/img/section/20170304/1488584463465899148.png" alt='三一游学创始人Tiger Liu 刘太戈'/><div class='lt_txt'><h4>Tiger Liu——三一游学创始人帝国理工优秀毕业生专访</h4><p>在世界排名第二的伦敦帝国理工精英教育的熏陶下，Tiger Liu (刘太戈)逐渐认识到教育的精髓。回国后，他创办了 TripleE Group(三一游学互联网游学平台)。</p><div class='lt_click'>点击查看</div></div></a></li><li class='lt_set clearfix'><a href="news_200.htm" tppabs="http://www.sanyi.org/news_200.htm"><img width='257' height='185' src="img/section/20170401/1491039536223519201.jpg" tppabs="http://www.sanyi.org/img/section/20170401/1491039536223519201.jpg" alt=''/><div class='lt_txt'><h4>【三一游学科普】未成年人独自乘坐飞机完整攻略</h4><p>未成年人独自乘搭飞机参加海外国际游学夏令营，是英、美、加、澳、欧洲等发达国家和地区的青少年参加海外游学最主流、最成熟的方式。大型航空公司均提供“无人陪伴儿童”这一温馨服务，并已发展出完善的服务制度和标准流程。</p><div class='lt_click'>点击查看</div></div></a></li><li class='lt_set clearfix'><a href="news_130.htm" tppabs="http://www.sanyi.org/news_130.htm"><img width='257' height='185' src="img/section/20160516/1463371930109140161.jpeg" tppabs="http://www.sanyi.org/img/section/20160516/1463371930109140161.jpeg" alt='美国海关与边境保护局'/><div class='lt_txt'><h4>“未成年人不允许单独出入境美国”？三一游学来辟谣！</h4><p>近日，一则有关“美国2016年新政：未成年人不得单独入境美国”的一则假新闻刷爆朋友圈。家长们纷纷担忧是否忙活了一个多月准备申请报名的夏令营就此泡汤了？三一游学直接联系了美国海关与边境保护局(CBP)，并得到了美国官方回复：未成年人可单独入境美国，但须携带不随行父母同意函！</p><div class='lt_click'>点击查看</div></div></a></li><li class='lt_set clearfix'><a href="news_177.htm" tppabs="http://www.sanyi.org/news_177.htm"><img width='257' height='185' src="img/section/20170304/1488584229716975393.png" tppabs="http://www.sanyi.org/img/section/20170304/1488584229716975393.png" alt='惠灵顿公学'/><div class='lt_txt'><h4>世界顶级名校英国惠灵顿公学(Wellington College)入驻杭州萧山</h4><p>作为杭州推进教育国际化的重要举措之一，举世闻名的英国惠灵顿公学（Wellington College），1月11日上午正式签约，将入驻杭州创办杭州惠灵顿双语学校（暂用名）。</p><div class='lt_click'>点击查看</div></div></a></li><li class='lt_set clearfix'><a href="news_127.htm" tppabs="http://www.sanyi.org/news_127.htm"><img width='257' height='185' src="img/section/20160427/1461725395971510267.jpg" tppabs="http://www.sanyi.org/img/section/20160427/1461725395971510267.jpg" alt='英国游学同学合照'/><div class='lt_txt'><h4>家长必读！16岁中国女孩Evelyn Chen独自英国游学游记</h4><p>没有了中国领队老师的全程呵护，没有了中国同学自如的母语交流，我被迫学会独立生活，适应纯英文的环境，了解并尊重各国的习惯和礼节，短短2周，我获得了受益一生的能力。</p><div class='lt_click'>点击查看</div></div></a></li><li class='lt_set clearfix'><a href="news_14.htm" tppabs="http://www.sanyi.org/news_14.htm"><img width='257' height='185' src="img/section/20150319/1426745744380438091.jpg" tppabs="http://www.sanyi.org/img/section/20150319/1426745744380438091.jpg" alt='探访福田老人日照中心志愿者的合照'/><div class='lt_txt'><h4>“游走世界志愿行”第二站——老人日照中心</h4><p>老人的笑脸是夕阳下壮美的景色，孩子的笑脸是朝阳中希望的种子。清早的阳光还在沉睡，福田区日照老人中心的院落中， 伴随着孩子们自信满满的自我介绍，老人们的脸上已经浮现了阳光一样温暖的笑容...</p><div class='lt_click'>点击查看</div></div></a></li><li class='lt_set clearfix'><a href="news_4.htm" tppabs="http://www.sanyi.org/news_4.htm"><img width='257' height='185' src="img/section/20150319/1426747205947400953.jpg" tppabs="http://www.sanyi.org/img/section/20150319/1426747205947400953.jpg" alt='三一义工团招募启事'/><div class='lt_txt'><h4>三一游学“游走世界志愿行”团体志愿者招募启事</h4><p>自从三一游学推出“游走世界志愿行”系列志愿活动以来，受到了深圳孩子和家长的热切关注和积极参与。针对大家希望长期做志愿活动的需求，我们决定与深圳市南山义工联合作，以团体形式注册为深圳三一义工团...</p><div class='lt_click'>点击查看</div></div></a></li></ul>
                <a href="javascript:void(0)" class="lt_prev sprite sprite-sl"></a>
                <a href="javascript:void(0)" class="lt_next sprite sprite-sr"></a>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        _fn.slide();
        _fn.slide3();
    </script>
@endsection