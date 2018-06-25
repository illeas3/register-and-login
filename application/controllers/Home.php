<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	function __construct() {
        parent::__construct();
        if (($this->session->userdata('user')!="") && !empty($this->session->userdata('userid'))){
	        $id=$this->session->userdata('userid');
			$getlanguage=$this->db->get_where('users' , array('id' => $id))->row()->language;
			if($getlanguage){
				$language=$getlanguage;
			}else{
				$language=$this->db->get_where('settings')->row()->language;
			}
		}elseif(($this->session->userdata('language')!="") && !empty($this->session->userdata('language'))){
			$language=$this->session->userdata('language');
		}else{
			$language=$this->db->get_where('settings')->row()->language;
		}
		$this->lang->load($language, $language);
    }
	public function index()
	{
		if (($this->session->userdata('user')!="") && !empty($this->session->userdata('user'))){
			$data['title']=lang('user_dashboard');
			$this->load->view('header',$data);
			$this->load->view('home');
			$this->load->view('footer');
		}else{
			redirect('login');
		}
	}
	public function home(){
		if (($this->session->userdata('user')!="") && !empty($this->session->userdata('user'))){
			$data['title']=lang('user_dashboard');
			$this->load->view('header',$data);
			$this->load->view('home');
			$this->load->view('footer');
		}else{
			redirect('login');
		}
	}
	public function profile(){
		if (($this->session->userdata('user')!="") && !empty($this->session->userdata('user'))){
			$data['title']=lang('user_profile');
			$this->load->view('header',$data);
			$this->load->view('profile');
			$this->load->view('footer');
		}else{
			redirect('login');
		}
	}
}



