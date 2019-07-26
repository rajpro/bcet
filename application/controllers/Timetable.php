<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this teacher class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Timetable extends CI_Controller {

	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('TimetableDB');
 	}


	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/
	public function index()
	{
		$this->common->checkAuth('timetable_view');
		// Sidebar menu Management
		$data['menu'] = 'timetable';
		$data['sub_menu'] = 'timetable_view';
		$post = $this->input->post();
		$data['p_data'] = $post;
        $data['branches'] = $this->TimetableDB->allBranches();
        $data['courses'] = $this->TimetableDB->allCourses();
		$data['academicyear'] = $this->TimetableDB->allAcademicyear();
		$data['subject'] = $this->TimetableDB->allSubjectid();
		if(!empty($post)){
			if($post['acid']==0 || $post['branch']==0 || $post['course']==0){
				$this->session->set_flashdata('warning', '<h4>All Filter Fields are Mandatory</h4><p>Please Choose all Fields</p>');
				redirect(base_url('timetable'));
			}
			$data['timetable'] = $this->TimetableDB->findTime($post);
			// print_r($data['timetable']);
			// exit();

			$data['timetable_data'] = $this->TimetableDB->findTimeTable($post);
		}
		//view 
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('timetable/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as parameter and retrive a perticular teacher data
	* and View All data.
	* @param int $id This is a teacher (id) field in teacher Table.
	* @return teacher Detail View page to browser
	*/
	public function view($id)
	{
		
        $this->common->checkAuth('timetable_view');
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('timetable/index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as post method and save them in teacher Table
	* @return Teacher Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('timetable_create');
		// Sidebar menu Management
		$data['menu'] = 'timetable';
		$data['sub_menu'] = 'timetable_create';
		//keeping form data in post 
		$post = $this->input->post();
		$data['courses'] = $this->TimetableDB->allCourses();
		$data['academicyear'] = $this->TimetableDB->allAcademicyear();
		$data['branch'] = ['Choose Branch'];
		$data['semester'] = ['Choose Semester'];
		// Form validation
		$this->form_validation->set_rules('acid', 'Academic Year', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('branch', 'Branch', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('course', 'Course', 'required|is_natural_no_zero');
		if($this->form_validation->run() == TRUE){
			if ($sm = $this->TimetableDB->findABCS($post)) {
				$post['semester'] = $sm;
			}else{
				$this->session->set_flashdata('warning', '<h4>Timetable of semester</h4><p>Timetable Already Present</p>');
				redirect('timetable/create');
			}
			if(!empty($post['stime'])){
				$timetable_batch_data = $this->_prepareTimetable($post);
				if($this->TimetableDB->saveBatchData($timetable_batch_data)){ // Save form data in timetable table
					$this->session->set_flashdata('success', '<h4>New Timetable of semester</h4><p>New Timetable of semester '.$post['semester'].' is successfully Added.</p>');
				}else{
					$this->session->set_flashdata('warning', '<h4>New Timetable of semester</h4><p>New Timetable of semester '.$post['semester'].' is Not successfully Added.</p>');
				}
				redirect('timetable'); // redirected to Branch's create method
			}else{
				$data['post'] = $post;
				$data['timetable'] = $this->TimetableDB->findTeacherSubject($post);
				$data['branch'] = $this->TimetableDB->findBranch(['course'=>$post['course']]);
				$data['semester'] = $this->TimetableDB->findSem(['course_id'=>$post['course']]);
			}
		}
		//view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('timetable/create',$data);
		$this->load->view('template/footer',$data);
	}
	

	/**
	* Get data as parameter and retrive a perticular student data
	* and update them.
	* @param int $id This is a student (id) field in Teacher Table.
	* @return Teacher update page to browser
	*/
	public function update()
	{
		$this->common->checkAuth('timetable_update');
		// Sidebar menu Management
		$data['menu'] = 'timetable';
		$data['sub_menu'] = 'timetable_update';
		//keeping form data in post 
		$data['post'] = $post = $this->input->post();
		$data['courses'] = $this->TimetableDB->allCourses();
		$data['academicyear'] = $this->TimetableDB->allAcademicyear();
		$data['branch'] = ['Choose Branch'];
		$data['semester'] = ['Choose Semester'];
		// Form validation
		$this->form_validation->set_rules('acid', 'Academic Year', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('branch', 'Branch', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('course', 'Course', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('semester', 'semester', 'required|is_natural_no_zero');
		if($this->form_validation->run() == TRUE){
			if(!empty($post['id'])){
				$timetable_batch_data = $this->_prepareTimetable($post);
				if($this->TimetableDB->saveBatchUpdateData($timetable_batch_data)){ // Save form data in timetable table
					$this->session->set_flashdata('success', '<h4>New Timetable of semester</h4><p>New Timetable of semester '.$post['semester'].' is successfully Added.</p>');
				}else{
					$this->session->set_flashdata('warning', '<h4>New Timetable of semester</h4><p>New Timetable of semester '.$post['semester'].' is Not successfully Added.</p>');
				}
				redirect('timetable'); // redirected to Branch's create method
			}else{
				$data['timetable'] = $this->TimetableDB->findTeacherSubject($post);
				$data['branch'] = $this->TimetableDB->findBranch(['course'=>$post['course']]);
				$data['semester'] = $this->TimetableDB->findSem(['course_id'=>$post['course']]);
				$data['timetable_data'] = $this->TimetableDB->findTimeTableData($post);
				if(!$data['timetable_data']){
					$this->session->set_flashdata('warning', '<h4>Not Found</h4><p>No Timetable is found.</p>');
					redirect(base_url('timetable'));
				}
			}
		}
		//view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('timetable/update',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('timetable_delete');
	}

	private function _prepareTimetable($data)
	{
		$d = array();
		for ($i=0; $i < count($data['teacher_id']); $i++) {
			if(!empty($data['teacher_id'][$i]) && !empty($data['subject_id'][$i])){
				$d[$i] = [
					'acid' => $data['acid'],
				    'course' => $data['course'],
				    'branch' => $data['branch'],
				    'semester' => $data['semester'],
				    'time_from' => $data['stime'][$i],
				    'time_to' => $data['etime'][$i],
				    'subject_id' => $data['subject_id'][$i],
				    'teacher_id' => $data['teacher_id'][$i],
				    'day' => strtoupper($data['days'][$i]),
				    'status' => 'active'
				];
			}
			if(!empty($data['id'])){
				if(!empty($data['id'][$i]) && !empty($data['teacher_id'][$i]) && !empty($data['subject_id'][$i])){
					$d[$i]['id'] = $data['id'][$i];
				}elseif(!empty($data['id'][$i]) && empty($data['teacher_id'][$i]) && empty($data['subject_id'][$i])){
					$this->TimetableDB->delete($data['id'][$i]);
				}elseif(empty($data['id'][$i]) && !empty($data['teacher_id'][$i]) && !empty($data['subject_id'][$i])){
					$this->TimetableDB->save($d[$i]);
					unset($d[$i]);
				}
			}
		}
		return $d;
	}

	public function semester_update ($acid, $course, $branch) {
		$this->TimetableDB->deactivateTimetable($acid,$branch,$course);
		$this->session->set_flashdata('success', '<h4>TimeTable Deactivation</h4><p>Timetable Deactivated Successfully</p>');
		redirect(base_url('timetable'));
	}
}