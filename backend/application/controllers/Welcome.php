<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function login(){
	    if(empty($_POST['lang'])){
            $_COOKIE['lang']="chinese";
        }else{
            $_COOKIE['lang']=$this->input->post("lang");
        }

        $this->lang->load('form_validation',$_COOKIE['lang']);
        $username=$this->input->post('username');
        $password=$this->input->post('password');

        $this->db->select('username,password');
        $this->db->from('setting');
        $result = $this->db->get()->row();
        if($result->username!=$username){
            echo json_encode(array("state" => 0, "ret" =>$this->lang->line('login_validation_username')));
            die;
        }
        if($result->password!=$password){
            echo json_encode(array("state" => 0, "ret" =>$this->lang->line('login_validation_password')));
            die;
        }

        if($result->username==$username && $result->password==$password){
            echo json_encode(array("state" => 1, "ret" =>"success"));
            die;
        }
	}
}
