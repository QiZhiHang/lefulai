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
    <?php if($type) { ?>
            <section class=" j-f-tel padding-lr b-color-f mb-1">
                <div class="text-all dis-box j-text-all b-color-f card-div">
                    <div>
                        <p>账户充值</p>
                        <span></span>
                    </div>
                    <div class="box-flex input-text text-right">
                        <p><?php echo $amount; ?></p>
                        <span class="color-red"></span>
                    </div>
                </div>
            </section>

            <section class=" j-f-tel padding-lr b-color-f">
                <div class="text-all dis-box j-text-all b-color-f card-div">
                    <div>
                        <p>支付方式<span><?php echo ($payment['payment']); ?>&nbsp;手续费：[<?php echo $pay_fee; ?>]</span></p>

                    </div>
                </div>
                <div class="text-all dis-box j-text-all b-color-f card-div">
                    <div>
                        <p>支付方式描述</p>
                        <span><?php echo ($payment['pay_desc']); ?></span>
                    </div>
                </div>
            </section>
            <div class="margin-lr">
                <div class="ect-button-more dis-box m-top12">
                    <!-- <a class="btn-reset box-flex" href="javascript:history.go(-1)">取消</a> -->
                    <a class="btn-reset box-flex" href="<?php echo url('user/account/log');?>">支付完成</a>
                </div>
            </div>
    <?php } else { ?>
                      <?php $n=1;if(is_array($account_log)) foreach($account_log as $item) { ?>
			<form action="">
				<section class=" j-f-tel padding-lr b-color-f mb-1">
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<p><?php echo ($item['type']); ?></p>
							<span><?php echo ($item['add_time']); ?></span>
						</div>
						<div class="box-flex input-text text-right">
							<p><?php echo ($item['amount']); ?></p>
							<span class="color-red"><?php echo ($item['pay_status']); ?></span>
						</div>
					</div>
				</section>

				<section class=" j-f-tel padding-lr b-color-f">
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<p><?php if($item['type']=='提现') { ?>银行卡<?php } else { ?>支付方式<?php } ?><span><?php echo ($item['payment']); ?>&nbsp;手续费：[<?php echo ($item['pay_fee']); ?>]</span></p>
							<span><?php echo ($item['bank_number']); ?></span>

						</div>
					</div>
                    <?php if($item['pay_desc']) { ?>
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<p>支付方式描述</p>
							<span><?php echo ($item['pay_desc']); ?></span>
						</div>
					</div>
                    <?php } ?>
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<p>会员备注</p>
							<span><?php echo ($item['user_note']); ?></span>
						</div>
					</div>
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<p>管理员备注</p>
							<span><?php echo ($item['short_admin_note']); ?></span>
						</div>
					</div>
				</section>
				<div class="margin-lr">
					<div class="ect-button-more dis-box m-top12">
                                            <?php if($item['pay_status']=='未确认') { ?>
                                            <!-- <a class="btn-submit box-flex" href="<?php echo url('user/account/cancel',array('id'=>$item['id']));?>">取消</a> -->
                                            <a class="btn-submit box-flex" href="<?php echo url('user/account/log');?>">确定</a>
                                            <?php } ?>
						   <!-- <?php echo ($item['handle']); ?> -->
					</div>
				</div>
			</form>
                     <?php $n++;}unset($n); ?>
        <?php } ?>
		</div>
	</body>

</html>