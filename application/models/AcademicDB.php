<?php  

class AcademicDB extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = "academic";
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
        return $this->db->get($this->table, $limit,$offset)->result();
    }

    // Delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
?>