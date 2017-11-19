<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function login(){

        $this->lang->load('form_validation',$this->input->post("lang"));
        $username=$this->input->post('username');
        $password=$this->input->post('password');

        $this->db->select('username,password');
        $this->db->from('setting');
        $result_super = $this->db->get()->row();


        $this->db->select('username,password');
        $this->db->from('administrator');
        $array = array('username' => $username, 'password' => $password);
        $this->db->where($array);
        $result_admin = $this->db->get()->row();
        if($result_super->username!=$username && $result_admin->username!=$username){
            echo json_encode(array("state" => 0, "ret" =>$this->lang->line('login_validation_username')));
            die;
        }
        if($result_super->password!=$password && $result_admin->password!=$password){
            echo json_encode(array("state" => 0, "ret" =>$this->lang->line('login_validation_password')));
            die;
        }

        if($result_super->username==$username && $result_super->password==$password){
            echo json_encode(array("state" => 1, "ret" =>"success","permit"=>"super"));
            die;
        }

        if($result_admin->username==$username && $result_admin->password==$password){
            echo json_encode(array("state" => 1, "ret" =>"success","permit"=>"admin"));
            die;
        }
	}
}
