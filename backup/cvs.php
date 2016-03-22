<?php
/*
* 数据导出
*
* ==============================================================================================================================================
* @auther 麦考林
*
*/
class cvs
{
	private $target_url 	         = "http://m.wm18.com";
	function __construct()
	{
	}
	/**
	 *
	 */
	function main()
	{

	}
	/**
	 * http://192.168.1.101/feature/cvs/cvs.php?act=tuan_order
	 *
	 */
	function tuan_order()
	{
		//$sql = "select zhuanyuan_id from ". $GLOBALS['ecs']->table('order_goods')."  where is_pintuan";
		//$sql = "select og.order_id,og.tuan_id,og.zhuanyuan_id,pt.id,og.goods_number from m_order_goods og,m_pintuaninfo pt where og.tuan_id=pt.id AND pt.pintuan_id=0 and og.order_id>40211 group by og.order_id,og.tuan_id,og.zhuanyuan_id,pt.id";
		$sql = "select og.order_id,og.tuan_id,og.zhuanyuan_id,pt.id,og.goods_number,og.goods_attr from m_order_goods og,m_pintuaninfo pt where og.tuan_id=pt.id AND pt.pintuan_id=0 group by og.order_id,og.tuan_id,og.zhuanyuan_id,pt.id";
		$goods_list = $GLOBALS['db']->getAll($sql);
		$data=array();
		foreach($goods_list as $key =>$row)
		{
			//$sql2="select oi.* from m_order_info oi where oi.order_id=".$row['order_id']." and oi.pay_status=2";
			$sql2="select oi.* from m_order_info oi where oi.order_id=".$row['order_id']." ";
			$row2 = $GLOBALS['db']->getRow($sql2);
			//if($row2 && $row2['ptstatus']==2)
			if($row2)
			{
				$sql3="select * from m_users where user_id=".$row2['user_id'];
				$row3 = $GLOBALS['db']->getRow($sql3);
				$sql4="select * from m_weixin_pay_log where order_sn='".$row2['order_sn']."'";
				$row4 = $GLOBALS['db']->getRow($sql4);
				$data[$key]['order_id']=$row['order_id'];
				$data[$key]['order_sn']="'".$row2['order_sn'];
				$data[$key]['downloadid']="'".$row2['downloadid'];
				$data[$key]['out_trade_no']="'".$row4['out_trade_no'];
				$data[$key]['user_id']=$row3['user_id'];
				$data[$key]['consignee']=$row2['consignee'];
				$data[$key]['mobile']=$row2['mobile'];
				$data[$key]['address']=$this->get_address($row2)." ".$row2['address'];
				$data[$key]['pay_name']=$row2['pay_name'];
				$data[$key]['pay_time']=($row2['pay_time']==0) ? "未支付" : date("Y-m-d H:i:s",$row2['pay_time']);
				$data[$key]['goods_amount']=$row2['goods_amount'];
				$data[$key]['goods_number']=$row['goods_number'];
				$data[$key]['goods_attr']=$row['goods_attr'];
				if($row2['ptstatus']==1)
				$ptstatus="已成功";
				else if($row2['ptstatus']==2)
				$ptstatus="失败";
				else
				$ptstatus="";
				$data[$key]['ptstatus']=$ptstatus;
				$data[$key]['tuan_id']=$row['tuan_id'];
				$data[$key]['link']="http://m.wm18.com/fightgroups.php?act=fightone&zhuanyuanid=".$row2['user_id']."&tuanid=".$row['tuan_id'];
			}
		}
		$title_arr[] = array('Order_id','订单编号','clop中订单号','第三方微信流水号','会员编号','收货人','手机号','收货地址','支付方式','支付时间','商品金额','商品数量','商品属性','状态','团ID','链接');
		$datelist = array_merge ($title_arr,$data);
		$this->outputCsvHeader($datelist);
	}
	/**
	 * http://192.168.1.101/feature/cvs/cvs.php?act=tuan_order_pingtuan&pintuan_id=331&type=
	 *
	 */
	function tuan_order_pingtuan($id=331)
	{
		$pintuan_id=$_GET['pintuan_id'];
		$pintuan_type=$_GET['type'];
		$id=($_GET['id']) ? $_GET['id'] : $id;
		//$sql = "select zhuanyuan_id from ". $GLOBALS['ecs']->table('order_goods')."  where is_pintuan";
		//$sql = "select og.order_id,og.tuan_id,og.zhuanyuan_id,pt.id,og.goods_number from m_order_goods og,m_pintuaninfo pt where og.tuan_id=pt.id AND pt.pintuan_id=0 and og.order_id>40211 group by og.order_id,og.tuan_id,og.zhuanyuan_id,pt.id";
		$sql = "select og.order_id,og.tuan_id,og.zhuanyuan_id,pt.id,og.goods_number,og.goods_attr from m_order_goods og,m_pintuaninfo pt where og.tuan_id=pt.id AND pt.pintuan_id=".$pintuan_id." and pt.add_time>1454061748 and og.goods_id=7114 group by og.order_id,og.tuan_id,og.zhuanyuan_id,pt.id ";
		$goods_list = $GLOBALS['db']->getAll($sql);
		$data=array();
		foreach($goods_list as $key =>$row)
		{
			//$sql2="select oi.* from m_order_info oi where oi.order_id=".$row['order_id']." and oi.pay_status=2";
			if($pintuan_type=="all")
			$sql2="select oi.* from m_order_info oi where oi.order_id=".$row['order_id']." ";
			else
			$sql2="select oi.* from m_order_info oi where oi.order_id=".$row['order_id']." and oi.pay_status=2 ";
			$row2 = $GLOBALS['db']->getRow($sql2);
			//if($row2 && $row2['ptstatus']==2)
			if($row2)
			{
				$sql3="select * from m_users where user_id=".$row2['user_id'];
				$row3 = $GLOBALS['db']->getRow($sql3);
				$sql4="select * from m_weixin_pay_log where order_sn='".$row2['order_sn']."'";
				$row4 = $GLOBALS['db']->getRow($sql4);
				$data[$key]['order_id']=$row['order_id'];
				$data[$key]['order_sn']="'".$row2['order_sn'];
				$data[$key]['downloadid']="'".$row2['downloadid'];
				$data[$key]['out_trade_no']="'".$row4['out_trade_no'];
				$data[$key]['user_id']=$row3['user_id'];
				$data[$key]['consignee']=$row2['consignee'];
				$data[$key]['mobile']=$row2['mobile'];
				$data[$key]['address']=$this->get_address($row2)." ".$row2['address'];
				$data[$key]['pay_name']=$row2['pay_name'];
				$data[$key]['pay_time']=($row2['pay_time']==0) ? "未支付" : date("Y-m-d H:i:s",$row2['pay_time']);
				$data[$key]['goods_amount']=$row2['goods_amount'];
				$data[$key]['goods_number']=$row['goods_number'];
				$data[$key]['goods_attr']=$row['goods_attr'];
				if($row2['ptstatus']==1)
				$ptstatus="已成功";
				else if($row2['ptstatus']==2)
				$ptstatus="失败";
				else
				$ptstatus="";
				$data[$key]['ptstatus']=$ptstatus;
				$data[$key]['tuan_id']=$row['tuan_id'];
				$data[$key]['link']="http://m.wm18.com/fightgroups2.php?act=fightone&zhuanyuanid=".$row2['user_id']."&tuanid=".$row['tuan_id']."&id=".$id;
			}
		}
		$title_arr[] = array('Order_id','订单编号','clop中订单号','第三方微信流水号','会员编号','收货人','手机号','收货地址','支付方式','支付时间','商品金额','商品数量','商品属性','状态','团ID','链接');
		$datelist = array_merge ($title_arr,$data);
		if($type=="all")
		$this->outputCsvHeader($datelist,"拼团订单全部_".date("Ymd"));
		else
		$this->outputCsvHeader($datelist,"拼团订单_".date("Ymd"));
	}
	function order_cmbchina()
	{
		$type=$_GET['type'];
		if($type=="all")
		$sql = "select * from m_order_info  where order_status!=2 and pay_id=28 and add_time>1455743197";
		elseif($type=="nine")
		$sql = "select * from m_order_info  where order_status!=2 and pay_status=2 and pay_id=28 and add_time>1455743197";
		else
		$sql = "select * from m_order_info  where pay_status=2 and pay_id=28 and add_time>1455743197";
		$goods_list = $GLOBALS['db']->getAll($sql);
		$data=array();
		$total=0;
		$total_money=0;
		foreach($goods_list as $key =>$row)
		{
			if($type=="nine")
			{
				$sql = "select * from m_order_goods  where goods_id=7356 and order_id=".$row['order_id'];
				$goods_row = $GLOBALS['db']->getRow($sql);
				if($goods_row)
				{
					$sql3="select * from m_users where user_id=".$row['user_id'];
					$row3 = $GLOBALS['db']->getRow($sql3);
					$sql4="select * from m_weixin_pay_log where order_sn='".$row['order_sn']."'";
					$row4 = $GLOBALS['db']->getRow($sql4);

					$sql = "select * from m_order_goods  where order_id=".$row['order_id'];
					$order_list = $GLOBALS['db']->getAll($sql);
					$good_str="";
					foreach($order_list as $v2)
					{
						if($v2['goods_number']>1)
						$good_str.=$v2['goods_name']." - ".$v2['goods_sn']." * ".$v2['goods_number'];
						else
						$good_str.=$v2['goods_name']." - ".$v2['goods_sn'];
					}
					$data[$key]['order_id']=$row['order_id'];
					$data[$key]['order_sn']="'".$row['order_sn'];
					$data[$key]['downloadid']="'".$row['downloadid'];
					$data[$key]['user_id']=$row['user_id'];
					$data[$key]['consignee']=$row['consignee'];
					$data[$key]['mobile']=$row['mobile'];
					$data[$key]['address']=$this->get_address($row)." ".$row['address'];
					$data[$key]['pay_name']=$row['pay_name'];
					$data[$key]['pay_time']=($row['pay_time']==0) ? "未支付" : date("Y-m-d H:i:s",$row['pay_time']+8*3600);
					$data[$key]['goods_amount']=$row['goods_amount'];
					$data[$key]['money_paid']=$row['money_paid']+$row['surplus'];
					$data[$key]['goods_name']=$good_str;
					$total++;
					$total_money=$total_money+$data[$key]['money_paid'];
				}
			}
			else
			{
				$sql3="select * from m_users where user_id=".$row['user_id'];
				$row3 = $GLOBALS['db']->getRow($sql3);
				$sql4="select * from m_weixin_pay_log where order_sn='".$row['order_sn']."'";
				$row4 = $GLOBALS['db']->getRow($sql4);

				$sql = "select * from m_order_goods  where order_id=".$row['order_id'];
				$order_list = $GLOBALS['db']->getAll($sql);
				$good_str="";
				foreach($order_list as $v2)
				{
					if($v2['goods_number']>1)
					$good_str.=$v2['goods_name']." - ".$v2['goods_sn']." * ".$v2['goods_number'];
					else
					$good_str.=$v2['goods_name']." - ".$v2['goods_sn'];
				}
				$data[$key]['order_id']=$row['order_id'];
				$data[$key]['order_sn']="'".$row['order_sn'];
				$data[$key]['downloadid']="'".$row['downloadid'];
				$data[$key]['out_trade_no']="'".$row4['out_trade_no'];
				$data[$key]['user_id']=$row['user_id'];
				$data[$key]['consignee']=$row['consignee'];
				$data[$key]['mobile']=$row['mobile'];
				$data[$key]['address']=$this->get_address($row)." ".$row['address'];
				$data[$key]['pay_name']=$row['pay_name'];
				$data[$key]['pay_time']=($row['pay_time']==0) ? "未支付" : date("Y-m-d H:i:s",$row['pay_time']+8*3600);
				$data[$key]['goods_amount']=$row['goods_amount'];
				$data[$key]['money_paid']=$row['money_paid']+$row['surplus'];
				$data[$key]['goods_name']=$good_str;
				$total++;
				$total_money=$total_money+$data[$key]['money_paid'];
			}

		}
		$title_arr[] = array('Order_id','订单编号','clop中订单号','会员编号','收货人','手机号','收货地址','支付方式','支付时间','商品金额','已付款','商品名称');
		$datelist = array_merge ($title_arr,$data);
		if($type=="all")
		$this->outputCsvHeader($datelist,"招商银行订单_".date("Ymd"));
		else
		$this->outputCsvHeader($datelist,"招商银行订单已付款_".date("Ymd"));
		$danjia=sprintf("%.2f", $total_money/$total);;
		echo mb_convert_encoding("\n订单数:,		".$total.",	总金额:,		".$total_money.",	客单价:,		".$danjia, 'gbk', 'utf-8');
		//echo mb_convert_encoding("\n当前订单数:".$statistics['mun'].",		当前订单总金额:".$statistics['total_fee'].",	当前商品总数量:".$statistics['goods_number']		.",	当前订单总运费:".$statistics['shipping_fee']	.",	当前订单总积分:".$statistics['integral'], 'gbk', 'utf-8');
	}
	function order_temp2()
	{
		//$sql = "select * from m_order_info ";
		$sql = "select * from m_order_info where FROM_UNIXTIME(add_time,'%Y-%m-%d %H:%i:%s')>'2016-03-03 16:00:01' and FROM_UNIXTIME(add_time,'%Y-%m-%d %H:%i:%s')<'2016-03-06 16:00:00'";
		$goods_list = $GLOBALS['db']->getAll($sql);
		$data=array();
		$total=0;
		$total_money=0;
		$total_wei=0;
		$total_yi=0;
		foreach($goods_list as $key =>$row)
		{

			$sql = "select * from m_order_goods  where  order_id=".$row['order_id'];
			$goods_row = $GLOBALS['db']->getRow($sql);
			if($goods_row)
			{
				$sql3="select * from m_users where user_id=".$row['user_id'];
				$row3 = $GLOBALS['db']->getRow($sql3);
				$sql4="select * from m_weixin_pay_log where order_sn='".$row['order_sn']."'";
				$row4 = $GLOBALS['db']->getRow($sql4);

				$sql = "select * from m_order_goods  where order_id=".$row['order_id'];
				$order_list = $GLOBALS['db']->getAll($sql);
				$good_str="";
				foreach($order_list as $v2)
				{
					if($v2['goods_number']>1)
					$good_str.=$v2['goods_name']." - ".$v2['goods_sn']." * ".$v2['goods_number'];
					else
					$good_str.=$v2['goods_name']." - ".$v2['goods_sn'];
				}
				$data[$key]['order_id']=$row['order_id'];
				$data[$key]['order_sn']="'".$row['order_sn'];
				$data[$key]['downloadid']="'".$row['downloadid'];
				$data[$key]['user_id']=$row['user_id'];
				$data[$key]['consignee']=$row['consignee'];
				$data[$key]['mobile']=$row['mobile'];
				$data[$key]['address']=$this->get_address($row)." ".$row['address'];
				$data[$key]['pay_name']=$row['pay_name'];
				$data[$key]['pay_time']=($row['pay_time']==0) ? "未支付" : date("Y-m-d H:i:s",$row['pay_time']+8*3600);
				if($row['pay_time']==0)
				$total_wei++;
				else
				$total_yi++;
				$data[$key]['goods_amount']=$row['goods_amount'];
				$data[$key]['money_paid']=$row['money_paid']+$row['surplus'];
				$data[$key]['goods_name']=$good_str;
				$total++;
				$total_money=$total_money+$data[$key]['money_paid'];
			}


		}
		$title_arr[] = array('Order_id','订单编号','clop中订单号','会员编号','收货人','手机号','收货地址','支付方式','支付时间','商品金额','已付款','商品名称');
		$datelist = array_merge ($title_arr,$data);
		if($type=="all")
		$this->outputCsvHeader($datelist,"招商银行订单_".date("Ymd"));
		else
		$this->outputCsvHeader($datelist,"招商银行订单已付款_".date("Ymd"));
		$danjia=sprintf("%.2f", $total_money/$total);;
		echo mb_convert_encoding("\n订单数:,		".$total.",	总金额:,		".$total_money.",	客单价:,		".$danjia.",	已支付:,		".$total_yi.",	未支付:,		".$total_wei, 'gbk', 'utf-8');
		//echo mb_convert_encoding("\n当前订单数:".$statistics['mun'].",		当前订单总金额:".$statistics['total_fee'].",	当前商品总数量:".$statistics['goods_number']		.",	当前订单总运费:".$statistics['shipping_fee']	.",	当前订单总积分:".$statistics['integral'], 'gbk', 'utf-8');
	}
	/**
	 * 优惠券
	 *
	 */
	function order_bonus_temp()
	{
		//$sql = "select * from m_order_info ";
		$bonus_type_id=200;
		$sql = "select * from m_user_bonus  where bonus_type_id=".$bonus_type_id." and order_id>0 and FORM_UNIXTIME(used_time,'%Y-%m-%d %H:%i:%s')>2016-02-01 00:00:00  and FORM_UNIXTIME(used_time,'%Y-%m-%d %H:%i:%s')<2016-02-29 23:59:59 ";
		$goods_list = $GLOBALS['db']->getAll($sql);
		$data=array();
		$total=0;
		$total_money=0;
		$total_wei=0;
		$total_yi=0;
		foreach($goods_list as $key =>$row)
		{

			$sql = "select * from m_order_goods  where goods_id in(6203,6349,7115,6348,6344,6345,6346,7023,7024,7025,6296,4769,2075,6091) and order_id=".$row['order_id'];
			$goods_row = $GLOBALS['db']->getRow($sql);
			if($goods_row)
			{
				$sql3="select * from m_users where user_id=".$row['user_id'];
				$row3 = $GLOBALS['db']->getRow($sql3);
				$sql4="select * from m_weixin_pay_log where order_sn='".$row['order_sn']."'";
				$row4 = $GLOBALS['db']->getRow($sql4);

				$sql = "select * from m_order_goods  where order_id=".$row['order_id'];
				$order_list = $GLOBALS['db']->getAll($sql);
				$good_str="";
				foreach($order_list as $v2)
				{
					if($v2['goods_number']>1)
					$good_str.=$v2['goods_name']." - ".$v2['goods_sn']." * ".$v2['goods_number'];
					else
					$good_str.=$v2['goods_name']." - ".$v2['goods_sn'];
				}
				$data[$key]['order_id']=$row['order_id'];
				$data[$key]['order_sn']="'".$row['order_sn'];
				$data[$key]['downloadid']="'".$row['downloadid'];
				$data[$key]['user_id']=$row['user_id'];
				$data[$key]['consignee']=$row['consignee'];
				$data[$key]['mobile']=$row['mobile'];
				$data[$key]['address']=$this->get_address($row)." ".$row['address'];
				$data[$key]['pay_name']=$row['pay_name'];
				$data[$key]['pay_time']=($row['pay_time']==0) ? "未支付" : date("Y-m-d H:i:s",$row['pay_time']+8*3600);
				if($row['pay_time']==0)
				$total_wei++;
				else
				$total_yi++;
				$data[$key]['goods_amount']=$row['goods_amount'];
				$data[$key]['money_paid']=$row['money_paid']+$row['surplus'];
				$data[$key]['goods_name']=$good_str;
				$total++;
				$total_money=$total_money+$data[$key]['money_paid'];
			}


		}
		$title_arr[] = array('Order_id','订单编号','clop中订单号','会员编号','收货人','手机号','收货地址','支付方式','支付时间','商品金额','已付款','商品名称');
		$datelist = array_merge ($title_arr,$data);
		if($type=="all")
		$this->outputCsvHeader($datelist,"招商银行订单_".date("Ymd"));
		else
		$this->outputCsvHeader($datelist,"招商银行订单已付款_".date("Ymd"));
		$danjia=sprintf("%.2f", $total_money/$total);;
		echo mb_convert_encoding("\n订单数:,		".$total.",	总金额:,		".$total_money.",	客单价:,		".$danjia.",	已支付:,		".$total_yi.",	未支付:,		".$total_wei, 'gbk', 'utf-8');
		//echo mb_convert_encoding("\n当前订单数:".$statistics['mun'].",		当前订单总金额:".$statistics['total_fee'].",	当前商品总数量:".$statistics['goods_number']		.",	当前订单总运费:".$statistics['shipping_fee']	.",	当前订单总积分:".$statistics['integral'], 'gbk', 'utf-8');
	}
	function order_temp()
	{
		//$sql = "select * from m_order_info ";
		$sql = "select * from m_order_info  where  add_time>1456529160";
		$goods_list = $GLOBALS['db']->getAll($sql);
		$data=array();
		$total=0;
		$total_money=0;
		$total_wei=0;
		$total_yi=0;
		foreach($goods_list as $key =>$row)
		{

			$sql = "select * from m_order_goods  where goods_id in(6203,6349,7115,6348,6344,6345,6346,7023,7024,7025,6296,4769,2075,6091) and order_id=".$row['order_id'];
			$goods_row = $GLOBALS['db']->getRow($sql);
			if($goods_row)
			{
				$sql3="select * from m_users where user_id=".$row['user_id'];
				$row3 = $GLOBALS['db']->getRow($sql3);
				$sql4="select * from m_weixin_pay_log where order_sn='".$row['order_sn']."'";
				$row4 = $GLOBALS['db']->getRow($sql4);

				$sql = "select * from m_order_goods  where order_id=".$row['order_id'];
				$order_list = $GLOBALS['db']->getAll($sql);
				$good_str="";
				foreach($order_list as $v2)
				{
					if($v2['goods_number']>1)
					$good_str.=$v2['goods_name']." - ".$v2['goods_sn']." * ".$v2['goods_number'];
					else
					$good_str.=$v2['goods_name']." - ".$v2['goods_sn'];
				}
				$data[$key]['order_id']=$row['order_id'];
				$data[$key]['order_sn']="'".$row['order_sn'];
				$data[$key]['downloadid']="'".$row['downloadid'];
				$data[$key]['user_id']=$row['user_id'];
				$data[$key]['consignee']=$row['consignee'];
				$data[$key]['mobile']=$row['mobile'];
				$data[$key]['address']=$this->get_address($row)." ".$row['address'];
				$data[$key]['pay_name']=$row['pay_name'];
				$data[$key]['pay_time']=($row['pay_time']==0) ? "未支付" : date("Y-m-d H:i:s",$row['pay_time']+8*3600);
				if($row['pay_time']==0)
				$total_wei++;
				else
				$total_yi++;
				$data[$key]['goods_amount']=$row['goods_amount'];
				$data[$key]['money_paid']=$row['money_paid']+$row['surplus'];
				$data[$key]['goods_name']=$good_str;
				$total++;
				$total_money=$total_money+$data[$key]['money_paid'];
			}


		}
		$title_arr[] = array('Order_id','订单编号','clop中订单号','会员编号','收货人','手机号','收货地址','支付方式','支付时间','商品金额','已付款','商品名称');
		$datelist = array_merge ($title_arr,$data);
		if($type=="all")
		$this->outputCsvHeader($datelist,"招商银行订单_".date("Ymd"));
		else
		$this->outputCsvHeader($datelist,"招商银行订单已付款_".date("Ymd"));
		$danjia=sprintf("%.2f", $total_money/$total);;
		echo mb_convert_encoding("\n订单数:,		".$total.",	总金额:,		".$total_money.",	客单价:,		".$danjia.",	已支付:,		".$total_yi.",	未支付:,		".$total_wei, 'gbk', 'utf-8');
		//echo mb_convert_encoding("\n当前订单数:".$statistics['mun'].",		当前订单总金额:".$statistics['total_fee'].",	当前商品总数量:".$statistics['goods_number']		.",	当前订单总运费:".$statistics['shipping_fee']	.",	当前订单总积分:".$statistics['integral'], 'gbk', 'utf-8');
	}
	//http://192.168.1.101/feature/cvs/cvs.php?act=order_missing_downloadid_all
	function order_missing_downloadid_all()
	{
		$time=time()-300*86400;
		$sql = "select * from m_order_info  where order_status!=2 and pay_status=2 and (length(downloadid)<3 or downloadid is null) and ptstatus=1 and add_time>".$time;
		$goods_list = $GLOBALS['db']->getAll($sql);
		$data=array();
		$total=0;
		foreach($goods_list as $key =>$row)
		{
			$sql3="select * from m_users where user_id=".$row['user_id'];
			$row3 = $GLOBALS['db']->getRow($sql3);
			$sql4="select * from m_weixin_pay_log where order_sn='".$row['order_sn']."'";
			$row4 = $GLOBALS['db']->getRow($sql4);

			$sql = "select * from m_order_goods  where order_id=".$row['order_id'];
			$order_list = $GLOBALS['db']->getAll($sql);
			$good_str="";
			foreach($order_list as $v2)
			{
				if($v2['goods_number']>1)
				$good_str.=$v2['goods_name']." - ".$v2['goods_sn']." * ".$v2['goods_number'];
				else
				$good_str.=$v2['goods_name']." - ".$v2['goods_sn'];
			}
			$data[$key]['order_id']=$row['order_id'];
			$data[$key]['order_sn']="'".$row['order_sn'];
			$data[$key]['downloadid']="'".$row['downloadid'];
			$data[$key]['user_id']=$row['user_id'];
			$data[$key]['consignee']=$row['consignee'];
			$data[$key]['mobile']=$row['mobile'];
			$data[$key]['address']=$this->get_address($row)." ".$row['address'];
			$data[$key]['pay_name']=$row['pay_name'];
			$data[$key]['pay_time']=($row['pay_time']==0) ? "未支付" : date("Y-m-d H:i:s",$row['pay_time']+8*3600);
			$data[$key]['goods_amount']=$row['goods_amount'];
			$data[$key]['money_paid']=$row['money_paid']+$row['surplus'];
			$data[$key]['goods_name']=$good_str;
			$total++;
		}
		$title_arr[] = array('Order_id','订单编号','clop中订单号','会员编号','收货人','手机号','收货地址','支付方式','		  支付时间','商品金额','已付款','商品名称');
		$datelist = array_merge ($title_arr,$data);
		$this->outputCsvHeader($datelist,"没有clop订单_".date("Ymd"));
		echo mb_convert_encoding("\n订单数:,		".$total, 'gbk', 'utf-8');
		//echo mb_convert_encoding("\n当前订单数:".$statistics['mun'].",		当前订单总金额:".$statistics['total_fee'].",	当前商品总数量:".$statistics['goods_number']		.",	当前订单总运费:".$statistics['shipping_fee']	.",	当前订单总积分:".$statistics['integral'], 'gbk', 'utf-8');
	}
	function get_cmbchina_order_id()
	{
		$str='
2016010681856
2016010611573
2016021812649
';
		$str=explode("
",$str);
		foreach($str as $v)
		{
			if($v)
			{
				$sql2="select order_id from m_order_info where order_sn='".$v."'";
				$order_id = $GLOBALS['db']->getOne($sql2);
				$order_id="000000000".$order_id;
				echo "'".substr($order_id,-10);
				echo "<BR>";
			}
		}
	}
	/**
	 * http://www.wm18.com/feature/cvs/cvs.php?act=tuan_order_all
	 *
	 */
	function tuan_order_all()
	{
		$sql = "select og.order_id,og.tuan_id,og.zhuanyuan_id,pt.id,og.goods_number from m_order_goods og,m_pintuaninfo pt where og.tuan_id=pt.id AND pt.pintuan_id=0 group by og.order_id";
		$goods_list = $GLOBALS['db']->getAll($sql);
		$data=array();
		foreach($goods_list as $key =>$row)
		{
			//$sql2="select oi.* from m_order_info oi where oi.order_id=".$row['order_id']." and c.ptstatus=1 AND c.pay_status =2 and shenhe=1 and FROM_UNIXTIME(pay_time,'%Y-%m-%d')>='2016-01-20'";
			$sql2="select oi.* from m_order_info oi where oi.order_id=".$row['order_id']." and oi.pay_status=2";
			$row2 = $GLOBALS['db']->getRow($sql2);
			if($row2)
			{
				$sql3="select * from m_users where user_id=".$row2['user_id'];
				$row3 = $GLOBALS['db']->getRow($sql3);
				$data[$key]['order_id']=$row['order_id'];
				$data[$key]['order_sn']="'".$row2['order_sn'];
				$data[$key]['user_id']=$row3['user_id'];
				$data[$key]['zhuanyuan']=$row3['zhuanyuan'];
				$data[$key]['zyname']=$row3['zyname'];
				$data[$key]['consignee']=$row2['consignee'];
				$data[$key]['mobile']=$row2['mobile'];
				$data[$key]['address']=$this->get_address($row2)." ".$row2['address'];
				$data[$key]['pay_name']=$row2['pay_name'];
				$data[$key]['pay_time']=date("Y-m-d H:i:s",$row2['pay_time']);
				$data[$key]['goods_amount']=$row2['goods_amount'];
				$data[$key]['goods_number']=$row['goods_number'];
				if($row2['ptstatus']==1)
				$ptstatus="成功";
				else if($row2['ptstatus']==2)
				$ptstatus="失败";
				else
				$ptstatus="";
				$data[$key]['ptstatus']=$ptstatus;
				$data[$key]['tuan_id']=$row['tuan_id'];
				$data[$key]['link']="http://m.wm18.com/fightgroups.php?act=fightone&zhuanyuanid=".$row2['user_id']."&tuanid=".$row['tuan_id'];
			}
		}
		$title_arr[] = array('Order_id','订单号','会员编号','专员号','专员','收货人','手机号','收货地址','支付方式','支付时间','商品金额','商品数量','状态','团ID','链接');
		$datelist = array_merge ($title_arr,$data);
		//echo "<pre>";
		//print_r($datelist);
		//die();
		$this->outputCsvHeader($datelist);
	}
	/**
	 * http://www.wm18.com/feature/cvs/cvs.php?act=goods_point
	 *积分商品
	 */

	function goods_point()
	{
		$sql="SELECT g.goods_id,g.goods_sn,g.market_price, g.goods_name,g.goods_number,g.salesnum,g.sort_order,g.extension_code, g.goods_name_style, g.product_sn, g.integral_price, g.shop_price, g.goods_type, g.goods_brief, g.goods_thumb , g.goods_img, g.is_hot, g.goods_points_img FROM ".$GLOBALS['ecs']->table('goods')." AS g WHERE  is_on_sale=1 and g.is_delete = 0 AND g.integral_price > 0 ORDER BY goods_id asc";
		$goods_list = $GLOBALS['db']->getAll($sql);
		$data=array();
		foreach($goods_list as $key =>$row)
		{
			$data[$key]['goods_id']=$row['goods_id'];
			$data[$key]['goods_sn']=$row['goods_sn'];
			$data[$key]['goods_name']=$row['goods_name'];
			$data[$key]['shop_price']=$row['shop_price'];
			$data[$key]['integral_price']=$row['integral_price'];
			$data[$key]['goods_number']=$row['goods_number'];
			$data[$key]['goods_points_img']=$row['goods_points_img'];
			$data[$key]['link']="http://www.wm18.com/goods.php?id=".$row['goods_id'];
		}
		$title_arr[] = array('产品编号','商品编号','产品名称','价格','积分','库存','积分图片','链接');
		$datelist = array_merge ($title_arr,$data);
		$this->outputCsvHeader($datelist);
	}
	function sms_log()
	{
		$sql="select * from m_sms_log where FROM_UNIXTIME(add_time,'%Y-%m-%d %H:%i:%s')>'2016-03-19 00:00:01' and FROM_UNIXTIME(add_time,'%Y-%m-%d %H:%i:%s')<'2016-03-19 23:00:00'";
		$arr = $GLOBALS['db']->getAll($sql);
		foreach($arr as $key =>$row)
		{
			$arr[$key]['add_time']=date("Y-m-d H:i:s",$row['add_time']+8*3600);
			$arr[$key]['s_succeed']=($row['s_succeed']==1) ? "发送成功" : "";
		}
		$title_arr[] = array('编号','手机号','时间','结果');
		$datelist = array_merge ($title_arr,$arr);
		$this->outputCsvHeader($datelist);
	}
	function tuan_sn()
	{
		$sql="SELECT oi.order_sn,oi.user_id,oi.address,oi.consignee,oi.mobile,oi.pay_name FROM m_order_info AS oi LEFT JOIN m_order_goods AS og ON oi.order_id = og.order_id WHERE oi.pay_status =2 AND og.tuan_id =347 GROUP BY (oi.user_id)";
		$arr = $GLOBALS['db']->getAll($sql);
		foreach($arr as $key =>$row)
		{
			$user_info="select CLOP_userid from m_users where user_id=".$row['user_id'];
			$user_info2=$GLOBALS['db']->getOne($user_info);
			$arr[$key]['order_sn']="'".$row['order_sn'];
			$arr[$key]['user_id']="'".$user_info2;
		}
		$title_arr[] = array('订单编号','用户编号','地址','收货人','手机','支付名称');
		$datelist = array_merge ($title_arr,$arr);
		$this->outputCsvHeader($datelist);
	}
	/**
	 * 套组商品
	 *
	 */
	function group_goods()
	{
		$sql="SELECT * from m_group_goods group by parent_id order by parent_id desc limit 0,10";
		$arr = $GLOBALS['db']->getAll($sql);
		$array=array();
		$i=0;
		foreach($arr as $key =>$row)
		{
			$sql="SELECT * from m_group_goods where parent_id=".$row['parent_id'];
			$arr2 = $GLOBALS['db']->getAll($sql);
			$product_info=$GLOBALS['db']->getRow("SELECT * from m_goods where goods_id=".$row['parent_id']);
			$array[$i]['goods_id']=$product_info['goods_id'];
			$array[$i]['product_name']=$product_info['goods_name'];
			$array[$i]['shop_price']=$product_info['shop_price'];
			$array[$i]['MinQuantity']='父结点';
			$array[$i]['MaxQuantity']='父结点';
			$i++;

			//var_dump($product_info);die();
			foreach($arr2 as $key2 =>$row2)
			{
				
				$product_child_info=$GLOBALS['db']->getRow("SELECT * from m_goods where goods_id=".$row2['goods_id']);
				$array[$i]['goods_id']=$product_child_info['goods_id'];
				$array[$i]['product_name']=$product_child_info['goods_name'];
				$array[$i]['shop_price']=$row2['goods_price'];
				$array[$i]['MinQuantity']=$row2['MinQuantity'];
				$array[$i]['MaxQuantity']=$row2['MaxQuantity'];
				/*$user_info="select CLOP_userid from m_users where user_id=".$row['user_id'];
				$user_info2=$GLOBALS['db']->getOne($user_info);
				$arr[$key]['order_sn']="'".$row['order_sn'];
				$arr[$key]['user_id']="'".$user_info2;*/
				$i++;
			}
			
		}
		$title_arr[] = array('商品编号','商品名称','商品价格','最小数量','最大数量');
		$datelist = array_merge ($title_arr,$array);
		$this->outputCsvHeader($datelist);
	}

	/**
	 * http://www.wm18.com/feature/cvs/cvs.php?act=big_wheel
	 *积分商品
	 */

	function big_wheel()
	{
		$ggkid=$_GET['ggkid'];
		$sql="SELECT * FROM ".$GLOBALS['ecs']->table('ggklog')." where ggkid=".$ggkid." ORDER BY id desc";
		$goods_list = $GLOBALS['db']->getAll($sql);
		$data=array();
		foreach($goods_list as $key =>$row)
		{
			$sql3="select * from m_users where user_id=".$row['user_id'];
			$row3 = $GLOBALS['db']->getRow($sql3);
			//抽奖次数
			$sql4="select count(*) from ".$GLOBALS['ecs']->table('ggklog')." where ggkid=".$ggkid." and user_id=".$row['user_id'];
			$count = $GLOBALS['db']->getOne($sql4);
			$data[$key]['user_id']=$row['user_id'];
			$data[$key]['user_name']=$row3['user_name'];
			$data[$key]['wx_nickname']=($row3['wx_nickname']) ? $row3['wx_nickname'] : $row3['real_name'];
			$data[$key]['CLOP_userid']="'".$row3['CLOP_userid'];
			$data[$key]['pay_points']=($row['pay_points']) ? $row['pay_points'] : $row3['pay_points'];
			$data[$key]['jiang']=$row['jiang'];
			$data[$key]['name']=$row['name'];
			$data[$key]['shouji']=$row['shouji'];
			$data[$key]['address']=$row['address'];
			$data[$key]['count']=$count;
			$data[$key]['time']=date("Y-m-d H:i:s",$row['time']+8*3600);
		}
		$title_arr[] = array('用户编号','用户名','昵称','Clop编号','积分','奖项','姓名','手机号','地址','抽奖次数','时间');
		$datelist = array_merge ($title_arr,$data);
		$this->outputCsvHeader($datelist,"CVS数据_".date("Ymd"));
	}
	function AddCustInfo($CustNo,$name,$shouji,$sheng,$shi,$qu,$address,$zip){
		if($CustNo == ''){
			return true;
		}
		$mykey = IT_KEY;
		$CustNoxx=strtolower($CustNo);
		$appkey = md5($mykey.$CustNoxx);

		$url = IT_URL.'newcustinfo.api';  //老会员激活接口
		$string = '<?xml version="1.0" encoding="utf-8"?><NewCustInfo><request_header><appkey>'.$appkey.'</appkey></request_header><request_body><CustNo>'.$CustNo.'</CustNo><CustBirthday></CustBirthday><CustHBDLevel></CustHBDLevel><LastName>'.$name.'</LastName>
    <ReceiverProvince>'.$sheng.'</ReceiverProvince>  
    <ReceiverCity>'.$shi.'</ReceiverCity>  
    <ReceiverArea>'.$qu.'</ReceiverArea>  
    <ReceiverAddress>'.$address.'</ReceiverAddress>  
    <Mobile>'.$shouji.'</Mobile>  
    <Phone></Phone>
	<FROMSOURCE>DX</FROMSOURCE>
    <Postalcode>'.$zip.'</Postalcode>  
  </request_body> 　　
</NewCustInfo>';
		$post_data = array(
		"data" => $string
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
	function outputCsvHeader($data,$file_name = 'todayOrder')
	{
		header('Content-Type: text/csv');
		$str = mb_convert_encoding($file_name, 'gbk', 'utf-8');
		header('Content-Disposition: attachment;filename="' .$str . '.csv"');
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
		header('Expires:0');
		header('Pragma:public');
		$csv_data = '';
		foreach ($data as $line)
		{
			foreach ($line as $key => &$item)
			{
				$item = str_replace (',','，',str_replace(PHP_EOL,'',$item));   //过滤生成csv文件中的(,)逗号和换行
				$item = mb_convert_encoding($item, 'gbk', 'utf-8');
			}
			$csv_data .= implode(',', $line) . PHP_EOL;
		}
		echo $csv_data;
	}
	function get_address($consignee)
	{

		$sql = "SELECT concat(IFNULL(c.region_name,''),'', IFNULL(p.region_name,''),".
		"'',IFNULL(t.region_name, ''),'', IFNULL(d.region_name, '')) AS region " .
		" FROM " . $GLOBALS['ecs']->table('region') . " c, " . $GLOBALS['ecs']->table('region') . " p, " . $GLOBALS['ecs']->table('region') . " t," . $GLOBALS['ecs']->table('region') . " d
WHERE c.region_id='".$consignee['country']."'
AND p.region_id='".$consignee['province']."'
AND t.region_id='".$consignee['city']."'
AND d.region_id='".$consignee['district']."'
";
		return $GLOBALS['db']->getOne($sql);
	}
}
define('IN_ECS', true);
require(dirname(dirname(dirname(__FILE__))) . '/includes/init.php');
@ini_set('display_errors',"On");
$act=(empty($_REQUEST['act'])) ? "main" : $_REQUEST['act'];
$cvs = new cvs();
$sign=@is_callable(array($cvs,$act));
if($sign)
$cvs->$act();
else
ecs_header("Location:http://m.wm18.com/\n");
/*create TEMPORARY table
IF not EXISTS tmp_tablen as
(
select c.*,d.tuan_id,d.zhuanyuan_id,d.id from m_order_info c,(select a.order_id,a.tuan_id,a.zhuanyuan_id,b.id from m_order_goods a,m_pintuaninfo b where a.tuan_id=b.id AND b.pintuan_id=0 group by a.order_id,a.tuan_id,a.zhuanyuan_id,b.id)d
where c.order_id=d.order_id and c.ptstatus=1 AND c.pay_status =2 and shenhe=1 and FROM_UNIXTIME(pay_time,'%Y-%m-%d')>='2016-01-20'
)
select order_id,downloadid CLOP订单号,b.out_trade_no 第三方订单号,ptstatus,pay_status,shenhe,goods_amount,consignee 客户名,FROM_UNIXTIME(b.add_time,'%Y-%m-%d') 支付时间,a.tuan_id,a.zhuanyuan_id
from  tmp_tablen a left join m_weixin_pay_log b on a.order_sn=b.order_sn order by tuan_id*/
?>