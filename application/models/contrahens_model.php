<?phpinclude_once APPPATH."libraries/core/Crmmodel.php";class Contrahens_model extends Crmmodel{	public function __construct(){		parent::__construct();	}
	public function get_ds(){		$this->db->select('SQL_CALC_FOUND_ROWS _contrahens.rid as rid,							_cities.city_name,							_contrahens.scontrahens_name as scontrahens_name,  							_contrahens.contrahens_name as contrahens_name,  							_contrahens.contact_phone as contact_phone,							_contrahens.contact_person as contact_person, 							_contrahens.contact_email as contact_email, 							_contrahens.www as www,							_contrahens.adress as adress,							_contrahens.fax as fax,							DATE_FORMAT(_contrahens.modifyDT, \'%d.%m.%Y\') as modifyDT, 							_contrahens.descr as descr, _contrahens.archive', False);		$this->db->from('_contrahens');		$this->db->join('_cities', '_cities.rid = _contrahens._cities_rid');		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));		$query = $this->db_get('_cities');		return $query->num_rows()?$query->result():array();	}
	
	public function get_edit($rid){		$this->db->select('_contrahens.rid as rid,							_contrahens._cities_rid,							_contrahens.scontrahens_name as scontrahens_name,  							_contrahens.contrahens_name as contrahens_name,  							_contrahens.contact_phone as contact_phone,							_contrahens.contact_person as contact_person, 							_contrahens.contact_email as contact_email, 							_contrahens.www as www,							_contrahens.adress as adress,							_contrahens.fax as fax,							DATE_FORMAT(_contrahens.modifyDT, \'%d.%m.%Y %H:%i\') as modifyDT, 							_contrahens.owner_users_rid,							_contrahens.descr as descr, _contrahens.archive', False);		$this->db->from('_contrahens');		$this->db->where(array('_contrahens.rid'=>$rid));		$query = $this->db_get('_contrahens');		return $query->num_rows()?$query->row():False;	}
	
	public function create_record(){
		$ins_arr = array('_cities_rid'=>$this->ci->input->post('_cities_rid'),							'scontrahens_name'=>$this->ci->input->post('scontrahens_name'),  
							'contrahens_name'=>$this->ci->input->post('contrahens_name'), 
							'contact_phone'=>$this->ci->input->post('contact_phone'), 
							'contact_email'=>$this->ci->input->post('contact_email'), 
							'www'=>$this->ci->input->post('www'),
							'adress'=>$this->ci->input->post('adress'),
							'fax'=>$this->ci->input->post('fax'),
							'contact_person'=>$this->ci->input->post('contact_person'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());		$this->db->set('createDT', 'now()', False);		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();
		$this->db->insert('_contrahens', $ins_arr);
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
		$update_arr = array('_cities_rid'=>$this->ci->input->post('_cities_rid'),							'scontrahens_name'=>$this->ci->input->post('scontrahens_name'),  							'contrahens_name'=>$this->ci->input->post('contrahens_name'), 							'contact_phone'=>$this->ci->input->post('contact_phone'), 							'contact_email'=>$this->ci->input->post('contact_email'), 							'www'=>$this->ci->input->post('www'),							'adress'=>$this->ci->input->post('adress'),							'fax'=>$this->ci->input->post('fax'),							'contact_person'=>$this->ci->input->post('contact_person'),							'descr'=>$this->ci->input->post('descr'),							'archive'=>$this->ci->input->post('archive'),							'modifier_users_rid'=>get_curr_urid());		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_contrahens', $update_arr, array('rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function remove_items(){
		$this->db->trans_begin();		foreach($this->ci->input->post('row') as $rid){			$this->db->delete('_contrahens', array('rid'=>$rid));			}		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}		public function check_unique($val, $type='name', $rid=null){		$this->db->select('count(*) as quan');		$this->db->from('_contrahens');		if($type=='sname') $this->db->where(array('scontrahens_name'=>$val));		else $this->db->where(array('contrahens_name'=>$val));		if($rid) $this->db->where(array('rid != '=>$rid));		$query = $this->db->get();		return $query->num_rows()?$query->row()->quan:0;	}	
	
	public function move_record(){		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->update('_contrahens', $update_doc, array('_contrahens.rid'=>$this->ci->input->post('rid')));		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();    		return False;		}else{    		$this->db->trans_commit();    		return $this->ci->input->post('rid');		}			}	
	public function get_contrahent_byrid($rid){		$this->db->select('scontrahens_name', False);		$this->db->from('_contrahens');		$this->db->where(array('rid'=>$rid));		$this->db->order_by('scontrahens_name');		$query = $this->db->get();		return $query->num_rows()?$query->row()->scontrahens_name:null; 	}		
}
?>