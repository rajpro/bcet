<?php  

class AuthDB extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Login Credential Check
    public function credential($data='')
    {
        $query = $this->db->get_where('auth',['username'=>$data['username']])->row();
        if(!empty($query)){
            $PasswordHash = new PasswordHash();
            if($PasswordHash->CheckPassword($data['password'],$query->password)){
                $prepdata['uid'] = $query->id;
                $prepdata['username'] = $query->username;
                $prepdata['user_type'] = $query->user_type;
                $prepdata['profile'] = $this->_profile($query->profile_id,$query->user_type);
                $prepdata['role'] = $this->_role($query->user_type);
                return $prepdata;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    private function _profile($id,$user_type)
    {
        if ($user_type=='2') {
            return $this->db->get_where('teacher',['id'=>$id])->row_array();
        }
        return $this->db->get_where('staff',['id'=>$id])->row_array();
    }

    private function _role($id)
    {
        $query = $this->db->get_where('role',['id'=>$id])->row();
        return json_decode($query->role);
    }

    public function empcredential($data='')
    {
        $query = $this->db->get_where('marketing',['referral'=>$data['referral']])->row();
        if(!empty($query)){
            $PasswordHash = new PasswordHash();
            if($PasswordHash->CheckPassword($data['password'],$query->password)){
                $prepdata['uid'] = $query->id;
                $prepdata['referralid'] = $query->referral;
                $prepdata['name'] = $query->name;
                $prepdata['phone'] = $query->phone;
                $prepdata['email'] = $query->email;
                $prepdata['user_type'] = $query->user_type;
                $prepdata['salary_type'] = $query->salary_type;
                return $prepdata;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // Profile Insert
    public function save_profile($data='')
    {
        $query = $this->db->insert('profile', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    // Username and Password Insert
    public function save_credential($data='')
    {
        $query = $this->db->insert('user', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function noCard()
    {
        $query = $this->db->get_where('cards',['status'=>'0']);
        return $query->num_rows();
    }

    public function changePassword($data)
    {
        $this->db->where('id', $data['id']);
        $query = $this->db->update('admin', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function allRole()
    {
        
        $query = $this->db->get('role')->result();
        if (!empty($query)) {
            $d[] = 'Choose Role';
            foreach ($query as $value) {
                $d[$value->id] = $value->name;
            }
            return $d;
        }
        return '0';
    }
}
?>