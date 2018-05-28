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

}