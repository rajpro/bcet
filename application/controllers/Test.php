<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this academic class we can add,View,Update
 * academic details and view the details. 
 * @author  Group Alpha   
 */

class Test extends CI_Controller {

	/**
	* Get records from database and list them as table view
	* @return Academic view page to browser
	*/
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('TestDB');
 	}
	public function index()
	{
		$this->common->checkAuth('test_view');
		$data['menu'] = 'test';
		$data['sub_menu'] = 'test_view';
        // Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('test/index');
		$config['total_rows'] = $this->TestDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);
		//fetch data from academic table
		$data['model'] = $this->TestDB->pagination($perpage,$page);

		//echo "<pre>";print_r($data['model']);
		//exit();
		//view 
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('test/index',$data);
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
        $this->common->checkAuth('test_view');
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('test/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as post method and save them in Academic Table
	* @return Academic Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('test_create');
		$data['menu'] = 'test';
		$data['sub_menu'] = 'test_create';
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('test_name', 'Academic Name', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('mark', 'Mark', 'required|regex_match[/^[0-9-]+$/]');
		
		if($this->form_validation->run() == TRUE){
			if($this->TestDB->save($post)){ // Save form data in Academic table
				$this->session->set_flashdata('success', '<h4>New Test</h4><p>New test '.$post['test_name'].' is successfully Added.</p>');
				redirect('test'); // redirected to Academic's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Test</h4><p>New Test '.$post['test_name'].' is Not successfully Added.</p>');
			}
		}
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('test/create',$data);
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
		$this->common->checkAuth('test_update');
		$data['menu'] = 'test';
		$data['sub_menu'] = 'test_update';
			
		// Fetch data form table branch table
		$data['model'] = $post = $this->TestDB->findRow(['id'=>$id]);
		// Store form data in post variable
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('test_name', 'Academic Name', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('mark', 'Mark', 'required|regex_match[/^[0-9-]+$/]');
		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			if($this->TestDB->update($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>Update Test</h4><p>Update Test '.$post['test_name'].' is successfully Update.</p>');
				redirect('test'); // redirected to Branch's update method
			}else{
				$this->session->set_flashdata('warning', '<h4>Update Test</h4><p>Update Test '.$post['test_name'].' is Not successfully Update.</p>');
			}
		}
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('test/update',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get perticular academic id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('test_delete');
	}
}