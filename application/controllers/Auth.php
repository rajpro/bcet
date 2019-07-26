<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Auth extends CI_Controller {
 
 	function __construct()
 	{
 		parent::__construct();
 		require_once APPPATH."third_party/phppass/PasswordHash.php";
 		$this->load->model('AuthDB');
 	}

 	// public function index()
	// {
	// 	if(empty($this->session->logged_in)){
	// 		redirect(base_url('login'));
	// 	}
	// 	$data['selected_menu'] = '';
	// 	$data['sub_menu'] = '';
	// 	$data['nathing'] = 'works';
	// 	$this->load->view('template/login');
	// }

	public function login()
	{
		if($this->session->logged_in){
			redirect(base_url('dashboard'));
		}
		$PasswordHash = new PasswordHash();
		$data['role'] = $this->AuthDB->allRole();
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() == TRUE){
			if($sd = $this->_check()){
				$menu = $this->_menu($sd['role']);
				$this->session->set_userdata(['logged_in'=>'true']);
				$this->session->set_userdata($sd);
				$this->session->set_userdata(['menu'=>$menu]);
				redirect(base_url('dashboard'));
			}else{
				$this->session->set_flashdata('warning', '<h4>Access Denied</h4><p>Username and Password is Wrong.</p>');
			}
		}
		$this->load->view('template/login',$data);
	}

	private function _menu($data)
	{
		$d = array();
		foreach ($data as $key => $value) {
			$v = explode("_", $value);
			if(!in_array($v[0],$d)){
				$d[] = $v[0];
			}
		}
		return $d;
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('auth/login'));
	}

	protected function _check()
	{
		$post = $this->input->post();
		$check = $this->AuthDB->credential($post);
		if ($check){
	    	return $check;
	   	}
	   	return FALSE;
	}
}
?>