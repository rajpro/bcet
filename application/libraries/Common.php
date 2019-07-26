<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common {

	protected $CI;

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
        $this->CI->load->helper('url');
	}

    public function checkAuth($module)
    {
        if(!empty($this->CI->session->role)){
            if(!in_array($module,$this->CI->session->role)){
                $this->session->set_flashdata('success', '<h4>Access Denied</h4><p>Your are not allowed to this area.</p>');
                redirect(base_url('dashboard'));
            }
        }else{
            redirect(base_url('auth/login'));
        }
    }
}