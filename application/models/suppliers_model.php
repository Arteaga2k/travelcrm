<?php
/**
 * ПОставщики
 * 
 * @author Mazvv
 * @package Suppliers
 */
class Suppliers_model extends CRM_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function GetDS(){
		$this->db->select('_suppliers.rid as rid, _suppliers.supplier_name as supplier_name, _suppliers.code as code');
		$this->db->from('_suppliers');
		if($searchRule = $this->ciObject->GetSessionData('searchrule')){
			$this->db->like($searchRule);
		}
		if($sort = $this->ciObject->GetSessionData('sort')){
			$this->db->orderby($sort['c'], $sort['r']);
		}
		$query = $this->DBGet('_suppliers');
		if($query->num_rows()>0) return $this->ciObject->GetPagingDS($query->result());
		return array();
	}
	
	public function GetEditDS(){
		$this->db->select('_suppliers.rid as rid, _suppliers.supplier_name as supplier_name, _suppliers.code as code');
		$this->db->from('_suppliers');
		$this->db->where(array('rid'=>$this->ciObject->GetSessionData('activerecord')));
		$query = $this->DBGet('_suppliers');
		if($query->num_rows()>0) return $query->row();
		return False;
	}
	
	public function CreateRecord(){
		$insArray = array('supplier_name'=>$_POST['supplier_name'],
							'code'=>$_POST['code']);
		$this->db->trans_begin();
		$this->db->insert('_suppliers', $insArray);
		$insRid = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $insRid;
		}		
	}
	
	public function UpdateRecord(){
		$updateArray = array('supplier_name'=>$_POST['supplier_name'],
							'code'=>$_POST['code']);
		$this->db->trans_begin();
		$this->db->update('_suppliers', $updateArray, array('rid'=>$this->ciObject->GetSessionData('activerecord')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function DeleteRecord(){
		$this->db->trans_begin();
		$this->db->delete('_suppliers', array('rid'=>$this->ciObject->GetSessionData('activerecord')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}

	public function GetPair($p_value = 'rid', $p_name='supplier_name'){
		$this->db->select("_suppliers.{$p_value}, _suppliers.{$p_name}");
		$this->db->from('_suppliers');
		$this->db->orderby("_suppliers.supplier_name");
		$query = $this->db->get();
		if($query->num_rows()>0) return $query->result();
		return False;
	}
	
	public function GetPairArr($p_value = 'rid', $p_name='supplier_name'){
		$this->db->select("_suppliers.{$p_value}, _suppliers.{$p_name}");
		$this->db->from('_suppliers');
		$this->db->orderby("_suppliers.supplier_name");
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$result = array(' '=>'');
			foreach($query->result() as $item) $result[$item->$p_value]=$item->$p_name;
			return $result;
		}
		return False;
	}
}
?>