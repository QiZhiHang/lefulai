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
                         <form action="<?php echo url('user/account/account');?>" method="post">
			<div class="user-recharge b-color-f">
				<section class="m-top1px margin-lr">
					<div class="text-all dis-box j-text-all">
						<label class="t-remark">充值金额</label>
						<div class="box-flex input-text">
                                                    <input class="j-input-text" type="text" placeholder="" name="amount">
					</div>
					</div>
				</section>
				<section class="m-top1px padding-tb margin-lr" style="padding-bottom:0;">
					<div class="f-c-select-msg">
						<label class="t-remark">会员备注<span class="t-remark">（50字）</span></label>
						<div class="text-area1 m-top04">
                                                    <textarea class="text-area1" name="user_note" maxlength="50" placeholder="转账时请备注上自己的账号和姓名！"></textarea>
							<span>50</span>
						</div>
					</div>
				</section>
				<section class="padding-lr j-show-div j-show-get-val">
					<div class="text-all dis-box ">
						<label class="t-remark">充值方式</label>
						<div class="box-flex t-goods1 text-right onelist-hidden"><span> </span> <em class="t-first"></em></div>
                                           
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
					</div>
					<!--充值方式弹出层-->
					<div class="show-time-con ts-3 b-color-1 j-filter-show-div">
									<section class="goods-show-title of-hidden padding-all b-color-f">
										<h3 class="fl g-c-title-h3">充值方式</h3>
										<i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
									</section>
									<section class="s-g-list-con swiper-scroll">
										<div class="swiper-wrapper">
											<div class="swiper-slide select-two">
												<ul class="j-get-one padding-all">
                                                                                                    <?php $n=1;if(is_array($payment)) foreach($payment as $list) { ?>
													<li class="ect-select">
														<label class="ts-1" onclick="show(<?php echo ($list['pay_id']); ?>)"  ><dd><span><?php echo ($list['pay_name']); ?> 手续费：</span> <em class="t-first"><?php echo ($list['pay_fee']); ?></em></dd><i class="fr iconfont icon-gou ts-1"></i></label>
													</li>
                                                                                                        <?php $n++;}unset($n); ?>
													
												</ul>
											</div>
											<div class="swiper-scrollbar"></div>
										</div>
									</section>
								</div>
				</section>
                           
			</div>
			<div class="padding-all">
                            <button type="submit" class="btn-submit br-5 min-btn" name="submit" value="sub">提交申请</button>
			</div>
                 
                             <!--提现layer-->
                             <div class="mask-filter-div"></div>
                             <div class="two-btn ect-padding-tb ect-padding-lr ect-margin-tb text-center">
                                 <input type="hidden" name="surplus_type" value="0" />
                                 <input type="hidden" name="payment_id" value="0" />
                                 <input type="hidden" name="pay_code" value="0" />
                                 <input type="hidden" name="pay_name" value="0" />
                                 <input type="hidden" name="pay_fee" value="0" />
                                 <input type="hidden" name="rec_id" value="0" />

                             </div>
          </form>
		</div>
		<!--引用js-->
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
 
                <li>
                    <a href="<?php echo url('user/account/index');?>">
                         <i class="iconfont icon-money"></i>
                         <p>资金管理</p>
                    </a> 
                </li>                
                </ul>
        </div>
    </nav>
    <div class="common-show"></div> 

		<script type="text/javascript">
			function show(pid){
                           $("input[name=payment_id]").val(pid);
                        }
		</script>
	</body>

</html>