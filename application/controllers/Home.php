<meta name=”viewport” content=”width=device-width, initial-scale=1″>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Here in this batch class we can add,View,Update
 * academic details and view the details. 
 * @author  Group Alpha   
 */

class Home extends CI_Controller {

	/**
	* Get records from database and list them as table view
	* @return Batch view page to browser
	*/

	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('HomeDB');
 	}


	public function index()
	{
		$data["course"]=$this->HomeDB->allcourses();
		$data["branches"]=$this->HomeDB->allbranches();
		$data["gallery"]=$this->HomeDB->gallery();
		$data["video"]=$this->HomeDB->video();
		$data["notices"] = $this->HomeDB->notices();

		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/index',$data);
		$this->load->view('template/home_footer');
	}

	/**
	* Get data as parameter and retrive a perticular batch data
	* and View All data.
	* @param int $id This is a batch (id) field in Batch Table.
	* @return batch Detail View page to browser
	*/
	public function view()
	{

		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('home/index');
		$this->load->view('template/footer');
	}

	public function contact()
	{
        $data["course"]=$this->HomeDB->allcourses();
		$data["branches"]=$this->HomeDB->allbranches();
		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/contact');
		$this->load->view('template/home_footer');
	}

	public function faculties()
	{
        $data["course"]=$this->HomeDB->allcourses();
		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/faculties',$data);
		$this->load->view('template/home_footer');
	}

	public function faculty($id)
	{
         $data["course"]=$this->HomeDB->allcourses();
         $data["branches"]=$this->HomeDB->allbranches();
         $data["branch_details"]=$this->HomeDB->findbranchbyid($id);
         $data["teacher"]=$this->HomeDB->findTeacher(["branch"=>$id,'status'=>'active']);
         

		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/faculty',$data);
		$this->load->view('template/home_footer');
	}

	public function admission()
	{ 
		$data["course"]=$this->HomeDB->allcourses();
		$data["branches"]=$this->HomeDB->allbranches();
		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/admission');
		$this->load->view('template/home_footer');
	}

	public function extra($url)
	{
		$data["course"]=$this->HomeDB->allcourses();
		$data["branches"]=$this->HomeDB->allbranches();
		$data['extras'] = $this->db->get_where('web',['con_type'=>'web', 'url'=>$url])->result();
		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/extra',$data);
		$this->load->view('template/home_footer');
	}

	public function about($url)
	{
		$data["course"]=$this->HomeDB->allcourses();
		$data["branches"]=$this->HomeDB->allbranches();
		$data["abouts"]=$this->db->get_where('web',['con_type'=>'about', 'url'=>$url])->row();
		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/about',$data);
		$this->load->view('template/home_footer');
	}

	public function photos()
	{ 
		$data["course"]=$this->HomeDB->allcourses();
		$data["branches"]=$this->HomeDB->allbranches();
		$data["gallery"]=$this->HomeDB->gallery();
		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/photos',$data);
		$this->load->view('template/home_footer');
	}

	public function videos()
	{ 
		$data["course"]=$this->HomeDB->allcourses();
		$data["branches"]=$this->HomeDB->allbranches();
	    $data["video"]=$this->HomeDB->video();
		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/videos',$data);
		$this->load->view('template/home_footer');
	}

	public function seminar()
	{ 
		$data["course"]=$this->HomeDB->allcourses();
		$data["branches"]=$this->HomeDB->allbranches();
		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/seminar',$data);
		$this->load->view('template/home_footer');
	}

	public function noticess()
	{ 
		$data["course"]=$this->HomeDB->allcourses();
		$data["branches"]=$this->HomeDB->allbranches();
		$data["notice_detail"]=$this->HomeDB->notices();
		$this->load->view('template/home_head');
		$this->load->view('home/menu',$data);
		$this->load->view('home/notices',$data);
		$this->load->view('template/home_footer');
	}


}