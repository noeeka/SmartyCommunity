<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2017/11/16
 * Time: 13:14
 */

class Device extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    //添加门口机服务
    function addOutdoor(){
        $building = $this->input->post("building");
        $unit = $this->input->post("unit");
        $sip = $this->input->post("sip");
        $name = $this->input->post("name");
        $password = $this->input->post("password");
        $data = array(
            'building' => $building,
            'unit' => $unit,
            'sip' => $sip,
            'name' => $name,
            'password' => $password
        );
        $result = $this->db->insert('outdoor', $data);
        if ($result) {
            echo json_encode(array("state" => 1, "ret" => 1));
        }
    }

    //获取门口机列表服务
    function getOutdoors(){
        $filter_unit=$this->input->get("unit");
        $filter_building=$this->input->get("building");
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
        if(empty($filter_building) && empty($filter_unit)){
            $result = $this->db->get('outdoor')->result();
            $total=$this->db->count_all_results('outdoor');
        }else{
            $this->db->where('building', $filter_building);
            $this->db->where('unit', $filter_unit);
            $total=$this->db->count_all_results('outdoor');
            $result = $this->db->get_where('outdoor',array("building"=>$filter_building,"unit"=>$filter_unit))->result();
        }

        foreach ($result as $k=>$v){
            $building_info = $this->db->get_where('building',array("id"=>$v->building))->row();
            $unit_info = $this->db->get_where('unity',array("id"=>$v->unit))->row();
            $res[$k]['id']=$v->id;
            $res[$k]['unitId']=$v->unit;
            $res[$k]['buildingId']=$building_info->id;
            $res[$k]['building']=$building_info->building;
            $res[$k]['unit']=$unit_info->unit;
            $res[$k]['sip']=$v->sip;
            $res[$k]['name']=$v->name;
            $res[$k]['password']=$v->password;
        }
        echo json_encode(array("state" => 1, "ret" => $res,"confirm"=>$this->lang->line('building_remove_confirm'),"total"=>$total));

    }

    //编辑门口机服务
    function editOutdoor(){
        $id = $this->input->post('id');
        $building = $this->input->post('building');
        $unit = $this->input->post('unit');
        $sip = $this->input->post('sip');
        $name = $this->input->post('name');
        $password = $this->input->post('password');

        $data = array(
            'id' => $id,
            'building' => $building,
            'unit' => $unit,
            'sip' => $sip,
            'name' => $name,
            'password' => $password
        );
        $this->db->where('id', $id);
        $this->db->update('outdoor', $data);
        echo json_encode(array("state" => 1, "ret" => "success"));
    }

    //删除门口机服务
    function removeOutdoor(){
        $id = $this->input->post('id');
        $this->db->delete('outdoor', array('id' => $id));
        echo json_encode(array("state" => 1, "ret" => "success"));
    }

    //添加室内机
    function addIndoor(){
        $building = $this->input->post("building");
        $unit = $this->input->post("unit");
        $room = $this->input->post("room");
        $sip = $this->input->post("sip");
        $name = $this->input->post("name");
        $password = $this->input->post("password");
        $data = array(
            'building' => $building,
            'unit' => $unit,
            'room' => $room,
            'sip' => $sip,
            'name' => $name,
            'password' => $password
        );
        $result = $this->db->insert('indoor', $data);
        if ($result) {
            echo json_encode(array("state" => 1, "ret" => 1));
        }
    }

    //获取室内机列表服务
    function getIndoors(){
        $filter_room=$this->input->get("room");
        $filter_unit=$this->input->get("unit");
        $filter_building=$this->input->get("building");
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
        if(empty($filter_building) && empty($filter_unit) && empty($filter_room)){
            $result = $this->db->get('indoor')->result();
            $total=$this->db->count_all_results('indoor');
        }else{
            $this->db->where('room', $filter_room);
            $this->db->where('building', $filter_building);
            $this->db->where('unit', $filter_unit);
            $total=$this->db->count_all_results('indoor');
            $result = $this->db->get_where('indoor',array("building"=>$filter_building,"unit"=>$filter_unit,"room"=>$filter_room))->result();
        }

        foreach ($result as $k=>$v){
            $building_info = $this->db->get_where('building',array("id"=>$v->building))->row();
            $unit_info = $this->db->get_where('unity',array("id"=>$v->unit))->row();
            $room_info = $this->db->get_where('room',array("id"=>$v->room))->row();
            $res[$k]['id']=$v->id;
            $res[$k]['unitId']=$v->unit;
            $res[$k]['buildingId']=$building_info->id;
            $res[$k]['building']=$building_info->building;
            $res[$k]['unit']=$unit_info->unit;

            $res[$k]['room']=$room_info->room;
            $res[$k]['roomId']=$v->room;
            $res[$k]['sip']=$v->sip;
            $res[$k]['name']=$v->name;
            $res[$k]['password']=$v->password;
        }
        echo json_encode(array("state" => 1, "ret" => $res,"total"=>$total));
    }

    //编辑室内机服务
    function editIndoor(){
        $id = $this->input->post('id');
        $building = $this->input->post('building');
        $unit = $this->input->post('unit');
        $room = $this->input->post('room');
        $sip = $this->input->post('sip');
        $name = $this->input->post('name');
        $password = $this->input->post('password');

        $data = array(
            'id' => $id,
            'building' => $building,
            'unit' => $unit,
            'room' => $room,
            'sip' => $sip,
            'name' => $name,
            'password' => $password
        );
        $this->db->where('id', $id);
        $this->db->update('indoor', $data);
        echo json_encode(array("state" => 1, "ret" => "success"));
    }

    //删除室内机服务
    function removeIndoor(){
        $id = $this->input->post('id');
        $this->db->delete('indoor', array('id' => $id));
        echo json_encode(array("state" => 1, "ret" => "success"));
    }
}