<?php

/**
 * Author: wangfeng
 * Date: 2018/5/9
 * Time: 10:11
 * 用于导入外部数据源
 */
class Tools extends CI_Controller{
    private $file;

    public function __construct(){
        parent::__construct();
        global $argv;
        if(count($argv) < 4){
            exit('缺少必要的参数');
        }
        $this->file = $argv[3];
        if(!file_exists($this->file)){
            exit('要导入的文件不存在');
        }
        $this->load->database();
    }

    /**
     *
     */
    public function importHangye(){
        $tablename = 'industry';
        $contents = file_get_contents($this->file);
        $contents = explode("\n", $contents);
        if(count($contents) > 0){
            foreach($contents as $line){
                $line = trim($line);
                if($line){
                    $strs = explode(' ', $line);
                    //一级分类
                    if(count($strs) == 1 && strpos($line, '[')!==false){
                        $key = trim($strs[0], "[]");
                        $data = array('name'=>$key);
                        $this->db->insert($tablename, $data);
                        if($this->db->affected_rows() != 1){
                            exit('insert fail.please retry!');
                        }
                        $parentid = $this->db->insert_id();
                    }else if(count($strs) > 1 && strpos($line, '[')!==false){
                        $second_key = trim($strs[0], "[]");
                        $data = array('name'=>$second_key, 'parentid'=>$parentid);
                        $this->db->insert($tablename, $data);
                        if($this->db->affected_rows() != 1){
                            exit('insert fail.please retry!');
                        }
                        $secondid = $this->db->insert_id();
                        for($i=1; $i<count($strs); $i++){
                            $data = array('name'=>trim($strs[$i]), 'parentid'=>$secondid);
                            $this->db->insert($tablename, $data);
                            if($this->db->affected_rows() != 1){
                                exit('insert fail.please retry!');
                            }
                        }
                    }else if(count($strs) > 0){
                        for($i=0; $i<count($strs); $i++){
                            $data = array('name'=>trim($strs[$i]), 'parentid'=>$parentid);
                            $this->db->insert($tablename, $data);
                        }
                    }
                }
            }
        }
    }

}