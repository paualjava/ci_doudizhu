<?php
//订单自动审核功能
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
$time = time();
$nowtime=gmtime();
$sql= "SELECT * FROM " . $GLOBALS['ecs']->table('pintuaninfo') . " WHERE status=0 and pintuan_id>0";
$tuaninfo=$db->getAll($sql);
//print_r($tuaninfo);exit;
if(!empty($tuaninfo)){
	$sql = "update " .$GLOBALS['ecs']->table('wx_access_token'). " set time=86400";
	$GLOBALS['db']->getAll($sql);
	foreach($tuaninfo as $tinfo){
		$tuanid=$tinfo['id'];
		$tadd_time=$tinfo['add_time'];
		$end_time=$tadd_time+86400;//结束时间
		$pintuan_id=$tinfo['pintuan_id'];//拼团ID
		$buy_info=get_this_group_buy_info($pintuan_id);
		$pingtuan_count=@$buy_info['pingtuan_count'];
		$pingtuan_count_type=@$buy_info['pingtuan_count_type'];//拼团类型
		$pingtuan_count_type=(empty($pingtuan_count_type)) ? 1 : $pingtuan_count_type; //拼团类型 为空的话，按人
		$goods_name=@$buy_info['goods_name'];
		$goods_price=@$buy_info['price_ladder'][0]['price'];
		//判断该团是否到了截至时间
		if($time>$end_time){
			//查询该团份数是否已满足
			if($pingtuan_count_type==2)
			$sql = 'SELECT sum(og.goods_number)' .
			' FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS oi LEFT JOIN ' . $GLOBALS['ecs']->table('order_goods') . ' AS og ' .
			' on oi.order_id = og.order_id WHERE oi.pay_status=2 and og.tuan_id ='.$tuanid.' ';
			else
			$sql = 'SELECT COUNT(DISTINCT oi.user_id)' .
			' FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS oi LEFT JOIN ' . $GLOBALS['ecs']->table('order_goods') . ' AS og ' .
			' on oi.order_id = og.order_id WHERE oi.pay_status=2 and og.tuan_id ='.$tuanid.' ';
			
			$hanum=$db->getOne($sql);
			if($hanum>=$pingtuan_count || $buy_info['act_force_delivery']==1){
				//成功
				//参与人信息
				$sql = 'SELECT *' .' FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS oi LEFT JOIN ' . $GLOBALS['ecs']->table('order_goods') . ' AS og ' .' on oi.order_id = og.order_id  WHERE oi.pay_status=2 and og.tuan_id ='.$tuanid.'  group by(oi.user_id)';
				$res  = $db->query($sql);
				while ($rows = $GLOBALS['db']->fetchRow($res))
				{
					$orderid=$rows['order_id'];
					$sql = "update" . $ecs->table('order_info') . " set ptstatus=1,shenhe_time=$nowtime  WHERE order_id=$orderid";
					$db->query($sql);

					$sql = "update" . $ecs->table('pintuaninfo') . " set status=1  WHERE id=$tuanid";
					$db->query($sql);

					$mobile=$rows['mobile'];
					$uid=$rows['user_id'];
					$sql = 'SELECT wxopenid FROM '. $GLOBALS['ecs']->table('users').' WHERE `user_id` ='.$uid;
					$myinfo = $GLOBALS['db']->getRow($sql);
					$wxopenid=$myinfo['wxopenid'];
					//短信通知
					if(!empty($mobile)){
						$temp_str = '您的'.$goods_name.'成功！48小时内完成发货，届时请注意查收快递！感谢您的参加！';
						$content = urlencode($temp_str);
						$url = 'http://www.wm18.com/test.php?mobile='.$mobile.'&content='.$content;
						$note = fopen_url($url);
						if($note == 'succeed'){
							add_sms_log($mobile,'1');
						}else{
							add_sms_log($mobile,'0');
						}
					}
					//目标URL
					$wxurl=sendurl();
					$goods_number=$rows['goods_number'];
					$goods_number=($goods_number>1) ? " x ".$goods_number : "";
					//微信通知
					$postdata='{
		                       "touser":"'.$wxopenid.'",
		                       "template_id":"N_gPO4l8ACoJRT8PB6MB6vEEX6VTmbQa_2-S2vSu0sg",
		                       "topcolor":"#FF0000",
		                       "data":{
		                           "first":{
		                               "value":"恭喜您的拼团已成功",
		                               "color":"#000000"
		                           },
								  
								   "keyword1":{
		                               "value":"'.$goods_name.'",
		                               "color":"#000000"
		                           },
		                           "keyword2":{
		                               "value":"'.$goods_price.'"'.$goods_number.',
		                               "color":"#000000"
		                           },
								   "keyword3":{
		                               "value":"活动期内",
		                               "color":"#000000"
		                           },
								  
		                           "remark":{
		                               "value":"\n如有问题请致电400-110-1508或直接在微信留言，小麦将第一时间为您服务！",
		                               "color":"#000000"
		                           }
		                       }
		                   }';

					$result =  curl_request($wxurl,$postdata);
				}





			}else{
				//失败
				//参与人信息
				$sql = 'SELECT *' .' FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS oi LEFT JOIN ' . $GLOBALS['ecs']->table('order_goods') . ' AS og ' .' on oi.order_id = og.order_id  WHERE oi.pay_status=2 and og.tuan_id ='.$tuanid.'  group by(oi.user_id)';
				$res  = $db->query($sql);
				while ($rows = $GLOBALS['db']->fetchRow($res))
				{
					$orderid=$rows['order_id'];
					$sql = "update" . $ecs->table('order_info') . " set ptstatus=2,shenhe_time=$nowtime  WHERE order_id=$orderid";
					$db->query($sql);

					$sql = "update" . $ecs->table('pintuaninfo') . " set status=2  WHERE id=$tuanid";
					$db->query($sql);

					$mobile=$rows['mobile'];
					$uid=$rows['user_id'];
					$sql = 'SELECT wxopenid FROM '. $GLOBALS['ecs']->table('users').' WHERE `user_id` ='.$uid;
					$myinfo = $GLOBALS['db']->getRow($sql);
					$wxopenid=$myinfo['wxopenid'];
					if(!empty($mobile)){
						//短信通知
						$temp_str = '很抱歉！您的'.$goods_name.'拼团未成功！2-5个工作日内会完成退款！您也可以继续发起团购！感谢您的参加！';
						$content = urlencode($temp_str);
						$url = 'http://www.wm18.com/test.php?mobile='.$mobile.'&content='.$content;
						$note = fopen_url($url);
						if($note == 'succeed'){
							add_sms_log($mobile,'1');
						}else{
							add_sms_log($mobile,'0');
						}
					}
					//目标URL
					$wxurl=sendurl();
					//微信通知
					$postdata='{
		                       "touser":"'.$wxopenid.'",
		                       "template_id":"JuSRtoF7b7crI96ZqAQaEw3OT0xBZxCJStIjM2PAlhc",
		                       "topcolor":"#FF0000",
		                       "data":{
		                           "first":{
		                               "value":"很抱歉！您的拼团未成功",
		                               "color":"#000000"
		                           },
								  
								   "keyword1":{
		                               "value":"'.$goods_name.'",
		                               "color":"#000000"
		                           },
		                           "keyword2":{
		                               "value":"时限内未满足参团份数",
		                               "color":"#000000"
		                           },
								   
								  
		                           "remark":{
		                               "value":"\n如有问题请致电400-110-1508或直接在微信留言，小麦将第一时间为您服务！",
		                               "color":"#000000"
		                           }
		                       }
		                   }';
					// echo $wxurl;
					//print_r($postdata);
					$result =  curl_request($wxurl,$postdata);
					print_r($result);
				}




			}





		}


	}
}







//CURL提交数据
function curl_request($url,$data=null){
	$curl = curl_init(); // 启动一个CURL会话
	curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
	if($data != null){
		curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
	}
	curl_setopt($curl, CURLOPT_TIMEOUT, 300); // 设置超时限制防止死循环
	curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
	$info = curl_exec($curl); // 执行操作
	if (curl_errno($curl)) {
		echo 'Errno:'.curl_getinfo($curl);//捕抓异常
		dump(curl_getinfo($curl));
	}
	return $info;
}



//生成推送URL
function sendurl(){
	//获得全局Access Token
	include_once(dirname(__FILE__) ."/m.wm18.com/wxpay/Weixin_lib.php");
	$wxlb = new Weixin_lib();
	$access_token = $wxlb->get_wx_access_token();
	$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token."";
	return $url;
}


/**
获取远程文件内容 
@param $url 文件http地址 
*/ 
function fopen_url($url)
{
	if (function_exists('file_get_contents')) {
		$file_content = @file_get_contents($url);
	}
	elseif (ini_get('allow_url_fopen') && ($file = @fopen($url, 'rb'))){
		$i = 0;
		while (!feof($file) && $i++ < 1000) {
			$file_content .= strtolower(fread($file, 4096));
		}
		fclose($file);
	}
	elseif (function_exists('curl_init')) {
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT,2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl_handle, CURLOPT_FAILONERROR,1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Trackback Spam Check'); //引用垃圾邮件检查
		$file_content = curl_exec($curl_handle);
		curl_close($curl_handle);
	} else {
		$file_content = '';
	}
	return $file_content;
}
function get_this_group_buy_info($group_buy_id, $current_num = 0)
{
	/* 取得团购活动信息 */
	$group_buy_id = intval($group_buy_id);
	$sql = "SELECT *, act_id AS group_buy_id, act_desc AS group_buy_desc, start_time AS start_date, end_time AS end_date " .
	"FROM " . $GLOBALS['ecs']->table('goods_activity_pintuan') .
	"WHERE act_id = '$group_buy_id' " .
	"AND act_type = '" . GAT_GROUP_BUY . "'";
	$group_buy = $GLOBALS['db']->getRow($sql);

	/* 如果为空，返回空数组 */
	if (empty($group_buy))
	{
		return array();
	}

	$ext_info = unserialize($group_buy['ext_info']);
	$group_buy = array_merge($group_buy, $ext_info);

	/* 格式化时间 */
	$group_buy['formated_start_date'] = local_date('Y-m-d H:i', $group_buy['start_time']);
	$group_buy['formated_end_date'] = local_date('Y-m-d H:i', $group_buy['end_time']);

	/* 格式化保证金 */
	$group_buy['formated_deposit'] = price_format($group_buy['deposit'], false);

	/* 处理价格阶梯 */
	$price_ladder = $group_buy['price_ladder'];
	if (!is_array($price_ladder) || empty($price_ladder))
	{
		$price_ladder = array(array('amount' => 0, 'price' => 0));
	}
	else
	{
		foreach ($price_ladder as $key => $amount_price)
		{
			$price_ladder[$key]['formated_price'] = price_format($amount_price['price'], false);
		}
	}
	$group_buy['price_ladder'] = $price_ladder;

	/* 统计信息 */
	$stat = group_buy_stat($group_buy_id, $group_buy['deposit']);
	$group_buy = array_merge($group_buy, $stat);

	/* 计算当前价 */
	$cur_price  = $price_ladder[0]['price']; // 初始化
	$cur_amount = $stat['valid_goods'] + $current_num; // 当前数量
	foreach ($price_ladder as $amount_price)
	{
		if ($cur_amount >= $amount_price['amount'])
		{
			$cur_price = $amount_price['price'];
		}
		else
		{
			break;
		}
	}
	$group_buy['cur_price'] = $cur_price;
	$group_buy['formated_cur_price'] = price_format($cur_price, false);

	/* 最终价 */
	$group_buy['trans_price'] = $group_buy['cur_price'];
	$group_buy['formated_trans_price'] = $group_buy['formated_cur_price'];
	$group_buy['trans_amount'] = $group_buy['valid_goods'];

	/* 状态 */
	$group_buy['status'] = group_buy_status($group_buy);
	if (isset($GLOBALS['_LANG']['gbs'][$group_buy['status']]))
	{
		$group_buy['status_desc'] = $GLOBALS['_LANG']['gbs'][$group_buy['status']];
	}

	$group_buy['start_time'] = $group_buy['formated_start_date'];
	$group_buy['end_time'] = $group_buy['formated_end_date'];

	return $group_buy;
}
?>