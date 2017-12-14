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

<div class="con mb-7">
	<header class="user-header-box">
		<div class="padding-all">
			<a href="<?php echo url('profile/index');?>">
				<div class="user-header">
					<?php if($info['user_picture'] !=='' ) { ?>
					<div class="heaer-img"><img src="<?php echo ($info['user_picture']); ?>"></div>
					<?php } else { ?>
					<div class="heaer-img"><img src="<?php echo elixir('img/no_image.jpg');?>"></div>
					<?php } ?>
				</div>
			</a>
			<a href="<?php echo url('profile/index');?>" class="box-flex">
				<div class="header-admin">

					<h4 class="ellipsis-one f-06"><?php echo ($info['nick_name']); ?></h4>
					<p class="color-whie f-02 m-top02"><?php echo ($user_other_info['user_name']); ?></p>
				</div>
			</a>
			<div class="header-icon">
				<a class="youxiang" href="<?php echo url('index/messagelist');?>">
					<?php if($cache_info ) { ?>
					<div class="tishi-tag"></div>
					<?php } ?>
					<label class="f-02">消息</label>
				</a>

				<a class="shezhi" href="<?php echo url('profile/index');?>">
					<i class="iconfont icon-shezhi"></i>
				</a>
			</div>
		</div>
		</a>
	</header>
	<!--order-list-->
	<section class="b-color-f user-function-list">
		<a href="<?php echo url('order/index',array('status'=>0));?>">
			<div class="dis-box padding-all wallet-bt">
				<h3 class="box-flex"><i class="iconfont icon-iconfontquanbudingdan color-red"></i>我的订单</h3>
				<div class="box-flex f-03 text-right onelist-hidden jian-top">全部订单</div>
				<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
			</div>
		</a>
		<ul class="user-order-list g-s-i-title-2 dis-box text-center ">
			<a href="<?php echo url('user/order/index', array('status'=>1));?>" class="box-flex">

				<li>
					<h4><i class="iconfont icon-daifukuan"></i></h4>
					<p class="t-remark3">待付款</p>
					<?php if($pay_count > 0) { ?>
					<div class="user-list-num"><?php echo $pay_count; ?></div>
					<?php } ?>
				</li>
			</a>
			<?php if($team) { ?>
			<!-- <a href="<?php echo url('team/user/index');?>" class="box-flex">

				<li>
					<h4><i class="iconfont icon-wodetuandui"></i></h4>
					<p class="t-remark3">待拼团</p>
					<?php if($team_num > 0) { ?>
					<div class="user-list-num"><?php echo $team_num; ?></div>
					<?php } ?>
				</li>
			</a> -->
			<?php } ?>
			<a href="<?php echo url('user/order/index',array('status'=>2));?>" class="box-flex">
				<li>
					<h4><i class="iconfont icon-wodetubiaosvg03"></i></h4>
					<p class="t-remark3">待收货</p>
					<?php if($confirmed_count > 0) { ?>
					<div class="user-list-num"><?php echo $confirmed_count; ?></div>
					<?php } ?>
				</li>
			</a>
			<a href="<?php echo url('user/index/comment_list');?>" class="box-flex">
				<li>
					<h4><i class="iconfont icon-pinglun1" style="font-size:2.3rem;"></i></h4>
					<p class="t-remark3">待评价</p>
					<?php if($not_comment > 0) { ?>
					<div class="user-list-num"><?php echo $not_comment; ?></div>
					<?php } ?>
				</li>
			</a>
			<a href="<?php echo url('user/refound/index');?>" class="box-flex">
				<li>
					<h4><i class="iconfont icon-tuihuanhuo"></i></h4>
					<p class="t-remark3">退换货</p>
					<?php if($return_count > 0) { ?>
					<div class="user-list-num"><?php echo $return_count; ?></div>
					<?php } ?>
				</li>
			</a>
		</ul>
	</section>
	<!--money-list-->
	<section class="m-top08 user-function-list b-color-f">
		<a href="<?php echo url('user/account/index');?>">
			<div class="dis-box padding-all wallet-bt">
				<h3 class="box-flex"><i class="iconfont icon-qianbao  color-fe"></i>我的钱包</h3>
				<div class="box-flex f-03 text-right onelist-hidden jian-top">资金管理</div>
				<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
			</div>
		</a>
		<ul class="user-order-list  dis-box text-center">
			<a href="<?php echo url('user/account/index');?>" class="box-flex">
				<li>
					<h4 class="ellipsis-one"><?php echo ($user_pay['user_money']); ?></h4>
					<p class="t-remark3">现金积分</p>
				</li>
			</a>
			<a href="<?php echo url('user/account/index');?>" class="box-flex">

				<li>
					<h4 class="ellipsis-one"><?php echo ($user_pay['pay_points']); ?></h4>
					<p class="t-remark3">增值积分</p>
				</li>
			</a>
			<a href="javascript:;" class="box-flex">
				<li>
					<h4 class="ellipsis-one"><?php echo $today_money; ?></h4>
					<p class="t-remark3">今日收益</p>
				</li>
			</a>
			<a href="javascript:;" class="box-flex">
				<li>
					<?php if($couponses == '' ) { ?>
					<h4 class="ellipsis-one">0</h4> <?php } else { ?>
					<h4 class="ellipsis-one"><?php echo $leiji_money; ?></h4> <?php } ?>
					<p class="t-remark3">累计收益</p>
				</li>
			</a>
		</ul>
	</section>
	<section class="m-top06" style="display: none">
		<div class="index-banner swiper-container box mb-1 banner-second">
				<div class="swiper-wrapper">
				<?php echo insert_ads(array('id'=>267, 'num'=>6));?>
				</div>
				<!-- 分页器 -->
				<div class="swiper-pagination br-half text-c banner-second-pagination" style="bottom: 10px;"></div>
			</div>
	</section>
	<!--function-nav-list-->
	<nav class="b-color-f user-nav-box m-top08">
		<!-- <div class="box ul-4 text-c b-color-f">
			<a href="<?php echo url('user/index/collectionlist');?>">
				<label><i class="iconfont icon-zan-alt color-fe"></i></label>
				<p class="f-02 col-7">收藏的商品</p>
			</a>
			<a href="<?php echo url('user/index/storelist');?>" class="">
				<label><i class="iconfont icon-star-n color-f9c"></i></label>
				<p class="f-02 col-7">关注的店铺</p>
			</a>

			<?php if($share) { ?>
			<a href="<?php echo url('user/index/affiliate');?>">
				<label><i class="iconfont icon-fenxiang3 color-e72"></i></label>
				<p class="f-02 col-7">我的分享</p>
			</a>
			<?php } ?>
			<a href="<?php echo url('user/index/userhelp');?>">
				<label><i class="iconfont icon-3shouce color-f9c"></i></label>
				<p class="f-02 col-7">帮助中心</p>
			</a>
			<?php if($drp) { ?>
			<a href="<?php echo url('drp/index/index');?>">
				<label><i class="iconfont icon-dianpu color-red"></i></label>
				<p class="f-02 col-7">我的微店</p>
			</a>
			<?php } ?>
			<a href="<?php echo url('user/crowd/index');?>">
				<label><i class="iconfont icon-zichou color-ff7"></i></label>
				<p class="f-02 col-7">我的微筹</p>
			</a>
         
   			 <?php if($is_wechat == 1) { ?>
    		<a href="<?php echo url('user/profile/account_relation');?>">
				<label><i class="iconfont icon-fenxiang3 color-e72"></i></label>
				<p class="f-02 col-7">关联账号</p>
			</a>
   			<?php } ?>
			<?php if($team) { ?>
			<a href="<?php echo url('team/index/index');?>">
				<label><i class="iconfont icon-wodetuandui  color-f9c"></i></label>
				<p class="f-02 col-7">拼团频道</p>
			</a>
			<?php } ?>
			<a href="<?php echo url('merchants/index/index');?>">
				<label><i class="iconfont icon-shangjiaruzhu- color-98"></i></label>
				<p class="f-02 col-7">商家入驻</p>
			</a>
			<a href="<?php echo url('user/index/history');?>">
				<label><i class="iconfont icon-zuji color-c78"></i></label>
				<p class="f-02 col-7">浏览记录</p>
			</a>
            <a href="<?php echo url('user/profile/accountbind');?>">
				<label><i class="iconfont icon-3shouce color-f9c"></i></label>
				<p class="f-02 col-7">授权管理</p>
			</a>
		</div> -->

		<div class="box ul-4 text-c b-color-f">
			<?php if($user_other_info['is_shop']==1) { ?>
			<a href="<?php echo url('user/account/return_self');?>">
				<label><i class="iconfont icon-disanfang01 safe-icon color-ff7"></i></label>
				<p class="f-02 col-7">转为现金积分</p>
			</a>
			<?php } ?>
			<a href="<?php echo url('user/index/affiliate');?>">
				<label><i class="iconfont icon-fenxiang3 color-e72"></i></label>
				<p class="f-02 col-7">我的二维码</p>
			</a>
			<a href="<?php echo url('user/account/return_xianjin');?>">
				<label><i class="iconfont icon-zichou color-ff7"></i></label>
				<p class="f-02 col-7">现金积分互转</p>
			</a>
			<a href="<?php echo url('user/account/return_zengzhi');?>">
				<label><i class="iconfont icon-icon01 color-f9c"></i></label>
				<p class="f-02 col-7">增值积分互转</p>
			</a>
			<a href="<?php echo url('user/account/insert_card');?>">
				<label><i class="iconfont  icon-qudiandianpumingpianicon color-c78"></i></label>
				<p class="f-02 col-7">为自己入单</p>
			</a>
			<?php if($user_other_info['is_shop']==1) { ?>
			<a href="<?php echo url('user/account/insert_other_card');?>">
				<label><i class="iconfont icon-shangjiaruzhu- color-98"></i></label>
				<p class="f-02 col-7">为他人入单</p>
			</a>
			<?php } ?>
			<a href="<?php echo url('user/profile/accountsafe');?>">
				<label><i class="iconfont icon-zhaohuimima safe-icon color-e72"></i></label>
				<p class="f-02 col-7">账户安全</p>
			</a>
			<a href="<?php echo url('user/index/addresslist');?>">
				<label><i class="iconfont icon-zuji color-c78"></i></label>
				<p class="f-02 col-7">地址管理</p>
			</a>
			
			<a href="<?php echo url('user/account/deposit');?>">
				<label><i class="iconfont icon-zuji color-c78"></i></label>
				<p class="f-02 col-7">充值</p>
			</a>

			<!-- <a href="<?php echo url('user/account/coupont');?>">
				<label><i class="iconfont icon-dianpu color-red"></i></label>
				<p class="f-02 col-7">现金积分</p>
			</a>
			<a href="<?php echo url('user/account/coupont');?>">
				<label><i class="iconfont icon-dianpu color-red"></i></label>
				<p class="f-02 col-7">增值积分</p>
			</a> -->
			<?php if($user_other_info['is_shop']==1) { ?>
			<a href="<?php echo url('user/profile/realname');?>">
				<label><i class="iconfont icon-youxiangrenzheng safe-icon color-e72"></i></label>
				<p class="f-02 col-7">收款信息</p>
			</a>
			<?php } ?>
			<!-- <a href="<?php echo url('user/account/accountraply');?>">
				<label><i class="iconfont icon-dianpu color-red"></i></label>
				<p class="f-02 col-7">我要提现</p>
			</a> -->

			<a href="<?php echo url('user/account/my_share_list');?>">
				<label><i class="iconfont icon-wodetuandui  color-f9c"></i></label>
				<p class="f-02 col-7">推广会员</p>
			</a>
			
			<a href="<?php echo url('user/account/my_card_list');?>">
				<label><i class="iconfont icon-3shouce color-f9c"></i></label>
				<p class="f-02 col-7">我的卡包</p>
			</a>
			<?php if($user_other_info['is_shop']==1) { ?>
			<a href="<?php echo url('user/login/register',array('re_id'=>$user_id));?>">
				<label><i class="iconfont icon-shangjiaruzhu- color-98"></i></label>
				<p class="f-02 col-7">注册会员</p>
			</a>
			<a href="<?php echo url('user/account/todaysell');?>">
				<label><i class="iconfont icon-zichou color-ff7"></i></label>
				<p class="f-02 col-7">今日销售</p>
			</a>
			<?php } ?>

			<?php if($user_other_info['is_shop']==1) { ?>
			<!-- <a href="<?php echo url('user/account/shop_card_list');?>">
				<label><i class="iconfont icon-shangjiaruzhu- color-98"></i></label>
				<p class="f-02 col-7">店铺卡信息                                                                   </p>
			</a> -->
			<?php } ?>
			<a href="<?php echo url('user/login/logout');?>">
				<label><i class="iconfont icon-shoujiyanzheng1 safe-icon col-9"></i></label>
				<p class="f-02 col-7">退出登录</p>
			</a>
		</div>
	</nav>

</div>
<footer class="footer-nav dis-box">
	<a href="<?php echo url('/');?>" class="box-flex nav-list">
		<i class="nav-box i-home"></i><span>首页</span>
	</a>
	<a href="<?php echo url('category/index/index');?>" class="box-flex nav-list">
		<i class="nav-box i-cate"></i><span>分类</span>
	</a>
	<a href="<?php echo url('search/index/index');?>" class="box-flex nav-list">
		<i class="nav-box i-shop"></i><span>搜索</span>
	</a>
	<a href="<?php echo url('cart/index/index');?>" class="box-flex position-rel nav-list">
		<i class="nav-box i-flow"></i><span>购物车</span>
	</a>
	<?php if($filter) { ?>
	<a href="<?php echo url('drp/user/index');?>" class="box-flex nav-list active">
		<i class="nav-box i-user"></i><span><?php echo $custom; ?>中心</span>
	</a>
	<?php } elseif ($community) { ?>
	<a href="<?php echo url('community/index/index');?>" class="box-flex nav-list active">
		<i class="nav-box i-user"></i><span>社区</span>
	</a>
	<?php } else { ?>
	<a href="<?php echo url('user/index/index');?>" class="box-flex nav-list active">
		<i class="nav-box i-user"></i><span>我</span>
	</a>
	<?php } ?>
</footer>
<!--悬浮菜单e-->
		<script>
			/*店铺信息商品滚动*/
			var swiper = new Swiper('.j-g-s-p-con', {
				scrollbarHide: true,
				slidesPerView: 'auto',
				centeredSlides: false,
				grabCursor: true
			});
			var mySwiper = new Swiper('.banner-second', {
            autoplay: 5000,
            pagination: '.banner-second-pagination'
        });

       $(function(){
        //清除搜索记录
        var history = <?php if($history) { echo $history; } else { ?>""<?php } ?>;
        $(".clear_history").click(function(){
            if(history){
	            $.get("<?php echo url('user/index/clear_history');?>", '', function(data){
	        		if(data.status == 1){
			            $(".clearHistory").remove();
	                }
	            }, 'json');
            }
        });
    })
</script>
</body>

</html>