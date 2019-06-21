<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/MY_REST_Controller.php';
require_once APPPATH . 'libraries/codeigniter-predis/src/Redis.php';
require  'vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
class Booking extends MY_REST_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->model('Tiketinquiry_model');
		$this->load->model('Tiket_model');
	}

	public function index_post()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_data($this->post());
		if ($this->form_validation->run() == FALSE) {
			return $this->set_response(
				array(),
				$this->lang->line('text_invalid_params'),
				REST_Controller::HTTP_BAD_REQUEST
			);
		}
		$this->redis = new \CI_Predis\Redis(['serverName' => 'default']);
		$det_tiket = $this->redis->hget('code_ticket', $this->post('code_tiket'));
		$det_tiket = json_decode($det_tiket, TRUE);

		if(!$det_tiket){
			return $this->set_response(
				array(), 
				'Sorry Code Ticket Has been expire',
				REST_Controller::HTTP_CONFLICT
			);
		}

		$tiket_available = $this->Tiket_model->check_tiket_availability($det_tiket['id_ticket']);

		if(!$tiket_available){
			return $this->set_response(
				array(), 
				'Sorry Ticket Not Available',
				REST_Controller::HTTP_CONFLICT
			);
		}

		$inquiry_data =array(
			'ticket_id' => $det_tiket['id_ticket'],
			'email' => $this->post()['email'],
			'created_datetime' => date('Y-m-d H:i:s')
		);

		$inquiry_id = $this->Tiketinquiry_model->add($inquiry_data);

		if(!$inquiry_id){
			return $this->set_response(
				array(),
				$this->lang->line('text_server_error'),
				REST_Controller::HTTP_INTERNAL_SERVER_ERROR
			);
		}
		$code_booking = $this->generate_string(20);
		$det_booking = json_encode(array('inquiry_id' => $inquiry_id, 'code_ticket' => $this->post('code_tiket'), 'name' => $this->post('name'), 'dateofbirth' => $this->post('dateofbirth'), 'email' => $this->post('email')));
		$this->redis->hset('inquiry_ticket', $code_booking, $det_booking);
		
		$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
		$channel = $connection->channel();
		$channel->queue_declare('data_inquiry', false, false, false, false);
		$send_rabbit = json_encode($code_booking);
		$msg = new AMQPMessage($send_rabbit);
		$channel->basic_publish($msg, '', 'data_inquiry');
		$channel->close();
		$connection->close();

		$decreament_ticket = $this->Tiket_model->decreament_ticket($det_tiket['id_ticket']);	

		return $this->set_response(
			array(),
			'You are successfully booked',
			REST_Controller::HTTP_CREATED
		);

	}
}
 ?>