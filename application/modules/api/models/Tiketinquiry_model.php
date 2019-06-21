<?php

class Tiketinquiry_model extends CI_Model {
	
	function __construct() {
		
		parent::__construct();

		//Table Name
		$this->table_name = "tbl_ticket_inquiry";
	}

	function add($data = array()){
		
		// Saving the user
		$insert_query = $this->db->insert($this->table_name, $data);
		
		if(!$insert_query){
			return false;
		}

		return $this->db->insert_id();
	}



}