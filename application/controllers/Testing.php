<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this academic class we can add,View,Update
 * academic details and view the details. 
 * @author  Group Alpha   
 */

class Testing extends CI_Controller {

	
	public function index()
	{
		require_once APPPATH."third_party/phppass/PasswordHash.php";
		$PasswordHash = new PasswordHash();
		echo "<pre>";
		$result = $this->db->get('teacher')->result();
		foreach ($result as $key => $value) {
			$uname = substr(str_replace(" ",'',preg_replace("(dr )",'',preg_replace("(mrs )",'',preg_replace("(mr )",'',strtolower($value->name))))),0,8);
			$prep = [
				'user_type'=>2,
				'username'=>$uname,
				'password'=>$PasswordHash->HashPassword('1234'),
				'profile_id'=>$value->id,
				'email'=>($value->email)?$value->email:'email'.$key
			];
			if(!empty($this->db->get_where('auth',['username'=>$uname])->row())){
				$prep['username'] = $uname.'1';
			}if(empty($this->db->get_where('auth',['profile_id'=>$value->id])->row())){
				// $this->db->insert('auth',$prep);
			}
		}
		print_r($prep);

	}
}