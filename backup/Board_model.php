<?php

class Board_model extends MY_Model {
	private $table_name;
	function __construct() {
		$this->table_name = 'board';
	}
	
	public function getAllOnlineBoard($clubIDJSON) {
		$ids = json_decode($clubIDJSON);
		if (!count($ids)) {
			return 0;
		}
		$str = join($ids, ',');
		$sql = "SELECT * FROM board where (boardstatus=0 or boardstatus=1) and clubid in ($str);";
		return $this->dbBase_query($sql);
	}
	
	public function getBoardResult($bid) {
		$sql = "SELECT * FROM board_result where bid=$bid;";
		return $this->dbBase_query($sql);
	}
	
	public function allhand($bid,$uid) {
		$sql = "select count(tb.seq) as num from (SELECT * FROM board_round_log where bid=$bid and uid=$uid group by seq) as tb";
		return $this->dbBase_query($sql);
	}
	public function maxmoneypool($bid) {
		$sql = "SELECT max(moneypool) as maxmoneypool FROM board_round_log where bid=$bid;";
		return $this->dbBase_query($sql);
	}
	
	function getBoardUsers($bid) {
		return $this->dbBase_query("select uid,uname,avatar_thumb from user where uid in (SELECT uid FROM board_result where bid = $bid)");
	}
	function getBoardInfo($bid)
	{
		$arr = $this->dbBase_query("SELECT bname,createtime FROM board where bid = $bid;");
		if (count($arr)) {
			return $arr[0];
		}else return array();
	}
	/**
	 * 回放
	 *
	 * @param unknown_type $bid
	 * @param unknown_type $seq
	 * @return unknown
	 */
	public function getPlayBack($bid,$seq) {
		 
		 
		$sql = "SELECT * from board_round where bid=$bid and seq=$seq limit 0,1";
		$res2=$this->dbBase_query($sql);
		//var_dump($res2);die();
		$sql = "SELECT * from board_round_log as lg left join board_round_player as brp on lg.bid=brp.bid and lg.seq=brp.seq where brp.bid=$bid and brp.seq=$seq order by createtime asc";
		$res=$this->dbBase_query($sql);
		$i=1;
		foreach($res as $key=>$val)
		{
			$userid=$val['uid'];
			$sql = "SELECT uname,avatar_thumb,sex,diamond FROM user where uid = $userid";
			$user_info=$this->dbBase_query($sql);
			$res[$key]['uname']=$user_info[0]['uname'];
			$res[$key]['avatar_thumb']=$user_info[0]['avatar_thumb'];
			$res[$key]['createtime']=date("Y-m-d H:i:s",$val['createtime']);
			$i++;
		}
		//var_dump(array("start"=>$res2[0],"info"=>$res));
		return array("start"=>$res2[0],"info"=>$res);
	}
}