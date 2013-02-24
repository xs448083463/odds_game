<?php
class IboEvent{
	var $dbutil;
	
	//构造函数
	function __construct($dbutil){
		$this->dbutil = $dbutil;
	}
	
	/**
	 * 获取所有当前赛事表.
	 */
	function getAllEvent($conditionArr){
		$sqlcondition = $this->getEventSqlCondition($conditionArr);
		if($sqlcondition){
			$sql = "SELECT e.event_id, e.team_mian_name, e.team_sec_name, e.sport_subtype_name, e.event_time, o.victory, o.planish, o.fail ". 
											"FROM ibo_event e, ibo_odds o ".
											"WHERE e.event_id = o.event_id AND e.event_time > date_format(curdate(), '%Y-%m-%d' ) and e.event_result='' and (".$sqlcondition.") order by e.event_time asc";
		}else{
			$sql = "SELECT e.event_id, e.team_mian_name, e.team_sec_name, e.sport_subtype_name, e.event_time, o.victory, o.planish, o.fail ". 
											"FROM ibo_event e, ibo_odds o ".
											"WHERE e.event_id = o.event_id AND e.event_time > date_format(curdate(), '%Y-%m-%d' ) and e.event_result='' order by e.event_time asc";
			
		}
		return $this->dbutil->get_results($sql);
	}
	
	function setBet($param){
		$this->dbutil->insert("ibo_bet", $param);
		return $this->dbutil->last_error;
	}
	
	function getEventResults($eids){
		return $this->dbutil->get_results("select event_result from ibo_event where event_id in(".$eids.")");
	}
	
	/**
	 * 获取所有结束赛事
	 */
	function getAllFinishedEvent($conditionArr,$page){
		$sqlcondition = $this->getEventSqlCondition($conditionArr);
		$totalsize = $this->getAllFinishedEventNums($conditionArr);
		if($totalsize<1){
			return null;
		}
		$page->setTotalSize($totalsize);
		if($sqlcondition){
			$sql = "SELECT e.event_id, e.team_mian_name, e.team_sec_name, e.sport_subtype_name, e.event_time,e.event_result, o.victory, o.planish, o.fail ". 
											"FROM ibo_event e, ibo_odds o ".
											"WHERE e.event_id = o.event_id AND e.event_time < date_format(curdate(), '%Y-%m-%d' ) and (e.event_result is not null and e.event_result!='') and (".$sqlcondition.") order by e.event_time asc limit ".$page->startIndex.",".$page->pagesize;
		}else{
			$sql = "SELECT e.event_id, e.team_mian_name, e.team_sec_name, e.sport_subtype_name, e.event_time,e.event_result, o.victory, o.planish, o.fail ". 
											"FROM ibo_event e, ibo_odds o ".
											"WHERE e.event_id = o.event_id AND e.event_time < date_format(curdate(), '%Y-%m-%d' ) and (e.event_result is not null and e.event_result!='') order by e.event_time asc limit ".$page->startIndex.",".$page->pagesize;
		}
		$events =  $this->dbutil->get_results($sql);
		$page->result = $events;
		return $page;
	}
	
	/**
	 * 获取结束赛事条数
	 * @param unknown_type $conditionArr
	 */
	function getAllFinishedEventNums($conditionArr){
		$sqlcondition = $this->getEventSqlCondition($conditionArr);
		if($sqlcondition){
			$sql = "select * from ibo_event e, ibo_odds o ".
											"WHERE e.event_id = o.event_id AND e.event_time < date_format(curdate(), '%Y-%m-%d' ) and (e.event_result is not null and e.event_result!='') and (".$sqlcondition.") order by e.event_time asc";
		}else{
			$sql = "select * from ibo_event e, ibo_odds o ".
											"WHERE e.event_id = o.event_id AND e.event_time < date_format(curdate(), '%Y-%m-%d' ) and (e.event_result is not null and e.event_result!='') order by e.event_time asc";
		}
		return $this->dbutil->getResultNums($sql);
	}
	
	/**
	 * 获取赛事投注的用户列表
	 */
	function getEventUserBet($event_id){
//		$event_id = '676';
		$sql = "select b.user_name, e.sport_subtype_name,e.team_mian_name,e.team_sec_name, b.bet_vmoney,b.bet_odd,b.odds_name,b.bet_time from ibo_event e,ibo_bet b 
		where e.event_id=b.event_id and e.event_id='".$event_id."'";
		return $this->dbutil->get_results($sql);
	}
	
	/**
	 * 获取赛事历史比分
	 * @param unknown_type $event_id
	 */
	function getEventHistoryScore($event_id){
//		$event_id = '474';
		return $this->dbutil->get_results("select e.event_id, e.team_mian_name, e.team_sec_name, 
		e.sport_subtype_name,e.event_result,e.event_time from ibo_event_history e 
		where e.event_id='".$event_id."' and e.event_result is not null and e.event_result!=''");
	}
	
	/**
	 * 拼sql查询条件
	 * @param unknown_type $sport_subtype_name 赛事名称
	 * @param unknown_type $team_name 球队名称
	 */
	function getEventSqlCondition($conditionArr){
		if(!$conditionArr||count($conditionArr)<1){
			return null;
		}
		$sqlcondition = null;
		if(array_key_exists('sport_subtype_name',$conditionArr)){
			$sport_subtype_name = $conditionArr['sport_subtype_name'];
			if($sport_subtype_name!=null&&$sport_subtype_name!=''){
				$sportCondition = "sport_subtype_name like '%".$sport_subtype_name."%'";
			}
		}
		if(array_key_exists('team_name', $conditionArr)){
			$team_name = $conditionArr['team_name'];
			if($team_name!=null&&$team_name!=''){
				$teamCondition = "(team_mian_name like '%".$team_name."%' or team_sec_name like '%".$team_name."%')";
			}
		}
		
		if(array_key_exists('starttime',$conditionArr)){
			$starttime = $conditionArr['starttime'];
		}
		if(array_key_exists('endtime', $conditionArr)){
			$endtime = $conditionArr['endtime'];
		}
		if($starttime!=null&&$endtime!=null){
			$eventtimeCondition = "event_time between date_format('".$starttime."','%Y-%m-%d') and date_format('".$endtime."','%Y-%m-%d')";
		}else if($starttime!=null&&$endtime==null){
			$eventtimeCondition = "event_time >=date_format('".$starttime."', '%Y-%m-%d' )";
		}else if($starttime==null&&$endtime!=null){
			$eventtimeCondition = "event_time<=date_format('".$endtime."','%Y-%m-%d')";
		}
		
		$expression = " and ";
		$conditionArray = array();
		
		if($sportCondition!=null){
			array_push($conditionArray, $sportCondition);
		}
		if($teamCondition!=null){
			array_push($conditionArray, $teamCondition);
		}
		if($eventtimeCondition!=null){
			array_push($conditionArray, $eventtimeCondition);
		}
		$sqlcondition = implode($expression,$conditionArray);
		return $sqlcondition;
	}
}
?>