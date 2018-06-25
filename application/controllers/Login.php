<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
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
			$data['title']=lang('user_login');
			$this->load->view('login',$data);
		}
	}
	public function forget(){
		if (($this->session->userdata('user')!="") && !empty($this->session->userdata('userid'))){
			redirect('home');
		}else{
			$data['title']=lang('forgot_password');
			$this->load->view('forget',$data);
		}
	}
	function login_validation(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', 'Please fix error content!');
            redirect('login');
        }else{
        	$email=strtolower($this->input->post('email'));
        	$password=md5($this->input->post('password'));

        	$dbrow=$this->db->get_where('users' , array('email' => $email))->row();
        	//$dbrow=$this->db->query('select * from users where (uid = "'.$username.'" or email = "'.$username.'")')->row();
        	if($dbrow){
        		if(($dbrow->randcode==1)){
	        		if($dbrow->password==$password){
	        			$sedata = array(
							        'user'  => 1,
							        'uid'     => $dbrow->uid,
							        'userid'     => $dbrow->id,
							        'success'	=> 'Successfully logged in!',
							        'logged_in' => TRUE
							);
						$this->session->set_userdata($sedata);
	        			redirect('home');
	        		}else{
	        			$this->session->set_flashdata('error', 'Username/Password Seems Wrong!!');
	        			redirect('login');
	        		}
        		}else{
        			$this->session->set_flashdata('error', 'Your email is not acivated please confirm your account!!');
        			redirect('login');
        		}
        	}else{
        		$this->session->set_flashdata('error', 'User not found!!');
        		redirect('login');
        	}
        }

	}

	public function register(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
		$this->form_validation->set_rules('contact', 'contact', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address', 'address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('position', 'position', 'trim|xss_clean');
		$this->form_validation->set_rules('gender', 'gender', 'trim|xss_clean');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', 'Please fix error content!');
            redirect('welcome');
        }else{
        	$currentTime=strtotime(date("Y-m-d H:i:s"));
        	$randcode = rand();
        	$ip_address=$_SERVER['REMOTE_ADDR'];
            $data = array(
                'uid'    => strtolower($this->input->post('email')),
                'first_name'    => $this->input->post('first_name'),
                'last_name'    => $this->input->post('last_name'),
                'email'     => $this->input->post('email'),
                'contact'     => $this->input->post('contact'),
                'password'      => md5($this->input->post('password')),
                'userRole'     => $this->input->post('position'),
                'gender'     => $this->input->post('gender'),
                'address'     => $this->input->post('address'),
                'user_ip'      => $ip_address,
                'randcode'      => $randcode,
                'joindate'         => $currentTime
            );

            //Table Insert
            $result=$this->crud_model->insert($data);
	        if($result){
	        	//Create Message
	            $this->session->set_flashdata('success', 'Successfully create new users please check your email and active account!');
	            $from_email = "no_reply@loop-tech.net"; 
		        $to_email = $this->input->post('email'); 
		   
		         //Load email library 
		   
		        $this->email->from($from_email, 'Loop-tech'); 
		        $this->email->to($to_email);
		        $this->email->subject('Confirm Link.');
		         
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'sg3plcpnl0048.prod.sin3.secureserver.net';
				$config['smtp_port'] = '465';
				$config['smtp_user'] = 'no_reply@loop-tech.net';
				$config['smtp_pass'] = 'Illeas1448';
				$config['mailtype'] = 'html';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$bodys="Hello, ".$this->input->post('name')." Thank you for registration. Please go to the link and confirm you account! ".base_url()."login/confirm_account/".$randcode;
				$this->email->message($bodys);
		        $this->email->send();
	            redirect('login');
	        }else{
	        	$this->session->set_flashdata('error', 'Something went wrong please try again or contact support!');
	        	redirect('welcome');
	        }  
	            
        }
	}
	function confirm_account($code=null){
		if ($code!=" "){
			$codes=$this->db->get_where('users' , array('randcode' => $code))->row()->randcode;
			if ($codes!=" "){
				$alldata=array(
					'randcode'=>1,
					'userstatus'=>1
				);
				$sql=$this->crud_model->updates("users","randcode",$codes,$alldata);
				$this->session->set_flashdata('success', 'Thank you Successfully activating your account!');
	            $this->load->view('header');
				$this->load->view('login');
				$this->load->view('footer');
			}else{
				$this->session->set_flashdata('error', 'Email already confirmed!');
				$this->load->view('header');
				$this->load->view('login');
				$this->load->view('footer');
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong please try again or contact support!');
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');
		}
	}
	function forgetSubmit(){
		$this->load->library('email');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', 'Your email is not valied!');
            redirect('login/forget');
        }else{
        	$user_email=$this->input->post('email');
        	$numrow=$this->db->get_where('users' , array('email' => $user_email))->row()->email;
			if($numrow!=" "){
				$code = rand();
				$sql="UPDATE users SET randcode='$code' WHERE email='$user_email'";
				$this->db->query($sql);
				$from_email = "no_reply@loop-tech.net"; 
		        $to_email = $numrow; 
		   
		         //Load email library 
		   
		        $this->email->from($from_email, 'loop-tech.net'); 
		        $this->email->to($to_email);
		        $this->email->subject('password Reset'); 
		        $this->email->message(' This is an automated email. please DO NOT reply to this. Click the link below or paste it into your browser : '.base_url().'login/reset_pass/'.$code); 
		   
		         //Send mail 
		        $config = Array(
				    'protocol' => 'smtp',
				    'smtp_host' => 'sg3plcpnl0048.prod.sin3.secureserver.net',
				    'smtp_port' => 465,
				    'smtp_user' => 'no_reply@loop-tech.net',
				    'smtp_pass' => 'Illeas1448@',
				    'mailtype'  => 'html', 
				    'charset'   => 'iso-8859-1'
				);
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
		        if($this->email->send()){
		        	$this->session->set_flashdata("success","Check Your Email!"); 
		        }else{
		         	$this->session->set_flashdata("error","Error in sending Email."); 
		         	$this->load->view('email_form');
		        }
				redirect('login/forget');
			}
			else{
				$this->session->set_flashdata('error', 'Email address does not exist!!');
				redirect('login/forget');
			}
		}
	}
	function reset_pass($code=null){
		if ($this->session->userdata('user') == 1)
            redirect(base_url(), 'refresh');
        $data['code']=$this->uri->segment(3);
		$this->load->view('header');
		$this->load->view('reset_pass',$data);
		$this->load->view('footer');
	}
	function reset_passsubmit(){
		$this->form_validation->set_rules('code', 'code', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', 'Your entered value some missing!');
            redirect('login/reset_pass');
        }else{
			$password1=md5($this->input->post('password'));
			$get_code=$this->input->post('code');
			$count=$this->db->get_where('users' , array('randcode' => $get_code))->row()->randcode;
			if($count!=" "){
				$alldata=array(
					'randcode'=>1,
					'password'=>$password1
				);
				$sql=$this->crud_model->updates("users","randcode",$get_code,$alldata);
				if($sql){
					$this->session->set_flashdata('success', 'Your Password reset Successfully!!');
					redirect('login/reset_pass');
				}else{
					$this->session->set_flashdata('error', 'Something went wrong please try again!!');
					redirect('login/reset_pass/'.$get_code);
				}
			}else{
				$this->session->set_flashdata('error', 'You code had been expired please contact support!!');
				redirect('login/reset_pass/'.$get_code);
			}
		}
	}
	function logout(){
		$this->session->sess_destroy();
		setcookie("user", 1,  time() - 3600, "/"); 
		setcookie("uid", $username,  time() - 3600, "/"); 
		setcookie("userid", $dbrow->id,  time() - 3600, "/"); 
		setcookie("mobile_phone", $dbrow->mobile_phone,  time() - 3600, "/");
		redirect('welcome');
	}
}



