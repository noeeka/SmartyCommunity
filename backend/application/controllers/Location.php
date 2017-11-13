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
        if (empty($result->building)) {
            echo json_encode(array("state" => 1, "ret" => 1));
        } else {
            echo json_encode(array("state" => 1, "ret" => ($result->building + 1)));
        }
    }

    //添加楼栋号
    public function addBuilding()
    {
        $building = $this->input->post("building");
        $data = array(
            'building' => $building
        );

        $result = $this->db->insert('building', $data);
        if ($result) {
            echo json_encode(array("state" => 1, "ret" => 1));
        }
    }

    //获取栋列表
    public function getBuildings()
    {
        $this->lang->load('basic_info',get_cookie('lang'));
        $result = $this->db->get('building')->result();
        echo json_encode(array("state" => 1, "ret" => $result,"confirm"=>$this->lang->line('building_remove_confirm')));
    }

    //编辑楼栋信息、
    public function editBuilding()
    {
        $id = $this->input->post('id');
        $building = $this->input->post('building');

        $data = array(
            'id' => $id,
            'building' => $building
        );
        $this->db->where('id', $id);
        $this->db->update('building', $data);
        echo json_encode(array("state" => 1, "ret" => "success"));
    }
    //删除楼栋单元信息
    function removeBuilding(){
        $id = $this->input->post('id');
        $this->db->delete('building', array('id' => $id));
        echo json_encode(array("state" => 1, "ret" => "success"));
    }
    //添加单元信息
    function addUnit(){
        $building = $this->input->post("building");
        $unit = $this->input->post("unit");
        $data = array(
            'building' => $building,
            'unit' => $unit
        );

        $result = $this->db->insert('unity', $data);
        if ($result) {
            echo json_encode(array("state" => 1, "ret" => 1));
        }
    }
}