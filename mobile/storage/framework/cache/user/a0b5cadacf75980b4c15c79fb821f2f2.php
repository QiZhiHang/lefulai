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


<section class="b-color-f  my-nav-box">
	<a href="javascript:;">
		<div class="s-user-top">
			<div class="user-bg-box-1">
				<img src="<?php echo elixir('img/user-1.png');?>">
			</div>
			<div class="user-bg2-box-1"><img src="<?php echo elixir('img/user-2.png');?>"></div>
			<div class="s-xian-box user_profile_box s-user-top-1 p-r">
				<div class="dis-box t-goods1 onelist-hidden jian-top" for="logo">
					<div class="user-img ">
    					<div class="user-head-img-box-1">
                        <img src="<?php echo elixir('img/no_image.jpg');?>">
                        </div>
                    </div>
                    <div class="box-flex profile-index-top">
                        <h3 class="text-all-span my-u-title-size"><?php echo ($info['nick_name']); ?></h3>
                        <p class="text-all-span f-02"><span>用户名</span> <?php echo $user_name; ?></p>
                    </div>
				</div>
                
			</div>

		</div>
	</a>

	<div class="s-user-top onclik-nick_name">
		<div class="dis-box s-xian-box s-user-top-1">
			<h3 class="box-flex text-all-span my-u-title-size">昵称</h3>
			<div id="nick_name" class="box-flex t-goods1 text-right onelist-hidden jian-top"><?php echo ($info['nick_name']); ?></div>
            <span class="t-jiantou"></span>
		</div>
	</div>
	<div class="s-user-top onclik-sex">
		<div class="dis-box s-xian-box s-user-top-1">
			<h3 class="box-flex text-all-span my-u-title-size">性别</h3>
			<div id="sex" class="box-flex t-goods1 text-right onelist-hidden jian-top"><?php echo ($info['sex']); ?></div>
			<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
		</div>
	</div>
    <div class="s-user-top onclik-birthday">
        <div class="dis-box s-xian-box s-user-top-1">
            <h3 class="box-flex text-all-span my-u-title-size">出生日期</h3>
            <div id="birthday" class="box-flex t-goods1 text-right onelist-hidden jian-top"><?php echo ($info['birthday']); ?></div>
            <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
        </div>
    </div>
<a href="<?php echo url('index/addresslist');?>">
        <div class="s-user-top">
            <div class="dis-box s-user-top-1">
                <h3 class="box-flex text-all-span my-u-title-size">收货地址</h3>
                <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
            </div>
        </div>
    </a>
</section>
<section class="b-color-f my-nav-box m-top10">
	<a href="<?php echo url('user/profile/realname');?>">
		<div class="s-user-top">
			<div class="dis-box s-user-top-1">
				<h3 class="box-flex text-all-span my-u-title-size">银行信息</h3>
                <div class="box-flex t-goods1 text-right onelist-hidden jian-top"><?php if($user_real == 1) { ?>已认证<?php } else { ?>未认证<?php } ?></div>
				<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
			</div>
		</div>
	</a>
    <a href="<?php echo url('user/profile/accountsafe');?>">
        <div class="s-user-top">
            <div class="dis-box s-user-top-1">
                <h3 class="box-flex text-all-span my-u-title-size">账户安全</h3>
                <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
            </div>
        </div>
    </a>
</section>


<?php if($is_connect_user == 0) { ?>
<div class="ect-button-more padding-all">
    <a class="btn-submit box-flex br-5 bg-hui" type="button" href="<?php echo url('user/login/logout');?>">退出</a>
</div>
<?php } ?>

<!-- 修改昵称 -->
<div class=" my-nick_name-box">
    <div class="flow-consignee margin-lr ">
        <div class="text-all dis-box">
            <label>昵称</label>
            <div class="box-flex input-text">
                <input class="j-input-text inputcard" type="text" name="nick_name" placeholder="昵称" value="<?php echo ($info['nick_name']); ?>">
                <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
            </div>
        </div>
        <div class="ect-button-more dis-box m-top12  my-nick_name-close">
            <button  class="btn-submit box-flex br-5 min-two-btn" type="submit" value="submit">确定</button>
        </div>
    </div>
</div>
<!-- 修改性别 -->
<div class=" my-sex-box">
	<div class="flow-consignee margin-lr">
		<ul class="g-s-i-title-3 dis-box text-center user-sex">
			<li class="box-flex  sex-default-color">
				<a href="javascript:;" class="<?php if($user_sex == 1) { ?>active<?php } ?>">
					<i class="iconfont icon-nan my-sex-size" ></i>
                	<input type="radio" name="sex" value="1"/><h4 class="ellipsis-one f-03">男</h4>
				</a>
			</li>
			<li class="box-flex sex-default-color" >
				<a href="javascript:;" class="sex-nv <?php if($user_sex == 2) { ?>active<?php } ?>">
					<i class="iconfont icon-nv my-sex-size" ></i>
                  	<input type="radio" name="sex" value="2"/><h4 class="ellipsis-one f-03">女</h4>
				</a>
			<li>
		</ul>
		<div class="ect-button-more dis-box m-top12 updata-top my-sex-close">
          <button  class="btn-submit box-flex br-5 min-two-btn" type="submit" value="submit">确定</button>
		</div>
	</div>
</div>
<!-- 修改出生日期 -->
<div class=" my-birthday-box">
    <div class="flow-consignee margin-lr">
        <div class="weui-cell f-05 text-all col-3">
            <div class="weui-cell__hd"><span for="" class="weui-label">出生日期：</span></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="date" value="<?php if($info['birthday']) { echo ($info['birthday']); } else { ?>1900-00-00<?php } ?>" name="birthday">
            </div>
        </div>
        <div class="ect-button-more dis-box m-top12 my-birthday-close">
          <button  class="btn-submit box-flex br-5 min-two-btn" type="submit" value="submit">确定</button>
        </div>
    </div>
</div>
<script>
$(function($) {
    // 性别展开修改弹窗
	$(".onclik-sex").click(function() {
		$(".my-sex-box").addClass("current");
	});
    // 关闭
	$(".my-sex-close").click(function() {
		$(".my-sex-box").removeClass("current");
	});
    // 点击修改颜色
    $('.sex-default-color').click(function() {
        for (var i = 0; i < $('.sex-default-color').size(); i++) {
            if (this == $('.sex-default-color').get(i)) {
                $('.sex-default-color').eq(i).children('a').addClass('active');
            } else {
                $('.sex-default-color').eq(i).children('a').removeClass('active');
            }
        }
    });
    // 提交修改
    $(".user-sex").click(function(){
        var sex = $(".active input[name='sex']").val();

        $.post("<?php echo url('user/profile/editprofile');?>",{sex:sex},function(data){
            $("#sex").text(data.sex);
        },"json");

    });



    // 出生日期展开修改弹窗
    $(".onclik-birthday").click(function() {
        $(".my-birthday-box").addClass("current");
    });
    // 关闭 并提交修改
    $(".my-birthday-close").click(function() {
        $(".my-birthday-box").removeClass("current");

        var birthday = $("input[name='birthday']").val();
        $.post("<?php echo url('user/profile/editprofile');?>",{birthday:birthday},function(data){
            $("#birthday").text(data.birthday);
        },"json");
    });

});

<?php if($is_wechat == 0) { ?>

<?php } ?>
</script>
</body>
</html>