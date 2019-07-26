<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this student class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Web extends CI_Controller {

	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('WebDB');
 	}

	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/	
	public function index()
	{
		// Sidebar menu Management
		$data['menu'] = 'web';
		$data['sub_menu'] = 'web_view';

		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('web/index');
		$config['total_rows'] = $this->WebDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);

		// Fetch Data from (branch) table
		$data['model'] = $this->WebDB->pagination($perpage,$page);

		// These are view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('web/index',$data);
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
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('web/index');
		$this->load->view('template/footer');
	}

	/**
	* Get data as post method and save them in Branch Table
	* @return Branch Create page
	*/
	public function create()
	{
		// Sidebar menu Management
		$data['menu'] = 'web';
		$data['sub_menu'] = 'web_create';
		// Store form data in post variable
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('title', 'Title','required');
		$this->form_validation->set_rules('content', 'Title Content');
		$this->form_validation->set_rules('con_type', 'Content Type');
		if($this->form_validation->run() == TRUE){
			if($_FILES['pic']['error']!=4){
				$post['pic'] = $this->_do_upload()['file_name'];
			}
			// uppercase the branch code
			if($this->WebDB->save($post)){
			 // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>Web Content</h4><p>Web Content is successfully Added.</p>');
				redirect('web'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>Web Content</h4><p>Web Content is Not successfully Added.</p>');
			}
		}

		// These are view file
		$this->load->view('template/head');
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar');
		$this->load->view('web/create');
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
		// Sidebar menu Management
		$data['menu'] = 'web';
		$data['sub_menu'] = 'web_update';
		// Fetch data form table branch table
		$data['model'] = $post = $this->WebDB->findRow(['id'=>$id]);
		// Store form data in post variable
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('title', 'Title','required');
		$this->form_validation->set_rules('content', 'Title Content');
		$this->form_validation->set_rules('con_type', 'Content Type');
		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			if($_FILES['pic']['error']!=4){
				$post['pic'] = $this->_do_upload()['file_name'];
			} else {
				unset($post['pic']);
			}
			if($this->WebDB->update($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>Update</h4><p>Web Content '.$post[''].' is successfully Update.</p>');
				redirect('web'); // redirected to Branch's update method
			}else{
				$this->session->set_flashdata('warning', '<h4>Update</h4><p>Web Content '.$post[''].' is Not successfully Update.</p>');
			}
		}

		// These are view file
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);
		$this->load->view('web/update',$data);
		$this->load->view('template/footer');
	}

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		
		
	}

	private function _do_upload()
    {
        $config['upload_path']          = './home_assets/images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = '1024';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('pic')){
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }else{
            return $this->upload->data();
        }
    }
}