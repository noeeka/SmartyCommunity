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

    public function getExcelContens(){
        $this->load->library('UploadHandler');
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
        $options=array('upload_dir'=>'/temp');
        $upload_handler = new UploadHandler($options);
        $reponse=$upload_handler->response;
        //print_r($reponse['files'][0]->name);
        //print_r($_SERVER['DOCUMENT_ROOT']);
        $objPHPExcel = new IOFactory();
        //$objPHPExcel->getProperties();
        $filePath = $_SERVER['DOCUMENT_ROOT'].'/backend/temp/'.$reponse['files'][0]->name;
        $readerType = $objPHPExcel::identify($filePath);
        $objReader = $objPHPExcel::createReader($readerType);
        // 读文件
        $objPHPExcel = $objReader->load($filePath);


        $reader = new PHPExcel_Reader_Excel5();
        $excel = $reader->load($filePath); //excel的路径
        $data=$excel->getActiveSheet()->toArray();

        $objWorksheet = $objPHPExcel->getActiveSheet(0);
        print_r($objWorksheet);
        die;
        // 总行数
        $highestRow = $objWorksheet->getHighestRow();
        // 总列数
        $highestColumn = $objWorksheet->getHighestColumn();

        $highestColumnIndex = range('A', $highestColumn);
        $data = array();
        // 从第二行开始，第一行一般是表头
        for ($row = 0; $row <= $highestRow; $row++) {
            $array = array();
            foreach ($highestColumnIndex as $value) {
                //print_r($value);
                $address = $value . $row;
                echo $address."<br>";
                $array[] = $objWorksheet->getCell($address)->getFormattedValue();
            }
            array_push($data, $array);
        }
        //return $data;
        print_r($data);

    }

}