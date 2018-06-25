<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->userTbl = 'users';
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_all_table_value($table=null){
        $query = $this->db->get($table);
        return $query->result_array();
    }
    function cat_get_products_home($plan_type=null,$plan_type2=null){
        $this->db->select('*')->from('payment')->join('products','payment.product_id=products.product_id')->WHERE('payment.plan_type="$plan_type" OR payment.plan_type="$plan_type2" AND products.status=1')->order_by('payment.product_id','desc');
        $result = $this->db->get();
        return $result->result_array();
    }
    function get_products_comment($colmun=null){
        $this->db->select('*')->from('comments')->join('users','comments.uid=users.id')->WHERE('comments.product_id="$colmun"')->order_by('comments.cid','desc');
        $result = $this->db->get();
        return $result->result_array();
    }
    function get_limit_where_desc($limit=null,$start=null){
        $this->db->select('*')->from("products")->WHERE("status",1)->order_by("product_id","desc")->limit($start,$limit);
        $result = $this->db->get();
        return $result->result_array();
    }
    function watch_products(){

    }


    public function insert($data = array()) {
        //add created and modified data if not included
        if(!array_key_exists("created", $data)){
            $data['last_login'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['last_login'] = date("Y-m-d H:i:s");
        }
        
        //insert user data to users table
        $insert = $this->db->insert($this->userTbl, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }
    public function allinsert($table=null,$data = array()) {
        
        //insert user data to users table
        $insert = $this->db->insert($table, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }


    function updateincrement($product_id){
        $current_date = date('Y-m-d G:i:s'); 
        $this->db->set(array('counter' => 'counter+1','watch_date' => $current_date));
        $this->db->where('product_id', $product_id);
        $result=$this->db->update('products');
        if($result){
            return true;
        }else{
            return false;
        }

    }
    function addcounter($product_id){
        $current_date = date('Y-m-d G:i:s'); 
        $this->db->set(array('counter' => 'counter+1','watch_date' => $current_date));
        $this->db->where('product_id', $product_id);
        $result=$this->db->update('products');
        if($result){
            return true;
        }else{
            return false;
        }

    }
    function seller_others_products($seller=null){
        $this->db->select('*')->from('products')->WHERE('user_id',$seller)->order_by('product_id','desc')->limit(0,20);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getAllByActive($table=null,$colmun=null,$colval=null){
        $this->db->select('*')->from($table)->WHERE($colmun,$colval);
        $result = $this->db->get();
        return $result->result_array();
    }
    function getByIdTF($table=null,$colmun=null,$condition=array()){
        $this->db->select($colmun)->from($table)->WHERE($condition);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getByCondition($table=null,$colmun=null,$condition=array()){
        $this->db->select($colmun)->from($table)->WHERE($condition);
        $result = $this->db->get();
        return $result->result_array();
    }

    function updateuseronline($status=null,$id=null){
        $this->db->set(array('online' => $status));
        $this->db->where('id', $id);
        $result=$this->db->update('users');
        if($result){
            return true;
        }else{
            return false;
        }

    }
    function getsellerfeedback($colmun=array()){
        $this->db->select('*')->from("product_feedback")->WHERE($colmun)->order_by("id","desc");
        $result = $this->db->get();
        return $result->result_array();
    }

    function productIDdesc($userid=null){
        $this->db->select('*')->from("products")->WHERE("user_id",$userid)->order_by("product_id","desc");
        $result = $this->db->get();
        return $result->result_array();
    }

    function getWhere($table=null,$where=array()){
        $this->db->select('*')->from($table)->WHERE($where);
        $result = $this->db->get();
        return $result->result_array();
    }

    function updates($table=null,$colmun=null,$colval=null,$data=array()){
        $this->db->where($colmun,$colval);
        $result=$this->db->update($table,$data);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function getAllBydesc($table=null,$descol=null){
        $this->db->select('*')->from($table)->order_by($descol,"desc");
        $result = $this->db->get();
        return $result->result_array();
    }
    function getWhereAllBydesc($table=null,$whereCol1=null,$whereCol2=null,$descol=null){
        $this->db->select('*')->from($table)->WHERE($whereCol1,$whereCol2)->order_by($descol,"desc");
        $result = $this->db->get();
        return $result->result_array();
    }

    function whereDelete($table=null,$where=null){
        $this->db->where($where, null, false);
        $result= $this->db->delete($table);
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
