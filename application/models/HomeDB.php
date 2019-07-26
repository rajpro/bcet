<?php  

class HomeDB extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function allCourses()
    {
        $this->db->where('status','active');
        $query = $this->db->get('course')->result();
        if (!empty($query)) {
            foreach ($query as $value) {
                $d[$value->id] = $value->name;
            }
            return $d;
        }
        return '0';
    }

     public function allBranches()
    {
        $this->db->where('status','active');
        $query = $this->db->get('branch')->result();
        if (!empty($query)) {
            foreach ($query as $value) {
                $d[$value->course][$value->id] = $value->branch_name;
            }
            return $d;
        }
        return '0';
    }
    
    public function findTeacher($data)
    {
        return $this->db->get_where('teacher',$data)->result();
    }

    public function findbranchbyid($id)
    {
        return $this->db->get_where('branch',['id'=>$id])->row();
    }

    public function gallery()
    {
        return $this->db->get_where('web',['con_type'=>'pic'])->result();
    }

     public function video()
    {
        return $this->db->get_where('web',['con_type'=>'vid'])->result();
    }

    public function findWebById($id)
    {
        return $this->db->get_where('web',['id'=>$id])->row();
    }

    public function notices()
    {
        $this->db->order_by('id','DESC');
        $this->db->where('status','active');
        $this->db->where_in('notice_for',['Website','AllTeachers&Website']);
        return $this->db->get('notice')->result();
    }
    
}
?>