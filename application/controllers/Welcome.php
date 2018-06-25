<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct()
    {
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
		if (($this->session->userdata('user')!="") && !empty($this->session->userdata('userid'))){
			redirect('home');
		}else{
			$data['title']=lang('user_registration');
			$this->load->view('registration',$data);
		}
	}
	public function registration(){
		if (($this->session->userdata('user')!="") && !empty($this->session->userdata('userid'))){
			redirect('home');
		}else{
			$data['title']=lang('user_registration');
			$this->load->view('registration',$data);
		}
	}
}
