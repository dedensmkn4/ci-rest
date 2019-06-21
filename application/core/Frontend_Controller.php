<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

require  'vendor/autoload.php';
use \GuzzleHttp\Client;

class Frontend_Controller extends CI_Controller {
	public function __construct()
	{		
		parent::__construct();
	}
	public function guzzle_get($url,$uri){
        try
        {
            $client = new Client(['base_uri' => $url]);
	 		$response = $client->request('GET',$uri);
	 		$res = json_decode((string)$response->getBody()->getContents(), true);
        }
        catch (Exception $ex)
        {
        	$res = json_decode((string)$ex->getResponse()->getBody(true), true);
        }
	   	return $res;
	}
}