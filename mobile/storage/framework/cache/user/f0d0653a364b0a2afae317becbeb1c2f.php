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
    <div class="user-center user-register of-hidden">
        <div class="hd j-tab-title">
            <ul class="dis-box">
                <?php if($show) { ?>
                <li class="box-flex active">快速注册</li>
                <?php } else { ?>
                <li class="box-flex active">乐福来商城</li>
                <?php } ?>
            </ul>
        </div>
        <div id="j-tab-con">
            <div class="swiper-wrapper">
                <section class="swiper-slide swiper-no-swiping">
                    <form action="<?php echo url('register');?>" method="post" class="validation">
                     <div class="b-color-f  user-login-ul user-register-ul">
                        <div class="text-all dis-box j-text-all login-li" name="mobilediv">
                            <div class="box-flex input-text">
                                <input class="j-input-text" id="username" name="username" value="<?php echo $rand_username; ?>" datatype="s6-20"
                                       nullmsg="请输入您的用户名"
                                       errormsg="用户名需6位字母或数字" type="name" placeholder="请输入您的用户名"/>
                                <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                            </div>
                        </div>
                        
                        <div class="text-all dis-box j-text-all login-li m-top10" name="">
                            <div class="box-flex input-text">
                                <input class="j-input-text" id="nick_name" name="nick_name" 
                                       nullmsg="请输入您的真实姓名"
                                       errormsg="真实姓名不能为空" type="text" placeholder="请输入您的真实姓名"/>
                                <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                            </div>
                        </div>
                        <div class="text-all dis-box j-text-all login-li  m-top10" name="passworddiv">
                            <div class="box-flex input-text">
                                <input class="j-input-text" name="password" value="111111" type="password" datatype="*6-20"
                                       nullmsg="请设置6-20位登录密码"
                                       errormsg="密码至少6位数" placeholder="请输入密码"/>
                                <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                            </div>
                            <i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
                        </div>
                        <div class="text-all dis-box j-text-all login-li m-top10" name="">
                            <div class="box-flex input-text">
                                <input class="j-input-text" name="paypwd" value="222222" type="password" datatype="*6-20"
                                        nullmsg="请输支付入密码"
                                       errormsg="再次输入的密码不正确" placeholder="请输支付入密码"/>
                                <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                            </div>
                            <i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
                        </div>
                        

                        <div class="text-all dis-box j-text-all login-li m-top10" name="">
                            <div class="box-flex input-text">
                                <input class="j-input-text" id="recommend_username" value="<?php echo $re_username; ?>"  name="recommend_username" 
                                       nullmsg="您的推荐人账号"
                                       errormsg="您的推荐人账号" type="name" placeholder="您的推荐人账号"/>
                            </div>
                        </div>

                        <div class="text-all dis-box j-text-all login-li m-top10">
                            <div class="box-flex input-text">
                                <input class="j-input-text" name="captcha" datatype="*" nullmsg="请输入图片验证码" type="text"
                                       placeholder="请输入验证码"/>
                                <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                            </div>
                            <img src="<?php echo url('captcha/index/index');?>" onclick="this.src='<?php echo url('captcha/index/index');?>'"
                                 height="36" class="ipt-check-btn j-verify-img"/>
                        </div>
                        
                          </div>
                        <input type="hidden" name="back_act" value="<?php echo $back_act; ?>"/>
                        <button type="submit" class="btn-submit min-two-btn br-5">注册</button>
                        <a href="<?php echo url('user/login/index',array('back_act' => $back_act));?>" class="a-first u-l-register fr">已注册直接登录</a>

                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
<div class="div-messages"></div>
<!--引用js-->
<script>
    $(function () {
        $.Tipmsg.r = null;
        $(".validation").Validform({
            tiptype: function (msg) {
                d_messages(msg);
            },
            tipSweep: true,
            ajaxPost: true,
            callback: function (data) {
                // {"info":"demo info","status":"y"}
                if (data.status === 'y') {
                    window.location.href = data.url;
                } else {
                    d_messages(data.info);
                }
            }
        });
    })
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
       var myreg = /^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\d{8}$/;
        var mobile = $("input[name=mobile]").val();
        var verify_code = $("input[name=verify]").val();

        if (verify_code == '') {
            d_messages('请输入图片验证码');
            return false;
        }
        if (mobile == '') {
            d_messages('请输入手机号');
            return false;
        }
        if (!myreg.test(mobile)) {
            d_messages('请输入有效的手机号');
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

    /*切换*/
    var tabsSwiper = new Swiper('#j-tab-con', {
        speed: 0,
        noSwiping: true,
        autoHeight: true
    })
    $(".j-tab-title li").on('touchstart mousedown', function (e) {
        e.preventDefault()
        $(".j-tab-title .active").removeClass('active')
        $(this).addClass('active')
        tabsSwiper.slideTo($(this).index())
    })
    $(".j-tab-title li").click(function (e) {
        e.preventDefault()
    })

</script>
</body>

</html>