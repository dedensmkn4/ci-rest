<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

	public function __construct()
	{		
		parent::__construct();
	}

	public function index($code_ticket)
	{
		$data["view"]      = "frontend/booking_view";
		$data['code_tiket'] = $code_ticket;
        $this->load->view("main_layout", $data);
	}
	

}
