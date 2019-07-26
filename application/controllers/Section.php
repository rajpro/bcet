<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this student class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Section extends CI_Controller {
    
    function __construct()
 	{
 		parent::__construct();
 		$this->load->model('SectionDB');
 	}

	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/
	public function index()
	{
		$this->common->checkAuth('section_view');
		// Sidebar menu Management
		$data['menu'] = 'section';
		$data['sub_menu'] = 'section_view';

		$post = $this->input->post();
		$data['course'] = $this->SectionDB->allCourses();
		$data['academicyear'] = $this->SectionDB->allAcademicyear();
		$this->form_validation->set_rules('acid', 'acid', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('branch', 'branch', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('course', 'course', 'required|is_natural_no_zero');
	    if($this->form_validation->run() == TRUE){
		$data['model'] = $this->SectionDB->allSection(['acid'=>$post['acid'],'course'=>$post['course'],'branch'=>$post['branch']]);
		}
		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('section/index');
		$config['total_rows'] = $this->SectionDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);

		// Fetch Data from (branch) table
		//$data['model'] = $this->SectionDB->pagination($perpage,$page);

		// These are view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('section/index',$data);
		$this->load->view('template/footer',$data);

		
	}

	/**
	* Get data as parameter and retrive a perticular student data
	* and View All data.
	* @param int $id This is a student (id) field in Student Table.
	* @return Student Detail View page to browser
	*/
	
	/**
	* Get data as post method and save them in Student Table
	* @return Student Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('section_create');
		// Sidebar menu Management
		$data['menu'] = 'section';
		$data['sub_menu'] = 'section_create';
        // Store form data in post variable
		$post = $this->input->post();
		// Form validation
		$data['courses'] = $this->SectionDB->allCourses();
		$data['academicyear'] = $this->SectionDB->allAcademicyear();
		$this->form_validation->set_rules('stu_from', 'Student From', 'required|integer|max_length[50]');
		$this->form_validation->set_rules('stu_to', 'Student to', 'required|integer|max_length[50]');
		$this->form_validation->set_rules('sec', 'Section', 'required');
		
		if($this->form_validation->run() == TRUE){
			if($this->SectionDB->save($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>New Section details</h4><p>New Section details '.$post['sec'].' is successfully Added.</p>');
				redirect('section'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Section details</h4><p>New Section details '.$post['sec'].' is Not successfully Added.</p>');
			}
        }
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('section/create',$data);
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
		$this->common->checkAuth('section_update');
		// Sidebar menu Management
		$data['menu'] = 'section';
		$data['sub_menu'] = 'section_update';
		// Fetch data form table student table
		$data['model'] = $this->SectionDB->findRow(['id'=>$id]);
		// Store form data in post variable
		$data['branch'] = $this->SectionDB->allBranches();
		$data['courses'] = $this->SectionDB->allCourses();
		$data['academicyear'] = $this->SectionDB->allAcademicyear();
		//keeping form data in post 
        $post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('stu_from', 'Student From', 'required|integer|max_length[50]');
		$this->form_validation->set_rules('stu_to', 'Student to', 'required|integer|max_length[50]');
		$this->form_validation->set_rules('sec', 'Section', 'required');
		
		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			
			if($this->SectionDB->update($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>New Section details Update</h4><p>New Section details Update '.$post['sec'].' is successfully Added.</p>');
				redirect('section'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Section details Update</h4><p>New Section details Update '.$post['sec'].' is Not successfully Added.</p>');
			}
		}

		// These are view file
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);
		$this->load->view('section/update',$data);
		$this->load->view('template/footer');
	}

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('section_delete');
	
	}
	// These are view file
}

	