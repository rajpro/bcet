<?php  

class TeacherleaveDB extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = "teacherleave";
    }

    // No of Rows Count
    public function count()
    {
        return $this->db->count_all($this->table);
    }

    public function all($limit, $offset)
    {
        return $this->db->get($this->table)->result();
    }

    public function classAdjustcount()
    {
        return $this->db->count_all('classextend');
    }

    public function hodApprovalCount()
    {
        $teacher_detail = $this->db->get_where('teacher',['id'=>$this->session->profile['id']])->row();
        return $this->db->query("SELECT * FROM teacherleave WHERE emp_id IN (SELECT id FROM teacher WHERE course=".$teacher_detail->course." AND branch=".$teacher_detail->branch.")")->num_rows();
    }
    

    // Find By Id
    public function findRow($data='')
    {
        return $this->db->get_where($this->table,$data)->row();
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
        if($this->session->user_type!=1){
            $this->db->where('user_type',$this->session->user_type);
            $this->db->where('emp_id',$this->session->profile['id']);
        }
        return $this->db->get($this->table, $limit,$offset)->result();
    }

    public function classAdjustPagination($limit='',$offset='')
    {
        $this->db->order_by('id','DESC');
        $this->db->where('app_teacher',$this->session->profile['id']);
        return $this->db->get('classextend', $limit,$offset)->result();
    }

    public function hodApproval($limit='',$offset='')
    {
        $teacher_detail = $this->db->get_where('teacher',['id'=>$this->session->profile['id']])->row();
        return $this->db->query("SELECT * FROM teacherleave WHERE emp_id IN (SELECT id FROM teacher WHERE course=".$teacher_detail->course." AND branch=".$teacher_detail->branch.") LIMIT ".$limit." OFFSET ".$offset)->result();
    }

    // Delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    //all branches
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

    public function allTeachers()
    {
        $this->db->where('status','active');
        $query = $this->db->get('teacher')->result();
        if (!empty($query)) {
            $d[] = 'Choose Teacher';
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

    public function teacherTimetable($data)
    {
        $this->db->where('status','active');
        // $this->db->where('course',$data['course']);
        $this->db->where('teacher_id',$data['teacher_id']);
        $this->db->where_in('day',$data['days']);
        $query = $this->db->get('subject_assignment')->result();
        return  $query;
    }

    public function leaveReject($id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->table,['status'=>'rejected']);
        $result = $this->db->get_where($this->table,['id'=>$id])->row();
        $nd = ['user_type'=>$result->user_type,'user_id'=>$result->emp_id,'status'=>'open','not_date'=>date('Y-m-d')];
        $nd['notice_subject'] = "Your Leave Application Subject to <span class='user-name'>".$result->leave_sub."</span> is rejected.";
        return $this->db->insert('notification',$nd);
    }

    public function updateTeacherLeave($id)
    {
        // return;
        $this->db->where('id',$id);
        $this->db->update('teacherleave',['status'=>'principal_pending']);
        $teacher = $this->db->query("SELECT * FROM teacher WHERE id=(SELECT emp_id FROM teacherleave WHERE id=".$id.")")->row();
        $teacher = $this->db->query("SELECT * FROM teacher WHERE course=".$teacher->course." AND branch=".$teacher->branch." AND designation='hod_asstprof'")->row();
        $result = $this->db->get_where('teacherleave',['id'=>$id])->row();
        $nd = ['user_type'=>$result->user_type,'user_id'=>$result->emp_id,'status'=>'close','not_date'=>date('Y-m-d')];
        $nd['notice_subject'] = "<span class='user-name'>".$teacher->name."</span> accepted your leave Application.";
        return $this->db->insert('notification',$nd);
    }

    public function listTBS($tid,$data)
    {
        $this->db->select('teacher_id,time_from,time_to')->distinct()->where('teacher_id !=',$tid);
        $query = $this->db->get_where('subject_assignment',['branch'=>$data->branch,'course'=>$data->course,'acid'=>$data->acid,'status'=>'active'])->result();
        if(!empty($query)){
            foreach ($query as $key => $value) {
                $d[] = $value->teacher_id;
            }
            $rs = $this->db->where_in('id',$d)->get('teacher')->result();
            $a[] = 'Choose Teacher';
            foreach ($rs as $key => $value) {
                $a[$value->id] = $value->name;
            }
            return $a;
        }
        return;
    }

    public function findBySAId($data)
    {
        $this->db->where_in('id',$data);
        return $this->db->get('subject_assignment')->result();
    }

    public function saveTeacherExtend($data)
    {
        return $this->db->insert_batch('classextend',$data);
    }

    public function findTeacherIn($where,$in)
    {
        return $this->db->where_in($where,$in)->get('teacher')->result();
    }

    public function getStudyDetail($data)
    {
        $a = $this->db->get_where('branch',['id'=>$data['branch']])->row();
        $b = $this->db->get_where('course',['id'=>$data['course']])->row();
        return [$a->branch_name,$b->name];
    }

    public function getTimeCalculation($id)
    {
        $a = $this->db->get_where('subject_assignment',['id'=>$id])->row();
        return (date("ha",strtotime($a->time_from))."-".date("ha",strtotime($a->time_to)));
    }

    public function getSemesterById($id)
    {
        $a = $this->db->get_where('semester',['id'=>$id])->row();
        return $a->name;
    }

    public function saveNotification($data)
    {
        return $this->db->insert_batch('notification',$data);
    }

    public function updateClassExtend($id,$data)
    {
        $this->db->where('id',$id)->update('classextend',$data);
        $requester = $this->db->query("SELECT id,name FROM teacher WHERE id=(SELECT teacher FROM classextend WHERE id=".$id.")")->row();
        $accepter = $this->db->query("SELECT id,name FROM teacher WHERE id=(SELECT app_teacher FROM classextend WHERE id=".$id.")")->row();
        if($data['status']=='approved'){
            $ns = "<span class='user-name'>".$accepter->name."</span> is accepted your request.";
        }else{
            $ns = "<span class='user-name'>".$accepter->name."</span> is canceled your request.";
        }
        $notice = ['user_type'=>2,'user_id'=>$requester->id,'notice_subject'=>$ns,'not_date'=>date('Y-m-d')];
        $this->db->insert('notification',$notice);
        // Extra Notification Works.
        $cex = $this->db->query("SELECT COUNT(*) count FROM classextend WHERE teacher=(SELECT teacher FROM classextend WHERE id=".$id.") AND status IN ('pending','canceled')")->row();
        if($cex->count==0){
            $this->db->query("UPDATE teacherleave SET status='hod_pending' WHERE emp_id=(SELECT teacher FROM classextend WHERE id=".$id.") AND status='teacher_pending'");
            $tdetail = $this->db->query("SELECT * FROM teacher WHERE id=(SELECT teacher FROM classextend WHERE id=".$id.")")->row();
            $hod = $this->db->query("SELECT * FROM teacher WHERE course=".$tdetail->course." AND branch=".$tdetail->branch." AND designation='hod_asstprof'")->row();
            $ns = "<span class='user-name'>".$requester->name."</span> is requesting for a leave.";
            $notice = ['user_type'=>2,'user_id'=>$hod->id,'notice_subject'=>$ns,'not_date'=>date('Y-m-d')];
            $this->db->insert('notification',$notice);
        }
        return;
    }
}
?>