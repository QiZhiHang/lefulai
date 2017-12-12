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
    <form action="<?php echo url('user/account/account');?>" method="post" onsubmit="return check()">
        <div class="user-recharge b-color-f">
            <section class="j-show-div j-show-get-val padding-lr">
                <div class="dis-box text-all">
                    <label class="t-remark">提现账户</label>
                    <?php $n=1; if(is_array($bank)) foreach($bank as $key => $val) { ?>
                    <?php if($key==0) { ?>
                    <input type="hidden" name="bank_number" value="<?php echo ($val['bank_card_org']); ?>">
                    <input type="hidden" name="real_name" value="<?php echo ($val['bank_user_name']); ?>">
                    <input type="hidden" name="user_note" value="<?php echo ($val['bank_region']); ?>">
                    <input type="hidden" name="mobile" value="<?php echo ($val['bank_mobile']); ?>">
                    <div class="box-flex t-goods1 text-right onelist-hidden">
                        <span></span>
                    </div>
                    <?php } ?>
                    <?php $n++;}unset($n); ?>
                    <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
                </div>
                <!--充值方式弹出层-->
                <div class="show-time-con ts-3 b-color-1 j-filter-show-div">
                    <section class="goods-show-title of-hidden padding-all b-color-f">
                        <h3 class="fl g-c-title-h3">选择银行卡</h3>
                        <i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
                    </section>
                    <section class="s-g-list-con swiper-scroll">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide select-two">
                                <ul class="j-get-one padding-all">
                                    <?php $n=1;if(is_array($bank)) foreach($bank as $key) { ?>
                                    <li class="ect-select">
                                        <label class="ts-1" name="<?php echo ($key['bank_name']); ?>" card="<?php echo ($key['bank_card_org']); ?>">
                                            <dd><span><?php echo ($key['bank_card']); ?>(<?php echo ($key['bank_name']); ?>)</span></dd>
                                            <i class="fr iconfont icon-gou ts-1"></i></label>
                                    </li>
                                    <?php $n++;}unset($n); ?>
                                </ul>
                            </div>
                            <div class="swiper-scrollbar"></div>
                        </div>
                    </section>
                </div>
            </section>
            <section class="margin-lr">
                <div class="text-all dis-box j-text-all">
                    <label class="t-remark">提现金额</label>
                    <div class="box-flex input-text">
                        <input class="j-input-text" type="text" placeholder="本次最大提现额度 <?php echo $surplus_amount; ?>" name="amount">
                    </div>
                </div>
            </section>
            <?php if(config('shop.sms_signin') == 1) { ?>
            <section class="margin-lr">
                <div class="text-all dis-box j-text-all">
                    <label class="t-remark">验证码</label>
                    <div class="box-flex input-text">
                        <input class="j-input-text" type="text" name="verify" datatype="*" nullmsg="请输入图片验证码"/>
                        <img src="<?php echo url('captcha/index/index');?>" class="j-verify-img"
                             onclick="this.src='<?php echo url('captcha/index/index');?>'"
                             height="36" style="position: absolute; right: 0; top: 0; font-size: 1.4rem;"/>
                    </div>
                </div>
            </section>
            <section class="margin-lr">
                <div class="text-all dis-box j-text-all">
                    <label class="t-remark">短信验证码</label>
                    <div class="box-flex input-text">
                        <input class="j-input-text" type="text" name="mobile_code" datatype="*" nullmsg="请输入短信验证码">
                        <a style="position: absolute; right: 0; top: 25%; font-size: 1.4rem; z-index: 2"
                           href="javascript:;" id="sendsms">发送验证码</a>
                    </div>
                </div>
            </section>
            <?php } ?>
        </div>
         <input type="hidden" name="surplus_type" value="1">
        <div class="padding-all">
            <button type="submit" class="btn-submit">提交申请</button>
        </div>

       
    </form>
    <!--提现layer-->
    <div class="mask-filter-div"></div>
</div>
<script type="text/javascript">
    function check() {
        $(".ts-1").each(function () {
            if ($(this).hasClass("active")) {
                $("input[name=real_name]").val($(this).attr("name"));
                $("input[name=bank_number]").val($(this).attr("card"));
                a = 1;
            }
        })

        var amount = $("input[name=amount]").val();
        if (amount == '') {
            d_messages('请填写提现金额');
            return false;
        }

        // 验证码校验
        <?php if(config('shop.sms_signin') == 1) { ?>
        var verify_code = $("input[name=verify]").val();
        if (verify_code == '') {
            d_messages('请输入图片验证码');
            return false;
        }
        var mobile_code = $("input[name=mobile_code]").val();
        if (mobile_code == '') {
            d_messages('请输入短信验证码');
            return false;
        }
        <?php } ?>

        if (a != 1) {
            return false;
        }
    }

    var time = 60;
    var c = 1;
    function data() {
        if (time == 0) {
            c = 1;
            $("#sendsms").html("发送验证码");
            time = 60;
            return;
        }

        if (time != 0) {
            if ($(".ipt-check-btn").attr("class").indexOf("disabled") < 0) {
                $(".ipt-check-btn").addClass('disabled');
            }
            c = 0;
            $("#sendsms").html("<span>重新获取(" + time + ")</span>");
            time--;
        }
        setTimeout(data, 1000);
    }
    $("#sendsms").click(function () {
        var verify_code = $("input[name=verify]").val();
        var mobile = $("input[name=mobile]").val();

        if (verify_code == '') {
            d_messages('请输入图片验证码');
            return false;
        }
        if (mobile == '') {
            d_messages('请输入手机号');
            return false;
        }
        if (c == 0) {
            d_messages('发送频繁');
            return;
        }

        $.post(ROOT_URL + 'index.php?m=sms&a=send', {
            mobile: mobile,
            verify_code: verify_code,
            flag: 'register'
        }, function (res) {
            d_messages(res.msg);
            if (res.code == 2) {
                data();
            } else {
                $('.j-verify-img').click();
            }
        }, 'json');
    })
</script>
</body>
</html>