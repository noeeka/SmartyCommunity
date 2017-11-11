<?php

class Setting extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function systemSetting()
    {
        if (!$_POST) {
            $result = $this->db->get("setting")->row();
            if ($result) {
                echo json_encode(array("state" => 1, "ret" => $result));
            }
        } else {
            $project_name = $this->input->post('project_name');
            $address = $this->input->post('address');
            $tel = $this->input->post('tel');

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if (empty($username) || empty($password)) {
                $data = array(
                    'project_name' => $project_name,
                    'address' => $address,
                    'tel' => $tel
                );
            } else {
                $data = array(
                    'project_name' => $project_name,
                    'address' => $address,
                    'tel' => $tel,
                    'username' => $username,
                    'password' => $password,
                );
            }


            $this->db->update('setting', $data);
            echo json_encode(array("state" => 1, "ret" => "success"));

        }
    }
}