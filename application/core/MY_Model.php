<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	public function __construct()
	{	
		$this->load->database();
	}

	public function __destruct()
	{
		$this->db->close();
		// @unset($this);
	}
}