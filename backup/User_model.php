<?php
require_once (APPPATH . 'models/dbmodel/User.php');

class User_model extends MY_Model {
	private $table_name;
	function __construct() {
		// 		$this->load->model ( 'school_model' );
		// 		$this->load->library ( 'session' );
		$this->table_name = 'user';
	}

	/**
	 * 某个单位插入一个用户
	 * 
	 * @param 用户编号 $serial_id        	
	 * @param 单位名称 $school        	
	 * @param 用户名 $username        	
	 * @param 用户密码 $password        	
	 * @return number 插入成功返回插入行的ID,单位名称已存在返回－1
	 */
	public function insert($mobile,$password,$salt) {
		if ($this->isExist ($mobile)) {
			return - 1;
		};
		$data = array(
		'mobile' => $mobile ,
		'password' => md5($password.$salt),
		'add_time'=> date('Y-m-d H:i:s'),
		'salt' => $salt
		);
		$this->db->insert ( $this->table_name, $data );
		return $this->db->insert_id ();
	}

	public function insertThirdParty($qq_uid,$qq_image,$wechat_uid,$wechat_image,$webo_uid,$webo_image,$sex='',$uname='',$image='')
	{
		$uid = 0;
		if (!empty($qq_uid)) {
			$arrays = $this->dbBase_query("SELECT uid FROM $this->table_name where qq_uid = \"$qq_uid\";");
			if (count($arrays)) {
				$uid = $arrays[0]['uid'];
			}
		}
		if (!empty($wechat_uid)) {
			$arrays = $this->dbBase_query("SELECT uid FROM $this->table_name where wechat_uid = \"$wechat_uid\";");
			if (count($arrays)) {
				$uid = $arrays[0]['uid'];
			}
		}
		if (!empty($webo_uid)) {
			$arrays = $this->dbBase_query("SELECT uid FROM $this->table_name where webo_uid = \"$webo_uid\";");
			if (count($arrays)) {
				$uid = $arrays[0]['uid'];
			}
		}

		if ($uid)
		{
			$data = array (
			'token'=>$this->makeRandomString(32),
			'login_time'=> date('Y-m-d H:i:s'),
			);
			$data = array_filter ( $data ); // 过滤数组中的null/''/0
			$this->db->where ( 'uid', $uid);
			$this->db->update ( $this->table_name, $data );

			return $uid;
		}

		$data = array(
		'qq_uid' => $qq_uid ,
		'qq_image' => $qq_image ,
		'wechat_uid' => $wechat_uid ,
		'wechat_image' => $wechat_image ,
		'webo_uid' => $webo_uid ,
		'webo_image' => $webo_image ,
		'avatar' => $image ,
		'avatar_thumb' => $image ,
		'sex' => $sex ,
		'uname' => $uname ,
		'add_time'=> date('Y-m-d H:i:s'),
		'token'=>$this->makeRandomString(32),
		'login_time'=> date('Y-m-d H:i:s'),
		);
		$this->db->insert ( $this->table_name, $data );
		return $this->db->insert_id ();
	}
	/*
	/**
	* 通过id更新这个用户
	*
	* @param 用户id $id
	* @param 单位id $school_id
	* @param 用户名称 $username
	* @param 用户密码 $password
	* @return number －1用户名称已存在，1修改成功，0没有需要修改的或者数据不存在
	*/
	public function update($uid, $uname, $password, $salt,$avatar,$avatar_thumb,$sex,$mobile,$province,$city,$district,$money,$add_time,$login_time,$signature,$wallpapers='',$email='',$region_id=0,$safemode=0,$is_verify_friend=0) {
		$pwd = '';
		if (!empty($pwd) && !empty($salt)) {
			$pwd = md5($password.$salt);
		}
		$data = array (
		'uname' => $uname,
		'password' => $pwd,
		'salt' => $salt,
		'avatar' => $avatar,
		'sex' => $sex,
		'mobile' => $mobile,
		'email' => $email,
		'province' => $province,
		'city' => $city,
		'district' => $district,
		'money' => $money,
		'add_time' => $add_time,
		'login_time' => $login_time,
		'avatar_thumb' => $avatar_thumb,
		'signature'=>$signature,
		'wallpapers'=>$wallpapers,
		'region_id'=>$region_id,
		'safemode'=>$safemode,
		'is_verify_friend'=>$is_verify_friend,
		);

		$data = array_filter ( $data ); // 过滤数组中的null/''/0

		if (!count($data)) {
			return 0;
		}

		$this->db->where ( 'uid', $uid );
		$this->db->update ( $this->table_name, $data );

		return $this->db->affected_rows ();
	}

	public function update_findback_password($password, $salt,$mobile) {
		$data = array (
		'password' => md5($password.$salt),
		'salt' => $salt,
		'mobile' => $mobile,
		);

		$data = array_filter ( $data ); // 过滤数组中的null/''/0

		if (!count($data)) {
			return 0;
		}

		$this->db->where ( 'mobile', $mobile );
		$this->db->update ( $this->table_name, $data );

		return $this->db->affected_rows ();
	}

	public function updateMoney($uid,$money,$diamond) {
		$data = array (
		'money' => $money,
		'diamond' => $diamond,
		);

		$this->db->where ( 'uid', $uid );
		$this->db->update ( $this->table_name, $data );

		return $this->db->affected_rows ();
	}

	public function updateBuyProductInfo($uid,$card_type,$card_month_begin_time,$card_month_end_time,$card_year_begin_time,
	$card_year_end_time,$card_max_board,$card_max_club,$card_max_club_member,$card_max_board_round_collet) {
		$card_max_board=(empty($card_max_board)) ? 1 : $card_max_board;
		$card_max_club=(empty($card_max_club)) ? 2 : $card_max_club;
		$card_max_club_member=(empty($card_max_club_member)) ? 50 : $card_max_club_member;
		$card_max_board_round_collet=(empty($card_max_board_round_collet)) ? 50 : $card_max_board_round_collet;
		$data = array (
		'card_type'=>$card_type,
		'card_month_begin_time' => $card_month_begin_time,
		'card_month_end_time' => $card_month_end_time,
		'card_year_begin_time' => $card_year_begin_time,
		'card_year_end_time' => $card_year_end_time,
		'card_max_board' => $card_max_board,
		'card_max_club' => $card_max_club,
		'card_max_club_member' => $card_max_club_member,
		'card_max_board_round_collet' => $card_max_board_round_collet,
		);

		$this->db->where ( 'uid', $uid );
		$this->db->update ( $this->table_name, $data );

		return $this->db->affected_rows ();
	}

	public function updateLoginDeviceID($uid,$last_device_id) {
		$data = array (
		'last_device_id' => $last_device_id,
		);

		$this->db->where ( 'uid', $uid );
		$this->db->update ( $this->table_name, $data );

		return $this->db->affected_rows ();
	}

	public function setLoginTime($dateTime, $userid) {
		$data = array (
		'login_time' => $dateTime,
		);

		$this->db->where ( 'id', $userid );
		$this->db->update ( $this->table_name, $data );

		return $this->db->affected_rows ();
	}

	/**
	 * 删除用户
	 * 
	 * @param 单位id $school_id        	
	 * @param 单位用户名 $username        	
	 * @return number 1删除成功，0删除失败
	 */
	public function deleteUser($school_id, $username) {
		$this->db->where ( 'school_id', $school_id );
		$this->db->where ( 'username', $username );
		$this->db->delete ( $this->table_name );
		return $this->db->affected_rows ();
	}

	public function delete($id) {
		$this->db->where ( 'id', $id );
		$this->db->delete ( $this->table_name );
		return $this->db->affected_rows ();
	}

	/**
	 * 简单某个单位的用户是否存在
	 * 
	 * @param 单位ID $school_id        	
	 * @param 用户名 $username        	
	 * @return number
	 */
	public function isExist($mobile) {
		$sql = "SELECT * FROM " . $this->table_name . " where mobile = $mobile";
		$query = $this->db->query ( $sql );
		$array = $query->result_array ();
		return count ( $array );
	}

	/**
	 * 单位下的所有用户
	 * 
	 * @param 单位ID $school_id        	
	 */
	public function usersWithMobiles($mobilesArray) {
		$condition = join(",",$mobilesArray);
		$sql = "SELECT uid,uname,sex,signature,grade_name,email,avatar,avatar_thumb,mobile,wallpapers,money,vip_grade FROM " . $this->table_name . " where mobile in ($condition)";
		return $this->dbBase_query($sql);
	}

	public function userWithUserID($userid) {
		$sql = "SELECT * FROM " . $this->table_name . " where uid = $userid";
		return $this->dbBase_query($sql);
	}
	public function userWithUserIDToDetial($userid) {
		$sql = "SELECT * FROM " . $this->table_name . " where uid = $userid";
		$user_info=$this->dbBase_query($sql);
		//摊牌率
		$sql = "SELECT count(*) as total FROM (select * from board_round_log where uid = $userid and opertype=10 group by bid,seq) as b";
		$tan=$this->dbBase_query($sql);
		$sql = "SELECT count(*) as total FROM (select * from board_round_log where uid = $userid  group by bid,seq) as b";
		$tan2=$this->dbBase_query($sql);
		$percent_tanpai=(@$tan2[0]['total']>0) ? sprintf("%.2f",@$tan[0]['total']/$tan2[0]['total']*100)."%" : "0%";
		//弃牌率
		$sql = "SELECT count(*) as total FROM (select * from board_round_log where uid = $userid and opertype=2 group by bid,seq) as b";
		$tan=$this->dbBase_query($sql);
		$percent_qipai=(@$tan2[0]['total']>0) ? sprintf("%.2f",@$tan[0]['total']/$tan2[0]['total']*100)."%" : "0%";
		//入池率
		$percent_ruchi=sprintf("%.2f",100-(float)($percent_qipai/100)*100)."%";
		//胜率
		$sql = "SELECT count(*) as total FROM (select * from board_round_result where uid = $userid and won>0 group by bid,seq) as b";
		$tan=$this->dbBase_query($sql);
		$sql = "SELECT count(*) as total FROM (select * from board_round_result where uid = $userid  group by bid,seq) as b";
		$tan2=$this->dbBase_query($sql);
		$percent_shenglv=(@$tan2[0]['total']>0) ? sprintf("%.2f",@$tan[0]['total']/$tan2[0]['total']*100)."%" : "0%";
		//总盈利
		$sql = "SELECT sum(won) as total FROM (select * from board_round_result where uid = $userid group by bid,seq) as b";
		$tan=$this->dbBase_query($sql);
		$total_money=@$tan2[0]['total'];
		if(!empty($user_info[0]))
		{
			$user_info[0]['percent_shenglv']=$percent_shenglv;
			$user_info[0]['percent_tanpai']=$percent_tanpai;
			$user_info[0]['percent_ruchi']=$percent_ruchi;
			$user_info[0]['percent_qipai']=$percent_qipai;
			$user_info[0]['total_money']=$total_money;
			return $user_info;
		}
		else
		return array();

	}

	public function userWithMobile($mobile) {
		$sql = "SELECT * FROM " . $this->table_name . " where mobile = $mobile";
		$res=$this->dbBase_query($sql);
		foreach($res as $key=>$v)
		{
			$res[$key]['card_max_board']=(empty($v['card_max_board'])) ? 1 : $v['card_max_board'];
			$res[$key]['card_max_club']=(empty($v['card_max_club'])) ? 2 : $v['card_max_club'];
			$res[$key]['card_max_club_member']=(empty($v['card_max_club_member'])) ? 50 : $v['card_max_club_member'];
			$res[$key]['card_max_board_round_collet']=(empty($v['card_max_board_round_collet'])) ? 50 : $v['card_max_board_round_collet'];
		}
		return $res;
	}

	public function userWithUserIDArray($uidArray) {
		if (!count($uidArray)) {
			return 0;
		}
		$condition = join($uidArray, ',');
		$sql = "SELECT * FROM " . $this->table_name . " where uid in ($condition)";
		return $this->dbBase_query($sql);
	}

	public function usersWithUname($uname,$start=0,$count=20) {
		$sql = "SELECT * FROM " . $this->table_name . " where uname like '%$uname%' limit $start,$count";
		return $this->dbBase_query($sql);
	}

	/**
	 * 
	 * @param unknown $mobile
	 * @param unknown $password
	 * @return -1 登录失败 返回用户信息数组 登录成功
	 */
	public function login($mobile, $password) {

		$array = $this->dbBase_query("SELECT salt FROM $this->table_name where mobile=$mobile");
		if (!count($array)) {
			return -1;
		}
		$salt = $array[0]['salt'];
		$password = md5($password.$salt);
		$this->db->where ( 'mobile', $mobile );
		$this->db->where ( 'password', $password );
		$query = $this->db->get ( $this->table_name );
		$array = $query->result_array();;

		if (! count ( $array )) {
			return -1; // 用户不存在
		} else {
			$user = $array[0];
			$user['card_max_board']=(empty($user['card_max_board'])) ? 1 : $user['card_max_board'];
			$user['card_max_club']=(empty($user['card_max_club'])) ? 2 : $user['card_max_club'];
			$user['card_max_club_member']=(empty($user['card_max_club_member'])) ? 50 : $user['card_max_club_member'];
			$user['card_max_board_round_collet']=(empty($user['card_max_board_round_collet'])) ? 50 : $user['card_max_board_round_collet'];
			$data = array (
			'token'=>$this->makeRandomString(32),
			'login_time'=> date('Y-m-d H:i:s'),
			);
			$data = array_filter ( $data ); // 过滤数组中的null/''/0
			$this->db->where ( 'uid', $user['uid'] );
			$this->db->update ( $this->table_name, $data );
			$user['token'] = $data['token'];
			return $user;
		}
	}

	public function loginWithToken($uid, $token) {
		$this->db->where ( 'uid', $uid );
		$this->db->where ( 'token', $token );
		$query = $this->db->get ( $this->table_name );
		$array = $query->result_array();
		if (! count ( $array )) {
			return -1; // 无法登录
		} else {
			$user = $array[0];
			return $user;
		}
	}

	/**
	 * 用户登出
	 */
	public function logout() {
		$this->sessionClearUser ();
		$this->sessionSetLogOutStatus ();
	}

	/**
	 * 用户是否已经登陆
	 */
	public function isLogin() {
		return $this->session->isLogin;
	}

	/**
	 * 获取Session中的用户信息
	 * 
	 * @return User
	 */
	public function user() {
		return $this->sessionGetUser ();
	}

	/**
	 * user对象信息存储到session
	 * 
	 * @param user对象 $user        	
	 */
	public function sessionSaveUser($user) {
		$newdata = array (
		'id' => $user->id,
		'school_id' => $user->school_id,
		'school' => $user->school,
		'username' => $user->username,
		'password' => $user->password
		);

		$this->session->set_userdata ( $newdata );
	}

	public function sessionSaveLastLoginTime($lastLoginTime) {
		$newdata = array (
		'lastLoginTime' => $lastLoginTime,
		);

		$this->session->set_userdata ( $newdata );
	}

	public function sessionLastLoginTime() {
		return $this->session->lastLoginTime;
	}

	/**
	 * session中获取用户
	 * 
	 * @return User
	 */
	public function sessionGetUser() {
		$user = new User ();
		// 		$user->id = $this->session->id;
		// 		$user->password = $this->session->password;
		// 		$user->school = $this->session->school;
		// 		$user->school_id = $this->session->school_id;
		// 		$user->username = $this->session->username;
		return $user;
	}

	/**
	 * 清除session中的用户
	 */
	public function sessionClearUser() {
		$array_items = array (
		'id',
		'password',
		'school',
		'school_id',
		'username'
		);
		$this->session->unset_userdata ( $array_items );
	}

	public function sessionSetLoginStatus() {
		$this->session->set_userdata ( 'isLogin', 1 );
	}

	public function sessionSetLogOutStatus() {
		$this->session->set_userdata ( 'isLogin', 0 );
		$array_items = array (
		'isLogin'
		);
		$this->session->unset_userdata ( $array_items );
	}

	/**
	 * 生成验证码图片
	 * @return 验证码图片URL
	 */
	public function makeCaptcha() {
		require_once (APPPATH . 'libraries/ValidateCode.php');
		$_vc = new ValidateCode();  //实例化一个对象
		$_vc->doimg();

		$newdata = array (
		'captcha' => $_vc->getCode(),
		);
		$this->session->set_userdata ($newdata);

		// 		$captchaImageURL = $this->config->base_url("/resource/captcha/".$cap['filename']);
		// // 		return $captchaImageURL;
		// 		$this->load->helper('file');
		// 		$filePath = APPPATH."../resource/captcha/".$cap['filename'];
		// // 		echo $filePath;

		// 		header("Content-type:image/jpeg");
		// 		$img=imagecreatefromjpeg($filePath);
		// 		imagejpeg($img);
		// 		imagedestroy($img);
		// 		return $img;
	}

	/**
	 * 验证验证码是否正确
	 * @param 用户输入的验证码值 $captchaValue
	 * @return 1相等 0不等
	 */
	public function verifyCaptcha($captchaValue) {
		return strtolower($captchaValue) === strtolower($this->session->captcha);
	}

	function selectLimit($startRow,$perPage) {
		return $this->dbBase_query0("SELECT * FROM $this->table_name order by id desc limit $startRow,$perPage;",'user');
	}

	function selectCount() {
		return $this->dbBase_query_count("SELECT count(*) as cnt FROM $this->table_name;");
	}

	function selectUserCountWithUserID($uid) {
		return $this->dbBase_query_count("SELECT count(*) as cnt FROM $this->table_name where uid = $uid");
	}
	function updateDiamondNumber($uid, $number,$userinfo)
	{
		if($number>0 && preg_match("/^\d+$/is",$number))
		{
			$nubmer=$userinfo['diamond']+$number;
			$data=array("diamond"=>$nubmer);
			$this->db->where ( 'uid', $uid);
			$this->db->update ( $this->table_name, $data );
			return $this->db->affected_rows ();
		}
		else
		return 0;

	}
	public function getUserInfoStatistics($userid) {
		$sql = "SELECT * FROM " . $this->table_name . " where uid = $userid";
		$user_info=$this->dbBase_query($sql);
		//摊牌率
		$sql = "SELECT count(*) as total FROM (select * from board_round_log where uid = $userid and opertype=10 group by bid,seq) as b";
		$tan=$this->dbBase_query($sql);
		$sql = "SELECT count(*) as total FROM (select * from board_round_log where uid = $userid  group by bid,seq) as b";
		$tan2=$this->dbBase_query($sql);
		$percent_tanpai=(@$tan2[0]['total']>0) ? sprintf("%.2f",@$tan[0]['total']/$tan2[0]['total']*100)."%" : "0%";
		//弃牌率
		$sql = "SELECT count(*) as total FROM (select * from board_round_log where uid = $userid and opertype=2 group by bid,seq) as b";
		$tan=$this->dbBase_query($sql);
		$percent_qipai=(@$tan2[0]['total']>0) ? sprintf("%.2f",@$tan[0]['total']/$tan2[0]['total']*100)."%" : "0%";
		//入池率
		$percent_ruchi=sprintf("%.2f",100-(float)($percent_qipai/100)*100)."%";
		//胜率
		$sql = "SELECT count(*) as total FROM (select * from board_round_result where uid = $userid and won>0 group by bid,seq) as b";
		$tan=$this->dbBase_query($sql);
		$sql = "SELECT count(*) as total FROM (select * from board_round_result where uid = $userid  group by bid,seq) as b";
		$tan2=$this->dbBase_query($sql);
		$percent_shenglv=(@$tan2[0]['total']>0) ? sprintf("%.2f",@$tan[0]['total']/$tan2[0]['total']*100)."%" : "0%";
		//总盈利
		$sql = "SELECT sum(won) as total FROM (select * from board_round_result where uid = $userid group by bid,seq) as b";
		$tan=$this->dbBase_query($sql);
		$total_money=@$tan2[0]['total'];
		//总手数
		$sql = "SELECT count(*) as total FROM (select * from board_round_log where uid = $userid group by bid,seq) as b";
		$tan=$this->dbBase_query($sql);
		$total_hand=@$tan[0]['total'];
		//单局最大
		$sql = "select bid,sum(money) as total from board_round_log where uid = $userid group by bid order by money desc limit 0,1";
		$tan=$this->dbBase_query($sql);
		$total_bid_max=@$tan[0]['total'];
		//单手最大
		$sql = "SELECT max(money) as total FROM (select * from board_round_log where uid = $userid group by bid,seq) as b";
		$tan=$this->dbBase_query($sql);
		$total_hand_single=@$tan[0]['total'];
		if(!empty($user_info[0]))
		{
			$user_info[0]['total_money']=$total_money;
			$user_info[0]['total_hand_single']=$total_hand_single;
			$user_info[0]['total_bid_max']=$total_bid_max;
			$user_info[0]['total_hand']=$total_hand;
			$user_info[0]['percent_shenglv']=$percent_shenglv;
			$user_info[0]['percent_ruchi']=$percent_ruchi;
			$user_info[0]['percent_tanpai']=$percent_tanpai;
			$user_info[0]['percent_qipai']=$percent_qipai;
			return $user_info;
		}
		else
		return array();
	}
	/**收藏好友***/
	public function collectFriend($uid,$t_uid)
	{
		$row=$this->dbBase_query("SELECT * FROM $this->table_name where uid = '$uid' and bid='$bid' and hand_card='$hand_card' and common_card='$common_card' limit 1");
		if($row)
		{
			return "aleadyCollect";
		}
		else
		{
			$data = array(
			'uid' => $uid,
			'bid' => $bid ,
			'hand_card' => $hand_card,
			'common_card' => $common_card,
			'money' => $money,
			'type' => $type,
			'add_time'=> date('Y-m-d H:i:s'),
			'seq' => $seq
			);
			$this->db->insert ( $this->table_name, $data );
			return $this->db->insert_id ();
		}
	}

}