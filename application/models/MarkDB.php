<?php  

class MarkDB extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = "marks";
    }

    // Find By Id
    public function findRow($data='')
    {
        return $this->db->get_where($this->table,$data)->row();
    }
    // Find all test name from test table
    public function allTestName()
    {
        $query = $this->db->get('test')->result();
        if (!empty($query)) {
            foreach ($query as $value) {
                $d[$value->id] = $value->test_name;
            }
            return $d;
        }
        return '0';
    }
    // Find all coursees from course table whose status is active
    public function allCourses()
    {
        $this->db->where('status','active');
        $query = $this->db->get('course')->result();
        if (!empty($query)) {
            $d[] = 'Choose Course';
            foreach ($query as $value) {
                $d[$value->id] = $value->name;
            }
            return $d;
        }
        return '0';
    }
    // Find all academicyear from academic table whose status is active
    public function allAcademicyear()
    {
        $this->db->where('status','active');
        $query = $this->db->get('academic')->result();
        if (!empty($query)) {
            $d[] = 'Choose Academic Year';
            foreach ($query as $value) {
                $d[$value->id] = $value->academic_name;
            }
            return $d;
        }
        return '0';
    }
    //serach student
    public function findStudent($data)
    {
        return $this->db->get_where('student',$data)->result(); 
    }
    // save a batch data to the marks table
    public function multiSaveMark($data)
    {
        return $this->db->insert_batch($this->table,$data);
    }
    //find all the test id from marks table
    public function findTestHeald($data)
    {
        $this->db->select('test_id');
        $this->db->distinct();
        if($data['test']!='0'){
            return $this->db->get_where('marks',['subject_id'=>$data['subject_id'],'semester_id'=>$data['semester'],'teacher_id'=>$data['teacher'],'test_id'=>$data['test']])->result();
        }else{
            return $this->db->get_where('marks',['subject_id'=>$data['subject_id'],'semester_id'=>$data['semester'],'teacher_id'=>$data['teacher']])->result();
        }
    }
    //find test full mark from test table
    public function findTestMark($data)
    {
        $this->db->where_in('id',$data);
        $query = $this->db->get('test')->result();
        foreach ($query as $value) {
                $d[$value->id] = $value->mark;
            }
            return $d;
    }

    public function findBranch($data)
    {
        $this->db->where('status','active');
        $query = $this->db->get_where('branch',$data)->result();
        if (!empty($query)) {
            $d[] = 'Choose Branch';
            foreach ($query as $value) {
                $d[$value->id] = $value->branch_name;
            }
            return $d;
        }
        return ['No Branches Found'];
    }

    
    public function findSem($data)
    {
        $query = $this->db->get_where('semester',$data)->result();
        if (!empty($query)) {
            $d[] = 'Choose Semester';
            foreach ($query as $value) {
                $d[$value->id] = $value->name;
            }
            return $d;
        }
        return ['No Semester Found'];
    }
    //find student secured mark from marks table
    public function findSecuredMark($sid,$data)
    {
        $this->db->where_in('student_id',$sid);
        $query = $this->db->get_where('marks',$data)->result();
        $d[]="fihj";
        foreach ($query as $value) {
              $d[$value->student_id][$value->test_id] = $value->mark;
              $d[$value->student_id]['id'] = $value->id;
            }
            return $d;
            
    }

    public function findData($data)
    {
        return $this->db->get_where($this->table,$data)->result();

    }

    public function findFullMark($data)
    {
        return $this->db->get_where('test',$data)->row();
    }
}   
?>