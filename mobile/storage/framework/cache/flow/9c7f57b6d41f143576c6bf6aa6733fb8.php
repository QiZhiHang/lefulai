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
        <div class="flow-done">
            <div class="flow-done-con">
                <?php if($order['pay_code'] == 'balance') { ?>
                <i class="iconfont icon-hookring2"></i>
                <p class="flow-done-title">余额支付成功</p>
                <?php } else { ?>
                <i class="iconfont icon-qian"></i>
                <p class="flow-done-title">付款金额</p>
                <?php if($child_order > 1) { ?>
                <p class="flow-done-price"><?php echo ($total['amount_formated']); ?></p>
                <?php } else { ?>
                <p class="flow-done-price"><?php echo ($order['order_amount']); ?></p>
                <?php } ?>
                <?php } ?>
            </div>
            <?php if($child_order > 1) { ?>
            <div class="flow-done-all">
                <?php $n=1;if(is_array($child_order_info)) foreach($child_order_info as $child) { ?>
                <div class="padding-all b-color-f flow-done-id">
                    <section class="dis-box">
                        <label class="t-remark g-t-temark">订单号：</label>
                        <span class="box-flex t-goods1 text-right"><?php echo ($child['order_sn']); ?></span>
                    </section>
                </div>
                <?php $n++;}unset($n); ?>
            </div>
            <?php } else { ?>
            <div class="flow-done-all">
            <div class="padding-all b-color-f flow-done-id">
                <section class="dis-box">
                    <label class="t-remark g-t-temark">订单号：</label>
                    <span class="box-flex t-goods1 text-right"><?php echo ($order['order_sn']); ?></span>
                </section>
                <?php if($store) { ?>
                <section class="dis-box">
                    <label class="t-remark g-t-temark">门店信息：</label>
                    <span class="box-flex t-goods1 text-right"><?php echo ($store['stores_name']); ?>[<?php echo ($store['province_name']); ?> <?php echo ($store['city_name']); ?> <?php echo ($store['district_name']); ?>] <?php echo ($store['stores_address']); ?></span>
                </section>
                <?php } ?>
            </div>
            </div>
            <?php } ?>
            <div class="padding-all ect-button-more dis-box flow_done_btn">
                <!-- <?php if($pay_online && $order['pay_code'] != 'balance') { ?> -->
                <!-- 如果是线上支付则显示支付按钮 -->
                <?php echo $pay_online; ?>
                <!-- <?php } ?> -->
            </div>
            <div class="flow-done-other dis-box">
               <a href="<?php echo url('user/order/detail', array('order_id'=>$order['order_id']));?>" class="flow-done-btn btn-default-new min-two-btn br-5">查看订单</a>
            </div>
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
</body>
</html>