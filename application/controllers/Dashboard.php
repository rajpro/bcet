<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Here in this Dashboard class we can show the statistical overview.
 * @author  Group Alpha   
 */
class Dashboard extends CI_Controller {


    /**
	* Here we show the statistical overview.
	* @return Dashboard view page to browser
	*/
	public function index()
	{
		if(!$this->session->logged_in){
			redirect(base_url());
		}
		// echo "<pre>";print_r($_SESSION);
		// exit();
		$data['menu'] = 'dashboard';
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('dashboard/admin',$data);
		$this->load->view('template/footer',$data);
		// $this->load->view('template/new_notification',$data);
		// $this->load->view('template/notification_list',$data);

	}

	public function account()
	{
		if(!$this->session->logged_in){
			redirect(base_url());
		}
		require_once APPPATH."third_party/phppass/PasswordHash.php";
		$this->load->model('TeacherDB');
		$this->load->model('StaffDB');
		$data['menu'] = 'dashboard';
		// echo "<pre>";print_r($_SESSION);
		// exit();
		if ($this->session->user_type==2) {
			$data['model'] = $this->TeacherDB->findRow(['id'=>$this->session->profile['id']]);
			$this->form_validation->set_rules('name', 'Enter Your Name', 'required|alpha_numeric_spaces');
			$this->form_validation->set_rules('bio', 'Your Experience');
		    $this->form_validation->set_rules('email', 'Email','required|valid_email');
		} else {
			$data['model'] = $this->StaffDB->findRow(['id'=>$this->session->profile['id']]);
			$this->form_validation->set_rules('name', 'Enter Your Name', 'required|alpha_numeric_spaces');
	    	$this->form_validation->set_rules('email', 'Email','required|valid_email');
		}
		$PasswordHash = new PasswordHash();

		if($this->form_validation->run() == TRUE){
			$post=$this->input->post();
			$post['id'] = $this->session->profile['id'];
			//$post['pic'] = $this->_do_upload()['file_name'];
			$pass_check = (!empty($post['password'])?true:false);
			if($pass_check){
				$auth['profile_id'] = $this->session->profile['id'];
				$auth["email"]=$post["email"];
				$auth["user_type"]=$this->session->user_type;
				$auth["password"]=$PasswordHash->HashPassword($post['password']);
			}
			if (isset($_FILES['userfile']) and $_FILES['userfile']['error']!=4) {
				if (!empty($this->_do_upload()['file_name'])) {
					$post['pic'] = $this->_do_upload()['file_name'];
				}
			}

			unset($post["password"],$post["userfile"]);
			
			if ($this->session->user_type==2) {
				$update = $this->TeacherDB->update($post);
			}else{
				$update = $this->StaffDB->update($post);
			}
			
			if($update){ // Save form data in teacher table
				if($pass_check){
					if($this->session->user_type==2){
						$this->TeacherDB->authUpdate($auth);
					}else{
						$this->StaffDB->authUpdate($auth);
					}
				}
				$this->session->set_flashdata('success', '<h4>Profile</h4> '.$post['name'].' is successfully Updated.</p>');
				redirect('dashboard/account/'); // redirected to Teacher's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>Update Teacher</h4><p>Update Teacher '.$post['name'].' is Not successfully Added.</p>');
			}
		}
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('dashboard/account',$data);
		$this->load->view('template/footer',$data);
	}

	private function _do_upload()
    {
        $config['upload_path']          = './teacherimages/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = '1024';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('userfile'))
        {
                $error = array('error' => $this->upload->display_errors());

        }
        else
        {
            return $this->upload->data();
        }
    }

}	
