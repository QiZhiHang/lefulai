<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="description" content="<?php echo $description; ?>"/>
    <meta name="keywords" content="<?php echo $keywords; ?>"/>
    <title><?php echo $page_title; ?></title>
    <?php echo global_assets('css');?>
    <script type="text/javascript">var ROOT_URL = '/mobile/';</script>
    <?php echo global_assets('js');?>
    <?php if($is_wechat) { ?>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script type="text/javascript">
        // 分享内容
        var shareContent = {
            title: '<?php echo ($share_data['title']); ?>',
            desc: '<?php echo ($share_data['desc']); ?>',
            link: '<?php echo ($share_data['link']); ?>',
            imgUrl: '<?php echo ($share_data['img']); ?>',
            success: function (res) {
                // 用户确认分享后执行的回调函数
                // res {"checkResult":{"onMenuShareTimeline":true},"errMsg":"onMenuShareTimeline:ok"}
                console.log(JSON.stringify(res));
                var msg = res.errMsg;
                var jsApiname = msg.replace(':ok','');
                shareCount(jsApiname,'<?php echo ($share_data['link']); ?>');
            }
        };

        // 分享统计
        function shareCount(jsApiname = '', link = ''){
            $.post('<?php echo url("wechat/jssdk/count");?>', {jsApiname: jsApiname, link:link}, function (res) {
                if(res.status == 200){
                    //
                }
            }, 'json');
        }

        $(function(){
            var url = window.location.href;
            var jsConfig = {
                debug: false,
                jsApiList: [
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'onMenuShareQQ',
                    'onMenuShareQZone'
                ]
            };
            $.post('<?php echo url("wechat/jssdk/index");?>', {url: url}, function (res) {
                if(res.status == 200){
                    jsConfig.appId = res.data.appId;
                    jsConfig.timestamp = res.data.timestamp;
                    jsConfig.nonceStr = res.data.nonceStr;
                    jsConfig.signature = res.data.signature;
                    // 配置注入
                    wx.config(jsConfig);
                    // 事件注入
                    wx.ready(function () {
                        wx.onMenuShareTimeline(shareContent);
                        wx.onMenuShareAppMessage(shareContent);
                        wx.onMenuShareQQ(shareContent);
                        wx.onMenuShareWeibo(shareContent);
                        wx.onMenuShareQZone(shareContent);
                    });
                }
            }, 'json');
        })
    </script>
    <?php } ?>
</head>
<body>
<p style="text-align:right; display:none;"><?php echo config('shop.stats_code');?></p>
<div id="loading"><img src="<?php echo elixir('img/loading.gif');?>" /></div>

		<section class="purse-header-box text-center purse-f">
			<p>可用现金积分</p>
			<h2><?php echo $surplus_amount; ?></h2>
			<h5>增值积分：<?php echo $pay_points; ?>&nbsp;累计奖励：<?php echo $leiji_money; ?></h5>
		 	<img src="<?php echo elixir('img/pur-bg.png');?>">
			<div class="user-pur-box">
				<?php if($leiji_info['is_shop']==1) { ?>
				<div class="user-nav-1-box g-s-i-title-2 dis-box text-center">
					<a href="<?php echo url('user/account/deposit');?>" class="box-flex">
						<h4 class="ellipsis-one purse-f"><i class="iconfont icon-money is-money-color"></i>充值</h4>
					</a>
					<a href="<?php echo url('user/account/accountraply');?>" class="box-flex">
						<h4 class="ellipsis-one purse-f"><i class="iconfont icon-wodetixian is-money-color"></i>提现</h4>
					</a>
				</div>
				<?php } ?>
			</div>
		</section>
		<section class="b-color-f my-nav-box m-top10">
			<!-- <div class="user-money-list g-s-i-title-1 dis-box my-dingdan purse-f">
				<a href="<?php echo url('user/account/bonus');?>" class="box-flex text-center">
					<p class="t-remark3">红包</p>
					<h4 class="ellipsis-one"><?php echo $record_count; ?></h4>
					<div class="purse-ts-box" style="display:none"></div>
				</a>
                               <?php if(config('shop.use_value_card')) { ?>
                                <a href="<?php echo url('user/account/value_card');?>" class="box-flex text-center">
					<p class="t-remark3">储值卡 </p>
					<h4 class="ellipsis-one"><?php echo ($value_card['num']); ?></h4>
					<div class="purse-ts-box" style="display:none"></div>
				</a>
                               <?php } ?>
				<a href="#" class="box-flex text-center">
					<p class="t-remark3">当前积分</p>
					<h4 class="ellipsis-one"><?php echo $pay_points; ?></h4>
					<div class="purse-ts-box" style="display:none"></div>
				</a>
			</div> -->
		</section>
		<section class="b-color-f my-nav-box m-top10">
			<a href="<?php echo url('user/account/detail');?>">
				<div class="dis-box padding-all my-bottom">
					<h3 class="box-flex text-all-span my-u-title-size">账户明细</h3>
					<div class="f-04"><span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span></div>
				</div>
			</a>
			<a href="<?php echo url('user/account/log');?>">
				<div class="dis-box padding-all my-bottom">
					<h3 class="box-flex text-all-span my-u-title-size">充值提现记录</h3>
					<div class="f-04"><span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span></div>
				</div>
			</a>
			<a href="<?php echo url('user/account/detail_xianjin');?>">
				<div class="dis-box padding-all my-bottom">
					<h3 class="box-flex text-all-span my-u-title-size">现金积分明细</h3>
					<div class="f-04"><span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span></div>
				</div>
			</a>
			<a href="<?php echo url('user/account/detail_zengzhi');?>">
				<div class="dis-box padding-all my-bottom">
					<h3 class="box-flex text-all-span my-u-title-size">增值积分明细</h3>
					<div class="f-04"><span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span></div>
				</div>
			</a>
		</section>

    <!--快捷导航-->
    <script>
    $(function(){
       // 获取节点
          var block = document.getElementById("ectouch-top");
          var oW,oH;
          // 绑定touchstart事件
          block.addEventListener("touchstart", function(e) {
           var touches = e.touches[0];
           //oW = touches.clientX - block.offsetLeft;
           oH = touches.clientY - block.offsetTop;
           //阻止页面的滑动默认事件
           document.addEventListener("touchmove",defaultEvent,false);
          },false)
         
          block.addEventListener("touchmove", function(e) {
           var touches = e.touches[0];
           //var oLeft = touches.clientX - oW;
           var oTop = touches.clientY - oH;
          //  if(oLeft < 0) {
          //   oLeft = 0;
          //  }else if(oLeft > document.documentElement.clientWidth - block.offsetWidth) {
          //   oLeft = (document.documentElement.clientWidth - block.offsetWidth);
          //  }
          // block.style.left = oLeft + "px";
           block.style.top = oTop + "px";
          var max_top = block.style.top =oTop;
          if(max_top < 30){
             block.style.top = 30 + "px";
          }
          if(max_top > 440){
            block.style.top = 440 + "px";
          }
          },false);
           
          block.addEventListener("touchend",function() {
           document.removeEventListener("touchmove",defaultEvent,false);
          },false);
          function defaultEvent(e) {
           e.preventDefault();
          }
    })
</script>
<nav class="commom-nav dis-box ts-5" id="ectouch-top">
        <div class="left-icon">
            <div class="nav-icon"><i class="iconfont icon-jiantou1"></i>快速导航</div>
            <div class="filter-top filter-top-index" id="scrollUp">
                <i class="iconfont icon-jiantou"></i>
                <span>顶部</span>
            </div>
        </div>
        <div class="right-cont box-flex">
            <ul class="nav-cont">
                <li>
                      <a href="<?php echo url('/');?>">
                        <i class="iconfont icon-home"></i>
                        <p>首页</p>
                      </a>  
                </li>
                <li>
                    <a href="<?php echo url('search/index/index');?>">
                         <i class="iconfont icon-sousuo"></i>
                         <p>搜索</p>
                    </a>  
                </li>
                <li>
                     <a href="<?php echo url('category/index/index');?>">
                         <i class="iconfont icon-caidan"></i>
                         <p>分类</p>
                     </a> 
                </li>
                <li>
                     <a href="<?php echo url('cart/index/index');?>">
                         <i class="iconfont icon-gouwuche"></i>
                         <p>购物车</p>
                      </a> 
                </li>
                <li>
                    <a href="<?php echo url('user/index/index');?>">
                         <i class="iconfont icon-geren"></i>
                         <p>个人中心</p>
                    </a> 
                </li>
               
                </ul>
        </div>
    </nav>
    <div class="common-show"></div> 

	</body>

</html>