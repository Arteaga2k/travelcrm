<?php
/**
 * User_model - модель пользователя
 * 
 * @author Mazvv
 * @package Extenders
 */
class User_model extends Model {
	
	public function __construct(){
		parent::Model();
	}
	
	public function check_user($p_userLogin, $p_userPassword) {
		$today = date("Y-m-d");
		$this->db->select('_users.rid as usersRID, _users.edate_passwd, _users.chdate_passwd, 
							_employeers.f_name, _employeers.s_name, _employeers.l_name,
							_filials.rid as filialsRID, _positions.rid as positionsRID, _positions.name, _emp_to_positions_rows.bdate as positionDATEFROM', True);
		$this->db->from('_users');
		$this->db->join('_employeers', '_employeers.rid = _users._employeers_rid AND _employeers.archive = 0');
		$this->db->join('_emp_to_positions_rows', '_employeers.rid = _emp_to_positions_rows._employeers_rid AND _emp_to_positions_rows.archive = 0');
		$this->db->join('_filials', '_filials.rid = _emp_to_positions_rows._filials_rid AND _filials.archive = 0');				
		$this->db->join('_positions', '_positions.rid = _emp_to_positions_rows._positions_rid AND _positions.archive = 0');
		$this->db->where(array('_users.user_login'=>$p_userLogin, '_users.user_passwd'=>$p_userPassword, '_users.archive'=>0, '_emp_to_positions_rows.bdate <='=>$today));
		$this->db->order_by('_emp_to_positions_rows.bdate', 'desc');
		//$this->db->groupby('_users.rid');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows()){ 
			return $query->row();
		}
		return False;
	}

	public function check_edate($login) {
		$this->db->select('if(_users.edate_passwd < now(), 0, 1) as is_end', False);
		$this->db->from('_users');
		$this->db->where(array('_users.user_login'=>$login));
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->is_end:False;
	}
	
	public function get_urid_by_login($login){
		$query= $this->db->select('_users.rid')->from('_users')->where(array('user_login'=>$login))->get();
		return $query->num_rows()?$query->row()->rid:null;
	}
	
	public function get_chdate_by_urid($urid){
		$query= $this->db->select('_users.chdate_passwd')->from('_users')->where(array('rid'=>$urid))->get();
		return $query->num_rows()?$query->row()->chdate_passwd:null;
	}
	
	public function check_atimeout($p_userRid){
		$this->db->select("TIMEDIFF('".date("Y-m-d H:i")."', last_activity) as period");
		$this->db->from('_users');
		$this->db->where(array('rid'=>$p_userRid));
		$query = $this->db->get();
		$this->db->where(array('rid'=>$p_userRid));
		$this->db->update('_users', array('last_activity'=>date("Y-m-d H:i")));
		$timeArr = explode(':', $query->row()->period);
		if($timeArr[1]>30) return false; 
		return true;
	}	

	public function get_fn($p_userRid){
		$this->db->select("TRIM(_employeers.l_name) as l_name, TRIM(_employeers.f_name) as f_name, TRIM(_employeers.s_name) as s_name");
		$this->db->from('_users');
		$this->db->join('_employeers', '_users._employeers_rid = _employeers.rid AND _employeers.archive = 0');
		$this->db->where(array('_users.rid'=>$p_userRid, '_users.archive'=>0));
		$query = $this->db->get();
		if($query->num_rows) {
			$row = $query->row();
			return $row->l_name.' '.$row->f_name.' '.$row->s_name;
		}
		return False;
	}
	
	public function get_user_position($urid){
		$this->db->select('	_filials.rid as filialsRID, _filials.name as filialsNAME, _positions.rid as positionsRID, _positions.name as positionsNAME, _employeers.rid as empRID, _employeers.email as empMAIL', True);
		$this->db->from('_users');
		$this->db->join('_employeers', '_employeers.rid = _users._employeers_rid AND _employeers.archive = 0');
		$this->db->join('_emp_to_positions_rows', '_employeers.rid = _emp_to_positions_rows._employeers_rid AND _emp_to_positions_rows.archive = 0');
		$this->db->join('_filials', '_filials.rid = _emp_to_positions_rows._filials_rid AND _filials.archive = 0');		
		$this->db->join('_positions', '_positions.rid = _emp_to_positions_rows._positions_rid AND _positions.archive = 0');
		$this->db->where(array('_users.rid'=>$urid, '_users.archive'=>0));
		$this->db->where('_emp_to_positions_rows.bdate <= now()');
		$this->db->order_by('_emp_to_positions_rows.bdate', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->num_rows()?$query->row():False;
	}
	
	public function get_uprid($urid){
		if($up = $this->get_user_position($urid)) return $up->positionsRID;
		else return False;	
	}

	public function get_pn($urid){
		if($up = $this->get_user_position($urid)) return $up->positionsNAME;
		else return False;	
	}
	
	public function get_ufrid($urid){
		if($up = $this->get_user_position($urid)) return $up->filialsRID;
		else return False;	
	}

	public function get_ufiln($urid){
		if($up = $this->get_user_position($urid)) return $up->filialsNAME;
		else return False;	
	}

	public function get_uerid($urid){
		if($up = $this->get_user_position($urid)) return $up->empRID;
		else return False;	
	}

	public function get_uem($urid){
		if($up = $this->get_user_position($urid)) return $up->empMAIL;
		else return False;	
	}
	
	public function cp($p_userRid, $p_newPasswd, $period){
		$nextDate = date('Y-m-d', mktime(date("H"), date("i"), date("s"), date("m"), date("d")+$period, date("Y")));
		$this->db->trans_begin();
		$this->db->where(array('_users.rid'=>$p_userRid));
		$this->db->update('_users', array('_users.user_passwd'=>$p_newPasswd, '_users.chdate_passwd'=>$nextDate));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		} else {
    		$this->db->trans_commit();
		}
		return True;
	}
	
	public function get_uer($p_userRid){
		$this->db->select('_employeers.rid');
		$this->db->from('_users');
		$this->db->join('_employeers', '_users._employeers_rid = _employeers.rid AND _employeers.archive = 0');
		$this->db->where(array('_users.rid'=>$p_userRid, '_users.archive'=>0));
		$query = $this->db->get();
		if($query->num_rows) {
			$row = $query->row();
			return $row->rid;
		}
		return False;
	}
	
	public function get_um($p_userRid){
		$this->db->select('_employeers.email');
		$this->db->from('_users');
		$this->db->join('_employeers', '_users._employeers_rid = _employeers.rid AND _employeers.archive = 0');
		$this->db->where(array('_users.rid'=>$p_userRid, '_users.archive'=>0));
		$query = $this->db->get();
		if($query->num_rows) {
			$row = $query->row();
			return $row->email;
		}
		return False;
	}
}
?>