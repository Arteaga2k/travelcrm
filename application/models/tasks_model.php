<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Tasks_model extends Crmmodel{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _tasks.rid, 
							_tasks.priority,
							_tasks.objtype,
							_tasks.objrid,
							DATE_FORMAT(_tasks.edate, \'%d.%m.%Y\') as edate,
							_tasks.done, _tasks.descr as descr', False);
		$this->db->from('_tasks');
		$this->db->where(array('owner_users_rid'=>get_curr_urid()));
		/* { to show filter for tasks*/
		
		if($searchRule = $this->ci->session->userdata('to_show_tasks')){
			#var_dump($searchRule);	
			switch($searchRule){
				case '1': { $this->db->where(array('_tasks.edate'=>date('Y-m-d'))); break;}
				case '2': { $this->db->where(array('_tasks.edate <'=>date('Y-m-d'), 'done'=>'0')); break;}
				case '3': {
					if($objtype = $this->ci->session->userdata('objtype_tasks')) 
						$this->db->where(array('objtype'=>$objtype)); 
					if($objrid = $this->ci->session->userdata('objrid_tasks')) 
						$this->db->where(array('objrid'=>$objrid)); 
					break;
				}
				default: break;
			}
		} else $this->db->where(array('_tasks.edate'=>date('Y-m-d')));
		/* } to show filter for tasks*/
		$this->db->order_by('_tasks.edate DESC, _tasks.priority DESC');
		$this->db->limit($this->ci->config->item('crm_tasks_per_page'), $this->ci->session->userdata('tasks_page'));
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}

	public function get_edit($rid){
		$this->db->select('SQL_CALC_FOUND_ROWS _tasks.rid, 
							_tasks.objrid,
							_tasks.priority,	
							DATE_FORMAT(_tasks.edate, \'%d.%m.%Y\') as edate,
							_tasks.done, _tasks.descr as descr', False);
		$this->db->from('_tasks');
		$this->db->where(array('_tasks.rid'=>$rid));
		$this->db->order_by('_tasks.edate ASC, _tasks.priority DESC');
		$query = $this->db->get();
		return $query->num_rows()?$query->row():null;
	}
	
	public function create_record(){
		$ins_arr = array('edate'=>date('Y-m-d', strtotime($this->ci->input->post('edate_tasks'))),
							'objtype'=>$this->ci->input->post('objtype')?$this->ci->input->post('objtype'):$this->ci->get_objtype(),
							'objrid'=>($this->ci->input->post('attach_to_obj'))?$this->ci->input->post('objrid'):null,
							'priority'=>$this->ci->input->post('priority_tasks'),
							'descr'=>$this->ci->input->post('descr_tasks'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_tasks', $ins_arr);
		$insRid = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $insRid;
		}		
	}

	public function update_record(){
		$update_arr = array('edate'=>date('Y-m-d', strtotime($this->ci->input->post('edate_tasks'))),
							'priority'=>$this->ci->input->post('priority_tasks'),
							'descr'=>$this->ci->input->post('descr_tasks'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_tasks', $update_arr, array('rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	
	public function remove_items(){
		$this->db->trans_begin();
		$this->db->delete('_tasks', array('rid'=>$this->ci->input->post('rid')));	
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}

	public function close_task(){
		$task = $this->get_edit($this->ci->input->post('rid'));
		$update_arr = array('done'=>$task->done?0:1,
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_tasks', $update_arr, array('rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
}
?>