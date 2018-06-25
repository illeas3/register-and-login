<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends CI_Controller {
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
	}
	public function getuser(){
		$id=$this->input->post('id');
		$users= $this->db->get_where('users' , array('id' => $id))->row(); 
		if($users->online==1){
			$status="Online";
		}else{
			$status="Offline";
		}
		echo '<div class="left-align"><b>User status : '.$status.'</b></br>
			<tr>
	        	<td><b>First name :</b></td>
	        	<td>'.$users->first_name.'</td>
	    	</tr></br>
	    	<tr>
	        	<td><b>Last name :</b></td>
	        	<td>'.$users->last_name.'</td>
	    	</tr></br>
	    	<tr>
	        	<td><b>Email :</b></td>
	        	<td>'.$users->email.'</td>
	    	</tr></br>
	    	<tr>
	        	<td><b>Contact :</b></td>
	        	<td>'.$users->contact.'</td>
	    	</tr></br>
	    	<tr>
	        	<td><b>Join date :</b></td>
	        	<td>'.strtotime($users->joindate).'</td>
	    	</tr></br>
	    	<tr>
	        	<td><b>User IP :</b></td>
	        	<td>'.$users->user_ip.'</td>
	    	</tr></br>
	    	<tr>
	        	<td><b>Address :</b></td>
	        	<td>'.$users->address.'</td>
	    	</tr></div>';
	}
	public function getlanguage(){
		$val=$this->input->post('val');
		$userid=$this->session->userdata('userid');
		if($userid!=" "){
			$data=array(
				'language'=>$val
			);
			$this->crud_model->updates("users","id",$userid,$data);
		}else{
			$this->session->set_userdata('language',$val);
		}
	}
}



