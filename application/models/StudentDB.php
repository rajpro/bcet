<?php  

class StudentDB extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = "student";
    }

    // No of Rows Count
     public function count($data='')
    {
        if(!empty($data)){
            if($data['course']!=0){$this->db->where('course',$data['course']);}
            if($data['branch']!=0){$this->db->where('branch',$data['branch']);}
            if(!empty($data['name'])){$this->db->like('name',$data['name'],'both');}
        }
        return $this->db->get($this->table)->num_rows();
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
    public function pagination($limit='',$offset='',$data)
    {
        $this->db->order_by('id','DESC');
        if(!empty($data)){
            if($data['course']!=0){$this->db->where('course',$data['course']);}
            if($data['branch']!=0){$this->db->where('branch',$data['branch']);}
            if(!empty($data['name'])){$this->db->like('name',$data['name'],'both');}
        }
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
        
    public function findStudent($data)
    {
    return $this->db->get_where('student',$data)->result();
    }
    public function multiSaveStudent($data)
    {
        return $this->db->insert_batch($this->table,$data);
    }

    public function findBranchById($id)
    {
        return $this->db->get_where('branch',['id'=>$id])->row();
    }

    public function findCourseById($id)
    {
        return $this->db->get_where('course',['id'=>$id])->row();
    }

    public function findAcademicById($id)
    {
        return $this->db->get_where('academic',['id'=>$id])->row();
    }
}
?>