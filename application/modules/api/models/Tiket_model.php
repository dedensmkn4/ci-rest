<?php

class Tiket_model extends CI_Model {
	function __construct() {
		
		parent::__construct();

		//Table Name
		$this->table_name = "tbl_ticket";
	}
	function get_data(){
		$this->db->select("a.id, a.stock, b.name as origin_airport_name, c.name as destination_airport_name, d.name as airline_name");
		$this->db->from($this->table_name. " as a");
		$this->db->join("mst_airport b", "a.origin_airport_code=b.code");
		$this->db->join("mst_airport c", "a.destination_airport_code=c.code");
		$this->db->join("mst_airline d", "a.airline_code=d.code");
		$this->db->where("a.stock >", 0);
		return $this->db->get()->result_array();
	}

	function check_tiket_availability($id_tiket = null){
		$filters = array('id' => $id_tiket);

		$stock = $this->db->from($this->table_name)->where($filters)->get()->row();
		
		if($stock){
			if($stock->stock > 0) return true;
		}

		return false;
	}

	function decreament_ticket($id_tiket){
		$this->db->reset_query();
		$update_query = $this->db->where('id', $id_tiket)->set('stock', 'stock-1', FALSE)->update($this->table_name);
		
		if(!$update_query){
			return false;
		}
		return true;
	}
}