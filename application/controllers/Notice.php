<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this academic class we can add,View,Update
 * academic details and view the details. 
 * @author  Group Alpha   
 */

class Notice extends CI_Controller {

	/**
	* Get records from database and list them as table view
	* @return Academic view page to browser
	*/
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('NoticeDB');
 	}
	public function index()
	{
		$this->common->checkAuth('notice_view');
		$data['menu'] = 'notice';
		$data['sub_menu'] = 'notice_view';
        // Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('notice/index');
		$config['total_rows'] = $this->NoticeDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);
		//fetch data from academic table
		$data['model'] = $this->NoticeDB->pagination($perpage,$page);

		//echo "<pre>";print_r($data['model']);
		//exit();
		//view 
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('notice/index',$data);
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
        $this->common->checkAuth('notice_view');
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('notice/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as post method and save them in Academic Table
	* @return Academic Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('notice_create');
		$data['menu'] = 'notice';
		$data['sub_menu'] = 'notice_create';
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('notice_subject', 'Notice Subject',"required");
		$this->form_validation->set_rules('notice_content', 'Notice Content');
		$this->form_validation->set_rules('notice_date', 'Notice Date');
		$this->form_validation->set_rules('notice_for', 'Notice For',"required");
        
		if($this->form_validation->run() == TRUE){
			$post['notice_date'] = date("Y-m-d",strtotime($post['notice_date']));
			if($_FILES['file_name']['error']==0){
				$post['file_name'] = $this->_do_upload()['file_name'];
			}
			if($this->NoticeDB->save($post)){

				$this->_email_all_teacher($post);
			 // Save form data in Academic table
				$this->session->set_flashdata('success', '<h4>New Notice</h4><p>New Notice '.$post['notice_subject'].' is successfully Added.</p>');
				redirect('notice'); // redirected to Academic's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Notice</h4><p>New Notice '.$post['notice_subject'].' is Not successfully Added.</p>');
			}
		}
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('notice/create',$data);
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
		$this->common->checkAuth('notice_update');
		$data['menu'] = 'notice';
		$data['sub_menu'] = 'notice_update';
		// Fetch data form table branch table
		$data['model'] = $post = $this->NoticeDB->findRow(['id'=>$id]);
        $post = $this->input->post();

        $this->form_validation->set_rules('notice_subject', 'Notice Subject',"required");
		$this->form_validation->set_rules('notice_content', 'Notice Content');
		$this->form_validation->set_rules('notice_date', 'Notice Date');

		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			if($_FILES['file_name']['error']==0){
				$post['file_name'] = $this->_do_upload()['file_name'];
			}
			if($this->NoticeDB->update($post)){ // Save form data in course table
				$this->session->set_flashdata('success', '<h4>Notice</h4><p>New Notice '.$post['notice_subject'].' is successfully Updated.</p>');
				redirect('notice'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>Notice</h4><p>New Notice '.$post['notice_subject'].' is Not successfully Updated.</p>');
			}
		}
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('notice/update',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get perticular academic id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('notice_delete');
		$this->NoticeDB->delete($id);
		$this->session->set_flashdata('success', '<h4>Delete Notice</h4><p>Notice is successfully Deleted.</p>');
		redirect(base_url('notice'));
		
	}

	private function _email_all_teacher($data)
	{
		$this->load->library('email');
		$teacher = $this->db->get('teacher')->result();
		if(empty($data['file_name'])){
			$message = $data['notice_content'];
		}else{
			$message = "Click On the Link<br>".$data['notice_content'];
		}
		foreach ($teacher as $key => $value) {
			$this->email->to($value->email);
			$this->email->from('noreply@bcetorissa.org','Balasore College of Engg & Tech.');
			$this->email->subject($data['notice_subject']);
			$this->email->message($message);
			$this->email->send();
		}
	}

	private function _do_upload()
    {
        $config['upload_path']          = './notice_files/';
        $config['file_name']          = md5(time());
        $config['allowed_types']        = 'jpg|png|pdf|jpeg';
        $config['max_size']             = '2048';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('file_name'))
        {
            $error = array('error' => $this->upload->display_errors());
        }
        else
        {
            return $this->upload->data();
        }
    }
}