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

    public function restore()
    {
        $basic_data = $this->input->post("basic_data");
        if (!empty($basic_data)) {
            $this->db->truncate('building');
            $this->db->truncate('unity');
            $this->db->truncate('room');



            $res_building = array();
            $res_unit=array();
            foreach($basic_data as $key=>$value){
                $res_building[$value['building']][] = $value;
            }

            foreach($res_building as $key=>$value){
                $res_unit=array();
                if(count($value)>1){
                    foreach($value as $k=>$v){
                        $res_unit[$v['unit']][] = $v;
                    }
                }else{
                    $res_unit[$value[0]['unit']][] = $value[0];
                }
                $result[$key]=$res_unit;
            }
            
            foreach ($result as $building_key=>$building_value){
                $data = array(
                    'building' => $building_key
                );
                $this->db->insert('building', $data);
                $building_id=$this->db->insert_id();
                foreach($building_value as $unit_key=>$unit_value){
                    $data_unit = array(
                        'building' => $building_id,
                        'unit'=>$unit_key
                    );
                    $this->db->insert('unity', $data_unit);
                    $unit_id=$this->db->insert_id();

                    foreach($unit_value as $room_key=>$room_value){
                        $data_room = array(
                            'building' => $building_id,
                            'unit'=>$unit_id,
                            'room'=>$room_value['room']
                        );
                        $this->db->insert('room', $data_room);
                    }
                }
            }

        }
        echo json_encode(array("state"=>1,"ret"=>"success"));
        die;
    }

    public function testing(){
        $data='[{"building":"001","unit":"01","room":"0101"},{"building":"001","unit":"01","room":"0102"},{"building":"001","unit":"01","room":"0103"},{"building":"001","unit":"02","room":"0104"},{"building":"001","unit":"04","room":"0105"},{"building":"001","unit":"06","room":"0106"},{"building":"001","unit":"01","room":"0201"},{"building":"001","unit":"01","room":"0202"},{"building":"001","unit":"01","room":"0203"},{"building":"001","unit":"01","room":"0204"},{"building":"001","unit":"01","room":"0205"},{"building":"001","unit":"01","room":"0206"},{"building":"001","unit":"01","room":"0301"},{"building":"001","unit":"01","room":"0302"},{"building":"001","unit":"01","room":"0303"},{"building":"001","unit":"01","room":"0304"},{"building":"001","unit":"01","room":"0305"},{"building":"001","unit":"01","room":"0306"},{"building":"001","unit":"01","room":"0401"},{"building":"001","unit":"01","room":"0402"},{"building":"001","unit":"01","room":"0403"},{"building":"001","unit":"01","room":"0404"},{"building":"001","unit":"01","room":"0405"},{"building":"001","unit":"01","room":"0406"},{"building":"001","unit":"01","room":"0501"},{"building":"001","unit":"01","room":"0502"},{"building":"001","unit":"01","room":"0503"},{"building":"001","unit":"01","room":"0504"},{"building":"001","unit":"01","room":"0505"},{"building":"001","unit":"01","room":"0506"},{"building":"001","unit":"01","room":"0601"},{"building":"001","unit":"01","room":"0602"},{"building":"001","unit":"01","room":"0603"},{"building":"001","unit":"01","room":"0604"},{"building":"001","unit":"01","room":"0605"},{"building":"001","unit":"01","room":"0606"},{"building":"002","unit":"01","room":"0606"},{"building":"003","unit":"01","room":"0606"},{"building":"004","unit":"01","room":"0606"}]';
        $res=json_decode($data,true);
        $res_building = array();
        $res_unit=array();
        foreach($res as $key=>$value){
            $res_building[$value['building']][] = $value;
        }

        foreach($res_building as $key=>$value){
            if(count($value)>1){
                foreach($value as $k=>$v){
                    $res_unit[$v['unit']][] = $v;
                }
            }
            $result[$key]=$res_unit;
        }

    }
}