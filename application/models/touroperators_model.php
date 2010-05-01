<?phpinclude_once APPPATH."libraries/core/Crmmodel.php";class Touroperators_model extends Crmmodel{	public function __construct(){		parent::__construct();	}
	public function get_ds(){		$this->db->select('SQL_CALC_FOUND_ROWS _touroperators.rid as rid,							_touroperators.stouroperator_name as stouroperator_name,  							_touroperators.touroperator_name as touroperator_name,  							_touroperators.license as license, 							_touroperators.chief_name as chief_name, 							_touroperators.contact_phone as contact_phone, 							_touroperators.contact_email as contact_email, 							_touroperators.www as www,							_touroperators.contract as contract, 							_touroperators.category as category, 							_touroperators.payment_condition as payment_condition,							DATE_FORMAT(_touroperators.contract_period, \'%d.%m.%Y\') as contract_period,							_touroperators.adress as adress,							_touroperators.fax as fax,							_touroperators.contact_person as contact_person,							DATE_FORMAT(_touroperators.modifyDT, \'%d.%m.%Y\') as modifyDT, 							_touroperators.descr as descr, _touroperators.archive', False);		$this->db->from('_touroperators');		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));		$query = $this->db_get('_cities');		return $query->num_rows()?$query->result():array();	}
	
	public function get_edit($rid){		$this->db->select('_touroperators.rid as rid, 							_touroperators.stouroperator_name as stouroperator_name,							_touroperators.touroperator_name as touroperator_name,  							_touroperators.license as license, 							_touroperators.chief_name as chief_name, 							_touroperators.contact_phone as contact_phone, 							_touroperators.contact_email as contact_email, 							_touroperators.www as www,							_touroperators.category as category, 							_touroperators.contract as contract,							_touroperators.payment_condition as payment_condition,							DATE_FORMAT(_touroperators.contract_period, \'%d.%m.%Y\') as contract_period,							_touroperators.adress as adress,							_touroperators.fax as fax,							_touroperators.contact_person as contact_person,							DATE_FORMAT(_touroperators.modifyDT, \'%d.%m.%Y %H:%i\') as modifyDT, 							_touroperators.owner_users_rid,							_touroperators.descr as descr, _touroperators.archive', False);		$this->db->from('_touroperators');		$this->db->where(array('_touroperators.rid'=>$rid));		$query = $this->db_get('_touroperators');		return $query->num_rows()?$query->row():False;	}
	
	public function create_record(){
		$ins_arr = array('touroperator_name'=>$this->ci->input->post('touroperator_name'),  
							'stouroperator_name'=>$this->ci->input->post('stouroperator_name'), 
							'category'=>$this->ci->input->post('category'), 
							'license'=>$this->ci->input->post('license'), 
							'chief_name'=>$this->ci->input->post('chief_name'), 
							'contact_phone'=>$this->ci->input->post('contact_phone'), 
							'contact_email'=>$this->ci->input->post('contact_email'), 
							'www'=>$this->ci->input->post('www'),
							'contract'=>$this->ci->input->post('contract'), 
							'contract_period'=>date('Y-m-d', strtotime($this->ci->input->post('contract_period'))), 
							'adress'=>$this->ci->input->post('adress'),
							'fax'=>$this->ci->input->post('fax'),
							'contact_person'=>$this->ci->input->post('contact_person'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());		$this->db->set('createDT', 'now()', False);		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();
		$this->db->insert('_touroperators', $ins_arr);
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
		$update_arr = array('touroperator_name'=>$this->ci->input->post('touroperator_name'),  							'stouroperator_name'=>$this->ci->input->post('stouroperator_name'), 							'category'=>$this->ci->input->post('category'), 							'license'=>$this->ci->input->post('license'), 							'chief_name'=>$this->ci->input->post('chief_name'), 							'contact_phone'=>$this->ci->input->post('contact_phone'), 							'contact_email'=>$this->ci->input->post('contact_email'), 							'www'=>$this->ci->input->post('www'),							'contract'=>$this->ci->input->post('contract'), 							'contract_period'=>date('Y-m-d', strtotime($this->ci->input->post('contract_period'))), 							'adress'=>$this->ci->input->post('adress'),							'fax'=>$this->ci->input->post('fax'),							'contact_person'=>$this->ci->input->post('contact_person'),							'descr'=>$this->ci->input->post('descr'),							'archive'=>$this->ci->input->post('archive'),							'modifier_users_rid'=>get_curr_urid());		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_touroperators', $update_arr, array('rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function remove_items(){
		$this->db->trans_begin();		foreach($this->ci->input->post('row') as $rid){			$this->db->delete('_touroperators', array('rid'=>$rid));			}		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}		public function check_unique($val, $type='name', $rid=null){		$this->db->select('count(*) as quan');		$this->db->from('_touroperators');		if($type=='name') $this->db->where(array('stouroperator_name'=>$val));		else $this->db->where(array('touroperator_name'=>$val));		if($rid) $this->db->where(array('rid != '=>$rid));		$query = $this->db->get();		return $query->num_rows()?$query->row()->quan:0;	}	
	
	public function GetPair($p_value = 'rid', $p_name='stouroperator_name'){
		$this->db->select("_touroperators.{$p_value}, _touroperators.{$p_name}");
		$this->db->from('_touroperators');
		$this->db->orderby("_touroperators.{$p_name}");
		$query = $this->db->get();
		if($query->num_rows()>0) return $query->result();
		return False;
	}
	
	public function move_record(){		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->update('_touroperators', $update_doc, array('_touroperators.rid'=>$this->ci->input->post('rid')));		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();    		return False;		}else{    		$this->db->trans_commit();    		return $this->ci->input->post('rid');		}			}	
	public function get_touroperatorname_byrid($rid){		$this->db->select('stouroperator_name', False);		$this->db->from('_touroperators');		$this->db->where(array('rid'=>$rid));		$this->db->order_by('stouroperator_name');		$query = $this->db->get();		return $query->num_rows()?$query->row()->stouroperator_name:null; 	}		
}
?>