<?php  

class StaffDB extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = "staff";
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

     public function authSave($data='')
    {
        return $this->db->insert('auth', $data);
    }

    public function authUpdate($data='')
    {
        $this->db->where('profile_id',$data['profile_id']);
        $this->db->where('user_type',$data['user_type']);
        return $this->db->update('auth', $data);
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

    // Roles
    public function roles()
    {
        $query = $this->db->get('role')->result();
        $d[] = 'Choose Role';
        if(!empty($query)){
            foreach ($query as $key => $value) {
                $d[$value->id] = $value->name;
            }
        }
        return $d;
    }

    // Username
    public function findUsername($profile_id,$role)
    {
        $query = $this->db->get_where('auth',['profile_id'=>$profile_id,'user_type'=>$role])->row();
        return $query;
    }
}
?>