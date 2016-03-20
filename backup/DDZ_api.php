<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once (APPPATH . 'libraries/Aes.php');

class DDZ_api extends MY_Controller {
	public $testParams;
	function __construct() {
		parent::__construct ();
	}
	public function test() {

		$this->log_write("helloworld0000000");

		return ;

		echo "test<br/>";

		echo Security::encrypt("hello", "B88D178C590D6A33");
		echo "test<br/>";
		echo Security::decrypt("AozZiMaFpPKgbviufysw9A==", "B88D178C590D6A33");
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
			$params["action"]="friend_mobile_check";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["contacts"]='["123456,1234567,15221584917"]';
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="friend_add";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["uid_to"]='2';
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="friend_relation";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["fid"]='2';
			$params["feedback_mark"]='2';
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="friend_my";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="user_search";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["uname"]="c";
			$params["start"]="0";
			$params["count"]="3";
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="friend_new";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["start"]="0";
			$params["count"]="3";
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="getUsersWithUserIDArray";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["uid_array_json"]="[1,2]";
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="region";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="club_create";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["name"]="my club";
			$params["region_id"]="100";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="club_edit";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["cid"]="4";
			$params["name"]="my club001";
			$params["logo"]="1";
			$params["desc"]="2";
			$params["region_id"]="3";
			$params["money"]="2";
			$params["wallpapers"]="[1,2,3]";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="club_search";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["name"]="my";
			$params["start"]="0";
			$params["count"]="1";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="club_join_request";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["cid"]="8";
			$params["desc"]="hello";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="club_join_request_list";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["cid"]="7";
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="club_join_request_delete";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["cid"]="7";
			$params["cjid"]="3";
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="club_join_request_process";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["cid"]="7";
			$params["cjid"]="4";
			$params["back_mark"]="1";
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="club_my";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="club_detail";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["cid"]=7;
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="shop_products";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["type"]=1;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="shop_buy";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["sid"]='3';
			$params["type"]='2';
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="chat_list";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["to_uid"]=2;
			$params["start_time"]="2015-12-12 09:33:27";
			$params["end_time"]="2015-12-12 09:33:33";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="chat_with_other_user";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["to_uid"]=2;
			$params["type"]=1;
			$params["msg"]="helloworld";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="pwdSendCode";
			$params["mobile"]='18939785273';
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="pwdCheckCode";
			$params["mobile"]="18939785273";
			$params["code"]="824078";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="pwdReset";
			$params["mobile"]="123456";
			$params["code"]="12345678";
			$params["newPwd"]="12345678";
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="bindMobile";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["mobile"]='18939785273';
			$params["code"]='735090';
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="club_my_doudizhu";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="bindMobileSendCode";
			$params["mobile"]='18939785273';
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="bindEmail";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["email"]="cheneylew@163.com";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="loginWithThirdParty";
			$params["type"]="3";
			$params["userid"]="5197019A3DC98F939CD9475B12ABA658";
			$params["image"]="http://qzapp.qlogo.cn/qzapp/1104992946/5197019A3DC98F939CD9475B12ABA658/100";
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="club_money_in";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["type"]=2;
			$params["money"]=100;
			$params["cid"]=4;
			$params["bid"]=0;
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="club_money_out";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["money"]=20;
			$params["cid"]=4;
			$params["to_uid"]=1;
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="club_money_history_in";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["cid"]=23;
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="club_money_history_out";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["cid"]=4;
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="borad_collection_add";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["type"]='1';
			$params["bid"]='6';
			$params["hand_card"]='H14,H14';
			$params["common_card"]='H13,H12,H11,H10,H9';
			$params["money"]=1200;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="borad_collection_list";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["start"]='0';
			$params["count"]='2';
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_user";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params[""]='';
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="club_list_detail";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["cids"]='4,5,6';
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="user_album_create";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["name"]='name';
			$params["desc"]='desc';
			$params["authority"]='1';
			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="user_album_photo_upload";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["name"]='name';
			$params["desc"]='desc';
			$params["rid"]='1';
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="user_album_select";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="user_album_select_recently";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="user_album_delete";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["uaid"]=5;

			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="club_region";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["region_id"]=25;

			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_board_history";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["beginDate"]="2016-02-25 00:00:00";
			$params["endDate"]="2016-02-25 23:59:59";
			$params["targetuid"]="71";

			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_board_history_doudizhu";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["beginDate"]="20160125";
			$params["endDate"]="20160326";

			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_board_history_datepicker";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$params["beginDate"]="2015-01-30";
			$params["endDate"]="2016-01-30";

			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="board_round_history";
			$params["bid"]=866;

			$this->testParams = json_encode($params);
			$this->index();
		}

		if (0) {
			unset($params);
			$params["action"]="get_offline_msg";
			$params["uid"]=69;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="delete_offline_msg";
			$params["msg_id_json_array"]="[1,2,3,4,5,6,7]";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="getAllOnlineBoard";
			$params["club_id_json_array"]="[1,2,3,4,5,6,7]";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="board_round_history";
			$params["bid"]="1122";
			$params["uid"]="1";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="delete_club_offline_msg";
			$params["msg_id_json_array"]="[2,3,4,5]";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="get_club_offline_msg";
			$params["clubid"]="23";
			$params["addtime"]="1455899436";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="getServerTime";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (1) {
			unset($params);
			$params["action"]="getBoardResult_doudizhu";
			$params["bid"]="71";
			$params["uid"]="80";
			$this->testParams = json_encode($params);
			$this->index();
		}
		

		if (0) {
			unset($params);
			$params["action"]="shop_buy_ucoin";
			$params["diamond"]="2";
			$params["ucoin"]="20";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_money_date_count_doudizhu";
			$params["beginDate"]="2016-03-13 00:00:00";
			$params["endDate"]="2016-03-28 23:59:59";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_preson_result_doudizhu";
			$params["uid"]=$uid;
			$params["date"]="2016-03-14";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_my_club_doudizhu";
			$params["date"]="20160315";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_my_person_doudizhu";
			$params["date"]="20160315";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_my_info_doudizhu";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_my_statistics_doudizhu";
			$params["uid"]=80;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="stat_club_board_doudizhu";
			$params["date"]="2016-03-14";
			$params["clubid"]="38";
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="get_my_detail_count_doudizhu";
			$params["beginDate"]="2014-02-28 00:00:00";
			$params["endDate"]="2018-02-28 23:59:59";
			$params["uid"]=$uid;
			$params["token"]=$token;
			$this->testParams = json_encode($params);
			$this->index();
		}
		if (0) {
			unset($params);
			$params["action"]="getBoardLastRoundResult";
			$params["bid"]="1484";
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
			if(in_array($action,get_class_methods('DDZ_api'))) {
				if ($action != "regist") {
					$this->loadModel("user_model");
					$this->loadModel("Friend_model");
				}
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

	function loginWithThirdParty($map) {
		$userid = isset($map->userid)?$map->userid:"";
		$this->checkIsEmpty('该平台UID', $userid);

		$image = isset($map->image)?$map->image:"";
		$gender = isset($map->gender)?$map->gender:"";
		$name = isset($map->name)?$map->name:"";

		$type = isset($map->type)?$map->type:"";
		$this->checkIsEmpty('该平台类型1QQ 2微信 3微博', $type);

		$this->loadModel("user_model");
		$uid = 0;
		if ($type == 1) {
			$uid = $this->user_model->insertThirdParty($userid,$image,'','','','',$gender,$name,$image);
		}elseif ($type == 2)
		{
			$uid = $this->user_model->insertThirdParty('','',$userid,$image,'','',$gender,$name,$image);
		}elseif ($type == 3)
		{
			$uid = $this->user_model->insertThirdParty('','','','',$userid,$image,$gender,$name,$image);
		}

		if ($uid) {
			$this->response->data = array($this->getUserInfo($uid,false));
		}else
		{
			$this->response->message = "第三方登录失败";
		};
		$this->echoSafeResponse();
	}

	public function registSendCode($map)
	{
		$mobile = isset($map->mobile)?$map->mobile:"";
		$this->checkIsEmpty("手机号", $mobile);

		$this->loadModel('verif_code_model');
		$res = $this->verif_code_model->getAvailableCode($mobile,10,2);
		if (count($res)) {
			$this->response->message = '10分钟内请不要重复发送！';
			$this->echoSafeResponse();
		}else
		{
			$code = $this->getVerifCode(6);
			$ok = $this->sendMessage($mobile, $code);
			if ($ok) {
				$this->verif_code_model->insert($mobile,$code,2);
				$this->response->status = 0;
				$this->response->message = '已经发送验证码到您手机，请查收！';
				$this->echoSafeResponse();
			}else
			{
				$this->response->message = '发送短信失败';
				$this->echoSafeResponse();
			}
		}
	}

	function regist($map) {
		$mobile = isset($map->mobile)?$map->mobile:"";
		$password = isset($map->password)?$map->password:"";
		$code = isset($map->code)?$map->code:"";

		$this->checkIsEmpty('手机号', $mobile);
		$this->checkIsEmpty('密码', $password);
		$this->checkIsEmpty("验证码", $mobile);

		if ($this->checkMobileAndCode($mobile, $code,2)) {
			$this->loadModel("user_model");
			$userid = $this->user_model->insert($mobile,$password,$this->makeSalt(6));
			if ($userid>0) {
				$this->response->status = 0;
				$this->response->message = '注册成功';
			}else
			{
				$this->response->message = '您的手机已经注册过了！';
			}
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = '验证码不正确';
			$this->echoSafeResponse();
		}
	}

	function login($map) {
		$mobile = isset($map->mobile)?$map->mobile:"";
		$password = isset($map->password)?$map->password:"";

		$deviceid = isset($map->deviceid)?$map->deviceid:"";
		$code = isset($map->code)?$map->code:"";

		if ($this->checkIsEmpty('手机号', $mobile)) {
			return ;
		};
		if ($this->checkIsEmpty('密码', $password)) {
			return ;
		};

		$user = $this->getUserInfoWithMobile($mobile);
		if ($user) {
			//安全模式 需要验证 登录设备UDID是否变了
			if ($user['safemode'] == 2) {
				if ($deviceid == $user['last_device_id']) {
					//同一个手机登录 不需要验证码
				}else {
					//不同手机登录需要验证码
					if ($code) {
						//校验验证码
						if ($this->checkMobileAndCode($mobile, $code,0)) {
							//校验通过继续登录
						}else
						{
							$this->response->status = 103;
							$this->response->message = '您已切换设备，验证码不正确！';
							$this->echoSafeResponse();
						}
					}else
					{
						//发送验证码
						$this->loadModel('verif_code_model');
						$res = $this->verif_code_model->getAvailableCode($mobile,10,3);
						if (count($res)) {
							$this->response->status = 102;
							$this->response->message = '您已切换设备，10分钟内请不要重复发送！';
							$this->echoSafeResponse();
						}else
						{
							$code = $this->getVerifCode(6);
							$ok = $this->sendMessage($mobile, $code);
							if ($ok) {
								$this->verif_code_model->insert($mobile,$code,0);
								$this->response->status = 100;
								$this->response->message = '您已切换设备，发送验证短信失败！';
								$this->echoSafeResponse();
							}else
							{
								$this->response->status = 101;
								$this->response->message = '您已切换设备，发送短信失败！';
								$this->echoSafeResponse();
							}
						}
					}
				};
			}
		}

		$this->loadModel("user_model");
		$status = $this->user_model->login($mobile,$password);
		if ($status != -1) {
			if (is_array($status)) {
				$this->response->status = 0;
				$this->response->message = '登录成功';
				unset($status['password']);
				unset($status['salt']);
				$status['region_name'] = $this->getRegionName($status['region_id']);
				$this->response->data = array($status);
				if ($deviceid) {
					$this->user_model->updateLoginDeviceID($status['uid'],$deviceid);
				}
			}else
			{
				$this->response->message = '登录失败(用户格式不正确)';
			}
		}else
		{
			$this->response->status = 1;
			$this->response->message = '登录失败(用户不存在)!';
		}
		$this->echoSafeResponse();

	}

	function loginWithToken($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";

		$this->checkIsEmpty('用户ID', $uid);
		$this->checkIsEmpty('用户Token', $token);

		$this->loadModel("user_model");
		$status = $this->user_model->loginWithToken($uid,$token);
		if ($status != -1) {
			if (is_array($status)) {
				$this->response->status = 0;
				$this->response->message = '登录成功';
				unset($status['password']);
				unset($status['salt']);
				$status['region_name'] = $this->getRegionName($status['region_id']);
				$this->response->data = array($status);
			}else
			{
				$this->response->message = '登录失败';
			}
		}else
		{
			$this->response->message = 'token失效过期，请从新登录';
		}
		$this->echoSafeResponse();
	}

	function updateUserInfo($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$this->checkLogin($uid, $token);

		$uname = isset($map->uname)?$map->uname:"";
		$sex = isset($map->sex)?$map->sex:"";
		$signature = isset($map->signature)?$map->signature:"";
		$region_id = isset($map->region_id)?$map->region_id:"";
		$safemode = isset($map->safemode)?$map->safemode:"0";
		$is_verify_friend = isset($map->is_verify_friend)?$map->is_verify_friend:"0";

		$this->loadModel('user_model');
		$affectrows = $this->user_model->update($uid, $uname, '', '','','',$sex,'','','','','','','',$signature,'','',$region_id,$safemode,$is_verify_friend);
		if ($affectrows) {
			$this->response->status = 0;
			$this->response->message = "更新用户信息成功";
			$this->response->data = array($this->getUserInfo($uid));
		}else
		{
			$this->response->message = "更新用户信息失败";
		}
		$this->echoSafeResponse();
	}

	public function getUsersWithUserIDArray($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$uid_array_json = isset($map->uid_array_json)?$map->uid_array_json:"0";

		$users = $this->getUsersWithIDArray(json_decode($uid_array_json));
		if (count($users)) {
			$this->response->status = 0;
			$this->response->message = "获取到用户";
			$this->response->data = $users;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有符合条件的用户";
			$this->echoSafeResponse();
		}
	}

	public function getUserInfoWithUserID($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$t_uid = isset($map->t_uid)?$map->t_uid:"";
		$this->checkIsEmpty("目标用户id", $t_uid);

		$user = $this->getUserInfo($t_uid);
		if ($user) {
			$isMyFriend = $this->checkIsMyFriend($uid, $t_uid);
			if ($isMyFriend) {
				$user["clubids"] = $this->getClubIDSWithUserId($user['uid']);
				$user["isMyFriend"] = TRUE;
			}else {
				$user["isMyFriend"] = FALSE;
			};

			$this->response->status = 0;
			$this->response->message = "获取到用户";
			$this->response->data = array($user);
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有符合条件的用户";
			$this->echoSafeResponse();
		}
	}

	public function pwdSendCode($map)
	{
		$mobile = isset($map->mobile)?$map->mobile:"";
		$this->checkIsEmpty("手机号", $mobile);

		$this->loadModel('verif_code_model');
		$res = $this->verif_code_model->getAvailableCode($mobile,10,0);
		if (count($res)) {
			$this->response->message = '10分钟内请不要重复发送！';
			$this->echoSafeResponse();
		}else
		{
			$code = $this->getVerifCode(6);
			$ok = $this->sendMessage($mobile, $code);
			if ($ok) {
				$this->verif_code_model->insert($mobile,$code,0);
				$this->response->status = 0;
				$this->response->message = '已经发送验证码到您手机，请查收！';
				$this->echoSafeResponse();
			}else
			{
				$this->response->message = '发送短信失败';
				$this->echoSafeResponse();
			}
		}
	}

	public function pwdCheckCode($map)
	{
		$mobile = isset($map->mobile)?$map->mobile:"";
		$this->checkIsEmpty("手机号", $mobile);

		$code = isset($map->code)?$map->code:"";
		$this->checkIsEmpty("验证码", $mobile);

		if ($this->checkMobileAndCode($mobile, $code,0)) {
			$this->response->status = 0;
			$this->response->message = '验证码校验通过';
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = '验证码输入有误';
			$this->echoSafeResponse();
		}
	}

	public function pwdReset($map)
	{
		$mobile = isset($map->mobile)?$map->mobile:"";
		$this->checkIsEmpty("手机号", $mobile);

		$code = isset($map->code)?$map->code:"";
		$this->checkIsEmpty("验证码", $mobile);

		$newPwd = isset($map->newPwd)?$map->newPwd:"";
		$this->checkIsEmpty("新密码", $newPwd);

		if ($this->checkMobileAndCode($mobile, $code,0)) {
			$affectrows = $this->user_model->update_findback_password($newPwd, $this->makeSalt(6),$mobile);
			if ($affectrows) {
				$this->response->status = 0;
				$this->response->message = '修改密码成功';
				$this->echoSafeResponse();
			}else
			{
				$this->response->message = '修改密码失败';
				$this->echoSafeResponse();
			}
		}else
		{
			$this->response->message = '验证码不正确';
			$this->echoSafeResponse();
		}
	}

	public function passwordReset($map)
	{
		$mobile = isset($map->mobile)?$map->mobile:"";
		$this->checkIsEmpty("手机号", $mobile);

		$oldPwd = isset($map->oldPwd)?$map->oldPwd:"";
		$this->checkIsEmpty("旧密码", $oldPwd);

		$arr = $this->user_model->login($mobile, $oldPwd);
		if (!is_array($arr)) {
			$this->response->message = '密码不正确';
			$this->echoSafeResponse();
		}

		$newPwd = isset($map->newPwd)?$map->newPwd:"";
		$this->checkIsEmpty("新密码", $newPwd);

		$affectrows = $this->user_model->update_findback_password($newPwd, $this->makeSalt(6),$mobile);
		if ($affectrows) {
			$this->response->status = 0;
			$this->response->message = '修改密码成功';
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = '修改密码失败';
			$this->echoSafeResponse();
		}
	}

	public function bindMobileSendCode($map)
	{
		$mobile = isset($map->mobile)?$map->mobile:"";
		$this->checkIsEmpty("手机号", $mobile);

		$this->loadModel('verif_code_model');
		$res = $this->verif_code_model->getAvailableCode($mobile,10,1);
		if (count($res)) {
			$this->response->message = '10分钟内请不要重复发送！';
			$this->echoSafeResponse();
		}else
		{
			$code = $this->getVerifCode(6);
			$ok = $this->sendMessage($mobile, $code);
			if ($ok) {
				$this->verif_code_model->insert($mobile,$code,1);
				$this->response->status = 0;
				$this->response->message = '已经发送验证码到您手机，请查收！';
				$this->echoSafeResponse();
			}else
			{
				$this->response->message = '发送短信失败';
				$this->echoSafeResponse();
			}
		}
	}

	public function bindMobile($map)
	{
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$mobile = isset($map->mobile)?$map->mobile:"";
		$code = isset($map->code)?$map->code:"";
		$this->checkIsEmpty("手机号", $mobile);
		$this->checkIsEmpty("验证码", $code);

		if ($this->checkMobileAndCode($mobile, $code,1)) {
			$affectrows = $this->user_model->update($uid, '', '', '','','','',$mobile,'','','','','','','');
			if ($affectrows) {
				$this->response->status = 0;
				$this->response->message = '绑定手机号成功';
				$this->response->data = array($mobile);
				$this->echoSafeResponse();
			}else
			{
				$this->response->message = '绑定手机号失败';
				$this->echoSafeResponse();
			}
		}else
		{
			$this->response->message = '验证码不正确';
			$this->echoSafeResponse();
		}
	}

	public function bindEmail($map)
	{
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$email = isset($map->email)?$map->email:"";
		$this->checkIsEmpty("手机号", $email);

		$affectrows = $this->user_model->update($uid, '', '', '','','','','','','','','','','','','',$email);

		if ($affectrows) {
			$this->response->status = 0;
			$this->response->message = '绑定邮箱成功';
			$this->response->data = array($email);
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = '绑定邮箱失败';
			$this->echoSafeResponse();
		}
	}

	protected function checkMobileAndCode($mobile,$code,$type)
	{
		$this->loadModel('verif_code_model');
		$res = $this->verif_code_model->getAvailableCode($mobile,10,$type);
		if (!count($res)) {
			return 0;
		}
		return ($res[0]['code'] == $code);
	}

	protected function checkLogin($uid,$token)
	{
		$this->loadModel("user_model");
		$status = $this->user_model->loginWithToken($uid,$token);
		if ($status != -1) {
			if (is_array($status)) {
				unset($status['password']);
				unset($status['salt']);
				unset($status['password']);
				unset($status['password']);
				return $status;
			}else
			{
				$this->response->message = '登录失败';
				$this->echoSafeResponse();
				exit();
			}
		}else
		{
			$this->response->message = 'token失效过期，请从新登录';
			$this->echoSafeResponse();
			exit();
		}
	}

	protected function getUserInfo($uid,$closedToken = true,$clubsJoin=FALSE) {
		$this->loadModel("user_model");
		$arr = $this->user_model->userWithUserID($uid);
		$userinfo = array();
		if (count($arr)) {
			$userinfo = $arr[0];
		}
		unset($userinfo['password']);
		unset($userinfo['salt']);
		if ($closedToken) {
			unset($userinfo['token']);
		}
		if ($userinfo) {
			$userinfo['region_name'] = $this->getRegionName($userinfo['region_id']);
		}
		if ($clubsJoin) {
			$userinfo["clubids"] = $this->getClubIDSWithUserId($userinfo['uid']);
		}
		return $userinfo;
	}

	protected function getUserInfoWithMobile($mobile,$closedToken = true) {
		$this->loadModel("user_model");
		$arr = $this->user_model->userWithMobile($mobile);
		$userinfo = array();
		if (count($arr)) {
			$userinfo = $arr[0];
		}
		unset($userinfo['password']);
		unset($userinfo['salt']);
		if ($closedToken) {
			unset($userinfo['token']);
		}
		if ($userinfo) {
			$userinfo['region_name'] = $this->getRegionName($userinfo['region_id']);
		}
		return $userinfo;
	}

	protected function getUsersWithIDArray($ids) {
		$this->loadModel("user_model");
		$list = $this->user_model->userWithUserIDArray($ids);
		return $this->filterUserSecretInfo($list);
	}

	public function getEncryKey()
	{
		$this->response->status = 0;
		$this->response->data = $this->safeKey();
		echo $this->response;
	}

	protected  function upload($isNeedThumb=TRUE,$deleteSource = FALSE) {
		$config['upload_path']      = APPPATH.'../resource/upload/photos/';
		$config['allowed_types']    = 'gif|jpg|png';
		$config['max_size']     = 1024*5;
		// 		$config['max_width']        = 1024;
		// 		$config['max_height']       = 768;
		$config ['file_name'] = date ('YmdHis').rand(1, 1000000);

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->response->message = "上传文件失败";
			$this->response->data = array(strip_tags($error["error"]));
			$this->echoSafeResponse();
			exit();
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->response->status = 0;
			$this->response->message = "上传文件成功";
			$res = array();
			$res['full_name'] = $data["upload_data"]["file_name"];
			$res['full_path'] = "resource/upload/photos/".$data["upload_data"]["file_name"];
			if ($isNeedThumb) {
				$thumbInfo = $this->resizeImage($data, 100, 100);
				$res['thumb_name'] = $thumbInfo["upload_data"]["thumb_image_name"];
				$res['thumb_path'] = "resource/upload/photos/".$thumbInfo["upload_data"]["thumb_image_name"];
			}
			if ($deleteSource) {
				$this->unlinkFileWithPath($res['full_path']);
				unset($res['full_name']);
				unset($res['full_path']);
			}
			return $res;
		}
	}

	protected  function upload_file() {
		$config['upload_path']      = APPPATH.'../resource/upload/data/';
		// 		$config['allowed_types']    = 'gif|jpg|png';
		$config['max_size']     = 1024*2;
		// 		$config['max_width']        = 1024;
		// 		$config['max_height']       = 768;
		$config ['file_name'] = date ('YmdHis').rand(1, 1000000);

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->response->message = "上传文件失败";
			$this->response->data = array(strip_tags($error["error"]));
			$this->echoSafeResponse();
			exit();
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->response->status = 0;
			$this->response->message = "上传文件成功";
			$res = array();
			$res['full_name'] = $data["upload_data"]["file_name"];
			$res['full_path'] = "resource/upload/data/".$data["upload_data"]["file_name"];
			return $res;
		}
	}

	public function do_upload()
	{
		$josn =  json_encode($this->upload(true));
		echo $josn;
		$this->log_write($josn);
	}

	protected function unlinkFileWithPath($path)
	{
		$filePath = APPPATH.'../'.$path;
		if (file_exists($filePath)) {
			@unlink($filePath);
			return true;
		}else return false;
	}

	public function upload_portrait($map)
	{
		// 		$uid=$this->get_or_post('uid');
		// 		$token=$this->get_or_post('token');

		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";

		$userInfo = $this->checkLogin($uid, $token);

		$fileInfo = $this->upload();

		$this->loadModel('user_model');
		$this->user_model->update($uid, '', '', '',$fileInfo['full_path'],$fileInfo['thumb_path'],'','','','','','','','','');

		//删除磁盘上面旧的壁纸
		if (!empty($userInfo->avatar)) {
			@unlink(APPPATH.'../'.$userInfo->avatar);
		}
		if (!empty($userInfo->avatar_thumb)) {
			@unlink(APPPATH.'../'.$userInfo->avatar_thumb);
		}

		$userInfo['avatar'] = $fileInfo['full_path'];
		$userInfo['avatar_thumb'] = $fileInfo['thumb_path'];
		$this->response->data = array($userInfo);
		$this->echoSafeResponse();
	}

	public function upload_wallpaper($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);
		if (empty($userinfo['wallpapers'])) {
			$userinfo['wallpapers']="[]";
		}

		$wallid = isset($map->wallid)?$map->wallid:"";
		$this->checkIsEmpty('壁纸编号(客户端定)', $wallid);

		$fileInfo = $this->upload(false);
		// 		$fileInfo['full_path'] = "xxxxxx";
		$this->loadModel('user_model');

		$array=json_decode($userinfo['wallpapers']);
		// 		echo json_encode($array);
		//删除已经重复的id墙纸
		foreach ($array as $idx=>$dic) {
			if ($dic->wallid==$wallid) {
				@unlink(APPPATH.'../'.$dic->wallpath);
				array_splice($array,$idx,$idx+1);
			}
		}
		// 		echo json_encode($array);

		//添加新的墙纸

		$wallpapers['wallid'] = $wallid;
		$wallpapers['wallpath'] = $fileInfo['full_path'];
		$array[count($array)] = $wallpapers;
		// 		return ;
		$this->loadModel('user_model');
		$this->user_model->update($uid, '', '', '','','','','','','','','','','','',json_encode($array));

		$this->response->message="上传壁纸成功";
		$this->response->data = array($this->getUserInfo($uid));
		$this->echoSafeResponse();
	}

	public function delete_wallpaper($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);
		if (empty($userinfo['wallpapers'])) {
			$userinfo['wallpapers']="[]";
		}

		$wallid = isset($map->wallid)?$map->wallid:"";
		$this->checkIsEmpty('壁纸编号(客户端定)', $wallid);



		$array=json_decode($userinfo['wallpapers']);
		// 		echo json_encode($array);
		//删除已经重复的id墙纸
		foreach ($array as $idx=>$dic) {
			if ($dic->wallid==$wallid) {
				@unlink(APPPATH.'../'.$dic->wallpath);
				array_splice($array,$idx,$idx+1);
			}
		}
		// 		echo json_encode($array);

		$this->loadModel('user_model');
		$this->user_model->update($uid, '', '', '','','','','','','','','','','','',json_encode($array));

		$this->response->message="删除壁纸成功";
		$this->response->data = array($this->getUserInfo($uid));
		$this->echoSafeResponse();
	}

	public function friend_mobile_check($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$contacts = isset($map->contacts)?$map->contacts:"";
		$this->checkIsEmpty('通讯录联系人(格式传入应为\"[\"1866666668\",\"1866666668\"]\")', $contacts);

		$contacts = json_decode($contacts);
		if (!count($contacts)) {
			$this->response->message = "没有手机号传入";
			$this->echoSafeResponse();
			exit();
		}

		$this->loadModel('user_model');
		$users = $this->user_model->usersWithMobiles($contacts);
		$myfiends = $this->getMyFriends($uid);
		foreach ($users as $idx=>$user) {
			foreach ($myfiends as $friend) {
				if ($user["uid"] === $friend["uid"]) {
					$users[$idx]['isMyFriend'] = true;
				}else
				{
					if (!isset($users[$idx]['isMyFriend'])) {
						$users[$idx]['isMyFriend'] = false;
					}
				};
			}
			// 			$users[$idx]["clubids"] = $this->getClubIDSWithUserId($user['uid']);
		}

		$this->response->data = $users;
		$this->echoSafeResponse();
	}

	public function friend_add($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$uid_to = isset($map->uid_to)?$map->uid_to:"";
		$this->checkIsEmpty("好友用户ID", $uid_to);

		$cnt = $this->user_model->selectUserCountWithUserID($uid_to);
		if (!$cnt) {
			$this->response->message = "您要添加的用户不存在";
			$this->echoSafeResponse();
			exit();
		}

		$from_msg = isset($map->from_msg)?$map->from_msg:"";

		$this->loadModel("friend_model");

		$sent = $this->friend_model->isSentInvitation($uid,$uid_to);
		if ($sent) {
			$this->response->message = "您的邀请已发送，无需重复发送！";
			$this->echoSafeResponse();
			exit();
		}

		$rid = $this->friend_model->insert($uid,$uid_to,$from_msg);
		if ($rid) {
			$to_user = $this->getUserInfo($uid_to);
			if ($to_user['is_verify_friend'] == 2)
			{
				$afr = $this->friend_model->updateFeedBackMark($rid,2);
				if ($afr) {
					$this->response->status = 0;
					$this->response->message = "对方已经设置自动添加您为好友了";
					$this->echoSafeResponse();
				}else
				{
					//
				}
			}else
			{
				$this->response->status = 0;
				$this->response->message = "添加好友消息已发送";
				$this->echoSafeResponse();
			}

		}else
		{
			$this->response->message = "添加好友失败";
			$this->echoSafeResponse();
		}
	}

	public function friend_relation($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$fuid = isset($map->fuid)?$map->fuid:"";
		$this->checkIsEmpty("朋友ID", $fuid);

		$feedback_mark = isset($map->feedback_mark)?$map->feedback_mark:"";
		$this->checkIsEmpty("关系标记：1拒绝 2同意", $feedback_mark);

		$this->loadModel("friend_model");

		$stat = $this->friend_model->updatefeedback($uid,$fuid,$feedback_mark);
		if ($stat) {
			$this->response->status = 0;
			if ($feedback_mark == 1) {
				$this->response->message = "处理好用关系成功，您已拒绝该好友请求";
			}else if($feedback_mark == 2){
				$this->response->message = "处理好用关系成功，您已同意该好友请求";
			}else if($feedback_mark == 3){
				$this->response->message = "处理好用关系成功，您已解除该好友关系";
				$this->friend_model->deleteFriend($uid,$fuid);
			}
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "处理好用关系失败";
			$this->echoSafeResponse();
		}
	}

	public function friend_my($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$list = $this->getMyFriends($uid);
		foreach ($list as $idx =>$friend) {
			// 			$list[$idx]["clubids"] = $this->getClubIDSWithUserId($friend['uid']);
		}
		if (count($list)) {
			$this->response->status = 0;
			$this->response->message = "查询都您的好友";
			$this->response->data = $list;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "您还没有好友";
			$this->echoSafeResponse();
		}
	}

	public function friend_check_is_my_friend($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$uid_to = isset($map->uid_to)?$map->uid_to:"";
		$userinfo = $this->checkLogin($uid, $token);

		$this->checkIsEmpty("目标用户ID", $uid_to);

		$this->loadModel("friend_model");
		$cnt = $this->friend_model->checkIsMyFriend($uid,$uid_to);
		if ($cnt) {
			$this->response->status = 0;
			$this->response->message = "是好友关系";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "不是好友关系";
			$this->echoSafeResponse();
		}
	}

	protected function checkIsMyFriend($uid,$uid_to)
	{
		$this->loadModel("friend_model");
		$cnt = $this->friend_model->checkIsMyFriend($uid,$uid_to);
		return $cnt;
	}

	public function friend_new($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$start = isset($map->start)?$map->start:"0";
		$count = isset($map->count)?$map->count:"20";

		$this->loadModel("friend_model");
		$list = $this->friend_model->selectNewFriend($uid,$start,$count);
		// 		echo json_encode($list);
		$array = array();
		foreach ($list as $friend) {
			array_push($array, $friend['uid_from']);
		}
		// 		echo json_encode($array);
		$users = $this->getUsersWithIDArray($array);
		foreach ($users as $idx =>$user) {
			foreach ($list as $friend) {
				if ($user['uid'] == $friend['uid_from']) {
					$users[$idx]['friend_info'] = $friend;
				}
			}
			// 			$users[$idx]["clubids"] = $this->getClubIDSWithUserId($user['uid']);
		}

		if (count($users)) {


			$this->response->status = 0;
			$this->response->message = "查询都您的新好友";
			$this->response->data = $users;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "您还没有新好友";
			$this->echoSafeResponse();
		}
	}

	public function user_search($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);
		$uname = isset($map->token)?$map->uname:"";
		$this->checkIsEmpty("用户昵称", $uname);

		$start = isset($map->start)?$map->start:"0";
		$count = isset($map->count)?$map->count:"2";

		$this->loadModel("user_model");
		$list = $this->user_model->usersWithUname($uname,$start,$count);
		if (count($list)) {
			$this->response->status = 0;
			$this->response->message = "查询到用户";
			$this->response->data = $this->filterUserSecretInfo($list);
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有查询到用户";
			$this->echoSafeResponse();
		}
	}

	protected function getMyFriends($uid) {
		$this->loadModel("friend_model");
		$addMeFriends = $this->friend_model->selectMyFriendsFrom($uid);
		$meAddFriends = $this->friend_model->selectMyFriendsTo($uid);
		$list = array_merge($addMeFriends, $meAddFriends);
		return $this->filterUserSecretInfo($list);
	}

	protected function filterUserSecretInfo($userArray) {
		$res = array();
		if (count($userArray) && is_array($userArray)) {
			foreach ($userArray as $user) {
				unset($user['password']);
				unset($user['salt']);
				unset($user['token']);
				$user['region_name'] = $this->getRegionName($user['region_id']);
				array_push($res, $user);
			}
		}
		return  $res;
	}

	private function getRegionName($regionID) {
		$this->loadModel("region_model");
		return $this->region_model->reginNameWithID($regionID);
	}

	public function region($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$this->loadModel("region_model");
		$hotCities = $this->region_model->selectHotCity();
		$provices = $this->region_model->selectMainProvice();
		if (count($provices)) {
			$this->response->status = 0;
			$this->response->message = "查询到用户";
			$this->response->data = array($hotCities,$provices);
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有到用户";
			$this->echoSafeResponse();
		}
	}

	protected function getClubWithClubID($cid)
	{
		$this->loadModel('club_model');
		$array = $this->club_model->clubWithID($cid);
		if (count($array)) {
			return $array[0];
		}else return array();
	}

	protected function getClubIDSWithUserId($uid)
	{
		$this->loadModel('club_model');
		$array = $this->club_model->clubIDSWithUID($uid);
		if (count($array)) {
			return $array;
		}else return array();
	}

	protected function checkIsUserClub($cid,$uid)
	{
		$this->loadModel("club_model");
		$ok = $this->club_model->checkUserClub($cid,$uid);
		if (count($ok)) {
			return true;
		}else
		{
			$this->response->message = "没有权限操作它人的俱乐部";
			$this->echoSafeResponse();
		}
	}

	public function club_create($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$name = isset($map->name)?$map->name:"";
		$region_id = isset($map->region_id)?$map->region_id:"";
		$uid_create = $uid;

		$this->checkIsEmpty('俱乐部名称', $name);
		$this->checkIsEmpty('所在城市或省份', $region_id);
		$this->checkIsEmpty('创建用户的ID', $uid_create);


		$this->loadModel("doudizhu_club_model");
		$ok = $this->doudizhu_club_model->insert($name,$region_id,$uid_create);

		if ($ok) {
			$this->loadModel('clubUser_model');
			$this->clubUser_model->insert($ok,$uid);
			$this->response->status = 0;
			$this->response->message = "创建俱乐部成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "创建俱乐部失败";
			$this->echoSafeResponse();
		}
	}

	public function club_edit($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$name = isset($map->name)?$map->name:"";
		$logo = isset($map->logo)?$map->logo:"";
		$desc = isset($map->desc)?$map->desc:"";
		$region_id = isset($map->region_id)?$map->region_id:"";

		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel("club_model");
		$ok = $this->club_model->update($cid,$name,$logo,$desc,$region_id,'','','','','');

		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "俱乐部修改成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "俱乐部没有任何修改";
			$this->echoSafeResponse();
		}
	}

	public function club_delete($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel("club_model");

		$isUsersClub = $this->club_model->checkUserClub($cid,$uid);
		if (!$isUsersClub) {
			$this->response->message = "不是该会员的俱乐部";
			$this->echoSafeResponse();
		}

		$ok = $this->club_model->delete($cid);
		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "俱乐部删除成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "俱乐部删除失败";
			$this->echoSafeResponse();
		}
	}

	public function club_search($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$name = isset($map->name)?$map->name:"";
		$this->checkIsEmpty('俱乐部名称', $name);

		$start = isset($map->start)?$map->start:"0";
		$count = isset($map->count)?$map->count:"20";

		$this->loadModel("club_model");
		$array = $this->club_model->clubsWithName($name,$start,$count);

		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "俱乐部查询成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有查到俱乐部";
			$this->echoSafeResponse();
		}
	}

	public function club_region($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$region_id = isset($map->region_id)?$map->region_id:"";
		$this->checkIsEmpty('俱乐部地区', $region_id);

		$start = isset($map->start)?$map->start:"0";
		$count = isset($map->count)?$map->count:"20";

		$this->loadModel("club_model");
		$array = $this->club_model->clubsWithRegionID($region_id,$start,$count);

		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "俱乐部查询成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有查到俱乐部";
			$this->echoSafeResponse();
		}
	}
	public function club_detail($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel("club_model");
		$array = $this->club_model->clubWithCid($cid);

		if (count($array)) {
			$this->loadModel('clubUser_model');
			$userids = array();
			$cusers = $this->clubUser_model->clubUsersWithCid($cid);
			if (count($cusers)) {
				foreach ($cusers as $clubUser) {
					array_push($userids, $clubUser['uid']);
				}
			}

			$array[0]['users'] = $this->getUsersWithIDArray($userids);
			$array[0]['creater'] = $this->getUserInfo($array[0]['uid_create']);


			$this->response->status = 0;
			$this->response->message = "俱乐部查询成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有查到俱乐部";
			$this->echoSafeResponse();
		}
	}
	/**my_add**/
	public function club_my_doudizhu($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);
		$this->loadModel("doudizhu_model");
		$array = $this->doudizhu_model->myClubList($uid);

		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "俱乐部查询成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有查到俱乐部";
			$this->echoSafeResponse();
		}
	}
	/**my_add**/
	public function borad_collection_list_doudizhu($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$start = isset($map->start)?$map->start:"0";
		$count = isset($map->count)?$map->count:"15";

		$this->loadModel("doudizhu_model");
		$res = $this->doudizhu_model->show_user_collection($uid,$start,$count);
		if ($res) {
			$this->response->status = 0;
			$this->response->message = "查询收藏成功";
			$this->response->data = $res;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有收藏的牌局";
			$this->echoSafeResponse();
		}
	}
	/**my_add**/
	public function borad_collection_add_doudizhu($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$bid = isset($map->bid)?$map->bid:"";
		$this->checkIsEmpty("牌局ID", $bid);

		$seq = isset($map->seq)?$map->seq:"-1";
		$this->checkIsEmpty("第几手", $seq);

		$hand_card = isset($map->hand_card)?$map->hand_card:"";
		$this->checkIsEmpty("手牌2张", $hand_card);

		$common_card = isset($map->common_card)?$map->common_card:"";
		$this->checkIsEmpty("公共牌5张", $common_card);

		$money = isset($map->money)?$map->money:"";
		$this->checkIsEmpty("输赢金额", $money);

		$type = isset($map->type)?$map->type:"";
		$this->checkIsEmpty("输还是赢", $type);

		$this->loadModel("doudizhu_model");
		$rowid = $this->doudizhu_model->collection_insert($uid,$bid,$hand_card,$common_card,$money,$type,$seq);

		if ($rowid=="aleadyCollect") {
			$this->response->status = 1;
			$this->response->message = "请不要重复收藏";
			$this->echoSafeResponse();
		}
		elseif ($rowid) {
			$this->response->status = 0;
			$this->response->message = "收藏成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "收藏失败";
			$this->echoSafeResponse();
		}
	}
	/**my_add**/
	public function stat_board_history_doudizhu($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);
		$todayBegin = date("Y-m-d",time());
		$todayEnd = $todayBegin." 23:59:59";
		$beginDate = isset($map->beginDate)?$map->beginDate:$todayBegin;
		$endDate = isset($map->endDate)?$map->endDate:$todayEnd;
		$beginDate=(strlen($beginDate)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 00:00:00",$beginDate) : $beginDate;
		$endDate=(strlen($endDate)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 23:59:59",$endDate) : $endDate;
		
		$startRow = isset($map->startRow)?$map->startRow:"0";
		$count = isset($map->count)?$map->count:"20";
		$targetuid = isset($map->targetuid)?$map->targetuid:$uid;
		$clubid = isset($map->clubid)?$map->clubid:"0";
		$this->loadModel("doudizhu_statBoardHistory_model");
		$arr = $this->doudizhu_statBoardHistory_model->showHistoryWithDate($targetuid,$beginDate,$endDate,$startRow,$count,$clubid);
		if (count($arr)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $arr;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}
	/**my_add**/
	public function get_my_detail_count_doudizhu($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);
		$todayBegin = date("Y-m-d",time());
		$todayEnd = $todayBegin." 23:59:59";

		$beginDate = isset($map->beginDate)?$map->beginDate:$todayBegin;
		$endDate = isset($map->endDate)?$map->endDate:$todayEnd;
		$beginDate=(strlen($beginDate)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 00:00:00",$beginDate) : $beginDate;
		$endDate=(strlen($endDate)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 23:59:59",$endDate) : $endDate;
		

		

		$this->loadModel("doudizhu_model");
		$arr = $this->doudizhu_model->get_my_detail_count_doudizhu($uid,$beginDate,$endDate);
		if (count($arr)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $arr;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}
	/**my_add**/
	/**
	 * 个人战绩
	 *
	 * @param unknown_type $map
	 */
	public function stat_preson_result_doudizhu($map) {
		// 		$uid = isset($map->uid)?$map->uid:"";
		// 		$token = isset($map->token)?$map->token:"";
		// 		$userinfo = $this->checkLogin($uid, $token);
		$uid = isset($map->uid)?$map->uid:"";
		
		$dayBegin = isset($map->date)?$map->date:date("Y-m-d",time());
		$todayBegin=(strlen($dayBegin)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 00:00:00",$dayBegin) : $dayBegin;
		$todayEnd = (strlen($dayBegin)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 23:59:59",$dayBegin) : $dayBegin;
		$this->checkIsEmpty("日期", $todayBegin);
		$this->loadModel('doudizhu_stat_model');
		$arr = $this->doudizhu_stat_model->stat_preson_result_doudizhu($uid,$todayBegin,$todayEnd);
		if (count($arr)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $arr;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}
	
		/**my_add**/
	/**
	 * 我的详细信息--统计接口
	 *
	 * @param unknown_type $map
	 */
	public function stat_my_info_doudizhu($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		//$userinfo = $this->checkLogin($uid, $token);
		$this->loadModel('doudizhu_stat_model');
		$arr = $this->doudizhu_stat_model->stat_my_info_doudizhu($uid);
		if (count($arr)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $arr;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}
	
	/**my_add**/
	/**
	 * 我的俱乐部信息--统计接口
	 *
	 * @param unknown_type $map
	 */
	public function stat_my_club_doudizhu($map) {
		$uid = isset($map->uid)?$map->uid:"";
		//$token = isset($map->token)?$map->token:"";
		//$userinfo = $this->checkLogin($uid, $token);
		$dayBegin = isset($map->date)?$map->date:date("Y-m-d",time());
		$todayBegin=(strlen($dayBegin)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 00:00:00",$dayBegin) : $dayBegin;
		$todayEnd = (strlen($dayBegin)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 23:59:59",$dayBegin) : $dayBegin;
		$this->checkIsEmpty("日期", $todayBegin);
		
		$this->loadModel('doudizhu_stat_model');
		$arr = $this->doudizhu_stat_model->stat_my_club_doudizhu($uid,$todayBegin,$todayEnd);
		if (count($arr)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $arr;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}
		/**my_add**/
	/**
	 * 我的战绩--统计接口
	 *
	 * @param unknown_type $map
	 */
	public function stat_my_person_doudizhu($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		//$userinfo = $this->checkLogin($uid, $token);
		
		$dayBegin = isset($map->date)?$map->date:date("Y-m-d",time());
		$todayBegin=(strlen($dayBegin)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 00:00:00",$dayBegin) : $dayBegin;
		$todayEnd = (strlen($dayBegin)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 23:59:59",$dayBegin) : $dayBegin;
		$this->checkIsEmpty("日期", $todayBegin);
		
		$this->loadModel('doudizhu_stat_model');
		$arr = $this->doudizhu_stat_model->stat_my_person_doudizhu($uid,$todayBegin,$todayEnd);
		if (count($arr)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $arr;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}
		/**my_add**/
	/**
	 * 我的信息--统计接口
	 *
	 * @param unknown_type $map
	 */
	public function stat_my_statistics_doudizhu($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);
		$this->loadModel('doudizhu_stat_model');
		$arr = $this->doudizhu_stat_model->stat_my_statistics_doudizhu($uid);
		if (count($arr)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $arr;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}
	
	
	/**my_add**/
	public function stat_club_board_doudizhu($map) {
		// 		$uid = isset($map->uid)?$map->uid:"";
		// 		$token = isset($map->token)?$map->token:"";
		// 		$userinfo = $this->checkLogin($uid, $token);

		$date = isset($map->date)?$map->date:date("Y-m-d",time());
		$clubid = isset($map->clubid)?$map->clubid:"";
		$start = isset($map->start)?$map->start:"0";
		$count = isset($map->count)?$map->count:"20";

		$this->checkIsEmpty("日期", $date);
		$this->checkIsEmpty("俱乐部id", $clubid);

		$this->loadModel('doudizhu_statBoardHistory_model');
		$arr = $this->doudizhu_statBoardHistory_model->clubBoardStat($date,$clubid,$start,$count);
		if (count($arr)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $arr;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}
	/**my_add**/
	public function stat_money_date_count_doudizhu($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		//$userinfo = $this->checkLogin($uid, $token);

		$beginDate = isset($map->beginDate)?$map->beginDate:"";
		$endDate = isset($map->endDate)?$map->endDate:"";
		$beginDate=(strlen($beginDate)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 00:00:00",$beginDate) : $beginDate;
		$endDate=(strlen($endDate)==8) ? preg_replace("/(\d{4})(\d{2})(\d{2})/is","\$1-\$2-\$3 23:59:59",$endDate) : $endDate;
		$this->checkIsEmpty("起始日期", $beginDate);
		$this->checkIsEmpty("结束日期", $endDate);

		$this->loadModel('doudizhu_statBoardHistory_model');
		$arr = $this->doudizhu_statBoardHistory_model->statMoneyDayCount($uid,$beginDate,$endDate);
		if (count($arr)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $arr;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}
	public function club_exit($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel("clubUser_model");

		$isUsersClub = $this->clubUser_model->isExistInClub($cid,$uid);
		if (!$isUsersClub) {
			$this->response->message = "不是该会员的俱乐部";
			$this->echoSafeResponse();
		}

		$ok = $this->clubUser_model->delete($cid,$uid);
		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "退出俱乐部成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "退出俱乐部失败";
			$this->echoSafeResponse();
		}
	}

	public function club_list_detail($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cids = isset($map->cids)?$map->cids:"";
		$this->checkIsEmpty('俱乐部ID格式 3,4,5,6', $cids);
		$arr = explode(',', $cids);
		$this->loadModel("club_model");
		$array = $this->club_model->clubSWithCids($arr);

		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "俱乐部查询成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有查到俱乐部";
			$this->echoSafeResponse();
		}
	}

	public function club_upload_logo($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";

		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel("club_model");
		$cnt = $this->club_model->checkUserClub($cid,$uid);
		if (!count($cnt)) {
			$this->response->message = "没有权限处理这个俱乐部";
			$this->echoSafeResponse();
			exit();
		}else
		{
			$this->unlinkFileWithPath($cnt[0]['logo']);
		}

		$fileInfo = $this->upload(false);
		$ok = $this->club_model->update($cid,'',$fileInfo['full_path'],'','','','','','','');

		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "俱乐部Logo上传成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "俱乐部没有任何修改";
			$this->echoSafeResponse();
		}
	}

	public function club_upload_wallpaper($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$wallid = isset($map->wallid)?$map->wallid:"";
		$this->checkIsEmpty('壁纸编号(客户端定)', $wallid);

		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel("club_model");
		$cnt = $this->club_model->checkUserClub($cid,$uid);
		if (!count($cnt)) {
			$this->response->message = "没有权限处理这个俱乐部";
			$this->echoSafeResponse();
			exit();
		}else
		{
			$this->unlinkFileWithPath($cnt[0]['logo']);
			$fileInfo = $this->upload(false);
			if (empty($cnt[0]['wallpapers'])) {
				$cnt[0]['wallpapers']="[]";
			}
		}

		$array=json_decode($cnt[0]['wallpapers']);
		//删除已经重复的id墙纸
		foreach ($array as $idx=>$dic) {
			if ($dic->wallid==$wallid) {
				$this->unlinkFileWithPath($dic->wallpath);
				array_splice($array,$idx,$idx+1);
			}
		}
		$wallpapers['wallid'] = $wallid;
		$wallpapers['wallpath'] = $fileInfo['full_path'];
		$array[count($array)] = $wallpapers;

		$ok = $this->club_model->update($cid,'','','','','',json_encode($array),'','','');

		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "俱乐部壁纸上传成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "俱乐部没有任何修改";
			$this->echoSafeResponse();
		}
	}

	public function club_delete_wallpaper($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$wallid = isset($map->wallid)?$map->wallid:"";
		$this->checkIsEmpty('壁纸编号(客户端定)', $wallid);

		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel("club_model");
		$cnt = $this->club_model->checkUserClub($cid,$uid);
		if (!count($cnt)) {
			$this->response->message = "没有权限处理这个俱乐部";
			$this->echoSafeResponse();
			exit();
		}else
		{
			$this->unlinkFileWithPath($cnt[0]['logo']);
			// 			$fileInfo = $this->upload(false);
			if (empty($cnt[0]['wallpapers'])) {
				$cnt[0]['wallpapers']="[]";
			}
		}

		$array=json_decode($cnt[0]['wallpapers']);
		//删除已经重复的id墙纸
		foreach ($array as $idx=>$dic) {
			if ($dic->wallid==$wallid) {
				$this->unlinkFileWithPath($dic->wallpath);
				array_splice($array,$idx,$idx+1);
			}
		}

		$ok = $this->club_model->update($cid,'','','','','',json_encode($array),'','','');

		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "俱乐部壁纸删除成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "俱乐部没有任何修改";
			$this->echoSafeResponse();
		}
	}

	public function club_join_request($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$desc = isset($map->desc)?$map->desc:"";

		$this->checkIsEmpty('俱乐部ID', $cid);
		$this->checkIsEmpty('用户ID', $uid);

		$this->loadModel('clubUser_model');
		$isExist = $this->clubUser_model->isExistInClub($cid,$uid);
		if ($isExist) {
			$this->response->message = "您已经加入了这个俱乐部了";
			$this->echoSafeResponse();
		}

		$this->loadModel("clubJoinRequest_model");
		$cnt = $this->clubJoinRequest_model->countWithCidAndUid($cid,$uid);
		if ($cnt) {
			$this->response->message = "请勿重复发送申请";
			$this->echoSafeResponse();
		}

		$ok = $this->clubJoinRequest_model->insert($cid,$uid,$desc);

		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "加入俱乐部申请已发送";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "加入俱乐部失败";
			$this->echoSafeResponse();
		}
	}

	public function club_join_request_list($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->checkIsUserClub($cid, $uid);

		$this->loadModel("clubJoinRequest_model");
		$ok = $this->clubJoinRequest_model->listWithCid($cid);

		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "加入俱乐部申请列表查询成功";
			$this->response->data = $ok;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "加入俱乐部申请列表没有消息";
			$this->echoSafeResponse();
		}
	}

	public function club_join_request_delete($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cjid = isset($map->cjid)?$map->cjid:"";
		$cid = isset($map->cid)?$map->cid:"";
		$this->checkIsEmpty('申请ID', $cjid);
		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->checkIsUserClub($cid, $uid);

		$this->loadModel("clubJoinRequest_model");
		$ok = $this->clubJoinRequest_model->delete($cjid);

		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "删除俱乐部加入申请成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "删除俱乐部加入申请失败";
			$this->echoSafeResponse();
		}
	}

	public function club_join_request_process($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cjid = isset($map->cjid)?$map->cjid:"";
		$cid = isset($map->cid)?$map->cid:"";
		$back_mark = isset($map->back_mark)?$map->back_mark:"";
		$this->checkIsEmpty('申请ID', $cjid);
		$this->checkIsEmpty('俱乐部ID', $cid);
		$this->checkIsEmpty('期望的处理结果', $back_mark);

		$this->checkIsUserClub($cid, $uid);

		$this->loadModel("clubJoinRequest_model");
		$ok = $this->clubJoinRequest_model->update($cjid,'','','','1',$back_mark);

		if ($ok) {
			if ($back_mark==1) {
				$this->loadModel('clubUser_model');
				$this->clubUser_model->insert($cid,$this->clubJoinRequest_model->getRquestJoinUserId($cjid));
			};
			$this->response->status = 0;
			$this->response->message = "处理成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "处理失败";
			$this->echoSafeResponse();
		}
	}

	public function club_user_delete($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$target_uid = isset($map->uid)?$map->target_uid:"";

		$this->checkIsEmpty('俱乐部ID', $cid);
		$this->checkIsEmpty('俱乐部用户ID', $target_uid);

		$this->checkIsUserClub($cid, $uid);

		if ($uid == $target_uid) {
			$this->response->message = "不能删除俱乐部创始人";
			$this->echoSafeResponse();
		}

		$this->loadModel("clubUser_model");
		$ok = $this->clubUser_model->delete($cid,$target_uid);

		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "删除俱乐部用户成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "删除俱乐部用户败";
			$this->echoSafeResponse();
		}
	}

	public function club_money_in($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$bid = isset($map->bid)?$map->bid:"";
		$type = isset($map->type)?$map->type:"";
		$money = isset($map->money)?$map->money:"";

		$this->checkIsEmpty('基金来源类型', $type);
		$this->checkIsEmpty('贡献基金金额', $money);
		if ($type == 1) {
			$this->checkIsEmpty('来源牌局ID', $bid);
		}else if($type == 2)
		{
			$this->checkIsEmpty('贡献用户ID', $uid);
		}

		$this->loadModel('club_money_model');
		$flag = $this->club_money_model->moneyIn($uid,$cid,$bid,$type,$money);
		if ($flag == 0) {
			$this->response->status = 0;
			$this->response->message = "操作成功";
			$this->echoSafeResponse();
		}elseif ($flag == -1)
		{
			$this->response->message = "操作失败";
			$this->echoSafeResponse();
		}elseif ($flag == 1)
		{
			$this->response->message = "会员金额不足";
			$this->echoSafeResponse();
		}
	}

	public function club_money_out($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$to_uid = isset($map->to_uid)?$map->to_uid:"";
		$money = isset($map->money)?$map->money:"";
		$comment = isset($map->comment)?$map->comment:"";

		$this->checkIsEmpty('充值目标用户ID', $to_uid);
		$this->checkIsEmpty('贡献基金金额', $money);
		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel('club_money_model');
		$flag = $this->club_money_model->moneyOut($uid,$to_uid,$cid,$money,$comment);
		if ($flag == 0) {
			$this->response->status = 0;
			$this->response->message = "操作成功";
			$this->loadModel('club_model');
			$this->response->data = $this->club_model->clubMoneyWithID($cid);
			$this->echoSafeResponse();
		}elseif ($flag == -1)
		{
			$this->response->message = "操作失败";
			$this->echoSafeResponse();
		}elseif ($flag == 1)
		{
			$this->response->message = "俱乐部金额不足";
			$this->echoSafeResponse();
		}
	}

	public function club_money_history_in($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel('club_money_model');
		$array = $this->club_money_model->logIn($cid);
		if (count($array)) {
			$this->response->message = "获取到数据成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else {
			$this->response->message = "获取数据失败";
			$this->echoSafeResponse();
		}
	}

	public function club_money_history_out($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel('club_money_model');
		$array = $this->club_money_model->logOut($cid);
		if (count($array)) {
			$this->response->message = "获取到数据成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else {
			$this->response->message = "获取数据失败";
			$this->echoSafeResponse();
		}
	}

	public function shop_products($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$type = isset($map->type)?$map->type:"";
		$this->checkIsEmpty('产品类型', $type);

		$this->loadModel("shop_model");
		$array = $this->shop_model->shopWithType($type);

		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "产品查询成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有查询到产品";
			$this->echoSafeResponse();
		}
	}

	public function shop_buy_ucoin($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$diamond = isset($map->diamond)?$map->diamond:"";
		$this->checkIsEmpty('钻石数量', $diamond);

		$ucoin = isset($map->ucoin)?$map->ucoin:"";
		$this->checkIsEmpty('U币数量', $ucoin);

		if ($userinfo['diamond']<$diamond) {
			$this->response->message = "用户钻石不足";
			$this->echoSafeResponse();
		}

		$ok = $this->user_model->updateMoney($uid,$userinfo['money']+$ucoin,$userinfo['diamond']-$diamond);
		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "购买成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "购买失败";
			$this->echoSafeResponse();
		}
	}

	public function shop_buy($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$sid = isset($map->sid)?$map->sid:"";
		$this->checkIsEmpty('产品ID', $sid);

		$type = isset($map->type)?$map->type:"";
		$this->checkIsEmpty('产品类型', $type);

		$this->loadModel("shop_model");
		$products = $this->shop_model->shopWithID($sid);
		if (!count($products)) {
			$this->response->message = "没有找到对应的产品";
			$this->echoSafeResponse();
		}else
		{
			$ttype = $products[0]['type'];
			if ($ttype != $type) {
				$this->response->message = "产品类型不正确";
				$this->echoSafeResponse();
			}else
			{
				//1购买U币
				if ($type == 1) {
					$product = $products[0];
					if ($userinfo['diamond']<$product['diamond']) {
						$this->response->message = "钻石不够 请购买钻石！";
						$this->echoSafeResponse();
					}else
					{
						//检查 购买年卡 或 月卡 是否到期，没有到期 不能重复购买
						if ($sid == 14 || $sid == 26){
							$cardtype = $userinfo['card_type'];
							if ($cardtype == 1) { //月卡
								if ($this->datetimeToTimestamp($userinfo["card_month_end_time"])>time()) {
									$this->response->message = "月卡还未过期，请勿重复购买";
									$this->echoSafeResponse();
								}
							}else if ($cardtype == 2) {//年卡
								if ($this->datetimeToTimestamp($userinfo["card_year_end_time"])>time()) {
									$this->response->message = "年卡还未过期，请勿重复购买";
									$this->echoSafeResponse();
								}
							}
						}

						$ucoin = $product['ucoin']+$product['ucoin_present'];
						$diamond = $product['diamond'];

						$ok = $this->user_model->updateMoney($uid,$userinfo['money']+$ucoin,$userinfo['diamond']-$diamond);
						if ($ok) {
							//月卡和年卡需要控制时间
							if ($sid == 14) {//月卡
								$this->user_model->updateBuyProductInfo($uid,1,$this->datetime(),$this->datetime(time()+3600*24*30),"0000-00-00 00:00:00",
								"0000-00-00 00:00:00",$product['max_board'],$product['max_club'],$product['max_club_member'],$product['max_board_round_collet']);
							}else if ($sid == 26) {//年卡
								$this->user_model->updateBuyProductInfo($uid,2,"0000-00-00 00:00:00","0000-00-00 00:00:00",$this->datetime(),
								$this->datetime(time()+3600*24*365),$product['max_board'],$product['max_club'],$product['max_club_member'],$product['max_board_round_collet']);
							}

							$this->response->status = 0;
							$this->response->message = "购买成功";
							$this->echoSafeResponse();
						}else
						{
							$this->response->message = "购买失败";
							$this->echoSafeResponse();
						}
					}
				}else if($type == 2)
				{
					$product = $products[0];
					$ok = $this->user_model->updateMoney($uid,$userinfo['money'],$userinfo['diamond']+$product['diamond']);
					if ($ok) {
						$this->response->status = 0;
						$this->response->message = "充值成功";
						$this->echoSafeResponse();
					}else
					{
						$this->response->message = "充值失败";
						$this->echoSafeResponse();
					}
				}
			}
		}
	}

	public function chat_with_other_user($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$to_uid = isset($map->to_uid)?$map->to_uid:"";
		$type = isset($map->type)?$map->type:"0";
		$msg = isset($map->msg)?$map->msg:"";

		$this->checkIsEmpty('发给谁的ID', $to_uid);
		$this->checkIsEmpty('消息类型（1 普通消息 2语音 3牌局 4战绩 5提示消息(如：您已经添加了玄德，你们现在可以对话了啦！)）', $type);
		if ($type!=2) {
			$this->checkIsEmpty('消息', $msg);
		}else
		{
			$info = $this->upload_file();
			$msg = $info['full_path'];
		}

		$this->loadModel("userChat_model");
		$ok = $this->userChat_model->insert($uid,$to_uid,$type,$msg);

		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "发送消息成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "发送消息失败";
			$this->echoSafeResponse();
		}
	}

	public function chat_list($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$to_uid = isset($map->to_uid)?$map->to_uid:"";
		$this->checkIsEmpty('发给谁的ID', $to_uid);

		$start_time = isset($map->start_time)?$map->start_time:"2000-12-12 09:33:27";
		$this->checkIsEmpty('要取消息的起始时间', $start_time);

		$end_time = isset($map->end_time)?$map->end_time:"2030-12-12 09:33:27";
		$this->checkIsEmpty('要取消息的结束时间', $start_time);

		$this->loadModel("userChat_model");
		$array = $this->userChat_model->chart_range_list($uid,$to_uid,$start_time,$end_time);

		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "消息查询成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "该时间段没有消息";
			$this->echoSafeResponse();
		}
	}

	/**
	 * 俱乐部和个人用户的相册封面修改api
	 * @param unknown $map
	 */
	public function album_cover_image_upload($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$uaid = isset($map->uaid)?$map->uaid:"";
		$this->checkIsEmpty("相册的ID", $uaid);

		$path = $this->upload(TRUE,TRUE);

		$this->loadModel('userAlbum_model');
		$rowid = $this->userAlbum_model->updateCoverImage($uaid,$path['thumb_path']);
		if ($rowid) {
			$this->response->status = 0;
			$this->response->message = "更新相册封面成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "更新相册封面失败";
			$this->echoSafeResponse();
		}
	}

	public function album_photos_list($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$uaid = isset($map->uaid)?$map->uaid:"";
		$this->checkIsEmpty("相册id", $uaid);

		$this->loadModel('userAlbumPhoto_model');
		$res = $this->userAlbumPhoto_model->albumPhotosWithOnlyAlbumID($uaid);
		if (count($res)) {
			$this->response->status = 0;
			$this->response->message = "获取相册照片列表成功";
			$this->response->data = $res;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "获取相册照片列表失败";
			$this->echoSafeResponse();
		}
	}

	public function user_album_create($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$name = isset($map->name)?$map->name:"";
		$desc = isset($map->desc)?$map->desc:"";
		$rid = $uid;
		$type = 0;
		$authority = isset($map->authority)?$map->authority:0;
		$create_uid = $uid;
		$this->checkIsEmpty("相册名称", $name);

		$this->loadModel('userAlbum_model');
		$rowid = $this->userAlbum_model->insert($name,$desc,$rid,$type,$authority,$create_uid);
		if ($rowid) {
			$this->response->status = 0;
			$this->response->message = "创建相册成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "创建相册失败";
			$this->echoSafeResponse();
		}
	}

	public function user_album_select($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$this->loadModel('userAlbum_model');
		$array = $this->userAlbum_model->albumsWithUserID($uid) ;
		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "搜索相册成功";

			$this->loadModel('userAlbumPhoto_model');
			foreach ($array as $key=>$value) {
				$res = $this->userAlbumPhoto_model->albumPhotosWithAlbumID($value['uaid']);
				$array[$key]['photos'] = $res;
			}

			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "您还没有相册";
			$this->echoSafeResponse();
		}
	}

	public function user_album_select_friend($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$userid = isset($map->userid)?$map->userid:"";

		$this->loadModel('userAlbum_model');
		$array = $this->userAlbum_model->albumsWithUserID($userid) ;
		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "搜索相册成功";

			$this->loadModel('userAlbumPhoto_model');
			foreach ($array as $key=>$value) {
				$res = $this->userAlbumPhoto_model->albumPhotosWithAlbumID($value['uaid']);
				$array[$key]['photos'] = $res;
			}

			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "您还没有相册";
			$this->echoSafeResponse();
		}
	}

	public function user_album_select_recently($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$this->loadModel('userAlbumPhoto_model');
		$array = $this->userAlbumPhoto_model->albumPhotosWithUID($uid) ;
		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "已经搜索到相册照片";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有照片";
			$this->echoSafeResponse();
		}
	}

	public function user_album_delete($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$uaid = isset($map->uaid)?$map->uaid:"";
		$this->checkIsEmpty("相册ID", $uaid);

		$this->loadModel('userAlbum_model');

		$res = $this->userAlbum_model->isUsersAlbum($uid,$uaid);
		if (!$res) {
			$this->response->message = "不能操作此相册";
			$this->echoSafeResponse();
		}

		$this->loadModel('userAlbumPhoto_model');
		$array = $this->userAlbumPhoto_model->albumPhotosWithAlbumID($uaid);
		foreach ($array as $dic) {
			$this->unlinkFileWithPath($dic['avatar']);
			$this->unlinkFileWithPath($dic['avatar_thumb']);
		}

		$this->userAlbumPhoto_model->delete($uaid);

		$ok = $this->userAlbum_model->delete($uaid) ;
		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "删除相册成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "删除相册失败";
			$this->echoSafeResponse();
		}
	}

	public function user_album_update($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$uaid = isset($map->uaid)?$map->uaid:"";
		$this->checkIsEmpty("相册ID", $uaid);

		$name = isset($map->name)?$map->name:"";$this->checkIsEmpty("相册名称", $name);
		$desc = isset($map->desc)?$map->desc:"";
		$authority = isset($map->authority)?$map->authority:"";

		$this->loadModel('userAlbum_model');
		$array = $this->userAlbum_model->update($uaid,$name,$desc,$authority)  ;
		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "修改相册成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "修改相册失败";
			$this->echoSafeResponse();
		}
	}

	public function user_album_photo_upload($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$name = isset($map->name)?$map->name:"";
		$desc = isset($map->desc)?$map->desc:"";
		$rid = isset($map->rid)?$map->rid:"";
		$create_uid = $uid;
		$this->checkIsEmpty("关联的ID：可能是用户相册ID", $rid);

		$path = $this->upload(TRUE);
		// 		$path["full_path"]="sa";
		// 		$path["thumb_path"]="safasd";

		$this->loadModel('userAlbum_model');
		$this->loadModel('userAlbumPhoto_model');

		$cnt = $this->userAlbumPhoto_model->countOfAlbumPhotos($rid,0);
		if (!$cnt) {
			$this->userAlbum_model->updateCoverImage($rid,$path["thumb_path"]);
		}

		$rowid = $this->userAlbumPhoto_model->insert($name,$desc,$rid,$path["full_path"],$path["thumb_path"],$create_uid);
		if ($rowid) {
			$this->response->status = 0;
			$this->response->message = "上传照片到相册成功";
			$this->response->data = array('uapid'=>$rowid);
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "上传照片到相册失败";
			$this->echoSafeResponse();
		}
	}

	public function user_album_photo_delete($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$uapid = isset($map->uapid)?$map->uapid:"";
		$this->checkIsEmpty("照片ID", $uapid);

		$this->loadModel('userAlbumPhoto_model');
		$rowid = $this->userAlbumPhoto_model->deleteWithPhotoID($uapid);
		if ($rowid) {
			$this->response->status = 0;
			$this->response->message = "操作成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "操作失败";
			$this->echoSafeResponse();
		}
	}

	public function club_album_create($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$clubid = isset($map->clubid)?$map->clubid:"";
		$this->checkIsEmpty("俱乐部ID", $clubid);

		$name = isset($map->name)?$map->name:"";
		$desc = isset($map->desc)?$map->desc:"";
		$rid = $clubid;
		$type = 1;
		$authority = isset($map->authority)?$map->authority:0;
		$create_uid = $uid;
		$this->checkIsEmpty("相册名称", $name);

		$this->loadModel('userAlbum_model');
		$rowid = $this->userAlbum_model->insert($name,$desc,$rid,$type,$authority,$create_uid);
		if ($rowid) {
			$this->response->status = 0;
			$this->response->message = "创建相册成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "创建相册失败";
			$this->echoSafeResponse();
		}
	}

	public function club_album_select($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$clubid = isset($map->clubid)?$map->clubid:"";
		$this->checkIsEmpty("俱乐部ID", $clubid);

		$this->loadModel('userAlbum_model');
		$array = $this->userAlbum_model->albumsWithRID($clubid,1) ;
		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "搜索相册成功";

			$this->loadModel('userAlbumPhoto_model');
			foreach ($array as $key=>$value) {
				$res = $this->userAlbumPhoto_model->albumPhotosWithAlbumID($value['uaid']);
				$array[$key]['photos'] = $res;
			}

			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "您还没有相册";
			$this->echoSafeResponse();
		}
	}

	public function club_album_select_recently($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$cid = isset($map->cid)?$map->cid:"";
		$this->checkIsEmpty('俱乐部ID', $cid);

		$this->loadModel('userAlbumPhoto_model');
		$array = $this->userAlbumPhoto_model->albumPhotosWithClubID($cid) ;
		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "已经搜索到相册照片";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "没有照片";
			$this->echoSafeResponse();
		}
	}

	public function club_album_delete($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$clubid = isset($map->clubid)?$map->clubid:"";
		$this->checkIsEmpty("俱乐部ID", $clubid);

		$uaid = isset($map->uaid)?$map->uaid:"";
		$this->checkIsEmpty("相册ID", $uaid);

		$this->loadModel('userAlbum_model');

		$res = $this->userAlbum_model->isUsersAlbum($clubid,$uaid);
		if (!$res) {
			$this->response->message = "不能操作此相册";
			$this->echoSafeResponse();
		}

		$this->loadModel('userAlbumPhoto_model');
		$array = $this->userAlbumPhoto_model->albumPhotosWithAlbumID($uaid);
		foreach ($array as $dic) {
			$this->unlinkFileWithPath($dic['avatar']);
			$this->unlinkFileWithPath($dic['avatar_thumb']);
		}

		$this->userAlbumPhoto_model->delete($uaid);

		$ok = $this->userAlbum_model->delete($uaid) ;
		if ($ok) {
			$this->response->status = 0;
			$this->response->message = "删除相册成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "删除相册失败";
			$this->echoSafeResponse();
		}
	}

	public function club_album_update($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$uaid = isset($map->uaid)?$map->uaid:"";
		$this->checkIsEmpty("相册ID", $uaid);

		$name = isset($map->name)?$map->name:"";$this->checkIsEmpty("相册名称", $name);
		$desc = isset($map->desc)?$map->desc:"";
		$authority = isset($map->authority)?$map->authority:"";

		$this->loadModel('userAlbum_model');
		$array = $this->userAlbum_model->update($uaid,$name,$desc,$authority)  ;
		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "修改相册成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "修改相册失败";
			$this->echoSafeResponse();
		}
	}

	public function club_album_photo_upload($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$name = isset($map->name)?$map->name:"";
		$desc = isset($map->desc)?$map->desc:"";
		$rid = isset($map->rid)?$map->rid:"";
		$create_uid = $uid;
		$this->checkIsEmpty("关联的ID：可能是用户相册ID,俱乐部ID", $rid);

		$path = $this->upload(TRUE);
		// 		$path["full_path"]="sa";
		// 		$path["thumb_path"]="safasd";

		$this->loadModel('userAlbum_model');
		$this->loadModel('userAlbumPhoto_model');

		$cnt = $this->userAlbumPhoto_model->countOfAlbumPhotos($rid,1);
		if (!$cnt) {
			$this->userAlbum_model->updateCoverImage($rid,$path["thumb_path"]);
		}

		$rowid = $this->userAlbumPhoto_model->insert($name,$desc,$rid,$path["full_path"],$path["thumb_path"],$create_uid,1);
		if ($rowid) {
			$this->response->status = 0;
			$this->response->message = "上传照片到相册成功";
			$this->response->data = array('uapid'=>$rowid);
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "上传照片到相册失败";
			$this->echoSafeResponse();
		}
	}
	public function club_album_photo_delete($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$uapid = isset($map->uapid)?$map->uapid:"";
		$this->checkIsEmpty("照片ID", $uapid);

		$this->loadModel('userAlbumPhoto_model');
		$rowid = $this->userAlbumPhoto_model->deleteWithPhotoID($uapid);
		if ($rowid) {
			$this->response->status = 0;
			$this->response->message = "操作成功";
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "操作失败";
			$this->echoSafeResponse();
		}
	}

	public function stat_user($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		if (1) {
			$res = array();
			$res['moneyInTotal'] = 250500.543;
			$res['playCount'] = 5000;
			$res['moneyMaxPerBoard'] = 25000;
			$res['moneyMaxPerHand'] = 3000;
			$res['moneyMaxPerHand'] = 3000;
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = array($res);
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}
	public function stat_board_history_datepicker($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$token = isset($map->token)?$map->token:"";
		$userinfo = $this->checkLogin($uid, $token);

		$beginDate = isset($map->beginDate)?$map->beginDate:"";
		$endDate = isset($map->endDate)?$map->endDate:"";
		$this->checkIsEmpty("起始日期", $beginDate);
		$this->checkIsEmpty("结束日期", $endDate);

		$this->loadModel('statBoardHistory_model');
		$arr = $this->statBoardHistory_model->showCalendar($uid,$beginDate,$endDate);
		if (count($arr)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $arr;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
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

	public function board_round_history($map) {
		$bid = isset($map->bid)?$map->bid:"";
		$this->checkIsEmpty('牌桌的ID', $bid);

		$uid = isset($map->uid)?$map->uid:"";
		$this->checkIsEmpty('用户ID', $uid);

		$this->loadModel('boardRound_model');
		$array = $this->boardRound_model->boardHistory($bid,$uid);
		if (count($array)) {
			foreach ($array as $key=>$val) {
				$array[$key]["players"] = $this->boardRound_model->boardPlayersAndCards($bid,$val['seq']);
				$array[$key]["record"] = $this->boardRound_model->boardRecoards($bid,$val['seq']);
			}

			$this->response->status = 0;
			$this->response->message = "查询牌桌历史成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询牌桌历史失败";
			$this->echoSafeResponse();
		}
	}

	public function get_offline_msg($map) {
		$uid = isset($map->uid)?$map->uid:"";
		$this->checkIsEmpty('用户ID', $uid);

		$this->loadModel('userOfflineMSG_model');
		$array = $this->userOfflineMSG_model->getUserMSG($uid);
		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "查询用户消息成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询用户消息失败";
			$this->echoSafeResponse();
		}
	}

	public function delete_offline_msg($map) {
		$msg_id_json_array = isset($map->msg_id_json_array)?$map->msg_id_json_array:"";
		$this->checkIsEmpty('消息ID的JSON', $msg_id_json_array);

		$this->loadModel('userOfflineMSG_model');
		$status = $this->userOfflineMSG_model->deleteUserMSGWithIDJsonArray($msg_id_json_array);
		if ($status) {
			$this->response->status = 0;
			$this->response->message = "删除消息成功";
			$this->response->data = array($msg_id_json_array);
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "删除消息失败";
			$this->echoSafeResponse();
		}
	}

	public function get_club_offline_msg($map) {
		// 		$club_id_json_array = isset($map->club_id_json_array)?$map->club_id_json_array:"";
		// 		$this->checkIsEmpty('俱乐部ID的JSON数组', $club_id_json_array);

		$clubid = isset($map->clubid)?$map->clubid:"";
		$this->checkIsEmpty('俱乐部ID的', $clubid);

		$addtime = isset($map->addtime)?$map->addtime:"0";

		$this->loadModel('userOfflineMSG_model');
		$array = $this->userOfflineMSG_model->getClubOfflineMSG($clubid,$addtime);
		if (count($array)) {
			$this->response->status = 0;
			$this->response->message = "查询成功";
			$this->response->data = $array;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "查询失败";
			$this->echoSafeResponse();
		}
	}

	public function delete_club_offline_msg($map) {
		$msg_id_json_array = isset($map->msg_id_json_array)?$map->msg_id_json_array:"";
		$this->checkIsEmpty('消息ID的JSON', $msg_id_json_array);

		$this->loadModel('userOfflineMSG_model');
		$status = $this->userOfflineMSG_model->deleteClubMSGWithIDJsonArray($msg_id_json_array);
		if ($status) {
			$this->response->status = 0;
			$this->response->message = "删除消息成功";
			$this->response->data = array($msg_id_json_array);
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "删除消息失败";
			$this->echoSafeResponse();
		}
	}

	public function getAllOnlineBoard($map) {
		$club_id_json_array = isset($map->club_id_json_array)?$map->club_id_json_array:"";
		$this->checkIsEmpty('俱乐部ID的JSON', $club_id_json_array);

		$this->loadModel('board_model');
		$res = $this->board_model->getAllOnlineBoard($club_id_json_array);
		if (count($res)) {
			$this->response->status = 0;
			$this->response->message = "成功";
			$this->response->data = $res;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "失败";
			$this->echoSafeResponse();
		}
	}

	public function getServerTime($map) {
		$this->response->status = 0;
		$this->response->message = "获取时间成功";
		$this->response->data = time();
		$this->echoSafeResponse();
	}

	public function getBoardResult_doudizhu($map) {
		$bid = isset($map->bid)?$map->bid:"";
		$this->checkIsEmpty('牌桌ID', $bid);
		$uid = isset($map->uid)?$map->uid:"";
		$this->checkIsEmpty('用户ID', $uid);

		$this->loadModel('doudizhu_model');
		$allUsers = $this->doudizhu_model->getBoardResult($bid);
		if (count($allUsers)) {
			foreach ($allUsers as $key=>$val) {
				$user = $this->getUsersWithIDArray(array($val['seat1_uid']));
				if (count($user)) {
					$allUsers[$key]['avatar_seat1_thumb'] = $user[0]['avatar_thumb'];
				}
				$user = $this->getUsersWithIDArray(array($val['seat2_uid']));
				if (count($user)) {
					$allUsers[$key]['avatar_seat2_thumb'] = $user[0]['avatar_thumb'];
				}
				$user = $this->getUsersWithIDArray(array($val['seat3_uid']));
				if (count($user)) {
					$allUsers[$key]['avatar_seat3_thumb'] = $user[0]['avatar_thumb'];
				}
				$user = $this->getUsersWithIDArray(array($val['seat4_uid']));
				if (count($user)) {
					$allUsers[$key]['avatar_seat4_thumb'] = $user[0]['avatar_thumb'];
				}
			}
			$res['info'] = $allUsers;
			$hands = $this->doudizhu_model->allhand($bid,$uid);
			$res['allhand'] = count($hands)?$hands[0]['num']:0;
			$max = $this->doudizhu_model->maxmoneypool($bid);
			$res['maxpot'] = count($max)?$max[0]['maxmoneypool']:0;
			$this->response->status = 0;
			$this->response->message = "成功";
			$this->response->data = array($res);
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "失败";
			$this->echoSafeResponse();
		}
	}

	public function getBoardLastRoundResult($map) {
		$bid = isset($map->bid)?$map->bid:"";
		$this->checkIsEmpty('牌桌ID', $bid);

		$this->loadModel('statBoardHistory_model');
		$results = $this->statBoardHistory_model->lastBoardHand($bid);
		if (count($results)) {
			foreach ($results as $k=>$v) {
				$r = $this->getUsersWithIDArray(array($v['uid']));
				$results[$k]['avatar_thumb'] = $r[0]['avatar_thumb'];
			}
			$this->response->status = 0;
			$this->response->message = "成功";
			$this->response->data = $results;
			$this->echoSafeResponse();
		}else
		{
			$this->response->message = "失败";
			$this->echoSafeResponse();
		}
	}
}
