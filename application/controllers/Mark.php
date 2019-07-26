<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this Course class we can add,View,Update
 * academic details and view the details. 
 * @author  Group Alpha   
 */

class Mark extends CI_Controller {

	/**
	* Get records from database and list them as table view
	* @return Course view page to browser
	*/function __construct()
 	{
 		parent::__construct();
 		$this->load->model('MarkDB');
 	}
	public function index()
	{
		$this->common->checkAuth('mark_view');
		$data['menu'] = 'mark';
		$data['sub_menu'] = 'mark_view';
		$post = $this->input->post();
		$data['test'] = $this->MarkDB->allTestName();
		$data['course'] = $this->MarkDB->allCourses();
		$data['academicyear'] = $this->MarkDB->allAcademicyear();
		
	    $this->form_validation->set_rules('teacher', 'teacher', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('semester', 'semester', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('subject_id', 'subject_id', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('acid', 'acid', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('branch', 'branch', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('course', 'course', 'required|is_natural_no_zero');
	    
	    if($this->form_validation->run() == TRUE){
			$data['model'] = $this->MarkDB->findStudent(['acid'=>$post['acid'],'course'=>$post['course'],'branch'=>$post['branch']]);
			$data['tests_head'] = $this->MarkDB->findTestHeald($post);
			foreach($data['model'] as $key => $val){
				$sid[] = $val->id;
			}
			if($post['test']=='0'){
				$data['secured_mark'] = $this->MarkDB->findSecuredMark($sid,['semester_id'=>$post['semester'],'subject_id'=>$post['subject_id']]);
			}else{
				$data['secured_mark'] = $this->MarkDB->findSecuredMark($sid,['semester_id'=>$post['semester'],'subject_id'=>$post['subject_id'],'test_id'=>$post['test']]);
			}
			foreach($data['tests_head'] as $key => $val){
				$tm[] = $val->test_id;
				$data['tests_mark'] = $this->MarkDB->findTestMark($tm);
			}
	    	
	    }
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('mark/index',$data);
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
		$this->common->checkAuth('mark_view');
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('mark/view',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as post method and save them in CourseTable
	* @return Course Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('mark_create');
		$data['menu'] = 'mark';
		$data['sub_menu'] = 'mark_create';
		$data['post'] = $post = $this->input->post();
		$data['test'] = $this->MarkDB->allTestName();
		$data['course'] = $this->MarkDB->allCourses();
		$data['academicyear'] = $this->MarkDB->allAcademicyear();
	    if(!empty($post) && empty($post['stu'])){
	   		$this->form_validation->set_rules('teacher', 'teacher', 'required|is_natural_no_zero');
	    	$this->form_validation->set_rules('semester', 'semester', 'required|is_natural_no_zero');
	    	$this->form_validation->set_rules('subject_id', 'subject', 'required|is_natural_no_zero');
	    	$this->form_validation->set_rules('acid', 'acid', 'required|is_natural_no_zero');
	    	$this->form_validation->set_rules('branch', 'branch', 'required|is_natural_no_zero');
	    	$this->form_validation->set_rules('course', 'course', 'required|is_natural_no_zero');
	    	$this->form_validation->set_rules('test', 'test', 'required|is_natural_no_zero');
	    	$this->form_validation->set_rules('test_date', 'test_date','required|regex_match[/^[0-9-]+$/]',['regex_match'=>'Please Select Valid Date']);
		    	if($this->form_validation->run() == TRUE){
		    		$data['data'] = $this->MarkDB->findData(['semester_id'=>$post['semester']]);
					$data['model'] = $this->MarkDB->findStudent(['acid'=>$post['acid'],'course'=>$post['course'],'branch'=>$post['branch']]);
					$data['full_mark'] = $this->MarkDB->findFullMark(['id'=>$post['test']]);
				}
		}			

				if(!empty($post['stu'])){
                    for($i=0;$i<count($post['stu']);$i++){
			   			$cdata[] = [
						'student_id'=>$post['stu'][$i],
						'mark'=>$post['mark'][$i],
						'teacher_id'=>$post['teacher'],
						'semester_id'=>$post['semester'],
						'subject_id'=>$post['subject_id'],
						'test_id'=>$post['test'],
						'test_date'=>date('Y-m-d',strtotime($post['test_date']))
						];
				
					}
					
					if($this->MarkDB->multiSaveMark($cdata)){ // Save form data in mark table
					$this->session->set_flashdata('success', '<h4>New Marks</h4><p>New Marks is successfully Added.</p>');
					}else{
					$this->session->set_flashdata('warning', '<h4>New Marks</h4><p>New Marks is Not successfully Added.</p>');
					}	
				redirect(base_url('mark'));
			   }      
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('mark/create',$data);
		$this->load->view('template/footer',$data);
	}	

	

	/**
	* Get data as parameter and retrive a perticular batch data
	* and update them.
	* @param int $id This is a batch (id) field in Batch Table.
	* @return Batch update page to browser
	*/
	public function update($id='')
	{
		$this->common->checkAuth('mark_update');
		$data['menu'] = 'mark';
		$data['sub_menu'] = 'mark_update';
		// Fetch data form table branch table
		//$data['model'] = $post = $this->MarkDB->findRow(['id'=>$id]);
		$data['post'] = $post = $this->input->post();
		$data['test'] = $this->MarkDB->allTestName();
		$data['course'] = $this->MarkDB->allCourses();
		$data['academicyear'] = $this->MarkDB->allAcademicyear();
		// Form validation
		$this->form_validation->set_rules('teacher_id', 'teacher', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('semester_id', 'semester', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('subject_id', 'subject', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('acid', 'acid', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('branch', 'branch', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('course', 'course', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('test_id', 'test', 'required|is_natural_no_zero');
		if($this->form_validation->run() == TRUE){
				$data['model'] = $this->MarkDB->findStudent(['acid'=>$post['acid'],'course'=>$post['course'],'branch'=>$post['branch']]);
				$data['tests_head'] = $this->MarkDB->findTestHeald($post);
					foreach($data['model'] as $key => $val){
						$sid[] = $val->id;
			        }
				$data['secured_mark'] = $this->MarkDB->findSecuredMark($sid,['semester_id'=>$post['semester'],'subject_id'=>$post['subject_id']]);

					foreach($data['tests_head'] as $key => $val){
				       $tm[] = $val->test_id;
					}
		    	$data['tests_mark'] = $this->MarkDB->findTestMark($tm);
		}
		if($this->MarkDB->update($post)){ // Save form data in course table
			$this->session->set_flashdata('success', '<h4>Mark</h4><p>New Mark  is successfully Updated.</p>');
			redirect('mark'); // redirected to Branch's create method
		}else{
			$this->session->set_flashdata('warning', '<h4>Mark</h4><p>New Mark is Not successfully Updated.</p>');
		}
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('mark/update',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get perticular batch id and delete that record.
	* @return Redirect to the index().
	*/
	
}