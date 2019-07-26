<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this student class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Role extends CI_Controller {

	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('RoleDB');
 	}

	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/	
	public function index()
	{
		$this->common->checkAuth('role_view');
		// Sidebar menu Management
		$data['menu'] = 'role';
		$data['sub_menu'] = 'role_view';

		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('role/index');
		$config['total_rows'] = $this->RoleDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);

		// Fetch Data from (branch) table
		$data['model'] = $this->RoleDB->pagination($perpage,$page);

		// These are view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('role/index',$data);
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
		$this->common->checkAuth('role_view');
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('role/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as post method and save them in Branch Table
	* @return Branch Create page
	*/
	public function create()
	{
		$this->common->checkAuth('role_create');
		// Sidebar menu Management
		$data['menu'] = 'role';
		$data['sub_menu'] = 'role_create';
		// Store form data in post variable
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('name', 'Name', 'required');
		if($this->form_validation->run() == TRUE){
			$post['role'] = json_encode($post['role']);
			if($this->RoleDB->save($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>New Role</h4><p>New Role '.$post['name'].' is successfully Added.</p>');
				redirect('role'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Role</h4><p>New Role '.$post['name'].' is Not successfully Added.</p>');
			}
		}

		// These are view file
		$this->load->view('template/head');
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar');
		$this->load->view('role/create');
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
		$this->common->checkAuth('role_update');
		// Sidebar menu Management
		$data['menu'] = 'role';
		$data['sub_menu'] = 'role_update';
		// Fetch data form table branch table
		$data['model'] = $this->RoleDB->findRow(['id'=>$id]);
		$data['model']->role = json_decode($data['model']->role);
		// Store form data in post variable
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('name', 'Name', 'required');
		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			$post['role'] = json_encode($post['role']);
			if($this->RoleDB->update($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>Update Role</h4><p>Update Role '.$post['name'].' is successfully Update.</p>');
				redirect('role'); // redirected to Branch's update method
			}else{
				$this->session->set_flashdata('warning', '<h4>Update Role</h4><p>Update Role '.$post['name'].' is Not successfully Update.</p>');
			}
		}

		// These are view file
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);
		$this->load->view('role/update',$data);
		$this->load->view('template/footer');
	}

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('role_delete');
		$this->RoleDB->delete($id);
		$this->session->set_flashdata('success', '<h4>Delete Role</h4><p>Role is successfully Deleted.</p>');
		redirect(base_url('role'));
		
	}
}