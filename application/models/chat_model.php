<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Chat_model extends Crmmodel{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds($last_rid = null){
		$this->db->select('SQL_CALC_FOUND_ROWS _chat.rid, 
							DATE_FORMAT(_chat.createDT, \'%d.%m.%Y %H:%i\') as msg_datetime,
							(select _filials.rid 
								FROM _emp_to_positions_rows 
								JOIN _emp_to_positions_headers ON _emp_to_positions_rows._emp_to_positions_headers_rid=_emp_to_positions_headers.rid
								JOIN _filials ON _emp_to_positions_rows._filials_rid=_filials.rid
								WHERE _emp_to_positions_rows._employeers_rid = _employeers.rid AND _emp_to_positions_headers.date_doc < now() 
								ORDER BY  _emp_to_positions_headers.date_doc ASC LIMIT 1
							) as _filials_rid,						
							CONCAT(_employeers.l_name, \' \', SUBSTRING(_employeers.f_name FROM 1 FOR 1), \'.\') as emp_name,
							_chat.descr as descr', False);
		$this->db->from('_chat');
		$this->db->join('_users', '_chat.owner_users_rid = _users.rid');
		$this->db->join('_employeers', '_employeers.rid = _users._employeers_rid');
		if($last_rid) $this->db->where(array('_chat.rid >'=>$last_rid));
		$this->db->limit($this->ci->config->item('crm_chat_limit'));
		$this->db->group_by('_chat.rid');
		$this->db->order_by('_chat.rid');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	public function create_record(){
		$ins_arr = array('descr'=>$this->ci->input->post('mess'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_chat', $ins_arr);
		$insRid = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $insRid;
		}		
	}
}
?>