<?php

class Shop_model extends MY_Model {
	private $table_name;
	//正式购买地址 沙盒购买地址
	private $url_buy     = "https://buy.itunes.apple.com/verifyReceipt";
	private $url_sandbox = "https://sandbox.itunes.apple.com/verifyReceipt";
	private $sandbox=1;
	function __construct() {
		$this->table_name = 'shop';
		$this->table_name_info = 'shop_buy_info';
	}
	public function shopWithType($type) {
		$sql = "SELECT * FROM $this->table_name where type = $type;";
		return $this->dbBase_query($sql);
	}

	public function shopWithID($sid) {
		$sql = "SELECT * FROM $this->table_name where sid = $sid;";
		return $this->dbBase_query($sql);
	}

	public function shopCheckSIDAndType($sid,$type) {
		return $this->dbBase_select_Count_whereAND($this->table_name, array('sid'=>$sid,'type'=>$type));
	}
	public function buyStart($product_id,$bundle,$uid) {
		$sql = "SELECT * FROM $this->table_name_info where uid = '$uid' and product_id='$product_id' limit 0,1";
		$info=$this->dbBase_query($sql);
		if(empty($info))
		{
			$serial_number=$this->get_serial_number($product_id,$uid);
			$data = array(
			'uid' => $uid ,
			'product_id' => $product_id,
			'bundle' => $bundle,
			'serial_number' => $serial_number,
			'type'=> 1,
			'postdate' => time(),
			);
			$this->db->insert ( $this->table_name_info, $data );
			return $serial_number;
		}
		else
		{
			$type=@$info[0]['type'];
			if($type==1)
			return @$info[0]['serial_number'];
			elseif($type==2)
			{
				return array("已经购买成功");
			}
			elseif($type==3)
			{
				return array("已经结束");
			}
		}
	}
	public function buyFailure($serial_number,$uid) {
		$sql = "SELECT * FROM $this->table_name_info where uid = '$uid' and serial_number='$serial_number' limit 0,1";
		$info=$this->dbBase_query($sql);
		if(!empty($info))
		{
			$data=array("type"=>3);
			$this->db->where ( 'uid', $uid );
			$this->db->where ( 'serial_number', $serial_number );
			$this->db->update ( $this->table_name_info, $data );
			return array("状态修改成功");
		}
		else
		{
			return array("未找到记录");
		}
	}
	public function get_serial_number($product_id,$uid)
	{
		$serial_number=md5(uniqid().$product_id.$uid);
		return $serial_number;
	}
	/**
	 * 需要把receipt_data存储起来
	 *
	 * @param unknown_type $serial_number
	 * @param unknown_type $uid
	 * @param unknown_type $receipt_data
	 * @return unknown
	 */
	public function shopBuyCheck($serial_number,$uid,$receipt_data) {
		$sql = "SELECT * FROM $this->table_name_info where uid = '$uid' and serial_number='$serial_number' limit 0,1";
		$info=$this->dbBase_query($sql);
		if(!empty($info))
		{
			//验证参数
			if (strlen($receipt_data)<90){
				return array("非法参数");
			}
			$this->db->where ( 'uid', $uid );
			$this->db->where ( 'serial_number', $serial_number );
			$update_info=array("receipt_data"=>$receipt_data,"type"=>2);
			$this->db->update ( $this->table_name_info,$update_info);
			//请求验证
			$data = $this->acurl($receipt_data);
			//如果是沙盒数据 则验证沙盒模式
			if($data->status=='21007'){
				//请求验证
				$this->sandbox=1;
				$html = $this->acurl($receipt_data);
				//$data = json_decode($html,1);
			}
			if($data->status===0){
				return array('buy'=>'1','message'=>'购买成功');
			}else{
				return array('buy'=>'0','message'=>'购买失败');
			}

		}
		else
		{
			return array("未找到记录");
		}
	}
	function acurl($receipt_data){
		//小票信息
		$POSTFIELDS = array("receipt-data" => $receipt_data);
		$POSTFIELDS = json_encode($POSTFIELDS);

		//正式购买地址 沙盒购买地址
		$url = ($this->sandbox==1) ? $this->url_sandbox : $this->url_buy;
		$curl_handle=curl_init();
		curl_setopt($curl_handle,CURLOPT_URL, $url);
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_handle,CURLOPT_HEADER, 0);
		curl_setopt($curl_handle,CURLOPT_POST, true);
		curl_setopt($curl_handle,CURLOPT_POSTFIELDS, $POSTFIELDS);
		curl_setopt($curl_handle,CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl_handle,CURLOPT_SSL_VERIFYPEER, 0);
		$response_json =curl_exec($curl_handle);
		$response =json_decode($response_json);
		curl_close($curl_handle);
		return $response;
	}
}