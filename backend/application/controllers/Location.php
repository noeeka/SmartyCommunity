<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2017/11/11
 * Time: 14:52
 */

class Location extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    //自动获取楼栋号
    public function getBuilding()
    {

        $this->db->select_max('building');
        $result = $this->db->get('building')->row();
        if(empty($result->building)){
            echo json_encode(array("state" => 1, "ret" =>1));
        }else{
            echo json_encode(array("state" => 1, "ret" =>($result->building+1)));
        }
    }

    //添加楼栋号
    public function addBuilding(){
        $building=$this->input->post("building");
        $data = array(
            'building' => $building
        );

        $result=$this->db->insert('building', $data);
        if($result){
            echo json_encode(array("state" => 1, "ret" =>1));
        }
    }

    //获取栋列表
}