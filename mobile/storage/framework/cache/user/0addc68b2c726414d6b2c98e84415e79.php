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


<div class="con b-color-f mb-7" >
    <form action="<?php echo url('realname');?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"  onsubmit="return false">
        <section class="j-f-tel margin-lr">
            <div class="text-all dis-box j-text-all bank_card">
                <label>真实姓名</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="text" name="data[real_name]" placeholder="真实姓名" value="<?php echo $nick_name; ?>" readonly="readonly"/>
                    <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                </div>
            </div>
            <div class="text-all dis-box j-text-all bank_user_name">
                <label>身份证号</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="text" name="data[self_num]" placeholder="身份证号" value="<?php echo ($real_user['self_num']); ?>" />
                    <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                </div>
            </div>


            <div class="text-all dis-box j-text-all bank_region">
                <label>银行</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="text" name="data[bank_name]" placeholder="如:工商银行上海XXX路支行" value="<?php echo ($real_user['bank_name']); ?>" />
                    <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                </div>
            </div>
            <div class="text-all dis-box j-text-all bank_name">
                <label>银行卡号</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="text" name="data[bank_card]" placeholder="银行卡号" value="<?php echo ($real_user['bank_card']); ?>" />
                    <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                </div>
            </div>
            <div class="text-all dis-box j-text-all bank_name">
                <label>手机号码</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="tel" name="mobile_phone" placeholder="手机号码" value="<?php echo ($real_user['bank_mobile']); ?>" />
                    <i class="iconfont icon-guanbi1 close-common j-is-null"></i>
                </div>
            </div>

            <div class="ect-button-more dis-box filter-btn">
                <input type="hidden" name="step" value="<?php echo $step; ?>" />
                <input type="hidden" name="real_id" value="<?php echo ($real_user['real_id']); ?>" />
                <input type="submit" value="<?php if($step == 'first') { ?>同意网站协议并确定<?php } else { ?>提交<?php } ?>" class="btn-submit box-flex" />
            </div>
        </section>
    </form>
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
                    <a href="<?php echo url('realnameok');?>">
                         <i class="iconfont icon-qudiandianpumingpianicon"></i>
                         <p>认证详情</p>
                    </a>
                </li>
                </ul>
        </div>
    </nav>
    <div class="common-show"></div>
<script type="text/javascript">

$(function(){
    // 提交表单
    $('input[type="submit"]').click(function(){
        // 验证数据
        var label_name = '';
        $(".inputcard").each(function(){
             if($(this).val() == ''){
                 label_name = $(this).parent().parent().find('label').html();
                 d_messages('请输入完整的'+ label_name);
                 return false;
             }
         });
    

        // 异步提交
        var ajax_data = $(".form-horizontal").serialize();
        $(".form-horizontal").ajaxSubmit({
            type: "POST",
            dataType: "json",
            url: "<?php echo url('realname');?>",
            data: {
                ajax_data
            },
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus) {
                d_messages(data.msg);
                if(data.status == 0){
                    window.location.href = "<?php echo url('realnameok');?>";
                }
                return false;
            },
        });

    });

    // 获取验证码
    $('.j-submit-phone').click(function(){
        var phoneNum = $('input[name=mobile_phone]').val();
        if(phoneNum == ''){
            d_messages('请填写手机号码');
            return false;
        }
        $.ajax({
            url : "<?php echo url('realnamesend');?>",
            data :　{mobile:phoneNum},
            type : 'post',
            dataType : 'json',
            success : function(data){
                if(data.error==0){
                    RemainTime();
                }
                d_messages(data.content, 2);
            }
        });
    });

});

    var iTime = 59;
    var Account;
 function RemainTime(){
      //document.getElementById('zphone').disabled = true;
      var iSecond,sSecond="",sTime="";
      if (iTime >= 0){
        iSecond = parseInt(iTime%60);
        if (iSecond >= 0){
          sSecond = iSecond + "秒";
        }
        sTime=sSecond;
        if(iTime==0){
          clearTimeout(Account);
          sTime='获取手机验证码';
          iTime = 59;
              c=1;
          //document.getElementById('zphone').disabled = false;
        }else{

          Account = setTimeout("RemainTime()",1000);
          iTime=iTime-1;
              c=0;
        }
      }else{
        sTime='没有倒计时';
      }
      //document.getElementById('zphone').value = sTime;
      $('#zphone').html(sTime);
    }

//下面用于图片上传预览功能
function setImagePreview(doc,preview) {
    var docObj1 = document.getElementById(doc);
    var imgObjPreview1 = document.getElementById(preview);
    if (docObj1.files && docObj1.files[0]) {
        imgObjPreview1.style.display = 'block';
        imgObjPreview1.src = window.URL.createObjectURL(docObj1.files[0]);
    } else {
        docObj1.select();
        var imgSrc = document.selection.createRange().text;
        var localImagId = document.getElementById("localImag");
        localImagId.style.width = "100%";
        localImagId.style.height = "50%";
        //图片异常的捕捉，防止用户修改后缀来伪造图片
        try {
            localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
            localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
        } catch (e) {
            alert("您上传的图片格式不正确，请重新选择!");
            return false;
        }
        imgObjPreview1.style.display = 'none';
        document.selection.empty();
    }
    return true;
}

</script>
</body>
</html>