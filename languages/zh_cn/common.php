<?php

/**
 * DSC 前台语言文件
 * ============================================================================
 * * 版权所有 2005-2017 上海商创网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.010xr.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: Zhuo $
 * $Id: common.php 2016-01-04 Zhuo $
 */

$_LANG['merchants_article'] = "您查看的文章已不存在，请与网站联系";

/* 优惠券 start */
$_LANG['lang_goods_coupons']['all_pay'] = "全场券";
$_LANG['lang_goods_coupons']['user_pay'] = "会员券";
$_LANG['lang_goods_coupons']['goods_pay'] = "购物券";
$_LANG['lang_goods_coupons']['reg_pay'] = "注册券";
$_LANG['lang_goods_coupons']['not_pay'] = "未知";
$_LANG['lang_goods_coupons']['is_goods'] = "限商品";
$_LANG['lang_goods_coupons']['is_all'] = "全品类通用";

$_LANG['lang_coupons_receive_failure'] = "领取失败,券已经被领完了";
$_LANG['lang_coupons_user_receive'] = "领取失败,您已经领取过该券了!每人限领取 %s 张";
$_LANG['lang_coupons_user_rank'] = "领取失败,仅限会员等级为: %s 领取";
$_LANG['lang_coupons_receive_succeed'] = "领取成功！感谢您的参与，祝您购物愉快~";
/* 优惠券 end */

/* 众筹 start */
$_LANG['lang_crowd_preheat'] = "预热中";
$_LANG['lang_crowd_of'] = "众筹中";
$_LANG['lang_crowd_succeed'] = "众筹成功";

$_LANG['lang_crowd_art_succeed'] = "发布成功";
$_LANG['lang_crowd_art_succeed_repeat'] = "已经发布过啦，请不要重复发布！";
$_LANG['lang_crowd_login'] = "登陆后发布话题";

$_LANG['lang_crowd_page_title'] = "众筹-收货地址";

$_LANG['lang_crowd_login_focus'] = "只有登陆用户才能关注";
$_LANG['lang_crowd_focus_succeed'] = "关注成功";
$_LANG['lang_crowd_focus_repeat'] = "已经关注过啦，请不要重复关注！";
$_LANG['lang_crowd_focus_cancel'] = "取消关注成功!";

$_LANG['lang_crowd_like'] = "点赞成功";
$_LANG['lang_crowd_like_repeat'] = "已经点过赞啦，请不要重复点赞！";

$_LANG['lang_crowd_next_step'] = "下一步";
$_LANG['lang_crowd_not_login'] = "您尚未登录，请登录您的账号！";

$_LANG['lang_crowd_not_pay'] = "您有未支付的众筹订单，请付款后再提交新订单";
$_LANG['lang_crowd_not_address'] = "您没有设置收货地址";
/* 众筹 end */

$_LANG['lang_product_sn'] = "货品货号";

$_LANG['dwt_shop_name'] = "";

$_LANG['order_payed_sms'] = '订单 %s 付款了，收货人：%s 电话：%s'; //wang

//ecmoban新睿社区 --zhuo start 审核收货人地址
$_LANG['order_address_stay'] = "无法提交订单<br/>收货地址已被修改，待审核中...";
$_LANG['order_address_no'] = "无法提交订单<br/>收货地址已被修改，审核未通过...";
$_LANG['index_lnk'] = "返回首页，继续购物！";

$_LANG['edit_address_success'] = '您的收货地址信息已成功更新,待审核通过';
$_LANG['address_list_lnk'] = '返回地址列表';

$_LANG['signin_failed_user'] = '收货地址为空，请您添加收货地址';
$_LANG['lnk_user'] = "去添加收货地址";
//ecmoban新睿社区 --zhuo end 审核收货人地址

$_LANG['single_user'] = '用户晒单'; //by zhang
$_LANG['discuss_user'] = '网友讨论圈'; //by zhang
$_LANG['allcount'] = '全部帖子'; //by zhang
$_LANG['s_count'] = '晒单帖';
$_LANG['t_count'] = '讨论帖';
$_LANG['w_count'] = '问答帖';
$_LANG['q_count'] = '圈子帖';
$_LANG['reply_number'] = '回复数';
$_LANG['click_count'] = '点击数';
$_LANG['sort']['single_sort'] = '排序';

$_LANG['set_gcolor'] = '设置商品颜色'; //by zhang

//ecmoban新睿社区 --zhuo start
$_LANG['ff'][FF_NOMAINTENANCE] = '未维修';
$_LANG['ff'][FF_MAINTENANCE] = '已维修';
$_LANG['ff'][FF_REFOUND] = '已退款';
$_LANG['ff'][FF_NOREFOUND] = '未退款';
$_LANG['ff'][FF_NOEXCHANGE] = '未换货';
$_LANG['ff'][FF_EXCHANGE] = '已换货';

$_LANG['steps_UserLogin'] = '您尚未登录，无法申请入驻';
$_LANG['UserLogin'] = '去登陆';

$_LANG['please_select'] = '请选择';
$_LANG['country'] = '国家';
$_LANG['province'] = '省';
$_LANG['city'] = '市';
$_LANG['area'] = '区';

$_LANG['delivery_warehouse'] = '发货仓库';

$_LANG['group_shortage'] = "对不起，该套餐主件商品已经库存不足暂停销售。\n你现在要进行缺货登记来预订该商品吗？";
$_LANG['group_not_on_sale'] = '对不起，该套餐主件商品已经下架。';
$_LANG['group_goods_not_exists'] = "对不起，指定的套餐主件商品不存在";

$_LANG['not_start'] = '未开始';
$_LANG['overdue'] = '已过期';
$_LANG['has_ended'] = '已结束';
$_LANG['not_use'] = '未使用';
$_LANG['had_use'] = '已使用';
//ecmoban新睿社区 --zhuo end

/* 用户登录语言项 */
$_LANG['empty_username_password'] = '对不起，您必须完整填写用户名和密码。';
$_LANG['shot_message'] = "短消息";

/* 公共语言项 */

$_LANG['largess'] = '赠品';
$_LANG['sys_msg'] = '系统提示';
$_LANG['catalog'] = '目录';
$_LANG['please_view_order_detail'] = '商品已发货，详情请到用户中心订单详情查看';
$_LANG['user_center'] = '用户中心';
$_LANG['shop_closed'] = "本店盘点中，请您稍后再来...";
$_LANG['shop_register_closed'] = '该网店暂停注册';
$_LANG['shop_upgrade'] = "本店升级中，管理员从 <a href=\\\"admin/\\\">管理中心</a> 登录后，系统会自动完成升级";
$_LANG['js_languages']['process_request'] = '正在处理您的请求...';
$_LANG['process_request'] = '正在处理您的请求...';
$_LANG['please_waiting'] = '请稍等, 正在载入中...';
$_LANG['icp_number'] = 'ICP备案证书号';
$_LANG['plugins_not_found'] = "插件 %s 无法定位";
$_LANG['home'] = '首页';
$_LANG['back_up_page'] = '返回上一页';
$_LANG['close_window'] = '关闭窗口';
$_LANG['back_home'] = '返回首页';
$_LANG['ur_here'] = '当前位置:';
$_LANG['all_goods'] = '全部商品';
$_LANG['all_recommend'] = "全部推荐";
$_LANG['all_attribute'] = "全部";
$_LANG['promotion_goods'] = '促销商品';
$_LANG['best_goods'] = '精品推荐';
$_LANG['new_goods'] = '新品上市';
$_LANG['hot_goods'] = '热销商品';
$_LANG['view_cart'] = "查看购物车";
$_LANG['catalog'] = '所有分类';
$_LANG['regist_login'] = '注册/登录';
$_LANG['profile'] = '个人资料';
$_LANG['query_info'] = "共执行 %d 个查询，用时 %f 秒，在线 %d 人";
$_LANG['gzip_enabled'] = '，Gzip 已启用';
$_LANG['gzip_disabled'] = '，Gzip 已禁用';
$_LANG['memory_info'] = '，占用内存 %0.3f MB';
$_LANG['cart_info'] = "%d";
$_LANG['shopping_and_other'] = '购买过此商品的人还购买过';
$_LANG['bought_notes'] = '购买记录';
$_LANG['later_bought_amounts'] = '近期成交数量';
$_LANG['bought_time'] = '购买时间';
$_LANG['turnover'] = '成交';
$_LANG['no_notes'] = '还没有人购买过此商品';
$_LANG['shop_price'] = "商 城 价";
$_LANG['market_price'] = "市场价";
$_LANG['goods_brief'] = '商品描述：';
$_LANG['goods_album'] = '商品相册';
$_LANG['promote_price'] = "促 销 价";
$_LANG['fittings_price'] = '配件价格：';
$_LANG['collect'] = '加入收藏夹';
$_LANG['add_to_cart'] = "加入购物车";
$_LANG['return_to_cart'] = "放回购物车";
$_LANG['search_goods'] = '商品搜索';
$_LANG['search'] = '搜索';
$_LANG['wholesale_search'] = '搜索批发商品';
$_LANG['article_title'] = '文章标题';
$_LANG['article_author'] = '作者';
$_LANG['article_add_time'] = '添加日期';
$_LANG['relative_file'] = '[ 相关下载 ]';
$_LANG['category'] = '分类';
$_LANG['brand'] = '品牌';
$_LANG['price_min'] = '最小价格';
$_LANG['price_max'] = '最大价格';
$_LANG['goods_name'] = '商品名称';
$_LANG['goods_attr'] = '商品属性';
$_LANG['goods_price_ladder'] = '价格阶梯';
$_LANG['ladder_price'] = '批发价格';
$_LANG['shop_prices'] = "本 店 价";
$_LANG['market_prices'] = "市 场 价";
$_LANG['group_buy_price'] = "团 购 价";
$_LANG['seckill_price'] = "秒 杀 价";
$_LANG['deposit'] = '团购保证金';
$_LANG['amount'] = '商品总价';
$_LANG['number'] = '购买数量';
$_LANG['handle'] = '操作';
$_LANG['add'] = '添加';
$_LANG['edit'] = '编辑';
$_LANG['drop'] = '删除';
$_LANG['view'] = '查看';
$_LANG['modify'] = '修改';
$_LANG['is_cancel'] = '取消';
$_LANG['amend_amount'] = '修改数量';
$_LANG['end'] = '结束';
$_LANG['require_field'] = '(必填)';
$_LANG['search_result'] = '搜索结果';
$_LANG['order_number'] = '订单号';
$_LANG['consignment'] = '发货单';
$_LANG['activities'] = '商品正在进行的活动';
$_LANG['remark_package'] = '超值礼包';
$_LANG['old_price'] = '原  价：';
$_LANG['package_price'] = '礼包价：';
$_LANG['then_old_price'] = '节  省：';
$_LANG['free_goods'] = '免运费商品';

$_LANG['searchkeywords_notice'] = '匹配多个关键字全部，可用 "空格" 或 "AND" 连接。如 win32 AND unix<br />匹配多个关键字其中部分，可用"+"或 "OR" 连接。如 win32 OR unix';
$_LANG['hidden_outstock'] = '隐藏已脱销的商品';
$_LANG['keywords'] = '关键字';
$_LANG['sc_ds'] = '搜索简介';
$_LANG['button_search'] = '立即搜索';
$_LANG['no_search_result'] = '无法搜索到您要找的商品！';
$_LANG['all_category'] = '所有分类';
$_LANG['all_brand'] = '所有品牌';
$_LANG['all_option'] = '请选择';
$_LANG['extension'] = '扩展选项';
$_LANG['gram'] = '克';
$_LANG['kilogram'] = '千克';
$_LANG['goods_sn'] = '商品货号：';
$_LANG['bar_code'] = '条形条码';
$_LANG['goods_brand'] = '品　　牌：';
$_LANG['goods_weight'] = '商品重量：';
$_LANG['goods_number'] = '商品库存：';
$_LANG['goods_give_integral'] = '购买此商品赠送：';
$_LANG['goods_integral'] = '可　　用：';
$_LANG['goods_bonus'] = '购买此商品可获得红包：';
$_LANG['goods_free_shipping'] = '此商品为免运费商品，计算配送金额时将不计入配送费用';
$_LANG['goods_rank'] = '用户评价：';
$_LANG['goods_compare'] = '商品比较';
$_LANG['properties'] = '商品属性：';
$_LANG['brief'] = '简要介绍：';
$_LANG['add_time'] = '上架时间：';
$_LANG['residual_time'] = '剩余时间';
$_LANG['begin_time_soon'] = '距开始时间';
$_LANG['day'] = '天';
$_LANG['hour'] = '小时';
$_LANG['minute'] = '分钟';
$_LANG['compare'] = '比较';
$_LANG['volume_price'] = '购买商品达到以下数量区间时可享受的优惠价格';
$_LANG['number_to'] = '数量';
$_LANG['article_list'] = '文章列表';

$_LANG['not'] = "无";
$_LANG['open'] = "展开";
$_LANG['open_more'] = "展开更多";
$_LANG['stop'] = "收起";
$_LANG['stop_more'] = "收起更多";
$_LANG['time'] = "时间";
$_LANG['money_symbol'] = "￥";
$_LANG['current_price'] = '当前价格';
$_LANG['start_time'] = '开始时间';
$_LANG['end_time'] = '结束时间';
$_LANG['con_cus_service'] = '联系客服';
$_LANG['min_fare'] = '最低加价';
$_LANG['max_fare'] = '最高加价';
$_LANG['store_shop'] = '商家店铺';
$_LANG['see_more'] = '查看更多';
$_LANG['comprehensive'] = '综合好评';
$_LANG['branch'] = '分';
$_LANG['score_detail'] = '评分明细';
$_LANG['industry_compare'] = '行业相比';
$_LANG['goods'] = '商品';
$_LANG['service'] = '服务';
$_LANG['prescription'] = '时效';
$_LANG['store_total'] = '店铺总分';
$_LANG['company'] = '公&nbsp;&nbsp;&nbsp;&nbsp;司';
$_LANG['seat_of'] = '所在地';
$_LANG['online_service'] = '在线客服';
$_LANG['enter_the_shop'] = '进入店铺';
$_LANG['follow'] = '关注';
$_LANG['follow_yes'] = '已关注';
$_LANG['follow_store'] = '关注店铺';
$_LANG['assign'] = '确定';
$_LANG['au_number'] = '次出价';
$_LANG['brand_home'] = '品牌首页';
$_LANG['brand_category'] = '品牌分类';

$_LANG['look_new'] = '找新品';
$_LANG['look_hot'] = '找热卖';
$_LANG['all_category'] = '全部分类';
$_LANG['change_a_lot'] = '换一批';
$_LANG['best'] = '精品';
$_LANG['see_all'] = '查看全部';
$_LANG['ren'] = '人';
$_LANG['jian_goods'] = '件商品';
$_LANG['guess_love'] = '猜你喜欢';
$_LANG['sale_amount'] = '销售量';
$_LANG['screen_price'] = '请填写筛选价格';
$_LANG['screen_price_left'] = '请填写筛选左边价格';
$_LANG['screen_price_right'] = '请填写筛选右边价格';
$_LANG['screen_price_dy'] = '左边价格不能大于或等于右边价格';
$_LANG['publish_top'] = '发表新话题';
$_LANG['types'] = '类型';
$_LANG['publish'] = '发表';
$_LANG['statement'] = '声明';
$_LANG['statement_one'] = '1、欢迎您在此提出与商品有关的问题，为保证话题质量，铁牌及以上级别用户可以发表话题，注册及以上级别用户可以回复；';
$_LANG['statement_two'] = '2、网友讨论采用先发布后审核原则，如果我们认为您的发贴不能给其他用户带来帮助或违反国家有关规定，' . @$dwt_shop_name . '商城有权删除';
$_LANG['commentTitle_not'] = '主题不能为空';
$_LANG['commentTitle_xz'] = '标题长度只能在2-50个字符之间';
$_LANG['content_not'] = '内容不能为空';
$_LANG['captcha_not'] = '验证码不能为空';
$_LANG['captcha_xz'] = '请输入4位数的验证码';
$_LANG['message_see'] = '【新消息】请查收!';
$_LANG['message_not'] = '【　　　】请查收!';

/* 商品比较JS语言项 */
$_LANG['compare_js']['button_compare'] = '比较选定商品';
$_LANG['compare_js']['exist'] = '您已经选择了%s';
$_LANG['compare_js']['count_limit'] = '最多只能选择4个商品进行对比';
$_LANG['compare_js']['goods_type_different'] = '\"%s\"和已选择商品类型不同无法进行对比';

$_LANG['bonus'] = '优惠券：';
$_LANG['no_comments'] = '暂时还没有任何用户评论';
$_LANG['give_comments_rank'] = '给出';
$_LANG['comments_rank'] = '评价';
$_LANG['comment_num'] = "用户评论 %d 条记录";
$_LANG['login_please'] = '由于您还没有登录，因此您还不能使用该功能。';
$_LANG['collect_existed'] = '该商品已经存在于您的收藏夹中。';
$_LANG['collect_success'] = '该商品已经成功地加入收藏夹。';
$_LANG['collect_brand_existed'] = '您已经关注过该品牌';
$_LANG['collect_brand_success'] = '成功关注该品牌';
$_LANG['cancel_brand_success'] = '已取消关注该品牌';
$_LANG['send_authemail_success'] = '验证邮件发送成功';
$_LANG['copyright'] = "&copy; 2005-%s %s 版权所有，并保留所有权利。";
$_LANG['no_ads_id'] = '没有指定广告的ID以及跳转的URL地址!';
$_LANG['remove_collection_confirm'] = '您确定要从收藏夹中删除选定的商品吗？';
$_LANG['err_change_attr'] = '没有找到指定的商品或者没有找到指定的商品属性。';

$_LANG['collect_goods'] = '收藏商品';
$_LANG['plus'] = '加';
$_LANG['minus'] = '减';
$_LANG['yes'] = '是';
$_LANG['no'] = '否';

$_LANG['same_attrbiute_goods'] = '相同%s的商品';

/* TAG */
$_LANG['button_submit_tag'] = '添加我的标记';
$_LANG['tag_exists'] = '您已经为该商品添加过一个标记，请不要重复提交.';
$_LANG['tag_cloud'] = '标签云';
$_LANG['tag_anonymous'] = '对不起，只有注册会员并且正常登录以后才能提交标记。';
$_LANG['tag_cloud_desc'] = '标签云（Tag cloud）是用以表示一个网站中的内容标签。 标签（tag、关键词）是一种更为灵活、有趣的商品分类方式，您可以为每个商品添加一个或多个标签，那么可以通过点击这个标签查看商品其他会员提交的与您的标签一样的商品,能够让您使用最快的方式查找某一个标签的所有网店商品。比方说点击“红色”这个标签，就可以打开这样的一个页面，显示所有的以“红色” 为标签的网店商品';

/* AJAX 相关 */
$_LANG['invalid_captcha'] = '对不起，您输入的验证码不正确。';
$_LANG['goods_exists'] = "对不起，您的购物车中已经存在相同的商品。";
$_LANG['fitting_goods_exists'] = "对不起，您的购物车中已经添加了该配件。";
$_LANG['invalid_number'] = '对不起，您输入了一个非法的商品数量。';
$_LANG['not_on_sale'] = '对不起，该商品已经下架。';
$_LANG['no_basic_goods'] = "对不起，您希望将该商品做为配件购买，可是购物车中还没有该商品的基本件。";
$_LANG['cannt_alone_sale'] = '对不起，该商品不能单独销售。';
$_LANG['shortage'] = "对不起，该商品已经库存不足暂停销售。\n你现在要进行缺货登记来预订该商品吗？";
$_LANG['shortage_little'] = "该商品已经库存不足。已将您的购货数量修改为 %d。\n您现在要去购物车吗？";
$_LANG['oos_tips'] = '该商品已经库存不足。您现在要进行缺货登记吗？';

$_LANG['addto_cart_success_1'] = "该商品已添加到购物车，您现在还需要继续购物吗？\n如果您希望马上结算，请点击“确定”按钮。\n如果您希望继续购物，请点击“取消”按钮。";
$_LANG['addto_cart_success_2'] = "该商品已添加到购物车，您现在还需要继续购物吗？\n如果您希望继续购物，请点击“确定”按钮。\n如果您希望马上结算，请点击“取消”按钮。";
$_LANG['no_keywords'] = "请输入搜索关键词！";

/* 分页排序 */
$_LANG['exchange_sort']['goods_id'] = '按上架时间排序';
$_LANG['exchange_sort']['exchange_integral'] = '按积分排序';
$_LANG['exchange_sort']['last_update'] = '按更新时间排序';
$_LANG['order']['DESC'] = '倒序';
$_LANG['order']['ASC'] = '正序';
$_LANG['pager_1'] = '总计 ';
$_LANG['pager_2'] = ' 个记录';
$_LANG['pager_3'] = '，共 ';
$_LANG['pager_4'] = ' 页。';
$_LANG['page_first'] = '第一页';
$_LANG['page_prev'] = '上一页';
$_LANG['page_next'] = '下一页';
$_LANG['page_last'] = '最末页';
$_LANG['btn_display'] = '显示方式';
$_LANG['page_last_new'] = '末页';

/* 投票 */
$_LANG['vote_times'] = '参与人次';
$_LANG['vote_ip_same'] = '对不起，您已经投过票了!';
$_LANG['submit_vote'] = '投票';
$_LANG['submit_reset'] = '重选';
$_LANG['vote_success'] = '恭喜你，投票成功';

/* 评论 */
$_LANG['cmt_submit_done'] = '您的评论已成功发表, 感谢您的参与!';
$_LANG['cmt_submit_wait'] = "您的评论已成功发表, 请等待管理员的审核!";
$_LANG['cmt_lang']['cmt_empty_username'] = '请输入您的用户名称';
$_LANG['cmt_lang']['cmt_empty_email'] = '请输入您的电子邮件地址';
$_LANG['cmt_lang']['cmt_error_login'] = '请您登录后再发表评论';
$_LANG['cmt_lang']['cmt_error_email'] = '电子邮件地址格式不正确';
$_LANG['cmt_lang']['cmt_empty_content'] = '您没有输入评论的内容';
$_LANG['cmt_spam_warning'] = '您至少在30秒后才可以继续发表评论!';
$_LANG['cmt_lang']['captcha_not_null'] = '验证码不能为空!';
$_LANG['cmt_lang']['cmt_invalid_comments'] = '无效的评论内容!';
$_LANG['invalid_comments'] = '无效的评论内容!';
$_LANG['error_email'] = '电子邮件地址格式不正确!';
$_LANG['admin_username'] = "管理员：";
$_LANG['reply_comment'] = '回复';
$_LANG['comment_captcha'] = '验证码';
$_LANG['comment_login'] = '只有注册会员才能发表评论，请您登录后再发表评论';
$_LANG['comment_custom'] = "评论失败。只有在本店购买过商品的注册会员才能发表评论。";
$_LANG['comment_brought'] = '评论失败。只有购买过此商品的注册用户才能评论该商品。';
$_LANG['anonymous'] = '匿名用户';

/* 其他信息 */
$_LANG['js_languages']['goodsname_not_null'] = '商品名不能为空！';

/* 商品比较 */
$_LANG['compare_remove'] = '移除';
$_LANG['compare_no_goods'] = '您没有选定任何需要比较的商品或者比较的商品数少于 2 个。';

$_LANG['no_user_name'] = '该用户名不存在';
$_LANG['undifine_rank'] = '暂无';
$_LANG['not_login'] = '您还没有登陆';
$_LANG['half_info'] = '信息不全，请填写所有信息';
$_LANG['no_id'] = '没有商品ID';
$_LANG['save_success'] = '修改成功';
$_LANG['drop_consignee_confirm'] = '您确定要删除该收货人信息吗？';

/* 夺宝奇兵 */
$_LANG['snatch_js']['price_not_null'] = '价格不能为空';
$_LANG['snatch_js']['price_not_number'] = '价格只能是数字';
$_LANG['snatch_list'] = '夺宝奇兵列表';
$_LANG['not_in_range'] = '你只能在%d到%d之间出价';
$_LANG['also_bid'] = '你已经出过价格 %s 了';
$_LANG['lack_pay_points'] = '你积分不够，不能出价';
$_LANG['snatch'] = '夺宝奇兵';
$_LANG['snatch_is_end'] = '活动已经结束';
$_LANG['snatch_start_time'] = '本次活动从 %s 到 %s 截止';
$_LANG['price_extent'] = '出价范围为';
$_LANG['user_to_use_up'] = '用户可多次出价，每次消耗';
$_LANG['snatch_victory_desc'] = '当本期活动截止时，系统将从所有竞价奖品的用户中，选出在所有竞价中出价最低、且没有其他出价与该价格重复的用户（即最低且唯一竞价），成为该款奖品的获胜者.';
$_LANG['price_less_victory'] = '如果用户获胜的价格低于';
$_LANG['price_than_victory'] = '将能按当期竞拍价购得该款奖品；如果用户获胜的价格高于';
$_LANG['or_can'] = '则能以';
$_LANG['shopping_product'] = '购买该款奖品';
$_LANG['victory_price_product'] = '获胜用户将能按当期竞拍价购得该款奖品.';
$_LANG['now_not_snatch'] = '当前没有活动';
$_LANG['my_integral'] = '我的积分';
$_LANG['bid'] = '出价';
$_LANG['me_bid'] = '我要出价';
$_LANG['me_now_bid'] = '我的出价';
$_LANG['only_price'] = '唯一价格';
$_LANG['view_snatch_result'] = '活动结果';
$_LANG['victory_user'] = '获奖用户';
$_LANG['price_bid'] = '所出价格';
$_LANG['bid_time'] = '出价时间';
$_LANG['not_victory_user'] = '没有获奖用户';
$_LANG['snatch_log'] = '参加夺宝奇兵%s ';
$_LANG['not_for_you'] = '你不是获胜者，不能购买';
$_LANG['order_placed'] = '您已经下过订单了，如果您想重新购买，请先取消原来的订单';

/* 购物流程中的前台部分 */
$_LANG['select_spe'] = '请选择商品属性';

/* 购物流程中的订单部分 */
$_LANG['price'] = '价格';
$_LANG['name'] = '名称';
$_LANG['describe'] = '描述';
$_LANG['fee'] = '费用';
$_LANG['free_money'] = '免费额度';
$_LANG['img'] = '图片';
$_LANG['no_pack'] = '不要包装';
$_LANG['no_card'] = '不要贺卡';
$_LANG['bless_note'] = '祝福语';
$_LANG['use_integral'] = '使用积分';
$_LANG['can_use_integral'] = '您当前的可用积分为';
$_LANG['noworder_can_integral'] = '本订单最多可以使用';
$_LANG['use_surplus'] = '使用余额';
$_LANG['your_surplus'] = '您当前的可用余额为';
$_LANG['pay_fee'] = '支付手续费';
$_LANG['insure_fee'] = '保价费用';
$_LANG['need_insure'] = '配送是否需要保价';
$_LANG['cod'] = '配送决定';

$_LANG['curr_stauts'] = '当前状态';
$_LANG['use_bonus'] = '使用红包';
$_LANG['use_value_card'] = '使用储值卡';
$_LANG['use_bonus_kill'] = '使用线下红包';
$_LANG['invoice'] = '开发票';
$_LANG['invoice_type'] = '发票类型';
$_LANG['invoice_title'] = '发票抬头';
$_LANG['invoice_content'] = '发票内容';
$_LANG['order_postscript'] = '订单附言';
$_LANG['booking_process'] = '缺货处理';
$_LANG['complete_acquisition'] = '该订单完成后，您将获得';
$_LANG['with_price'] = '以及价值';
$_LANG['de'] = '的';
$_LANG['bonus'] = '红包';
$_LANG['goods_all_price'] = '商品总价';
$_LANG['dis_amount'] = '商品优惠';
$_LANG['discount'] = '折扣';
$_LANG['tax'] = '发票税额';
$_LANG['shipping_fee'] = '配送费用';
$_LANG['pack_fee'] = '包装费用';
$_LANG['card_fee'] = '贺卡费用';
$_LANG['total_fee'] = '应付款金额';
$_LANG['self_site'] = '本站';
$_LANG['order_gift_integral'] = '订单 %s 赠送的积分';

/* 缺货处理 */
$_LANG['oos'][OOS_WAIT] = '等待所有商品备齐后再发';
$_LANG['oos'][OOS_CANCEL] = '取消订单';
$_LANG['oos'][OOS_CONSULT] = '与店主协商';

/* 评论部分 */
$_LANG['username'] = '用户名';
$_LANG['email'] = '电子邮件地址';
$_LANG['comment_rank'] = '评价等级';
$_LANG['comment_content'] = '评论内容';
$_LANG['submit_comment'] = '提交评论';
$_LANG['button_reset'] = '重置表单';
$_LANG['goods_comment'] = '商品评论';
$_LANG['article_comment'] = '文章评论';

/* 支付确认部分 */
$_LANG['pay_status'] = '支付状态';
$_LANG['pay_not_exist'] = '此支付方式不存在或者参数错误！';
$_LANG['pay_disabled'] = '此支付方式还没有被启用！';
$_LANG['pay_success'] = '您此次的支付操作已成功！';
$_LANG['pay_fail'] = '支付操作失败，请返回重试！';

/* 文章部分 */
$_LANG['new_article'] = '最新文章';
$_LANG['shop_notice'] = '商店公告';
$_LANG['order_already_received'] = "此订单已经确认过了，感谢您在本站购物，欢迎再次光临。";
$_LANG['order_invalid'] = '您提交的订单不正确。';
$_LANG['act_ok'] = "谢谢您通知我们您已收到货，感谢您在本站购物，欢迎再次光临。";
$_LANG['receive'] = '收货确认';
$_LANG['buyer'] = '买家';
$_LANG['next_article'] = '下一篇';
$_LANG['prev_article'] = '上一篇';

/* 虚拟商品 */
$_LANG['virtual_goods_ship_fail'] = '自动发货失败，请尽快联系商家重新发货';

/* 选购中心 */
$_LANG['pick_out'] = '选购中心';
$_LANG['fit_count'] = "共有 %s 件商品符合条件";
$_LANG['goods_type'] = "商品类型";
$_LANG['remove_all'] = '移除所有';
$_LANG['advanced_search'] = '高级搜索';
$_LANG['activity'] = '本商品正在进行';
$_LANG['order_not_exists'] = "非常抱歉，没有找到指定的订单。请和网站管理员联系。";

$_LANG['promotion_time'] = '的时间为%s到%s，赶快来抢吧！';

/* 倒计时 */
$_LANG['goods_js']['day'] = '天';
$_LANG['goods_js']['hour'] = '小时';
$_LANG['goods_js']['minute'] = '分钟';
$_LANG['goods_js']['second'] = '秒';
$_LANG['goods_js']['end'] = '结束';

/*商品语言JS start*/
$_LANG['goods_js']['goods_attr_js'] = '请选择商品规格类型';
/*商品语言JS end*/

$_LANG['favourable'] = '优惠活动';

/* 团购部分语言项 */
$_LANG['group_buy'] = '团购活动';
$_LANG['group_buy_goods'] = '团购商品';
$_LANG['gb_goods_name'] = '团购商品：';
$_LANG['gb_start_date'] = '开始时间：';
$_LANG['gb_end_date'] = '结束时间：';
$_LANG['gbs_pre_start'] = '该团购活动尚未开始，请继续关注。';
$_LANG['gbs_under_way'] = '该团购活动正在火热进行中，距离结束时间还有：';
$_LANG['gbs_finished'] = '该团购活动已结束，正在等待处理...';
$_LANG['gbs_succeed'] = '该团购活动已成功结束！';
$_LANG['gbs_fail'] = '该团购活动已结束，没有成功。';
$_LANG['gb_price_ladder'] = '价格阶梯：';
$_LANG['gb_ladder_amount'] = '数量';
$_LANG['gb_ladder_price'] = '价格';
$_LANG['gb_deposit'] = '保证金：';
$_LANG['gb_restrict_amount'] = '限购数量：';
$_LANG['gb_limited'] = '限购';
$_LANG['gb_gift_integral'] = '赠送积分：';
$_LANG['gb_cur_price'] = '当前价格：';
$_LANG['gb_valid_goods'] = '当前定购数量：';
$_LANG['gb_final_price'] = '成交价格：';
$_LANG['gb_final_amount'] = '成交数量：';
$_LANG['gb_notice_login'] = '提示：您需要先注册成为本站会员并且登录后，才能参加商品团购!';
$_LANG['gb_error_goods_lacking'] = '对不起，商品库存不足，请您修改数量！';
$_LANG['gb_error_restrict_amount'] = '对不起，您购买的商品数量已达到限购数量！';
$_LANG['gb_error_status'] = '对不起，该团购活动已经结束或尚未开始，现在不能参加！';
$_LANG['gb_error_login'] = '对不起，您没有登录，不能参加团购，请您先登录！';
$_LANG['group_goods_empty'] = '当前没有团购活动';

/* 预售部分语言项 */
$_LANG['presale_error_status'] = '对不起，该预售活动已经结束或尚未开始，现在不能参加！';
$_LANG['back_to_presale'] = '返回预售商品';

/* 拍卖部分语言项 */
$_LANG['auction'] = '拍卖活动';
$_LANG['auction_list'] = '拍卖活动列表';
$_LANG['act_status'] = '活动状态';
$_LANG['au_start_price'] = '起拍价';
$_LANG['au_start_price_two'] = '起 拍 价';
$_LANG['au_end_price'] = '一口价';
$_LANG['au_end_price_two'] = '一 口 价';
$_LANG['au_amplitude'] = '加价幅度';
$_LANG['au_deposit'] = '保证金';
$_LANG['au_deposit_two'] = '保 证 金';
$_LANG['no_auction'] = '当前没有拍卖活动';
$_LANG['au_pre_start'] = '该拍卖活动尚未开始';
$_LANG['au_under_way'] = '该拍卖活动正在进行中，距离结束时间还有：';
$_LANG['au_under_way_1'] = '该拍卖活动正在进行中';
$_LANG['au_bid_user_count'] = '已出价人数';
$_LANG['au_last_bid_price'] = '最后出价';
$_LANG['au_last_bid_user'] = '最后出价的买家';
$_LANG['au_last_bid_time'] = '最后出价时间';
$_LANG['au_finished'] = '该拍卖活动已结束';
$_LANG['au_bid_user'] = '买家';
$_LANG['au_bid_price'] = '出价';
$_LANG['au_bid_time'] = '时间';
$_LANG['au_bid_status'] = '状态';
$_LANG['no_bid_log'] = '暂时没有买家出价';
$_LANG['au_bid_ok'] = '领先';
$_LANG['out'] = '出局';
$_LANG['au_i_want_bid'] = '我要出价';
$_LANG['nin_want_bid'] = '您的出价';
$_LANG['button_bid'] = '出价';
$_LANG['button_buy'] = '立即购买';
$_LANG['au_not_under_way'] = '拍卖活动已结束，不能再出价了';
$_LANG['au_bid_price_error'] = '请输入正确的价格';
$_LANG['au_bid_after_login'] = '您只有注册成为会员并且登录之后才能出价';
$_LANG['au_bid_repeat_user'] = '您已经是这个商品的最高出价人了!';
$_LANG['au_your_lowest_price'] = '您的出价不能低于 %s';
$_LANG['au_your_lowest_price_wen'] = '您的出价不能低于';