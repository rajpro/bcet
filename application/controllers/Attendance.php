<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this student class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Attendance extends CI_Controller {

	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('AttendanceDB');
 	}

	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/	
	public function index()
	{    
		$this->common->checkAuth('attendance_view');
		// Sidebar menu Management
		$data['menu'] = 'attendance';
		$data['sub_menu'] = 'attendance_view';
		$data['post'] = $post = $this->input->post();
		$data['branches'] = $this->AttendanceDB->allBranches();
		$data['courses'] = $this->AttendanceDB->allCourses();
		$data['academicyear'] = $this->AttendanceDB->allAcademicyear();
		$data['semester'] = $this->AttendanceDB->allSemester();

		$this->form_validation->set_rules('teacher', 'teacher', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('semester', 'semester', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('subject_id', 'Subject', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('acid', 'acid', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('branch', 'branch', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('course', 'course', 'required|is_natural_no_zero');
		// Form validation
		if($this->form_validation->run() == TRUE){
	    	$data['model'] = $this->AttendanceDB->findStudent(['acid'=>$post['acid'],'course'=>$post['course'],'branch'=>$post['branch']]);
	    	$data['percent'] = $this->AttendanceDB->findStudentPercent($data['model'],['semester_id'=>$post['semester'],'teacher_id'=>$post['teacher'],'subject_id'=>$post['subject_id']]);
		}
		// These are view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('attendance/index',$data);
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
		$this->common->checkAuth('attendance_view');
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('attendance/view');
		$this->load->view('template/footer');


	}

	/**
	* Get data as post method and save them in Branch Table
	* @return Branch Create page
	*/
	public function create()
	{   
		$this->common->checkAuth('attendance_create');
		// Sidebar menu Management
		$data['menu'] = 'attendance';
		$data['sub_menu'] = 'attendance_create';
		// Store form data in post variable
		$data['post'] = $post = $this->input->post();
		$data['branches'] = $this->AttendanceDB->allBranches();
		$data['courses'] = $this->AttendanceDB->allCourses();
		$data['academicyear'] = $this->AttendanceDB->allAcademicyear();
		$data['semester'] = $this->AttendanceDB->allSemester();
        if(!empty($post) && empty($post['stu'])){
		    $this->form_validation->set_rules('semester', 'semester', 'required|is_natural_no_zero');
		    $this->form_validation->set_rules('subject_id', 'Subject', 'required|is_natural_no_zero');
		    $this->form_validation->set_rules('branch', 'branch', 'required|is_natural_no_zero');
		    $this->form_validation->set_rules('course', 'course', 'required|is_natural_no_zero');
		    $this->form_validation->set_rules('attendent_date', 'attendent_date','required|regex_match[/^[0-9-]+$/]',['regex_match'=>'Please Select Valid Date']);
			// Form validation
			if($this->form_validation->run() == TRUE){
				$post['teacher'] = $data['post']['teacher'] = $this->session->profile['id'];
				$post['acid'] = $data['post']['acid'] = $this->AttendanceDB->acid($post);
				$data['model'] = $this->AttendanceDB->findStudent(['acid'=>$post['acid'],'course'=>$post['course'],'branch'=>$post['branch']]);
			}
		}
	    if(!empty($post['stu'])){
		    for($i=0;$i<count($post['stu']);$i++){
		    	if(in_array($post['stu'][$i],$post['attendance'])){
		    		$cdata[] = [
					'student_id'=>$post['stu'][$i],
					'teacher_id'=>$post['teacher'],
					'semester_id'=>$post['semester'],
					'subject_id'=>$post['subject_id'],
					'attendent_date'=>date('Y-m-d',strtotime($post['attendent_date']))
					];
		    	}
			}
			if($this->AttendanceDB->multiSaveAttendance($cdata)){ // Save form data in mark table
				$this->session->set_flashdata('success', '<h4>New Attendance</h4><p>New Attendance  is successfully Added.</p>');
			}else{
				$this->session->set_flashdata('warning', '<h4>New Attendance</h4><p>New Attendance is Not successfully Added.</p>');
			}
			redirect(base_url('attendance'));		
		}
		// These are view file
		$this->load->view('template/head');
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar');
		$this->load->view('attendance/create');
		$this->load->view('template/footer');
	}

	/**
	* Get data as parameter and retrive a perticular student data
	* and update them.
	* @param int $id This is a student (id) field in Student Table.
	* @return Student update page to browser
	*/
	public function update()
	{
		$this->common->checkAuth('attendance_update');
		// Sidebar menu Management
		$data['menu'] = 'attendance';
		$data['sub_menu'] = 'attendance_update';
		// Fetch data form table branch table
		$data['branches'] = $this->AttendanceDB->allBranches();
		$data['courses'] = $this->AttendanceDB->allCourses();
		$data['academicyear'] = $this->AttendanceDB->allAcademicyear();
		$data['semester'] = $this->AttendanceDB->allSemester();
		
		$data['post'] = $post = $this->input->post();
		if(empty($post['stu'])){
			$data['model'] = $this->AttendanceDB->findStudent(['acid'=>$post['acid'],'course'=>$post['course'],'branch'=>$post['branch']]);
			$attendance = $this->AttendanceDB->findAttendance(['subject_id'=>$post['subject_id'],'attendent_date'=>date("Y-m-d",strtotime($post['attendent_date'])),'teacher_id'=>$post['teacher'],'semester_id'=>$post['semester']]);
			foreach ($attendance as $key => $value) {
				$d[]=$value->student_id;
			}
			$data['attendance'] = $d;
	    }
	    if(!empty($post['stu'])){
	    	$this->form_validation->set_rules('teacher', 'teacher', 'required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
				echo "<pre>";print_r($post);
				exit();
				$post['id'] = $id;

				if($this->AttendanceDB->update($post)){ // Save form data in branch table
					$this->session->set_flashdata('success', '<h4>Update Attendence</h4><p>Update Attendance '.$post['attendent_date'].' is successfully Update.</p>');
					redirect('attendance'); // redirected to Branch's update method
				}else{
					$this->session->set_flashdata('warning', '<h4>Update Attendence</h4><p>Update Attendance '.$post['attendent_date'].' is Not successfully Update.</p>');
				}
			}
	    }

		// These are view file
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);
		$this->load->view('attendance/update',$data);
		$this->load->view('template/footer');
	}

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
	  $this->common->checkAuth('attendance_delete');
	}
}