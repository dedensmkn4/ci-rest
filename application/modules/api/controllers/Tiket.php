<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/MY_REST_Controller.php';
require_once APPPATH . 'libraries/codeigniter-predis/src/Redis.php';
require  'vendor/autoload.php';

class Tiket extends MY_REST_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->model('Tiket_model');
	}

	public function index_get()
	{
		$now = time(NULL);
		$this->redis = new \CI_Predis\Redis(['serverName' => 'default']);
		$data = array();
        $tiket = $this->Tiket_model->get_data();
        foreach ($tiket as $k => $v) {
        	$code_ticket = $this->generate_string();
        	$det_data = json_encode(array('id_ticket' => $v['id'], 'origin' => $v['origin_airport_name'], 'destination' => $v['destination_airport_name'], 'airline' => $v['airline_name']));
        	$this->redis->hset('code_ticket', $code_ticket, $det_data);
        	$this->redis->expireAt('code_ticket', $now + 3600);
        	unset($v['id']);
        	$v['code'] = $code_ticket;
        	$data[] = $v;
        }
		$this->set_response($data, $this->lang->line('text_rest_success'), MY_REST_Controller::HTTP_OK);
	}


}


