<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this student class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Subject extends CI_Controller {

	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('SubjectDB');
 	}

	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/
	public function index()
	{
		$this->common->checkAuth('subject_view');
		$data['menu'] = 'subject';
		$data['sub_menu'] = 'subject_view';

		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('subject/index');
		$config['total_rows'] = $this->SubjectDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);

		// Fetch Data from (subject) table
		$data['model'] = $this->SubjectDB->pagination($perpage,$page);
        $data['branches'] = $this->SubjectDB->findBranches($data['model']);
		// These are view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('subject/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as parameter and retrive a perticular student data
	* and View All data.
	* @param int $id This is a student (id) field in Student Table.
	* @return Student Detail View page to browser
	*/
	public function view($id)
	{
		$this->common->checkAuth('subject_view');
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('subject/update');
		$this->load->view('template/footer');
	
	}

	/**
	* Get data as post method and save them in Student Table
	* @return Student Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('subject_create');
		$data['menu'] = 'subject';
		$data['sub_menu'] = 'subject_create';
		// Store form data in post variable
		$post = $this->input->post();
		$data['branch'] = $this->SubjectDB->allBranches();
		$data['course'] = $this->SubjectDB->allCourse();
		// Form validation
		$this->form_validation->set_rules('branch', 'Branch', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('sub_name', 'Subject Name', 'required');
		$this->form_validation->set_rules('course', 'Course Name','required|is_natural_no_zero');
		$this->form_validation->set_rules('sub_type', 'Subject Type', 'required');
		if($this->form_validation->run() == TRUE){
			$post['sub_name'] = strtoupper($post['sub_name']);
			if($this->SubjectDB->save($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>Subject details</h4><p>Subject details '.$post['sub_name'].' is successfully Added.</p>');
				redirect('subject'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>Subject details</h4><p>Subject details '.$post['sub_name'].' is Not successfully Added.</p>');
			}
		}

		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('subject/create',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as parameter and retrive a perticular student data
	* and update them.
	* @param int $id This is a student (id) field in Student Table.
	* @return Student update page to browser
	*/
	public function update($id)
	{
		$this->common->checkAuth('subject_update');
        $data['menu'] = 'subject';
		$data['sub_menu'] = 'subject_update';

		// Fetch data form table branch table
		$data['model'] = $post = $this->SubjectDB->findRow(['id'=>$id]);
		// Store form data in post variable
		$post = $this->input->post();
		$data['branch'] = $this->SubjectDB->allBranches();
		$data['course'] = $this->SubjectDB->allCourse();
		// Form validation
		$this->form_validation->set_rules('branch', 'Branch Name', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('sub_name', 'Subject Name', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('course', 'Course Name','required|is_natural_no_zero');
		$this->form_validation->set_rules('sub_type', 'Subject Type', 'required');
		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			$post['sub_name'] = strtoupper($post['sub_name']);
			if($this->SubjectDB->update($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>Update Subject</h4><p>Update Subject '.$post['sub_name'].' is successfully Update.</p>');
				redirect('subject'); // redirected to Branch's update method
			}else{
				$this->session->set_flashdata('warning', '<h4>Update Subject</h4><p>Update Subject'.$post['sub_name'].' is Not successfully Update.</p>');
			}
		}
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('subject/update',$data);
		$this->load->view('template/footer',$data);
	
	}

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('subject_delete');
		
	}
}