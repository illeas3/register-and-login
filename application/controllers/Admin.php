<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
		$this->load->model('crud_model');
		if (($this->session->userdata('admin')!="") && !empty($this->session->userdata('admin'))){
			redirect('admin/dashboard');
		}else{
			$data['title']=lang('admin_login_page');
			$this->load->view('admin/index',$data);
		}

	}
	function login_validation(){
		$this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', 'Please fix error content!');
            redirect('admin/index');
        }else{
        	$email=$this->input->post('email');
        	$password=md5($this->input->post('password'));

        	$dbrow=$this->db->get_where('admin' , array('email' => $email))->row();
        	if($dbrow){
        		if(($dbrow->email==$email) && ($dbrow->password==$password)){
        			$sedata = array(
						        'admin'  => 1,
						        'adminid'     => $dbrow->id,
						        'adminuser'     => $dbrow->username,
						        'success'	=> 'Successfully loggedin!'
						);
					$this->session->set_userdata($sedata);
        			redirect('admin/dashboard');
        		}else{
        			$this->session->set_flashdata('error', 'Username/Password Seems Wrong!!');
        			redirect('admin/index');
        		}
        	}else{
        		$this->session->set_flashdata('error', 'User not found!!');
        		redirect('admin/index');
        	}
        }
	}
	public function dashboard(){
		if (($this->session->userdata('admin')!="") && !empty($this->session->userdata('admin'))){
			$data['title']=lang('admin_dashboard');
			$this->load->view('admin/header',$data);
			$this->load->view('admin/dashboard');
			$this->load->view('admin/footer');
		}else{
			redirect('admin/index');
		}
	}
	public function userlist(){
		if (($this->session->userdata('admin')!="") && !empty($this->session->userdata('admin'))){
			$data['title']=lang('register_user_list');
			$this->load->view('admin/header',$data);
			$this->load->view('admin/userlist');
			$this->load->view('admin/footer');
		}else{
			redirect('admin/index');
		}
	}
	public function profile(){
		if (($this->session->userdata('admin')!="") && !empty($this->session->userdata('admin'))){
			$data['title']=lang('user_profile');
			$this->load->view('admin/header',$data);
			$this->load->view('admin/profile');
			$this->load->view('admin/footer');
		}else{
			redirect('admin/index');
		}
	}
	public function settings(){
		if (($this->session->userdata('admin')!="") && !empty($this->session->userdata('admin'))){
			$data['title']=lang('profile_settings');
			$this->load->view('admin/header',$data);
			$this->load->view('admin/settings');
			$this->load->view('admin/footer');
		}else{
			redirect('admin/index');
		}
	}
	public function useredit($user=null){
		$userid=$this->uri->segment(3);
		if (($this->session->userdata('admin')!="") && !empty($this->session->userdata('admin'))){
			$data['title']=lang('user_profile_edit');
			$data['userid']=$userid;
			$this->load->view('admin/header',$data);
			$this->load->view('admin/useredit');
			$this->load->view('admin/footer');
		}else{
			redirect('admin/index');
		}
	}
	public function editdetails(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('contact', 'contact', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address', 'address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('position', 'position', 'trim|xss_clean');
		$this->form_validation->set_rules('gender', 'gender', 'trim|xss_clean');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', 'Please fix error content!');
            redirect('admin/settings');
        }else{
        	$id=$this->input->post('id');
        	$currentTime=strtotime(date("Y-m-d H:i:s"));
        	$randcode = rand();
        	$ip_address=$_SERVER['REMOTE_ADDR'];
            $data = array(
                'uid'    => strtolower($this->input->post('email')),
                'first_name'    => $this->input->post('first_name'),
                'last_name'    => $this->input->post('last_name'),
                'email'     => $this->input->post('email'),
                'contact'     => $this->input->post('contact'),
                'address'     => $this->input->post('address'),
                'user_ip'      => $ip_address
            );

            //Table Insert
            $result=$this->crud_model->updates("admin","id",$id,$data);;
	        if($result){
	        	$this->session->set_flashdata('success', 'Successfully update profile!');
	        	redirect('admin/settings');
	        }else{
	        	$this->session->set_flashdata('error', 'Something went wrong please try again or contact support!');
	        	redirect('admin/settings');
	        }  
	            
        }
	}
	public function usereditdetails(){
		$userid=$this->input->post('userid');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('contact', 'contact', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address', 'address', 'trim|required|xss_clean');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', 'Please fix error content!');
            redirect('admin/useredit/'.$userid);
        }else{
        	$password=$this->input->post('password');
        	if($password==" "){
        		$password=$this->input->post('oldpass');
        	}else{
        		$password=md5($this->input->post('password'));
        	}
            $data = array(
                'uid'    => strtolower($this->input->post('email')),
                'first_name'    => $this->input->post('first_name'),
                'last_name'    => $this->input->post('last_name'),
                'email'     => $this->input->post('email'),
                'contact'     => $this->input->post('contact'),
                'password'     => $password,
                'address'     => $this->input->post('address')
            );
            //Table Insert
            $result=$this->crud_model->updates("users","id",$userid,$data);;
	        if($result){
	        	$this->session->set_flashdata('success', 'Successfully update user profile!');
	        	redirect('admin/useredit/'.$userid);
	        }else{
	        	$this->session->set_flashdata('error', 'Something went wrong please try again or contact support!');
	        	redirect('admin/useredit/'.$userid);
	        }  
	            
        }
	}
	public function passchange(){
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', 'Please fix error content!');
            redirect('admin/settings');
        }else{
        	$id=$this->input->post('id');
        	$old_password=md5($this->input->post('old_password'));

        	$dbrow=$this->db->get_where('admin' , array('id' => $id))->row();
	        if($old_password===$dbrow->password){
	            $data = array(
	                'password'      => md5($this->input->post('password'))
	            );
	            $result=$this->crud_model->updates("admin","id",$id,$data);;
		        if($result){
		        	$this->session->set_flashdata('success', 'Change password success!');
		        	redirect('admin/settings');
		        }else{
		        	$this->session->set_flashdata('error', 'Something went wrong please try again or contact support!');
		        	redirect('admin/settings');
		        }
		    }else{
		    	$this->session->set_flashdata('error', 'Old password not match!');
		        redirect('admin/settings');
		    }  
        }
	}
	public function changelang(){
		$this->form_validation->set_rules('language', 'Language', 'trim|required|xss_clean');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', 'Please fix error content!');
            redirect('admin/settings');
        }else{
        	$id=1;
            $data = array(
                'language'      => $this->input->post('language')
            );
            $result=$this->crud_model->updates("settings","setting_id",$id,$data);
	        if($result){
	        	$this->session->set_flashdata('success', 'Change language success!');
	        	redirect('admin/settings');
	        }else{
	        	$this->session->set_flashdata('error', 'Something went wrong please try again or contact support!');
	        	redirect('admin/settings');
	        }
        }
	}
	public function userdelete($userid=null){
		$userid=$this->uri->segment(3);
		$where = array('id' => $userid);
		$result=$this->crud_model->whereDelete("users",$where); 
		if($result){
		  	$this->session->set_flashdata('success', 'Successfully delete user!');
		  	redirect('admin/userlist');
		}else{
	    	$this->session->set_flashdata('error', 'Something went wrong Please try again!');
		  	redirect('admin/userlist');
		}
	}
	public function getlanguage(){
		$id=1;
		$val=$this->input->post('val');
		$data=array(
			'language'=>$val
		);
        $this->crud_model->updates("settings","setting_id",$id,$data);;
		echo $val;
	}
	function logout(){
		$this->session->sess_destroy();
		setcookie("user", 1,  time() - 3600, "/"); 
		setcookie("uid", $username,  time() - 3600, "/"); 
		setcookie("userid", $dbrow->id,  time() - 3600, "/"); 
		setcookie("mobile_phone", $dbrow->mobile_phone,  time() - 3600, "/");
		redirect('admin');
	}
}
