<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once (APPPATH . 'libraries/Aes.php');

class shop extends MY_Controller {
	public $testParams;
	function __construct() {
		parent::__construct ();
	}
	public function  unittest()
	{
		$uid = "66";
		$token = "rbbpjajilhmvauimrnzpynmzxuecjgvj";

		if (0) {
			$params["action"]="login";
			$params["mobile"]="15221584917";
			$params["password"]="123456";
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="loginWithToken";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="buyStart";
			$params["uid"]=$uid;
			$params["product_id"]=23;
			$params["bundle"]="bundle";
			$params["uid_to"]='2';
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="buyFailure";
			$params["uid"]=$uid;
			$params["serial_number"]='c5bafccdcf3f42280df44a84c9e0c900';
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (1) {
			unset($params);
			$params["action"]="shopBuyCheck";
			$params["uid"]=$uid;
			$params["serial_number"]='c5bafccdcf3f42280df44a84c9e0c900';
			$params["receipt_data"]="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";
			$this->testParams = json_encode($params);
			$this->index();
		}
		
	}
	/**
	 * 
	 * @param 用于单元测试带的参数 $testParams
	 */
	public function index()
	{
		$map = $this->safeParams($this->testParams);
		$action = isset($map->action)?$map->action:"";
		if (!empty($action)) {
			if(in_array($action,get_class_methods('shop'))) {
				$this->$action($map);
			}else
			{
				$this->response->message = "没有找到对应的方法";
				$this->echoSafeResponse();
			}
		}else
		{
			$this->response->message = "没有传入Action参数";
			$this->echoSafeResponse();
		}
	}
	//服务器二次验证代码
	/**
	 * 	在我们公司的测试服务器中，我们会连接苹果的测试服务器https://sandbox.itunes.apple.com/verifyReceipt验证。
	 *	在我们部署在线上的正式服务器中，我们会连接苹果的正式服务器https://buy.itunes.apple.com/verifyReceipt验证。
	 *	我们提交给苹果审核的是正式版，我们以为苹果审核时，我们应该连接苹果的线上验证服务器来验证购买凭证。结果我理解错了，苹果在审核App时，只会在sandbox环境购买，其产生的购买凭证，也只能连接苹果的测试验证服务器。但是审核的app又是连接的我们的线上服务器。所以我们这边的服务器无法验证通过IAP购买，造成我们app的又一次审核被拒。
	 *	解决方法是判断苹果正式验证服务器的返回code，如果是21007，则再一次连接测试服务器进行验证即可。苹果的这一篇文档上有对返回的code的详细说明 (引自 唐巧, 上边有文章地址).
	 *  测试
	 *	需要添加沙箱的测试帐号, 在itunsconnect中选择用户与职能，然后添加测试帐号, 这个帐号可以用于测试购买。 另外, 在测试的时候, 可能比较慢, 所以我的项目中加入了不可交互的HUD进行提示, 避免用户进行多次商品的添加与购买。 
	 * @param unknown $receipt
	 * @param string $isSandbox
	 * @throws Exception
	 * @return multitype:NULL
	 */
	public function storeBuyCheck($receipt, $isSandbox = false)
	{
		if ($isSandbox) {
			$endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';
		}
		else {
			$endpoint = 'https://buy.itunes.apple.com/verifyReceipt';
		}

		$postData = json_encode(
		array('receipt-data' => $receipt)
		);

		$ch = curl_init($endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);  //这两行一定要加，不加会报SSL 错误
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);


		$response = curl_exec($ch);
		$errno    = curl_errno($ch);
		$errmsg   = curl_error($ch);
		curl_close($ch);
		//判断时候出错，抛出异常
		if ($errno != 0) {
			throw new Exception($errmsg, $errno);
		}

		$data = json_decode($response);
		//判断返回的数据是否是对象
		if (!is_object($data)) {
			throw new Exception('Invalid response data');
		}
		//判断购买时候成功
		if (!isset($data->status) || $data->status != 0) {
			throw new Exception('Invalid receipt');
		}

		//返回产品的信息
		return array(
		'quantity'       =>  $data->receipt->quantity,
		'product_id'     =>  $data->receipt->product_id,
		'transaction_id' =>  $data->receipt->transaction_id,
		'purchase_date'  =>  $data->receipt->purchase_date,
		'app_item_id'    =>  $data->receipt->app_item_id,
		'bid'            =>  $data->receipt->bid,
		'bvrs'           =>  $data->receipt->bvrs
		);
	}

	public function storeBuy($param) {
		//获取 App 发送过来的数据,设置时候是沙盒状态
		$receipt   = $_GET['data'];
		$isSandbox = true;
		//开始执行验证
		try
		{
			$info = $this->storeBuyCheck($receipt, $isSandbox);
			// 通过product_id 来判断是下载哪个资源
			switch($info['product_id']){
				case 'com.application.xxxxx.xxxx':
					Header("Location:xxxx.zip");
					break;
			}
		}
		//捕获异常
		catch(Exception $e)
		{
			echo 'Message: ' .$e->getMessage();
		}
	}
	function shopBuyCheck($map)
	{
		$serial_number = isset($map->serial_number)?$map->serial_number:"";
		$this->checkIsEmpty("序列号", $serial_number);
		$uid = isset($map->uid)?$map->uid:"";
		$this->checkIsEmpty("用户编号", $uid);
		$receipt_data = isset($map->receipt_data)?$map->receipt_data:"";
		$this->checkIsEmpty("参数", $receipt_data);
		$this->loadModel("shop_model");
		$res = $this->shop_model->shopBuyCheck($serial_number,$uid,$receipt_data);
		if (count($res)) {
			$this->response->status = 0;
			$this->response->message = "数据返回成功";
			$this->response->data = $res;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "数据返回失败";
			$this->echoSafeResponse();
		}
	}
	function buyStart($map)
	{
		$product_id = isset($map->product_id)?$map->product_id:"";
		$this->checkIsEmpty("产品编号", $product_id);
		$bundle = isset($map->bundle)?$map->bundle:"";
		$this->checkIsEmpty("包名不能为空", $bundle);
		$uid = isset($map->uid)?$map->uid:"";
		$this->checkIsEmpty("用户编号", $uid);
		$this->loadModel("shop_model");
		$res = $this->shop_model->buyStart($product_id,$bundle,$uid);
		if (count($res)) {
			$this->response->status = 0;
			$this->response->message = "数据返回成功";
			$this->response->data = $res;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "数据返回失败";
			$this->echoSafeResponse();
		}
	}
	function buyFailure($map)
	{
		$serial_number = isset($map->serial_number)?$map->serial_number:"";
		$this->checkIsEmpty("序列号", $serial_number);
		$uid = isset($map->uid)?$map->uid:"";
		$this->checkIsEmpty("用户编号", $uid);
		$this->loadModel("shop_model");
		$res = $this->shop_model->buyFailure($serial_number,$uid);
		if (count($res)) {
			$this->response->status = 0;
			$this->response->message = "数据返回成功";
			$this->response->data = $res;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "数据返回失败";
			$this->echoSafeResponse();
		}
	}
}
