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

    //获取单元列表服务
    function getUnits(){
        $this->lang->load('basic_info',get_cookie('lang'));
        $result = $this->db->get('unity')->result();
        foreach ($result as $k=>$v){
            $building_info = $this->db->get_where('building',array("id"=>$v->building))->row();
            $res[$k]['id']=$v->id;
            $res[$k]['unit']=$v->unit;
            $res[$k]['buildingId']=$building_info->id;
            $res[$k]['building']=$building_info->building;
        }
        echo json_encode(array("state" => 1, "ret" => $res,"confirm"=>$this->lang->line('building_remove_confirm')));

    }

    //编辑单元信息服务
    function editUnit(){
        $id = $this->input->post('id');
        $building = $this->input->post('building');
        $unit = $this->input->post('unit');

        $data = array(
            'id' => $id,
            'building' => $building,
            'unit' => $unit
        );
        $this->db->where('id', $id);
        $this->db->update('unity', $data);
        echo json_encode(array("state" => 1, "ret" => "success"));
    }

    //删除单元信息服务
    function removeUnit(){
        $id = $this->input->post('id');
        $this->db->delete('unity', array('id' => $id));
        echo json_encode(array("state" => 1, "ret" => "success"));
    }

    //根据楼栋获取单元服务
    function getUnitsByBuilding(){
        $building=$this->input->get("building");
        $this->lang->load('basic_info',get_cookie('lang'));
        $result = $this->db->get_where('unity',array("building"=>$building))->result();
        echo json_encode(array("state" => 1, "ret" => $result,"confirm"=>$this->lang->line('building_remove_confirm')));
    }

    //添加房间服务
    function addRoom(){
        $building = $this->input->post("building");
        $unit = $this->input->post("unit");
        $room = $this->input->post("room");
        $data = array(
            'building' => $building,
            'unit' => $unit,
            'room' => $room
        );
        $result = $this->db->insert('room', $data);
        if ($result) {
            echo json_encode(array("state" => 1, "ret" => 1));
        }
    }

    function getRooms(){

        $this->lang->load('basic_info',get_cookie('lang'));
        $rpp=$this->input->get('rpp');
        $page=$this->input->get('page');
        if(empty($rpp)){
            $rpp=20;
        }else{
            $rpp=$this->input->get('rpp');
        }
        if(empty($page)){
            $page=1;
        }else{
            $page=$this->input->get('page');
        }
        $this->db->limit($rpp,($page-1)*$rpp);
        $result = $this->db->get('room')->result();
        foreach ($result as $k=>$v){
            $building_info = $this->db->get_where('building',array("id"=>$v->building))->row();
            $unit_info = $this->db->get_where('unity',array("id"=>$v->unit))->row();
            $res[$k]['id']=$v->id;
            $res[$k]['unitId']=$v->unit;
            $res[$k]['buildingId']=$building_info->id;
            $res[$k]['building']=$building_info->building;
            $res[$k]['unit']=$unit_info->unit;
            $res[$k]['room']=$v->room;
        }
        echo json_encode(array("state" => 1, "ret" => $res,"confirm"=>$this->lang->line('building_remove_confirm'),"total"=>$this->db->count_all_results('room')));

    }

    //编辑房间服务
    function editRoom(){
        $id = $this->input->post('id');
        $building = $this->input->post('building');
        $unit = $this->input->post('unit');
        $room = $this->input->post('room');

        $data = array(
            'id' => $id,
            'building' => $building,
            'unit' => $unit,
            'room' => $room
        );
        $this->db->where('id', $id);
        $this->db->update('room', $data);
        echo json_encode(array("state" => 1, "ret" => "success"));
    }

    //删除房间服务
    function removeRoom(){
        $id = $this->input->post('id');
        $this->db->delete('room', array('id' => $id));
        echo json_encode(array("state" => 1, "ret" => "success"));
    }
}