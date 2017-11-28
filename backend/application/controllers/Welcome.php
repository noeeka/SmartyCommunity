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

	public function test(){


$options = array(
    'trace' => true,
    'exceptions' => 0,
    'login' => 'noeeka',
    'password' => 'a8f19c202f9a40f0625e6ba81126fac5ea690e81',
);
$client = new SoapClient('https://flightxml.flightaware.com/soap/FlightXML3/wsdl', $options);

// get the weather.
$params = array("airport_code" => "TSN");
$result = $client->AirportBoards($params);
print_r($result);
die;
foreach ($result->AirportBoardsResults->conditions as $key => $condition) {
    print_r($condition);
    if (php_sapi_name() != 'cli') {
        echo "<br/>";
    }
    echo "\n";
}

    }
}
