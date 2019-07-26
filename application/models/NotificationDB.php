<?php  

class NotificationDB extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = "notification";
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
        $this->db->where('user_type',$this->session->user_type);
        $this->db->where('user_id',$this->session->profile['id']);
        return $this->db->get($this->table, $limit,$offset)->result();
    }

    // Delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

     public function allTeacher()
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

     public function allStudent()
    {
        $this->db->where('status','active');
        $query = $this->db->get('student')->result();
        if (!empty($query)) {
            $d[] = 'Choose Student';
            foreach ($query as $value) {
                $d[$value->id] = $value->name;
            }
            return $d;
        }
        return '0';
    }
    
    
}
?>