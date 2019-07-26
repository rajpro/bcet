<?php  

class AjaxDB extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function findBranch($data)
	{
		return $this->db->get_where('branch',$data)->result();
	}
	public function findSemester($data)
	{
		return $this->db->get_where('semester',$data)->result();
	}

	public function findTeacher($data)
	{
		$result = $this->db->get_where('subject_assignment',$data)->result();
		if(!empty($result)){
			foreach ($result as $key => $value) {
				$d[] = $value->teacher_id;
			}
			$d = array_unique($d);
			$result = $this->db->where_in('id',$d)->get('teacher')->result();
		}
		return $result;
	}

	public function findSubject($data)
	{
		$result = $this->db->get_where('subject_assignment',$data)->result();
		if(!empty($result)){
			foreach ($result as $key => $value) {
				$d[] = $value->subject_id;
			}
			$d = array_unique($d);
			$result = $this->db->where_in('id',$d)->get('subject')->result();
		}
		return $result;
	}
	public function setMark($data)
	{
		  $this->db->select('mark');
		  return $this->db->get_where('marks',$data)->row();
		 
	}

	public function updateMark($data)
	{
		return $this->db->where('id',$data['id'])->update('marks', $data);
	}

	public function checkMark($data)
	{
		return $this->db->get_where('test',$data)->row();
	}

	public function find_sem_ate($cid,$bid)
	{
		$sem_finder = 0;
		$semesters = $this->db->get_where('semester',['course_id'=>$cid])->result();
		$academic = $this->db->get_where('academic',['course'=>$cid,'status'=>'active'])->result();
		foreach ($academic as $key => $value) {
			if (!empty($sa = $this->db->get_where('subject_assignment',['acid'=>$value->id,'course'=>$cid,'branch'=>$bid,'status'=>'active'])->row())) {
				$sem_finder = 1;
			}
			$ac_ids[] = $sa;
		}
		if($sem_finder==0){
			return 0;
		}else{
			foreach ($ac_ids as $key => $value) {
				if(isset($value->semester)){
					$ss[] = $value->semester;
				}
			}
			$sem_list[0] = 'Choose Semester';
			foreach ($semesters as $key => $value) {
				if(in_array($value->id,$ss)){
					$sem_list[$value->id] = $value->name;
				}
			}
			ksort($sem_list);
			return $sem_list;
		}
	}

	public function find_sub_ate($cid,$bid,$sem)
	{
		$sem_finder = 0;
		$subjects = $this->db->get('subject')->result();
		$academic = $this->db->get_where('academic',['course'=>$cid,'status'=>'active'])->result();
		foreach ($academic as $key => $value) {
			if (!empty($sa = $this->db->get_where('subject_assignment',['acid'=>$value->id,'course'=>$cid,'branch'=>$bid,'semester'=>$sem,'teacher_id'=>$this->session->profile['id'],'status'=>'active'])->result())) {
				$sem_finder = 1;
			}
			$subject_ids[] = $sa;
		}
		if($sem_finder==0){
			return 0;
		}else{
			foreach ($subject_ids as $key => $value) {
				if(!empty($value)){
					foreach ($value as $ky => $val) {
						if(isset($val->subject_id)){
							$ss[] = $val->subject_id;
						}
					}
				}
			}
			$sem_list[0] = 'Choose Subject';
			foreach ($subjects as $key => $value) {
				if(in_array($value->id,$ss)){
					$sem_list[$value->id] = $value->sub_name;
				}
			}
			ksort($sem_list);
			return $sem_list;
		}
	}

	public function findABCS($data)
	{
		$sa = $this->db->order_by('id','DESC')->get_where('subject_assignment',['acid'=>$data['aid'],'course'=>$data['cid'],'branch'=>$data['bid']])->row();
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