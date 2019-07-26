<?php
Class Notification_model extends CI_Model
{
 
  function notification_list($limit){
	  $logged_in=$this->session->userdata('logged_in');
		
	  if($this->input->post('search')){
	 $this->db->or_like('savsoft_notification.nid',$this->input->post('search'));
	 $this->db->or_like('savsoft_notification.title',$this->input->post('search'));
	 $this->db->or_like('savsoft_notification.message',$this->input->post('search'));
	 $this->db->or_like('savsoft_notification.notification_date',$this->input->post('search'));
	 $this->db->or_like('savsoft_notification.click_action',$this->input->post('search'));
	 $this->db->or_like('savsoft_notification.notification_to',$this->input->post('search'));
	  }
	  if($logged_in['su'] == '0'){
	  $uid=$logged_in['uid'];
	  $this->db->or_where('savsoft_notification.uid',$uid);
	$this->db->or_where('savsoft_notification.uid','0');
		
	  }
	  $this->db->join('savsoft_users','savsoft_users.uid=savsoft_notification.uid','left');
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('nid','desc');
		$query=$this->db->get('savsoft_notification');
		return $query->result_array();
		
	 
 }
 
 
 function insert_notification($result,$nval){
		$this->load->library('email');

         $userdata=array(
         'title'=>$this->input->post('title'),
         'message'=>$this->input->post('message'),
         'click_action'=>$this->input->post('click_action'),
         'uid'=>$this->input->post('uid'),
         'notification_to'=>$nval,
         'response'=>$result,
         
         );

         if($this->db->insert('savsoft_notification',$userdata))
         {
         		if($userdata['uid']!='0')
         		{
         			$users=$this->db->get_where('savsoft_users',['uid'=>$userdata['uid']])->result();
         		}
         		else
         		{
         			$users=$this->db->get_where('savsoft_users',['su'=>0])->result();
         		}
         		foreach($users as $val)
         		{
		         	$fromemail=$this->config->item('fromemail');
					$fromname=$this->config->item('fromname_notice');
					$subject=$userdata['title'];
					$message=$userdata['message'];
					$this->email->to($val->email);
					$this->email->from($fromemail, $fromname);
					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->send();
				}

         	}
         	
         	
         }
         
 }
 

?>