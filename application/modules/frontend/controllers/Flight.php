<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flight extends Frontend_Controller {

	public function __construct()
	{		
		parent::__construct();
	}

	public function index()
	{
		$data["view"]      = "frontend/flight_view";
		$data['rest'] = $this->guzzle_get('http://localhost/ci-rest/','api/tiket');
        $this->load->view("main_layout", $data);
	}
	

}
