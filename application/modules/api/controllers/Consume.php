<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/codeigniter-predis/src/Redis.php';
require  'vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Consume extends CI_Controller {

	public function __construct()
	{		
		parent::__construct();
	}
	public function index(){

		$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
		$channel = $connection->channel();
	
		$callback = function ($msg) {
  			$email = $this->send_email(trim($msg->body,'"'));
		};

		$channel->basic_consume('data_inquiry', '', false, false, false, false, $callback);
		

		while (count($channel->callbacks)) {
		    $channel->wait();
		}
		$channel->close();
		$connection->close();
	}

	public function send_email($code_inquiry)
    {
    	$this->redis = new \CI_Predis\Redis(['serverName' => 'default']);
		$det_inquiry = $this->redis->hget('inquiry_ticket', $code_inquiry);
		$det_inquiry = json_decode($det_inquiry, TRUE);
		$det_tiket = $this->redis->hget('code_ticket', $det_inquiry['code_ticket']);
		$det_tiket = json_decode($det_tiket, TRUE);

        $config = [
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'otaxperience@gmail.com',    
               'smtp_pass' => 's@ndi12345678',    
               'smtp_port' => 465,
               'crlf'      => "\r\n",
               'newline'   => "\r\n"
           ];

        $this->load->library('email', $config);
        $this->email->from('no-reply@otaxperience.com', 'OTA Xperience');
        $this->email->to($det_inquiry['email']);
        $this->email->subject('Booking Ticket');
        $msg_tpl = 'Hallo <!--NAME--> Your Booked code is <!--CODE BOOKING--> penerbangan tujuan <!--ORIGIN--> - <!--DESTINATION--> dengan maskapai <!--AIR LINE-->';
        $message = str_ireplace(array('<!--NAME-->', '<!--CODE BOOKING-->', '<!--ORIGIN-->', '<!--DESTINATION-->', '<!--AIR LINE-->'),
            array($det_inquiry['name'], $code_inquiry, $det_tiket['origin'], $det_tiket['destination'], $det_tiket['airline']), $msg_tpl);
        $this->email->message($message);

        if($this->email->send()) {
        	$this->redis->hdel('code_ticket', $det_inquiry['code_ticket']);
        	return true;
    	}
    	return false;
    }
}
