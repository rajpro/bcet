<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this teacher class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Staff extends CI_Controller {

	function __construct()
 	{
 		parent::__construct();
 		require_once APPPATH."third_party/phppass/PasswordHash.php";
 		$this->load->model('StaffDB');
 	}


	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/
	public function index()
	{
		$this->common->checkAuth('staff_view');
		// Sidebar menu Management
		$data['menu'] = 'staff';
		$data['sub_menu'] = 'staff_view';
		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('staff/index');
		$config['total_rows'] = $this->StaffDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);
		//fetch data from teacher table
		$data['model'] = $this->StaffDB->pagination($perpage,$page);
		//view 
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('staff/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as parameter and retrive a perticular teacher data
	* and View All data.
	* @param int $id This is a teacher (id) field in teacher Table.
	* @return teacher Detail View page to browser
	*/
	public function view($id)
	{
		$this->common->checkAuth('staff_view');
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('staff/index');
		$this->load->view('template/footer');
	}

	/**
	* Get data as post method and save them in teacher Table
	* @return Teacher Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('staff_create');
		$PasswordHash = new PasswordHash();
		// Sidebar menu Management
		$data['menu'] = 'staff';
		$data['sub_menu'] = 'staff_create';
		$data['roles'] = $this->StaffDB->roles();
		$PasswordHash = new PasswordHash();
		//keeping form data in post 
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('name', 'Staff Name', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('desgn', 'Designation', 'required');
		$this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
		
		if($this->form_validation->run() == TRUE){

			

			$post['name'] = $post['name'];
			$auth["email"]=$post["email"];
			$auth['username'] = $post['username'];
			$auth['password'] = $PasswordHash->HashPassword($post['password']);
			$auth["user_type"]=$post['role'];
			unset($post['username'],$post['password']);
			if($this->StaffDB->save($post)){ // Save form data in teacher table
                $tid = $this->db->insert_id();
				$auth["profile_id"]=$tid;
                $this->StaffDB->authSave($auth);
				$this->session->set_flashdata('success', '<h4>New Staff</h4><p>New Staff '.$post['name'].' is successfully Added.</p>');
				redirect('staff'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Staff</h4><p>New Staff '.$post['name'].' is Not successfully Added.</p>');
			}
		}
		//view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('staff/create',$data);
		$this->load->view('template/footer',$data);
	}
	

	/**
	* Get data as parameter and retrive a perticular student data
	* and update them.
	* @param int $id This is a student (id) field in Teacher Table.
	* @return Teacher update page to browser
	*/
	public function update($id)
	{
		$this->common->checkAuth('staff_update');
		$PasswordHash = new PasswordHash();
		// Sidebar menu Management
		$data['menu'] = 'staff';
		$data['sub_menu'] = 'staff_update';

		$data['roles'] = $this->StaffDB->roles();
		$data['model'] = $this->StaffDB->findRow(['id'=>$id]);
		$authDetail = $this->StaffDB->findUsername($data['model']->id,$data['model']->role);
		//keeping form data in post 
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('name', 'Staff Name', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('desgn', 'Designation', 'required');
		$this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
		if($this->form_validation->run() == TRUE){
			if($_FILES['pic']['error']==0){
				$post['pic'] = $this->_do_upload()['file_name'];
			}
			$post['id'] = $id;
			$pass_check = (!empty($post['password'])?true:false);
			if($pass_check){
				$auth['profile_id'] = $id;
				$auth['user_type'] =$post["role"] ;
				$auth["email"]=$post["email"];
				$auth["password"]=$PasswordHash->HashPassword($post['password']);
			}
			unset($post["password"]);
			if($this->StaffDB->update($post)){ // Save form data in teacher table
				if($pass_check){
					$this->StaffDB->authUpdate($auth);
				}
				$this->session->set_flashdata('success', '<h4>Update Staff</h4><p>Update Staff '.$post['name'].' is successfully Added.</p>');
				redirect('staff'); // redirected to Teacher's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>Update Staff</h4><p>Update Staff '.$post['name'].' is Not successfully Added.</p>');
			}
		}
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);
		$this->load->view('staff/update',$data);
		$this->load->view('template/footer');
	
	}

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('staff_delete');
	}
	private function _do_upload()
        {
                $config['upload_path']          = './staffimages/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = '1024';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('pic'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    return $this->upload->data();
                }
        }
}