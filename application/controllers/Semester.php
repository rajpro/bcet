<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this Course class we can add,View,Update
 * academic details and view the details. 
 * @author  Group Alpha   
 */

class Semester extends CI_Controller {

	/**
	* Get records from database and list them as table view
	* @return Course view page to browser
	*/function __construct()
 	{
 		parent::__construct();
 		$this->load->model('SemesterDB');
 	}
	public function index()
	{
		$this->common->checkAuth('semester_view');
		$data['menu'] = 'semester';
		$data['sub_menu'] = 'semester_view';
		//
		$data['courses'] = $this->SemesterDB->allCourses();
		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('Semester/index');
		$config['total_rows'] = $this->SemesterDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);
		//fetch data from academic table
		$data['model'] = $this->SemesterDB->pagination($perpage,$page);


		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('Semester/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as parameter and retrive a perticular course data
	* and View All data.
	* @param int $id This is a course (id) field in Course Table.
	* @return course Detail View page to browser
	*/
	public function view($id)
	{
		$this->common->checkAuth('semester_view');

		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('Semester/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as post method and save them in CourseTable
	* @return Course Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('semester_create');
		$data['menu'] = 'Semester';
		$data['sub_menu'] = 'Semester_create';
		$post = $this->input->post();
		$data['courses'] = $this->SemesterDB->allCourses();
		// Form validation
		$this->form_validation->set_rules('name', 'Semester Name','required');
		$this->form_validation->set_rules('course_id', 'Course id','required|numeric');

		if($this->form_validation->run() == TRUE){
			if($this->SemesterDB->save($post)){ // Save form data in course table
				$this->session->set_flashdata('success', '<h4>New Semester</h4><p>New Semester'.$post['name'].' is successfully Added.</p>');
				redirect('Semester'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Semester</h4><p>New Semester'.$post['name'].' is Not successfully Added.</p>');
			}
		}

		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('Semester/create',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as parameter and retrive a perticular batch data
	* and update them.
	* @param int $id This is a batch (id) field in Batch Table.
	* @return Batch update page to browser
	*/
	public function update($id)
	{
		$this->common->checkAuth('semaster_update');
		$data['menu'] = 'Semester';
		$data['sub_menu'] = 'Semester_create';
		// Fetch data form table branch table
		$data['model'] = $this->SemesterDB->findRow(['id'=>$id]);
		$data['courses'] =  $this->SemesterDB->allCourses();
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('name', 'Semester Name','required');
		$this->form_validation->set_rules('course_id', 'Course Id','required|numeric');

		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			if($this->SemesterDB->update($post)){ // Save form data in course table
				$this->session->set_flashdata('success', '<h4>Semester</h4><p>New Semester '.$post['name'].' is successfully Updated.</p>');
				redirect('semester'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>Semester</h4><p>New Semester'.$post['name'].' is Not successfully Updated.</p>');
			}
		}
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('Semester/update',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get perticular batch id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('semester_delete');
		
		
	}
}