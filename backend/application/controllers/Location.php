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

    //获取楼栋子列表
    public function getBuildings()
    {

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
        $this->lang->load('basic_info', get_cookie('lang'));
        $result = $this->db->get('building')->result();
        echo json_encode(array("state" => 1, "ret" => $result, "confirm" => $this->lang->line('building_remove_confirm'),"total" => $this->db->count_all_results('building')));
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
    function removeBuilding()
    {
        $id = $this->input->post('id');
        $this->db->delete('building', array('id' => $id));
        $this->db->delete('unity', array('building' => $id));
        $this->db->delete('room', array('building' => $id));
        $this->db->delete('outdoor', array('building' => $id));
        $this->db->delete('indoor', array('building' => $id));
        echo json_encode(array("state" => 1, "ret" => "success"));
    }

    //添加单元信息
    function addUnit()
    {
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
    function getUnits()
    {
        $filter = $this->input->get("building");
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
        $this->lang->load('basic_info', get_cookie('lang'));
        if (!empty($filter)) {
            $result = $this->db->get_where('unity', array("building" => $filter))->result();
            $this->db->where('building', $filter);
            $total=$this->db->count_all_results('unity');
        } else {
            $result = $this->db->get('unity')->result();
            $total=$this->db->count_all_results('unity');
        }
        foreach ($result as $k => $v) {
            $building_info = $this->db->get_where('building', array("id" => $v->building))->row();
            $res[$k]['id'] = $v->id;
            $res[$k]['unit'] = $v->unit;
            $res[$k]['buildingId'] = $building_info->id;
            $res[$k]['building'] = $building_info->building;
        }
        echo json_encode(array("state" => 1, "ret" => $res, "confirm" => $this->lang->line('building_remove_confirm'),"total"=>$total));

    }

    //编辑单元信息服务
    function editUnit()
    {
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
    function removeUnit()
    {
        $id = $this->input->post('id');
        $this->db->delete('unity', array('id' => $id));
        $this->db->delete('room', array('unit' => $id));
        $this->db->delete('outdoor', array('unit' => $id));
        $this->db->delete('indoor', array('unit' => $id));
        echo json_encode(array("state" => 1, "ret" => "success"));
    }

    //根据楼栋获取单元服务
    function getUnitsByBuilding()
    {
        $building = $this->input->get("building");
        $this->lang->load('basic_info', get_cookie('lang'));
        $result = $this->db->get_where('unity', array("building" => $building))->result();
        echo json_encode(array("state" => 1, "ret" => $result, "confirm" => $this->lang->line('building_remove_confirm')));
    }

    function getRoomsByUnitAndBuilding()
    {
        $building = $this->input->get("building");
        $unit = $this->input->get("unit");
        $result = $this->db->get_where('room', array("building" => $building,"unit" => $unit))->result();
        echo json_encode(array("state" => 1, "ret" => $result));
    }

    //添加房间服务
    function addRoom()
    {
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

    function getRooms()
    {

        $filter_unit = $this->input->get("unit");
        $filter_building = $this->input->get("building");
        $this->lang->load('basic_info', get_cookie('lang'));
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
        if (empty($filter_building) && empty($filter_unit)) {
            $result = $this->db->get('room')->result();
            $total=$this->db->count_all_results('room');
        } else {
            $result = $this->db->get_where('room', array("building" => $filter_building, "unit" => $filter_unit))->result();
            $this->db->where('building', $filter_building);
            $this->db->where('unit', $filter_unit);
            $total=$this->db->count_all_results('room');
        }

        foreach ($result as $k => $v) {
            $building_info = $this->db->get_where('building', array("id" => $v->building))->row();
            $unit_info = $this->db->get_where('unity', array("id" => $v->unit))->row();
            $res[$k]['id'] = $v->id;
            $res[$k]['unitId'] = $v->unit;
            $res[$k]['buildingId'] = $building_info->id;
            $res[$k]['building'] = $building_info->building;
            $res[$k]['unit'] = $unit_info->unit;
            $res[$k]['room'] = $v->room;
        }
        echo json_encode(array("state" => 1, "ret" => $res, "confirm" => $this->lang->line('building_remove_confirm'), "total" => $total));

    }

    //编辑房间服务
    function editRoom()
    {
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
    function removeRoom()
    {
        $id = $this->input->post('id');
        $this->db->delete('room', array('id' => $id));

        $this->db->delete('indoor', array('room' => $id));
        echo json_encode(array("state" => 1, "ret" => "success"));
    }
}