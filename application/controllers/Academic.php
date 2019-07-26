<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this academic class we can add,View,Update
 * academic details and view the details. 
 * @author  Group Alpha   
 */

class Academic extends CI_Controller {

	/**
	* Get records from database and list them as table view
	* @return Academic view page to browser
	*/
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('AcademicDB');
 	}

	public function index()
	{
		$this->common->checkAuth('academic_view');
		$data['menu'] = 'academic';
		$data['sub_menu'] = 'academic_view';
		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('academic/index');
		$config['total_rows'] = $this->AcademicDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);
		//fetch data from academic table
		$data['model'] = $this->AcademicDB->pagination($perpage,$page);
		//view 
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('academic/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as parameter and retrive a perticular academic data
	* and View All data.
	* @param int $id This is a academic (id) field in Academic Table.
	* @return Academic Detail View page to browser
	*/
	public function view($id)
	{
		$this->common->checkAuth('academic_view');
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('academic/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as post method and save them in Academic Table
	* @return Academic Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('academic_create');
		$data['menu'] = 'academic';
		$data['sub_menu'] = 'academic_create';
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('academic_name', 'Academic Name', 'required|max_length[20]');
		$this->form_validation->set_rules('start_year', 'Start Year', 'required|regex_match[/^[0-9-]+$/]');
		$this->form_validation->set_rules('end_year', 'End Year', 'required|regex_match[/^[0-9-]+$/]');

		if($this->form_validation->run() == TRUE){
			$post['start_year'] = date("Y-m-d",strtotime($post['start_year']));
			$post['end_year'] = date("Y-m-d",strtotime($post['end_year']));
			if($this->AcademicDB->save($post)){ // Save form data in Academic table
				$this->session->set_flashdata('success', '<h4>New Academic</h4><p>New Academic '.$post['academic_name'].' is successfully Added.</p>');
				redirect('academic'); // redirected to Academic's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Academic</h4><p>New Academic '.$post['academic_name'].' is Not successfully Added.</p>');
			}
		}
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('academic/create',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as parameter and retrive a perticular academic data
	* and update them.
	* @param int $id This is a academic (id) field in Academic Table.
	* @return Academic update page to browser
	*/
	public function update($id)
	{
		$this->common->checkAuth('academic_update');
		$data['menu'] = 'academic';
		$data['sub_menu'] = 'academic_update';
		// Fetch data form table branch table
		$data['model'] = $post = $this->AcademicDB->findRow(['id'=>$id]);
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('academic_name', 'Academic Name', 'required|max_length[20]');
		$this->form_validation->set_rules('start_year', 'Start Year', 'required|regex_match[/^[0-9-]+$/]');
		$this->form_validation->set_rules('end_year', 'End Year', 'required|regex_match[/^[0-9-]+$/]');

		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			$post['start_year'] = date("Y-m-d",strtotime($post['start_year']));
			$post['end_year'] = date("Y-m-d",strtotime($post['end_year']));
			if($this->AcademicDB->update($post)){ // Save form data in Academic table
				$this->session->set_flashdata('success', '<h4>Update Academic</h4><p>Academic Detais '.$post['academic_name'].' is successfully Updated.</p>');
				redirect('academic'); // redirected to Academic's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>Update Academic</h4><p>Academic Update '.$post['academic_name'].' is Not successfully Updated.</p>');
			}
		}	
	
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('academic/update',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get perticular academic id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('academic_delete');
	}
}