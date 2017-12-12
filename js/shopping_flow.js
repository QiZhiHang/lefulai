/* $Id : shopping_flow.js 4865 2007-01-31 14:04:10Z paulgao $ */

var selectedShipping = null;
var selectedPayment  = null;
var selectedPack     = null;
var selectedCard     = null;
var selectedSurplus  = '';
var selectedBonus    = 0;
var selectedVcard    = 0;
var selectedIntegral = 0;
var selectedOOS      = null;
var alertedSurplus   = false;

var groupBuyShipping = null;
var groupBuyPayment  = null;

/* *
 * 改变配送方式
 */
function selectShipping(obj)
{
  if (selectedShipping == obj)
  {
    return;
  }
  else
  {
    selectedShipping = obj;
  }

  var supportCod = obj.attributes['supportCod'].value + 0;
  var theForm = obj.form;

  for (i = 0; i < theForm.elements.length; i ++ )
  {
    if (theForm.elements[i].name == 'payment' && theForm.elements[i].attributes['isCod'].value == '1')
    {
      if (supportCod == 0)
      {
        theForm.elements[i].checked = false;
        theForm.elements[i].disabled = true;
      }
      else
      {
        theForm.elements[i].disabled = false;
      }
    }
  }

  if (obj.attributes['insure'].value + 0 == 0)
  {
    document.getElementById('ECS_NEEDINSURE').checked = false;
    document.getElementById('ECS_NEEDINSURE').disabled = true;
  }
  else
  {
    document.getElementById('ECS_NEEDINSURE').checked = false;
    document.getElementById('ECS_NEEDINSURE').disabled = false;
  }
  
  var warehouse_id = $("#theForm").find("input[name='warehouse_id']").val();
  var area_id = $("#theForm").find("input[name='area_id']").val();

  var now = new Date();
  Ajax.call('flow.php?step=select_shipping', 'shipping=' + obj.value + '&warehouse_id=' + warehouse_id + '&area_id=' + area_id, orderShippingSelectedResponse, 'GET', 'JSON');
}

/**
 *
 */
function orderShippingSelectedResponse(result)
{
  if (result.need_insure)
  {
    try
    {
      document.getElementById('ECS_NEEDINSURE').checked = true;
    }
    catch (ex)
    {
      alert(ex.message);
    }
  }

  try
  {
    if (document.getElementById('ECS_CODFEE') != undefined)
    {
      document.getElementById('ECS_CODFEE').innerHTML = result.cod_fee;
    }
  }
  catch (ex)
  {
    alert(ex.message);
  }

  orderSelectedResponse(result);
}

/* *
 * 改变支付方式
 */
function selectPayment(value)
{
  if (selectedPayment == value)
  {
    return;
  }
  else
  {
    selectedPayment = value;
  }
  
  var warehouse_id = $("#theForm").find("input[name='warehouse_id']").val();
  var area_id = $("#theForm").find("input[name='area_id']").val();
  
    /*by kong 门店id*/
  var store_id = document.getElementById('store_id').value;
  (store_id > 0) ? store_id : 0;
   var store_seller = document.getElementById('store_seller').value;
  Ajax.call('flow.php?step=select_payment', 'payment=' + value + '&warehouse_id=' + warehouse_id + '&area_id=' + area_id + '&store_id=' +store_id + '&store_seller='+store_seller, orderSelectedResponse, 'GET', 'JSON');
}
/* *
 * 团购购物流程 --> 改变配送方式
 */
function handleGroupBuyShipping(obj)
{
  if (groupBuyShipping == obj)
  {
    return;
  }
  else
  {
    groupBuyShipping = obj;
  }

  var supportCod = obj.attributes['supportCod'].value + 0;
  var theForm = obj.form;

  for (i = 0; i < theForm.elements.length; i ++ )
  {
    if (theForm.elements[i].name == 'payment' && theForm.elements[i].attributes['isCod'].value == '1')
    {
      if (supportCod == 0)
      {
        theForm.elements[i].checked = false;
        theForm.elements[i].disabled = true;
      }
      else
      {
        theForm.elements[i].disabled = false;
      }
    }
  }

  if (obj.attributes['insure'].value + 0 == 0)
  {
    document.getElementById('ECS_NEEDINSURE').checked = false;
    document.getElementById('ECS_NEEDINSURE').disabled = true;
  }
  else
  {
    document.getElementById('ECS_NEEDINSURE').checked = false;
    document.getElementById('ECS_NEEDINSURE').disabled = false;
  }

  Ajax.call('group_buy.php?act=select_shipping', 'shipping=' + obj.value, orderSelectedResponse, 'GET');
}

/* *
 * 团购购物流程 --> 改变支付方式
 */
function handleGroupBuyPayment(obj)
{
  if (groupBuyPayment == obj)
  {
    return;
  }
  else
  {
    groupBuyPayment = obj;
  }

  Ajax.call('group_buy.php?act=select_payment', 'payment=' + obj.value, orderSelectedResponse, 'GET');
}

/* *
 * 改变商品包装
 */
function selectPack(obj)
{
  if (selectedPack == obj)
  {
    return;
  }
  else
  {
    selectedPack = obj;
  }
  
  var warehouse_id = $("#theForm").find("input[name='warehouse_id']").val();
  var area_id = $("#theForm").find("input[name='area_id']").val();

  Ajax.call('flow.php?step=select_pack', 'pack=' + obj.value + '&warehouse_id=' + warehouse_id + '&area_id=' + area_id, orderSelectedResponse, 'GET', 'JSON');
}

/* *
 * 改变祝福贺卡
 */
function selectCard(obj)
{
  if (selectedCard == obj)
  {
    return;
  }
  else
  {
    selectedCard = obj;
  }
  
  var warehouse_id = $("#theForm").find("input[name='warehouse_id']").val();
  var area_id = $("#theForm").find("input[name='area_id']").val();

  Ajax.call('flow.php?step=select_card', 'card=' + obj.value + '&warehouse_id=' + warehouse_id + '&area_id=' + area_id, orderSelectedResponse, 'GET', 'JSON');
}

/* *
 * 选定了配送保价
 */
function selectInsure(needInsure)
{
  needInsure = needInsure ? 1 : 0;
  
  var warehouse_id = $("#theForm").find("input[name='warehouse_id']").val();
  var area_id = $("#theForm").find("input[name='area_id']").val();

  Ajax.call('flow.php?step=select_insure', 'insure=' + needInsure + '&warehouse_id=' + warehouse_id + '&area_id=' + area_id, orderSelectedResponse, 'GET', 'JSON');
}

/* *
 * 团购购物流程 --> 选定了配送保价
 */
function handleGroupBuyInsure(needInsure)
{
  needInsure = needInsure ? 1 : 0;

  Ajax.call('group_buy.php?act=select_insure', 'insure=' + needInsure, orderSelectedResponse, 'GET', 'JSON');
}

/* *
 * 回调函数
 */
function orderSelectedResponse(result)
{
  if (result.error)
  {
	
	var foot = false;
	
	if(result.error == 1){
		var divId = 'no-goods-cart';
		var title = json_languages.cart;
		var content = $('#no_goods_cart').html();
	}else if(result.error == 2){
		var divId = 'no-address-cart';
		var title = json_languages.Shipping_address;
		var content = $('#no_address_cart').html();
	}
	
	pb({
		id:divId,
		title:title,
		width:450,
		height:50,
		content:content, 	//调取内容
		drag:false,
		foot:foot
	});
	
	$('#' + divId + ' .ftx-04').css({'padding': '11px 0px 0px 10px'});
	$('#' + divId + ' .tip-box').css({
		'width': '330px',
		'height': '50px',
		'padding': '0px 0px 10px 0px'
	});
	$('#' + divId + ' .item-fore').css({
		'margin': '0px 0px 0px 47px'
	});
	
	$('#' + divId + ' .pb-bd').css({
		'padding-left': '65px'
	});
  }

  try
  {
    var layer = document.getElementById("ECS_ORDERTOTAL");
    var goods_inventory = document.getElementById("goods_inventory");
    layer.innerHTML = (typeof result == "object") ? result.content : result;
	
	if(result.goods_list)
	{
		goods_inventory.innerHTML = (typeof result == "object") ? result.goods_list : result;
	}   
    
    if (result.payment != undefined)
    {
      var surplusObj = document.getElementById('ECS_SURPLUS'); //ecmoban新睿社区 --zhuo 
      if (surplusObj != undefined)
      {
        surplusObj.disabled = result.pay_code == 'balance';
      }
    }
  }
  catch (ex) { }
}

/* *
 * 改变余额
 */
function changeSurplus(val)
{	
	
	var warehouse_id = $("#theForm").find("input[name='warehouse_id']").val();
   	var area_id = $("#theForm").find("input[name='area_id']").val();
   
	/*获取 价格 by yanxin*/
	var sur = $(".sur").val();
	var shipping = $(".shipping").val();
	sur = sur.replace(/<[^<>]+>/g,'');
	sur = sur.replace('