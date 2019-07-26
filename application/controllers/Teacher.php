<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this teacher class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Teacher extends CI_Controller {

	function __construct()
 	{
 		parent::__construct();
 		require_once APPPATH."third_party/phppass/PasswordHash.php";
 		$this->load->model('TeacherDB');
 		$this->load->helper(array('form', 'url'));
 	}


	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/
	public function index()
	{
		$this->common->checkAuth('teacher_view');
		// Sidebar menu Management
		$data['menu'] = 'teacher';
		$data['sub_menu'] = 'teacher_view';
		$get = $this->input->get();
		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('teacher/index');
		$config['total_rows'] = $this->TeacherDB->count($get);
		$config['per_page'] = $perpage = 20;
		$config['reuse_query_string'] = TRUE;
		$config['uri_segment'] = 3;
		$page = $this->uri->segment(3,0);
		$this->pagination->initialize($config);
		//fetch data from teacher table
		$data['model'] = $this->TeacherDB->pagination($perpage,$page,$get);
		$data['branches'] = $this->TeacherDB->allBranches();
		$data['course'] = $this->TeacherDB->allCourses();

		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('teacher/index',$data);
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

		$this->common->checkAuth('teacher_view');
		// Sidebar menu Management
		$data['menu'] = 'teacher';
		$data['sub_menu'] = 'teacher_view';
		$data['model'] = $this->TeacherDB->findRow(['id'=>$id]);
		$data['branch'] = $this->TeacherDB->findBranchById($data['model']->branch);
		$data['course'] = $this->TeacherDB->findCourseById($data['model']->course);
		
        $this->common->checkAuth('teacher_view');
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('teacher/view',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as post method and save them in teacher Table
	* @return Teacher Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('teacher_create');
		// Sidebar menu Management
		$data['menu'] = 'teacher';
		$data['sub_menu'] = 'teacher_create';
		$post = $this->input->post();
		if(isset($post['course'])){
			$data['branches'] = $this->TeacherDB->allBranches(['course'=>$post['course']]);
		}else{
			$data['branches'] = ['Choose Branch'];
		}
		$data['courses'] = $this->TeacherDB->allCourses();
		// Form validation
		$PasswordHash = new PasswordHash();
		$this->form_validation->set_rules('name', 'Teacher Name', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('reg_no', 'Registration no', 'required');
		$this->form_validation->set_rules('emp_id', 'Teacher Id');
		$this->form_validation->set_rules('designation', 'Designation', 'required');
		$this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
		$this->form_validation->set_rules('d_o_joining', 'Date of joining', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[auth.username]',
				array('is_unique'=>"{field} is already Taken Please Choose another one.")
		);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[auth.email]',
				array('is_unique'=>"{field} is already Register Please Choose another one.")
		);
		$this->form_validation->set_rules('bio', 'Teacher Experience');
		$this->form_validation->set_rules('branch', 'branch', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('course', 'course', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('qua', 'Qualification', 'required');
		$this->form_validation->set_rules('ph_no', 'Phone No', 'required');

		if($this->form_validation->run() == TRUE){
			$post['name'] = strtoupper($post['name']);
			$post['designation'] = strtoupper($post['designation']);
			$post['d_o_joining'] = date("Y-m-d",strtotime($post['d_o_joining']));
			if($_FILES['pic']['error']==0){
				$post['pic'] = $this->_do_upload()['file_name'];
			}
			$auth["email"]=$post["email"];
			$auth["username"]=$post["username"];
			$auth["password"]=$PasswordHash->HashPassword($post['password']);
			$auth["user_type"]='2';
			unset($post["username"],$post["password"]);
			if($this->TeacherDB->save($post)){ // Save form data in teacher table
				$tid = $this->db->insert_id();
				$auth["profile_id"]=$tid;
                $this->TeacherDB->authSave($auth);
				$this->session->set_flashdata('success', '<h4>New Teacher</h4><p>New Teacher '.$post['name'].' is successfully Added.</p>');
				redirect(base_url('teacher')); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Teacher</h4><p>New Teacher '.$post['name'].' is Not successfully Added.</p>');
			}
		}
		//view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('teacher/create',$data);
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
		$this->common->checkAuth('teacher_update');
		$PasswordHash = new PasswordHash();
		// Sidebar menu Management
		$data['menu'] = 'teacher';
		$data['sub_menu'] = 'teacher_update';
		// Fetch data form table teacher table
		$data['model'] = $this->TeacherDB->findRow(['id'=>$id]);
		$data['branches'] = $this->TeacherDB->allBranches(['course'=>$data['model']->course]);
		$data['courses'] = $this->TeacherDB->allCourses();
		//keeping form data in post 
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('name', 'Teacher Name', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('reg_no', 'Registration no', 'required');
		$this->form_validation->set_rules('emp_id', 'Teacher Id');
		$this->form_validation->set_rules('designation', 'Designation', 'required');
		$this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('d_o_joining', 'Date of joining', 'required');
		$this->form_validation->set_rules('bio', 'Teacher Experience');
		$this->form_validation->set_rules('branch', 'branch', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('course', 'course', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('qua', 'Qualification', 'required');
		$this->form_validation->set_rules('ph_no', 'Phone No', 'required');
		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			$post['d_o_joining'] = date("Y-m-d",strtotime($post['d_o_joining']));
			if($_FILES['pic']['error']==0){
				$post['pic'] = $this->_do_upload()['file_name'];
			}
			$pass_check = (!empty($post['password'])?true:false);
			if($pass_check){
				$auth['profile_id'] = $id;
				$auth['user_type'] = '2';
				$auth["email"]=$post["email"];
				$auth["password"]=$PasswordHash->HashPassword($post['password']);
			}
			unset($post["password"],$post["userfile"]);
			if($this->TeacherDB->update($post)){ // Save form data in teacher table
				if($pass_check){
					$this->TeacherDB->authUpdate($auth);
				}
				$this->session->set_flashdata('success', '<h4>Update Teacher</h4><p>Update Teacher '.$post['name'].' is successfully Added.</p>');
				redirect(base_url('teacher')); // redirected to Teacher's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>Update Teacher</h4><p>Update Teacher '.$post['name'].' is Not successfully Added.</p>');
			}
		}
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);
		$this->load->view('teacher/update',$data);
		$this->load->view('template/footer');
	}

	  

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('teacher_delete');
	}

	private function _do_upload()
        {
                $config['upload_path']          = './teacherimages/';
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