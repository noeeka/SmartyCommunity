<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2017/11/17
 * Time: 14:21
 */

class File extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getExcelContents()
    {
        set_time_limit(0);
        header("Content-type: text/html; charset=utf-8");
        $this->load->library('UploadHandler');
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
        $options = array('upload_dir' => '/temp');
        $upload_handler = new UploadHandler($options);
        $reponse = $upload_handler->response;
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/backend/temp/' . $reponse['files'][0]->name;


        $reader = new PHPExcel_Reader_Excel5();
        $excel = $reader->load($filePath); //excel的路径
        $data = $excel->getActiveSheet()->toArray();

        $res = array();
        $result = array();
        $res_ori = array();
        if (empty($data[2][3])) {
            unlink($filePath);
            json_encode(array("state" => 0, "ret" => "file_format_error"));
            die;
        }
        //去掉数组前两个（根据大高欣的格式再订）
        for ($i = 2; $i < count($data); $i++) {
            if (strstr($data[$i][3], "主机")) {
                array_push($res, $data[$i]);
            }
        }
        foreach ($res as $key => $value) {
            $result[$key]['building'] = $value[0];
            $result[$key]['unit'] = $value[1];
            $result[$key]['room'] = $value[2];
        }
        if (!empty($result)) {
            unlink($filePath);
        } else {
            json_encode(array("state" => 0, "ret" => "retry"));
            die;
        }


        //获取原有数据库数据
        $result_ori = $this->db->get('room')->result();
        foreach ($result_ori as $k => $v) {
            $building_info = $this->db->get_where('building', array("id" => $v->building))->row();
            $unit_info = $this->db->get_where('unity', array("id" => $v->unit))->row();
            $res_ori[$k]['building'] = $building_info->building;
            $res_ori[$k]['unit'] = $unit_info->unit;
            $res_ori[$k]['room'] = $v->room;
        }


        echo json_encode(array("state" => 1, "ret" => array("new_data" => $result, "old_data" => $res_ori)));
        die;

    }

}