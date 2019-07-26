<?php  

class AttendanceDB extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = "attendance";
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

    public function findAttendance($data='')
    {
        return $this->db->get_where($this->table,$data)->result();
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

    public function allSemester()
    {
        
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
    //serach student
    
    public function findStudent($data)
    {
    return $this->db->get_where('student',$data)->result();
    }

    public function multiSaveAttendance($data)
    {
        return $this->db->insert_batch($this->table,$data);
    }

    public function findStudentPercent($student,$data)
    {
        foreach ($student as $key => $value) {
            $d[] = $value->id;
        }
        $no_of_date = $this->db->select('attendent_date')->distinct()->where_in('student_id',$d)->get_where('attendance',$data)->num_rows();
        $result = $this->db->where_in('student_id',$d)->get_where('attendance',$data)->result();
        foreach ($result as $value) {
            if(!empty($present[$value->student_id])){
                $present[$value->student_id] += 1;
            }else{
                $present[$value->student_id] = 1;
            }
        }
        foreach ($d as $value) {
            if(!empty($present[$value])){
                $atn = ($present[$value]/$no_of_date*100);
                $stu_struct[$value] = $atn;
            }else{
                $stu_struct[$value] = 0;
            }
        }
        return $stu_struct;
    }

    public function acid($data)
    {
        $acid = $this->db->get_where('subject_assignment',['course'=>$data['course'],'branch'=>$data['branch'],'semester'=>$data['semester'],'teacher_id'=>$data['teacher'],'status'=>'active'])->row();
        return $acid->acid;
    }
}
?>