<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this student class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Teacherleave extends CI_Controller {

	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('TeacherleaveDB');
 	}
	
	public function teacher_leave_index()
	{
		// Sidebar menu Management
		$this->common->checkAuth('extra_view');
		$data['menu'] = 'extra';
		$data['sub_menu'] = 'teacher_leave_view';

		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('teacherleave/teacher_leave_index');
		$config['total_rows'] = $this->TeacherleaveDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$this->pagination->initialize($config);

		// Fetch Data from (branch) table
		$data['model'] = $this->TeacherleaveDB->pagination($perpage,$page);
		// print_r($data['model']);
		// exit();

		// These are view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('extra/teacher_leave_index',$data);
		$this->load->view('template/footer',$data);
	}

	/**
	* Get data as parameter and retrive a perticular student data
	* and View All data.
	* @param int $id This is a student (id) field in Student Table.
	* @return Student Detail View page to browser
	*/
	public function teacher_leave_view($id)
	{    
		$this->common->checkAuth('extra_view');
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('extra/teacher_leave_index');
		$this->load->view('template/footer');
	}

	public function teacher_leave_create()
	{     
		$this->common->checkAuth('extra_create');
		// Sidebar menu Management
		$data['menu'] = 'extra';
		$data['sub_menu'] = 'teacher_leave_create';
		// Store form data in post variable
		$post = $this->input->post();
		$data['branches'] = $this->TeacherleaveDB->allBranches();
		$data['semester'] = $this->TeacherleaveDB->allSemester();
		$this->form_validation->set_rules('leave_sub', 'Leave Subject','required');
		$this->form_validation->set_rules('date_from', 'Date from','required');
		$this->form_validation->set_rules('date_to', 'Date to','required');
		if($this->form_validation->run() == TRUE){
			// Class Extend details
			if(!empty($post['said'])){
				if(in_array('0',$post['ap_teach'])){
					$this->session->set_flashdata('warning', '<h4>Error! </h4><p>Please Approch all the teacher.</p>');
					redirect(base_url('teacherleave/teacher_leave_index'));
				}
				$sa_detail = $this->TeacherleaveDB->findBySAId($post['said']);
				foreach($sa_detail as $value){
					foreach ($post['said'] as $key => $val) {
						if($val==$value->id){
							$class_extend[] = ["acid" => $value->acid,"branch" => $value->branch,"course" => $value->course,"teacher" => $value->teacher_id,"timetable_id" => $value->id,"semester" => $value->semester,"leave_type" => "leave","app_teacher" => $post['ap_teach'][$key],"extend_date" => $post['cxdate'][$key],"status" => "pending"];
						}
					}
				}
				$application = ['user_type'=>$this->session->user_type,'emp_id'=>$this->session->profile['id'],'date_from'=>date('Y-m-d',strtotime($post['date_from'])),'date_to'=>date('Y-m-d',strtotime($post['date_to'])),'leave_sub'=>$post['leave_sub']];
				if($this->TeacherleaveDB->saveTeacherExtend($class_extend) && $this->TeacherleaveDB->save($application)){
					$this->session->set_flashdata('success', '<h4>Leave Request</h4><p>For '.$post['leave_sub'].' leave application is requested.</p>');
					$this->_send_notification($class_extend);
				}else{
					$this->session->set_flashdata('warning', '<h4>Leave Request</h4><p>It seems to be some technical problem. Please try again later.</p>');
				}
				redirect('teacherleave/teacher_leave_create'); // redirected to Branch's create method
			}

			$diff = date_diff(date_create($post['date_from']),date_create($post['date_to']));
			$ds[date("Y-m-d",strtotime($post['date_from']))] = strtoupper(date("l",strtotime($post['date_from'])));
			for ($i=1; $i <=$diff->d ; $i++) {
				$ds[date("Y-m-d",strtotime($post['date_from']."+".$i." day"))] = strtoupper(date("l",strtotime($post['date_from']."+".$i." day")));
			}
			$qdata['teacher_id'] = $this->session->profile['id'];
			$qdata['days'] = $ds;
			$timetable = $this->TeacherleaveDB->teacherTimetable($qdata);
			if(!empty($timetable)){
				foreach ($ds as $key => $value) {
		        	foreach ($timetable as $val) {
		         		if ($value==$val->day) {
		         			$data['class_extend'][$key][] = [
		         				"said" => $val->id,
		         				"branch" => $val->branch,
		         				"semester" => $val->semester,
		         				'time'=>(date("h a",strtotime($val->time_from))."-".date("h a",strtotime($val->time_to))),
		         				"teachers" => $this->TeacherleaveDB->listTBS($val->teacher_id,$val) // List Teachers by Semester
		         			];
		         		}
		         	}
				}
			}
		}
		// These are view file
		$this->load->view('template/head');
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar');
		$this->load->view('extra/teacher_leave_create',$data);
		$this->load->view('template/footer');
	}

	public function update($id)
	{
		$this->common->checkAuth('extra_update');
	}

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('extra_delete');
	}

    public function leaverejected($id)
    {
    	$this->TeacherleaveDB->leaveReject($id);
    	redirect(base_url('teacherleave/teacher_leave_index'));
    }

    public function class_adjust()
	{
		// Sidebar menu Management
		$this->common->checkAuth('extra_view');
		$data['menu'] = 'extra';
		$data['sub_menu'] = 'extra_adjust_view';

		$data['course'] = $this->TeacherleaveDB->allCourses();
		$data['branch'] = $this->TeacherleaveDB->allBranches();
		$data['teachers'] = $this->TeacherleaveDB->allTeachers();
		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('teacherleave/class_adjust');
		$config['total_rows'] = $this->TeacherleaveDB->classAdjustcount();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = $this->uri->segment(3,0);
		$this->pagination->initialize($config);

		// Fetch Data from (branch) table
		$data['model'] = $this->TeacherleaveDB->classAdjustPagination($perpage,$page);

		// These are view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('extra/class_adjust',$data);
		$this->load->view('template/footer',$data);
	}

	public function adjust_ok($id)
    {
    	$this->TeacherleaveDB->updateClassExtend($id,['status'=>'approved']);
    	redirect(base_url('teacherleave/class_adjust'));
    }

    public function adjust_not($id)
    {
    	$this->TeacherleaveDB->leaveReject($id);
    	redirect(base_url('teacherleave/teacher_leave_index'));
    }

    public function hod_application()
	{
		// Sidebar menu Management
		$this->common->checkAuth('extra_view');
		$data['menu'] = 'extra';
		$data['sub_menu'] = 'extra_adjust_view';
		// Pagination Initialization
		$data['teachers'] = $this->TeacherleaveDB->allTeachers();
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('teacherleave/hod_application');
		$config['total_rows'] = $this->TeacherleaveDB->hodApprovalCount();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = $this->uri->segment(3,0);
		$this->pagination->initialize($config);

		// Fetch Data from (branch) table
		if($this->session->profile['designation']=='hod_asstprof' || $this->session->profile['designation']=='hod_prof'){
			$data['model'] = $this->TeacherleaveDB->hodApproval($perpage,$page);
		}elseif($this->session->profile['designation']=='principal'){
			$data['model'] = $this->TeacherleaveDB->all($perpage,$page);
		}

		// These are view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('extra/hod_approval',$data);
		$this->load->view('template/footer',$data);
	}

	public function principal_application()
	{
		// Sidebar menu Management
		$this->common->checkAuth('extra_view');
		$data['menu'] = 'extra';
		$data['sub_menu'] = 'extra_adjust_view';
		// Pagination Initialization
		$data['teachers'] = $this->TeacherleaveDB->allTeachers();
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('teacherleave/principal_application');
		$config['total_rows'] = $this->TeacherleaveDB->count();
		$config['per_page'] = $perpage = 20;
		$config['uri_segment'] = 3;
		$page = $this->uri->segment(3,0);
		$this->pagination->initialize($config);

		// Fetch Data from (branch) table
		$data['model'] = $this->TeacherleaveDB->all($perpage,$page);
		// echo "<pre>";print_r($data);
		// exit();

		// These are view file
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('extra/principal_approval',$data);
		$this->load->view('template/footer',$data);
	}

	public function hod_approve_ok($id)
    {
    	$this->TeacherleaveDB->updateTeacherLeave($id,['status'=>'principal_pending']);
    	redirect(base_url('teacherleave/hod_application'));
    }

    public function principal_approve_ok($id)
    {
    	$this->TeacherleaveDB->updateTeacherLeave($id,['status'=>'active','teacher_approved'=>'approved']);
    	redirect(base_url('teacherleave/principal_application'));
    }

    private function _send_notification($data)
    {
    	foreach ($data as $key => $value) {
    		$app_teacher[] = $value['app_teacher'];
    		$study_detail[] = $this->TeacherleaveDB->getStudyDetail($value);
    		$notice[] = [
    			'user_type' => 2,
    			'user_id' => $value['app_teacher'],
    			'not_date' => $value['extend_date'],
    			'semester' => $this->TeacherleaveDB->getSemesterById($value['semester']),
    			'timetable' => $this->TeacherleaveDB->getTimeCalculation($value['timetable_id']),
    		];
    	}
    	$teacher_details = $this->TeacherleaveDB->findTeacherIn('id',$app_teacher);
    	foreach ($teacher_details as $key => $value) {
    		$d[$value->id] = $value->name;
    	}
    	foreach ($notice as $key => $value) {
    		$notice[$key]['notice_subject'] = "<span class='user-name'>".$this->session->profile['name']."</span> is requesting for class adjustment.";
    		$notice[$key]['notice_body'] = $this->session->profile['name']." is requesting for a class adjustment on ".$value['not_date']." in ".$study_detail[$key][1].", ".$study_detail[$key][0].", ".$notice[$key]['semester']." at ".$notice[$key]['timetable']."<br>";
    		unset($notice[$key]['semester'],$notice[$key]['timetable']);
    	}
    	// echo "<pre>";print_r($notice);
    	// exit();
    	return $this->TeacherleaveDB->saveNotification($notice);
    }
}
