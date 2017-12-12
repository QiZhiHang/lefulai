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
    <section class="user-center user-login margin-lr p-r">
        <form class="login-form validation" action="<?php echo url('index');?>" method="post">
        <div class="user-login-header-box">
            <div class="user-login-header"><div class="user-login-header-img"><img src="<?php echo elixir('img/get_avatar.png');?>"/></div></div>
        </div>
            <div class="b-color-f  user-login-ul user-login-ul-after">
                <div class="text-all dis-box j-text-all login-li " name="usernamediv">
                    <i class="iconfont icon-huiyuan"></i>
                    <div class="box-flex input-text">
                        <input class="j-input-text" name="username" datatype="*" nullmsg="请输入用户名"
                               type="text" placeholder="请输入您的账号"/>
                        <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                    </div>
                </div>
                <div class="text-all dis-box j-text-all login-li m-top10" name="passworddiv">
                    <i class="iconfont icon-password"></i>
                    <div class="box-flex input-text">
                        <input class="j-input-text" name="password" type="password" datatype="*" nullmsg="请输入密码" placeholder="请输入您的密码"/>
                        <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                    </div>
                    <i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
                </div>
             </div>
            <input type="hidden" name="back_act" value="<?php echo $back_act; ?>"/>
            <button type="submit" class="btn-submit min-two-btn br-5">立即登录</button>
        </form>
       
    </section>
</div>
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
</script>
</body>

</html>