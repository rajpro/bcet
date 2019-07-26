<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this student class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Classextend extends CI_Controller {

	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('ClassextendDB');
 	}

	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/	
	public function class_extend_index()
	{
		// Sidebar menu Management
		 $this->common->checkAuth('extra_view');
		$data['menu'] = 'extra';
		$data['sub_menu'] = 'class_extend_view';
       
		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('classextend/class_extend_index');
		$config['total_rows'] = $this->ClassextendDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);

		// Fetch Data from (branch) table
		$data['model'] = $this->ClassextendDB->pagination($perpage,$page);

		// These are view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('extra/class_extend_index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as parameter and retrive a perticular student data
	* and View All data.
	* @param int $id This is a student (id) field in Student Table.
	* @return Student Detail View page to browser
	*/
	public function class_extend_view($id)
	{
	    $this->common->checkAuth('extra_view');
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('extra/class_extend_index');
		$this->load->view('template/footer');
	}

	/**
	* Get data as post method and save them in Branch Table
	* @return Branch Create page
	*/

	
	public function class_extend_create()
	{
		// Sidebar menu Management
		 $this->common->checkAuth('extra_create');
		$data['menu'] = 'extra';
		$data['sub_menu'] = 'class_extend_create';
		$data['course'] = $this->ClassextendDB->allCourses();
		$data['branch'] = $this->ClassextendDB->allBranches();
		$data['academicyear'] = $this->ClassextendDB->allAcademicyear();
		// Store form data in post variable
		$post = $this->input->post();
		// Form validation
		if($this->form_validation->run() == TRUE){
			$post['date'] = date("Y-m-d",strtotime($post['date']));
			if($this->ClassextendDB->save($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>New Teacher</h4><p>New Teacher '.$post['app_teacher'].' is successfully Added.</p>');
				redirect('classextend'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Teacher</h4><p>New Teacher '.$post['app_teacher'].' is Not successfully Added.</p>');
			}
		}

		// These are view file
		$this->load->view('template/head');
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar');
		$this->load->view('extra/class_extend_create');
		$this->load->view('template/footer');
	}

	

	/**
	* Get data as parameter and retrive a perticular student data
	* and update them.
	* @param int $id This is a student (id) field in Student Table.
	* @return Student update page to browser
	*/
	public function update($id)
	{
		$this->common->checkAuth('extra_update');


	}

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('extra_delete');
		
		
	}
}