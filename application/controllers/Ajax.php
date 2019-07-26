<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this student class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Ajax extends CI_Controller {

	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('AjaxDB');
 	}

	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/

	public function findbranch()
	{
		$post = $this->input->post();
		$data = $this->AjaxDB->findBranch(['course'=>$post['id']]);
		$d[] = 'Choose Branch';
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$d[$value->id] = $value->branch_name;
			}
		}
		$result = form_dropdown('branch',$d,'',['class'=>'form-control input-sm','id'=>'bid']);
		echo $result;
	}

	public function findbranchatend()
	{
		$post = $this->input->post();
		$data = $this->AjaxDB->findBranch(['course'=>$post['id']]);
		$d[] = 'Choose Branch';
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$d[$value->id] = $value->branch_name;
			}
		}
		$result = form_dropdown('branch',$d,'',['class'=>'form-control input-sm','onchange'=>'findSemesterAtendance()','id'=>'bid']);
		echo $result;
	}

	public function findbranchtime()
	{
		$post = $this->input->post();
		$data = $this->AjaxDB->findBranch(['course'=>$post['id']]);
		$d[] = 'Choose Branch';
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$d[$value->id] = $value->branch_name;
			}
		}
		$result = form_dropdown('branch',$d,'',['class'=>'form-control input-sm','onchange'=>'findSemTime()','id'=>'bid']);
		echo $result;
	}

	public function findsemester()
	{	

		$post = $this->input->post();
		$data = $this->AjaxDB->findSemester(['course_id'=>$post['id']]);
		$d[] = 'Choose Semester';
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$d[$value->id] = $value->name;
			}
		}
		$result = form_dropdown('semester',$d,'',['class'=>'form-control input-sm','onchange'=>'findTeacher()','id'=>'sid']);
		echo $result;
	}

	public function findsemestertime()
	{
		$post = $this->input->post();
		$sm = $this->AjaxDB->findABCS($post);
		$data = $this->AjaxDB->findSemester(['course_id'=>$post['cid']]);
		$d[] = 'Choose Semester';
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$d[$value->id] = $value->name;
			}
		}
		$result = form_dropdown('semester',$d,$sm,['class'=>'form-control input-sm','disabled'=>'disabled','id'=>'sid']);
		echo $result;
	}

	public function findsemestertt() // Find Semester for TimeTable
	{	
		$post = $this->input->post();
		$data = $this->AjaxDB->findSemester(['course_id'=>$post['id']]);
		$d[] = 'Choose Semester';
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$d[$value->id] = $value->name;
			}
		}
		$result = form_dropdown('semester',$d,'',['class'=>'form-control input-sm','onchange'=>'findTeacher()','id'=>'sid']);
		echo $result;
	}

	public function findteacher()
	{
		$post = $this->input->post();
		$data = $this->AjaxDB->findTeacher(['acid'=>$post['acid'],'branch'=>$post['brid'],'course'=>$post['crid'],'semester'=>$post['smid']]);
		$d[] = 'Choose Teacher';
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$d[$value->id] = $value->name;
			}
		}
		$result = form_dropdown('teacher',$d,'',['class'=>'form-control input-sm','onchange'=>'findSubject()','id'=>'tid']);
		echo $result;
	}

	public function findsubject()
	{
		$post = $this->input->post();
		$data = $this->AjaxDB->findSubject(['acid'=>$post['acid'],'branch'=>$post['brid'],'course'=>$post['crid'],'semester'=>$post['smid'],'teacher_id'=>$post['teid']]);
		$d[] = 'Choose Subject';
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$d[$value->id] = $value->sub_name;
			}
		}
		$result = form_dropdown('subject_id',$d,'',['class'=>'form-control input-sm','id'=>'sbid']);
		echo $result;
	}

	public function setMark(){
		$post = $this->input->post();
		$data = $this->AjaxDB->setMark(['id'=>$post['id']]);
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function updatemark(){
		$post = $this->input->post();
		$data = $this->AjaxDB->updateMark(['mark'=>$post['mrk'],'id'=>$post['mrkid']]);
	}

	public function checkmark(){
		$post = $this->input->post();
		$data = $this->AjaxDB->checkMark(['id'=>$post['tsid']]);
		echo json_encode($data);
		exit();

	}

	public function find_semester_atendance () {
		$cid = $this->input->post('cid');
		$bid = $this->input->post('bid');
		// $cid = 6;
		// $bid = 2;
		if($sm = $this->AjaxDB->find_sem_ate($cid, $bid)){ // Find Semester Attendance
			$result = form_dropdown('semester',$sm,'',['class'=>'form-control input-sm','onchange'=>'findSubjectAtten()','id'=>'semester']);
			echo $result;
		}else{
			$result = form_dropdown('semester',['0'=>'No Semester Found'],'',['class'=>'form-control input-sm','disabled'=>'disabled','id'=>'semester']);
			echo $result;
		}
	}

	public function findsubjectatten () {
		$cid = $this->input->post('cid');
		$bid = $this->input->post('bid');
		$sem = $this->input->post('sem');
		// $cid = 6;
		// $bid = 2;
		if($sb = $this->AjaxDB->find_sub_ate($cid, $bid, $sem)){ // Find Subject Attendance
			$result = form_dropdown('subject_id',$sb,'',['class'=>'form-control input-sm']);
			echo $result;
		}else{
			$result = form_dropdown('subject_id',['0'=>'No Subject Found'],'',['class'=>'form-control input-sm','disabled'=>'disabled']);
			echo $result;
		}
	}

}	