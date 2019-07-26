<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this student class we can add,View,Update,delete
 * student details and view the details. 
 * @author  Group Alpha   
 */

class Student extends CI_Controller {
    
    function __construct()
 	{
 		parent::__construct();
 		$this->load->model('StudentDB');
 		$this->load->helper(array('form', 'url'));
 	}

	/**
	* Get records from database and list them as table view
	* @return Student view page to browser
	*/
	public function index()
	{
		$this->common->checkAuth('student_view');
		// Sidebar menu Management
		$data['menu'] = 'student';
		$data['sub_menu'] = 'student_view';
		$get = $this->input->get();

		// Pagination Initialization
		$config = $this->config->item('pagination');
		$config['base_url'] = base_url('student/index');
		$config['total_rows'] = $this->StudentDB->count($get);
		$config['per_page'] = $perpage = 20;
		$config['reuse_query_string'] = TRUE;
		$config['uri_segment'] = 3;
		$page = $this->uri->segment(3,0);
		$this->pagination->initialize($config);
		
		// Fetch Data from (branch) table
		$data['model'] = $this->StudentDB->pagination($perpage,$page,$get);
		$data['post'] = $post = $this->input->post();
		$data['branches'] = $this->StudentDB->allBranches();
		$data['courses'] = $this->StudentDB->allCourses();
		$data['academicyear'] = $this->StudentDB->allAcademicyear();

	    $this->form_validation->set_rules('acid', 'acid', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('branch', 'branch', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('course', 'course', 'required|is_natural_no_zero');


		if($this->form_validation->run() == TRUE){
	    	$data['model'] = $this->StudentDB->findStudent(['acid'=>$post['acid'],'course'=>$post['course'],'branch'=>$post['branch']]);
        }
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('student/index',$data);
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
		$this->common->checkAuth('student_view');
		// Sidebar menu Management
		$data['menu'] = 'student';
		$data['sub_menu'] = 'student_view';
		$data['model'] = $this->StudentDB->findRow(['id'=>$id]);
		$data['branch'] = $this->StudentDB->findBranchById($data['model']->branch);
		$data['course'] = $this->StudentDB->findCourseById($data['model']->course);
		$data['academic'] = $this->StudentDB->findAcademicById($data['model']->acid);
		
		

		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('student/view',$data);
		$this->load->view('template/footer',$data);	
	}

	/**
	* Get data as post method and save them in Student Table
	* @return Student Create page to browser
	*/
	public function create()
	{
		$this->common->checkAuth('student_create');
		// Sidebar menu Management
		$data['menu'] = 'student';
		$data['sub_menu'] = 'student_create';
        // Store form data in post variable
		$post = $this->input->post();
		// Form validation
		$data['branch'] = $this->StudentDB->allBranches();
		$data['courses'] = $this->StudentDB->allCourses();
		$data['academicyear'] = $this->StudentDB->allAcademicyear();


		$this->form_validation->set_rules('name', 'Student Name', 'required|alpha_numeric_spaces|max_length[30]');
		$this->form_validation->set_rules('father_name', 'Father Name', 'required|alpha_numeric_spaces|max_length[30]');
		$this->form_validation->set_rules('mother_name', 'Mother Name', 'required|alpha_numeric_spaces|max_length[30]');
		$this->form_validation->set_rules('dob', 'Date Of Birth', 'required|regex_match[/^[0-9-]+$/]',['regex_match'=>'Please Select Valid Date']);
		$this->form_validation->set_rules('doa', 'Date Of Admission', 'required|regex_match[/^[0-9-]+$/]',['regex_match'=>'Please Select Valid Date']);
		$this->form_validation->set_rules('address', 'Address', 'required|max_length[70]');
		$this->form_validation->set_rules('roll', 'Roll No', 'required');
		$this->form_validation->set_rules('reg', 'Regd No');
		$this->form_validation->set_rules('branch', 'Branch', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('stu_phone', 'Student Phone Number', 'required|integer|max_length[12]');
		$this->form_validation->set_rules('par_phone', 'Parents phone Number', 'required|integer|max_length[12]');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('course', 'Course', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('acid', 'Academic Year', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('bgroup', 'Blood Group');
		$this->form_validation->set_rules('cast', 'Caste', 'required');
		$this->form_validation->set_rules('par_occupation', 'Parent Occupation','required|max_length[15]');
		if($this->form_validation->run() == TRUE){

			$post['roll'] = strtoupper($post['roll']); // uppercase the branch code
			$post['dob'] = date("Y-m-d",strtotime($post['dob']));
			$post['doa'] = date("Y-m-d",strtotime($post['doa']));
			$post['pic'] = $this->_do_upload()['file_name'];
			if($this->StudentDB->save($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>New Student details</h4><p>New Student details '.$post['name'].' is successfully Added.</p>');
				redirect('student'); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Student details</h4><p>New Student details '.$post['name'].' is Not successfully Added.</p>');
			}
        }
		$this->load->view('template/head',$data);
		$this->load->view('template/header',$data);
		$this->load->view('template/sidebar',$data);
		$this->load->view('student/create',$data);
		$this->load->view('template/footer',$data);

	}

	/**
	* Get data as parameter and retrive a perticular student data
	* and update them.
	* @param int $id This is a student (id) field in Student Table.
	* @return Student update page to browser
	*/
	public function update($id)
	{
		$this->common->checkAuth('student_update');
		// Sidebar menu Management
		$data['menu'] = 'student';
		$data['sub_menu'] = 'student_update';
		// Fetch data form table student table
		$data['model'] = $this->StudentDB->findRow(['id'=>$id]);
		// Store form data in post variable
		$data['branch'] = $this->StudentDB->allBranches();
		$data['courses'] = $this->StudentDB->allCourses();
		$data['academicyear'] = $this->StudentDB->allAcademicyear();
		//keeping form data in post 
		$post = $this->input->post();
		// Form validation
		$this->form_validation->set_rules('name', 'Student Name', 'required|alpha_numeric_spaces|max_length[30]');
		$this->form_validation->set_rules('father_name', 'Father Name', 'required|alpha_numeric_spaces|max_length[30]');
		$this->form_validation->set_rules('mother_name', 'Mother Name', 'required|alpha_numeric_spaces|max_length[30]');
		$this->form_validation->set_rules('dob', 'Date Of Birth', 'required|regex_match[/^[0-9-]+$/]',['regex_match'=>'Please Select Valid Date']);
		$this->form_validation->set_rules('doa', 'Date Of Admission', 'required|regex_match[/^[0-9-]+$/]',['regex_match'=>'Please Select Valid Date']);
		$this->form_validation->set_rules('address', 'Address', 'required|max_length[70]');
		$this->form_validation->set_rules('roll', 'Roll No', 'required');
		$this->form_validation->set_rules('reg', 'Regd No', 'required|max_length[10]');
		$this->form_validation->set_rules('branch', 'Branch', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('stu_phone', 'Student Phone Number', 'required|integer|max_length[12]');
		$this->form_validation->set_rules('par_phone', 'Parents phone Number', 'required|integer|max_length[12]');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('course', 'Course', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('acid', 'Academic Year', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('bgroup', 'Blood Group', 'required');
		$this->form_validation->set_rules('cast', 'Caste', 'required');
		$this->form_validation->set_rules('par_occupation', 'Parent Occupation', 'required|max_length[15]');
		if($this->form_validation->run() == TRUE){
			$post['id'] = $id;
			$post['roll'] = strtoupper($post['roll']); // uppercase the Roll code
			$post['dob'] = date("Y-m-d",strtotime($post['dob']));
			$post['doa'] = date("Y-m-d",strtotime($post['doa']));	
			$post['pic'] = $this->_do_upload()['file_name'];
			if($this->StudentDB->update($post)){ // Save form data in branch table
				$this->session->set_flashdata('success', '<h4>New Student details Update</h4><p>New Student details Update '.$post['name'].' is successfully Added.</p>');
				redirect('student/'.$id); // redirected to Branch's create method
			}else{
				$this->session->set_flashdata('warning', '<h4>New Student details Update</h4><p>New Student details Update '.$post['name'].' is Not successfully Added.</p>');
			}
		}

		// These are view file
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);
		$this->load->view('student/update',$data);
		$this->load->view('template/footer');
	}

	/**
	* Get perticular student id and delete that record.
	* @return Redirect to the index().
	*/
	public function delete($id)
	{
		$this->common->checkAuth('student_delete');


	}// These are view file


	public function addmultiplestudent()
	{
		$this->common->checkAuth('student_create');
		// Sidebar menu Management
		$data['menu'] = 'student';
		$data['sub_menu'] = 'student_addmultiplestudent';
        // Store form data in post variable
		$post = $this->input->post();
		$data['branch'] = $this->StudentDB->allBranches();
		$data['courses'] = $this->StudentDB->allCourses();
		$data['academicyear'] = $this->StudentDB->allAcademicyear();

		// Form validation
		$this->form_validation->set_rules('academic_name', 'Academic Year', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('course', 'Course', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('branch', 'Branch', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('section', 'Section', 'required');
		
		if($this->form_validation->run() == TRUE){
			if(!empty($_FILES['excel']) && $_FILES['excel']['error']!=4){
				$d = $this->_excel();
				if (!$d) {
					$this->session->set_flashdata('warning', '<h4>File Error</h4><p>File Extension is not recognise. Please Upload .xls file.</p>');
					redirect('student/addmultiplestudent');
				}else{
					$this->session->set_userdata('multi_student',$d);
					redirect('student/insertmultiplestudent');
				}
			}
		}
        $this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);
		$this->load->view('student/addmultiplestudent',$data);
		$this->load->view('template/footer');
	}

	public function insertmultiplestudent($check=false){
		$this->common->checkAuth('student_create');
		// Sidebar menu Management
		$data['menu'] = 'student';
		$data['sub_menu'] = 'student_addmultiplestudent';
		$data['branches'] = $this->StudentDB->allBranches();

		if(!$check){
			$data['model'] = $this->session->multi_student;
		}else{
			$d = $this->session->multi_student;
			if($this->StudentDB->multiSaveStudent($d)){ // Save form data in branch table
				$this->session->unset_userdata('multi_student');
				$this->session->set_flashdata('success', '<h4>Name</h4><p>details is successfully Added.</p>');
			}else{
				$this->session->set_flashdata('warning', '<h4>New Students</h4><p>New Students Not successfully Added.</p>');
			}
			redirect(base_url('student'));
		}
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);
		$this->load->view('student/insertmultiplestudent',$data);
		$this->load->view('template/footer');
	}


	private function _excel()
	{
		$this->common->checkAuth('student_create');
		require_once APPPATH."third_party/excel_reader.php";
		$config['upload_path']          = './xlsx/';
        $config['allowed_types']        = 'xls';
        $config['max_size']             = 5000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('excel')){
        	return false;
        }else{
        	$post = $this->input->post();
        	$file = $this->upload->data();
        	$excel = new PhpExcelReader;
        	$excel->read($file['full_path']);
			$d = $excel->sheets;
			$rd = $d[0]['cellsInfo'];
			$d = $d[0]['cells'];
			$cast = ['0'=>'Choose Caste','ST'=>'ST','SC'=>'SC','OBC'=>'OBC','GEN'=>'GENERAL','OTHERS'=>'OTHERS'];
			$gender = ['0'=>'Choose Gender','M'=>'MALE','F'=>'FEMALE'];
			for ($i=2;$i<=count($d);$i++) {
				$phone = (!empty($d[$i][7])?explode(',',$d[$i][7]):'');
				$da[] = [
				'roll'=>$d[$i][1],
				'name'=>strtolower($d[$i][2]),
				'reg'=>$d[$i][3],
				'acid'=>$post['academic_name'],
				'course'=>$post['course'],
				'branch'=>$post['branch'],
				'section'=>$post['section'],
				'father_name'=>strtolower($d[$i][4]),
				'mother_name'=>strtolower($d[$i][5]),
				'address'=>strtolower($d[$i][6]),
				'par_phone'=>(count($phone)=='2'?$phone[1]:$phone[0]),
				'stu_phone'=>$phone[0],
				'dob'=>(!empty($rd[$i][8]['raw'])?date('Y-m-d',$rd[$i][8]['raw']):''),
				'gender'=>(array_key_exists($d[$i][9],$gender)?$gender[$d[$i][9]]:''),
				'bgroup'=>(empty($d[$i][10])?'':$d[$i][10]),
				'cast'=>(!empty($cast[$d[$i][11]])?$cast[$d[$i][11]]:'OTHERS'),
				'doa'=>date('Y-m-d',$rd[$i][12]['raw'])
				];
				
				 
			}

			unlink($file['full_path']);
			return $da;
        }
	}

	private function _do_upload()
        {
                $config['upload_path']          = './studentimages/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = '1024';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                }
                else
                {
                    return $this->upload->data();
                }
        }

}   

