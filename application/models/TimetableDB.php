<?php  

class TimetableDB extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = "subject_assignment";
    }

    // No of Rows Count
    public function count()
    {
        return $this->db->count_all($this->table);
    }

    // Find By Id
    public function findRow($data='')
    {
        return $this->db->get_where($this->table,$data)->row();
    }

    public function checkTimeTable($data='')
    {
        return $this->db->get_where($this->table,$data)->num_rows();
    }

    // Save
    public function save($data='')
    {
        return $this->db->insert($this->table, $data);
    }

    // Update
    public function update($data='')
    {
        return $this->db->where('id',$data['id'])->update($this->table, $data);
    }

    public function saveBatchUpdateData($data='')
    {
        return $this->db->update_batch($this->table, $data,'id');
    }

    // Pagination
    public function pagination($limit='',$offset='')
    {
        $this->db->order_by('id','DESC');
        return $this->db->get($this->table, $limit,$offset)->result();
    }

    // Delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    //find branches
    public function findBranches($data='')
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $d[]=$value->branch;
            }
            $this->db->where_in('id',array_unique($d));
            $query = $this->db->get('branch')->result();
            foreach ($query as $key => $value) {
                $r[$value->id] = $value->branch_name;
            }
            return $r;
        }else{
            return false;
        }
    }

    public function allBranches()
    {
        $this->db->where('status','active');
        $query = $this->db->get('branch')->result();
        if (!empty($query)) {
            $d[] = 'Choose Branch';
            foreach ($query as $value) {
                $d[$value->id] = $value->branch_name;
            }
            return $d;
        }
        return '0';
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
    //find semester 
    public function findSemester($data='')
    {
        if(!empty($data)){
            foreach($data as $key => $value){
                $d[]=$value->semester;
            }
            $this->db->where_in('id',array_unique($d));
            $query = $this->db->get('semester')->result();
            foreach ($query as $key => $value) {
                $s[$value->id]=$value->name;
            }
            return $s;
        }else{
            return false;
        }
    }

    public function allSemesters()
    {
        //$this->db->where('status','active');
        $query = $this->db->get('semester')->result();
        if (!empty($query)) {
            $d[] = 'Choose Semester';
            foreach ($query as $value) {
                $d[$value->id] = $value->name;
            }
            return $d;
        }
        return '0';
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

    public function allTeacherid()
    {
        $this->db->where('status','active');
        $query = $this->db->get('teacher')->result();
        if (!empty($query)) {
            $d[] = 'Choose Teacher Id';
            foreach ($query as $value) {
                $d[$value->id] = $value->name;
            }
            return $d;
        }
        return '0';
    }

    public function allSubjectid()
    {
        $this->db->where('status','active');
        $query = $this->db->get('subject')->result();
        if (!empty($query)) {
            $d[] = 'Choose Subject Id';
            foreach ($query as $value) {
                $d[$value->id] = $value->sub_name;
            }
            return $d;
        }
        return '0';
    }

    public function findTime($data='')
    {
        $this->db->select('semester');
        $this->db->distinct();
        $this->db->order_by('id',"DESC");
        $this->db->where('acid',$data['acid']);
        $this->db->where('branch',$data['branch']);
        $this->db->where('course',$data['course']);
        // No of Semester
        $nofr = $this->db->get('subject_assignment')->result();
        // echo "<pre>";print_r($nofr);
        // print_r($data);
        // exit();
        $data['semester'] = $nofr[0]->semester;
        $data['day']="MONDAY";
        return $this->db->get_where('subject_assignment',$data)->result();
    }

    public function findTimeTable($data='')
    {
        $this->db->select('semester');
        $this->db->distinct();
        $this->db->order_by('id',"DESC");
        $this->db->where('acid',$data['acid']);
        $this->db->where('branch',$data['branch']);
        $this->db->where('course',$data['course']);
        // No of Semester
        $nofr = $this->db->get('subject_assignment')->result();
        $data['semester'] = $nofr[0]->semester;
        $result = $this->db->get_where('subject_assignment',$data)->result();
        foreach ($result as $key => $value) {
            $d[$value->day][] = $value->subject_id;
        }
        return $d;
    }

    public function saveBatchData($data)
    {
        return $this->db->insert_batch('subject_assignment', $data);
    }

    public function findTeacherSubject($data)
    {
        // Retrive All Subjects
        $subjects = $this->db->get_where('subject',['course'=>$data['course'],'branch'=>$data['branch']])->result();
        if(!empty($subjects)){
            $d[] = 'Choose Subject';
            foreach ($subjects as $key => $value) {
                $d[$value->id] = $value->sub_name;
            }
        }else{
            $d[] = "No Subject Found";
        }
        $result['subjects'] = $d;
        unset($d);

        // Retrive All Teachers
        $teachers = $this->db->get('teacher')->result();
        if(!empty($teachers)){
            $d[] = 'Choose Teachers';
            foreach ($teachers as $key => $value) {
                $d[$value->id] = $value->name;
            }
        }else{
            $d[] = "No Teacher Found";
        }
        $result['teachers'] = $d;
        return $result;
    }

    public function findTimeTableData($data)
    {
        $days=array("monday","tuesday","wednesday","thursday","friday","saturday");
        $timetable = $this->db->get_where('subject_assignment',$data)->result();
        foreach ($days as $key => $value) {
            for($i=0;$i<count($timetable);$i++){
                if(strtoupper($value)==$timetable[$i]->day){
                    $d[$value][$timetable[$i]->time_from] = [
                        'id'=>$timetable[$i]->id,
                        'subject_id'=>$timetable[$i]->subject_id,
                        'teacher_id'=>$timetable[$i]->teacher_id
                    ];
                }
            }
        }
        if(!empty($d)){
            return $d;
        }else{
            return false;
        }
    }

    public function deactivateTimetable($acid,$branch,$course)
    {
        $this->db->order_by('id','DESC');
        $this->db->where('acid',$acid);
        $this->db->where('branch',$branch);
        $this->db->where('course',$course);
        $this->db->where('status','active');
        if ($this->db->get($this->table)->num_rows()) {
            $this->db->where('acid',$acid);
            $this->db->where('branch',$branch);
            $this->db->where('course',$course);
            return $this->db->update($this->table,['status'=>'deactive']);
        } else {
            $this->db->where('acid',$acid);
            $this->db->where('branch',$branch);
            $this->db->where('course',$course);
            return $this->db->update($this->table,['status'=>'active']);
        }
    }

    public function findABCS($data)
    {
        $sa = $this->db->order_by('id','DESC')->get_where('subject_assignment',['acid'=>$data['acid'],'course'=>$data['course'],'branch'=>$data['branch'],'status'=>'active'])->row();
        if(empty($sa)){
            return 1;
        }elseif($sa->status=='active'){
            return 0;
        }else{
            return $sa->semester+1;
        }
    }
}
?>