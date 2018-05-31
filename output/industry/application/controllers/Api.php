<?php

/**
 * Author: wangfeng211731
 * Date: 2018/5/28
 * Time: 14:58
 */
class Api extends CI_Controller{

    public function mComplete(){
        $this->load->model('model_park');
        $name = $_GET['name'];
        $data = $this->model_park->getByName($name);
        echo json_encode($data);
    }

    public function getCities(){
        $prov_id = intval($this->input->get('prov_id'));
        if($prov_id == 0){
            echo json_encode(array('全国'=>0));
            exit;
        }
        $this->load->model('model_city');
        $cities = $this->model_city->getCities($prov_id);
        $map = array();
        foreach($cities as $city){
            $map[$city['name']] = $city['id'];
        }
        echo json_encode($map);
    }

}