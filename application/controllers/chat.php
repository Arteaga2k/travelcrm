<?php
/**
 * TravelCRM
 *
 * An open source CRM system for travel agencies
 *
 * @author		Mazvv (vitalii.mazur@gmail.com)
 * @license		GNU GPLv3 (http://gplv3.fsf.org) 
 * @link		http://www.travelcrm.org.ua
 */
include_once APPPATH."libraries/core/Crmcontroller.php";
class Chat extends Crmcontroller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load('chat');
		$this->load->model('chat_model');
	}
	
	public function _remap($m_Name){
		switch ($m_Name) {
			case 'update': {$this->output->set_output($this->update());break;}
		}
	}
	
	private function update(){
		$data = '';
		if($this->input->post('action')=='add'){
			$this->chat_model->create_record();
		}
        $data .= "<?xml version=\"1.0\"?>\n";
        $data .= "<response>\n";
		$messages = array_reverse($this->chat_model->get_ds($this->input->post('last_rid')));
        foreach($messages as $r){
        	$data .= "\t<message rid=\"$r->rid\">\n";
            $data .= "\t\t<author>{$r->emp_name} | {$r->msg_datetime}</author>\n";
			$data .= "\t\t<text>{$r->descr}</text>\n";
            $data .= "\t</message>\n";
        }
        $data .= "</response>";
        return $data;
	}
}

?>