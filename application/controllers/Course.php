<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this Course class we can add,View,Update
 * academic details and view the details. 
 * @author  Group Alpha   
 */

class Course extends CI_Controller {

	/**
	* Get records from database and list them as table view
	* @return Course view page to browser
	*/function __construct()
 	{
 		parent::__construct();
 		$this->load->model('CourseDB');
 	}
	public function index()
	{
		$this->common->checkAuth('course_view');
		$data['menu'] = 'course';
		$data['sub_menu'] = 'course_view';
		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('course/index');
		$config['total_rows'] = $this->CourseDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);
		//fetch data from academic table
		$data['model'] = $this->CourseDB->pagination($perpage,$page);


		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('course/index',$data);
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
		$this->common->checkAuth('course_view');
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('course/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as post method and save them in CourseTable
	* @return Course Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('course_create');
		$data['menu'] = 'course';
		$data['sub_menu'] = 'course_create';
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('name', 'Course Name','required|regex_match[/^[a-zA-Z].[a-zA-Z]+$/]');
		if($this->form_validation->run() == TRUE){
			if($this->CourseDB->save($post)){ // Save form data in course table
				$this->session->set_flashdata('success', '<h4>New Course</h4><p>New Course'.$post['name'].' is successfully Added.</p>');
				redirect('course'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Course</h4><p>New Course'.$post['name'].' is Not successfully Added.</p>');
			}
		}

		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('course/create',$data);
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
		$this->common->checkAuth('course_update');
		$data['menu'] = 'course';
		$data['sub_menu'] = 'course_create';
		// Fetch data form table branch table
		$data['model'] = $post = $this->CourseDB->findRow(['id'=>$id]);
        $post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('name', 'Course Name','required|regex_match[/^[a-zA-Z].[a-zA-Z]+$/]');
		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			if($this->CourseDB->update($post)){ // Save form data in course table
				$this->session->set_flashdata('success', '<h4>Course</h4><p>New Course '.$post['name'].' is successfully Updated.</p>');
				redirect('course'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>Course</h4><p>New Course '.$post['name'].' is Not successfully Updated.</p>');
			}
		}
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('course/update',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get perticular batch id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('course_delete');
		
	}
}
