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

<div class="con">
	<div class="affiliate-cont-box">
		<!--分享二维码-->
	    <header class="p-r">
		    <div><img src="/mobile/public/img/affiliate.jpg" class="img"></div>
			<div class="share-ewm-box">
				<img src="<?php echo $ewm; ?>">
				<p class="text-c">长按二维码发送给朋友</p>
			</div>
		</header>
		<!--分成说明-->
		<?php if($share['on'] == 1) { ?>
		<?php if($goodsid == 0) { ?>
		<section class="affiliate-cont padding-all">
		  <div class="b-color-f padding-all br-5">
			   <h4 class="f-06 m-top04">推荐分享说明</h4>
			   <ul class="m-top06">
			   		<li>1、将上面二维码进行分享（微信好友、社群等）</li>
			   		<li>2、访问者长按二维码识别注册本站会员</li>
			   		<li>3、访问者在本站<?php echo $expire; echo $expire_unit; ?>注册，即认定该用户是您推荐的，您做为推荐者将获得奖励。</li>
			   		<li>4、该用户今后在本站的一切消费，您均能获得一定比例的提成。目前实行的提成总额为订单金额的相应比例的增值积分分配给您、推荐您的人等，具体分配规则请参阅 我推荐的会员。</li>
			   </ul>
		   </div>
		</section>
		<?php } ?>
		<?php } ?>

		<?php if($share['on'] == 1) { ?>
		<?php if($goodsid == 0) { ?>
		<?php if($share['config']['separate_by'] == 0) { ?>
		<!-- 下线人数、分成 -->
		<!-- <section class="affiliate-cont padding-all">
		  <div class="b-color-f padding-all br-5">
		  	<h4 class="f-06 m-top04 text-c"><?php echo ($lang['affiliate_member']); ?></h4>
			<table class="share-table-box ">
				<tr class="share-top">
					<th><?php echo ($lang['affiliate_lever']); ?></th>
					<th><?php echo ($lang['affiliate_num']); ?></th>
					<th><?php echo ($lang['level_point']); ?></th>
					<th><?php echo ($lang['level_money']); ?></th>
				</tr>
				<?php $n=1; if(is_array($affdb)) foreach($affdb as $key => $list) { ?>
				<tr>
					<td><?php echo $key; ?></td>
					<td><?php echo ($list['num']); ?></td>
					<td><?php echo ($list['point']); ?></td>
					<td><?php echo ($list['money']); ?></td>
				</tr>
				<?php $n++;}unset($n); ?>
			</table>
			</div>
		</section> -->
		<!-- 下线人数、分成 -->
		<?php } ?>
		<!-- 我的推荐清单 -->
		<!-- <section class="affiliate-cont padding-all">
			<div class="b-color-f padding-all br-5">
			<h4 class="f-06 m-top04 text-c">分成明细</h4>
			<div class="affiliate-ajax">
			<script id="j-product" type="text/html">
				<%if totalPage > 0%>
					<%each logdb as val%>
						<table class="rule-table-box ">
							<tr class="share-top">
								<th colspan="4"><?php echo ($lang['order_number']); ?>：<%val.order_sn%></th>
							</tr>
							<tr class="rule-title">
								<td><?php echo ($lang['affiliate_money']); ?></td>
								<td><?php echo ($lang['affiliate_point']); ?></td>
								<td><?php echo ($lang['affiliate_mode']); ?></td>
								<td><?php echo ($lang['affiliate_status']); ?></td>
							</tr>
							<tr>
								<td><%#val.money%></td>
								<td><%val.point%></td>
								<td><%if val.separate_type == 1 || val.separate_type == 0%>推荐注册分成<%else%>订单分成<%/if%></td>
								<td><%if val.is_separate == 1%>已分成<%else%>等待处理<%/if%></td>
							</tr>
						</table>
					<%/each%>
				<%else%>
					<div class="no-div-message">
                    <i class="iconfont icon-biaoqingleiben"></i>
                    <p>亲，此处没有内容～！</p>
                	</div>
				<%/if%>
			</script>
			</div>
			</div>
		</section> -->
		<?php } ?>
		<?php } ?>
	</div>
</div>

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
<script>
$(function () {
	var url = "<?php echo url('affiliate');?>";
	//订单列表
	$('.affiliate-ajax').infinite({url: url, template: 'j-product'});
});
</script>

</body>
</html>