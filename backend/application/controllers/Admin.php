<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 2017/11/18
 * Time: 22:16
 */

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    //获取管理员列表服务
    function getAdmins(){
        $rpp = $this->input->get('rpp');
        $page = $this->input->get('page');
        if (empty($rpp)) {
            $rpp = 20;
        } else {
            $rpp = $this->input->get('rpp');
        }
        if (empty($page)) {
            $page = 1;
        } else {
            $page = $this->input->get('page');
        }
        $this->db->limit($rpp, ($page - 1) * $rpp);
        $result = $this->db->get('administrator')->result();
        echo json_encode(array("state" => 1, "ret" => $result,"total" => $this->db->count_all_results('administrator')));
    }


    public function editAdmin()
    {
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = array(
            'id' => $id,
            'username' => $username,
            'password' => $password,
        );
        $this->db->where('id', $id);
        $this->db->update('administrator', $data);
        echo json_encode(array("state" => 1, "ret" => "success"));
    }

    public function addAdmin()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $data = array(
            'username' => $username,
            'password' => $password,
        );

        $result = $this->db->insert('administrator', $data);
        if ($result) {
            echo json_encode(array("state" => 1, "ret" => 1));
        }
    }

    function removeAdmin()
    {
        $id = $this->input->post('id');
        $this->db->delete('administrator', array('id' => $id));
        echo json_encode(array("state" => 1, "ret" => "success"));
    }

}