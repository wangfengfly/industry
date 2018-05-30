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
     * 导入行业数据
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
                            $this->db->truncate($tablename);
                            exit('insert fail.please retry!');
                        }
                        $parentid = $this->db->insert_id();
                    }else if(count($strs) > 1 && strpos($line, '[')!==false){
                        $second_key = trim($strs[0], "[]");
                        $data = array('name'=>$second_key, 'parentid'=>$parentid);
                        $this->db->insert($tablename, $data);
                        if($this->db->affected_rows() != 1){
                            $this->db->truncate($tablename);
                            exit('insert fail.please retry!');
                        }
                        $secondid = $this->db->insert_id();
                        for($i=1; $i<count($strs); $i++){
                            $data = array('name'=>trim($strs[$i]), 'parentid'=>$secondid);
                            $this->db->insert($tablename, $data);
                            if($this->db->affected_rows() != 1){
                                $this->db->truncate($tablename);
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

    /**
     * @param $str
     * @param $length
     * @param bool|true $suffix
     * @param int $start
     * @param string $charset
     * @return string
     * 截取指定长度的中文字符串
     */
    private function cutStr($str, $length, $suffix=true, $start=0, $charset="utf-8") {
        $returnstr = '';
        $i = 0;
        $l = 0;
        while ($l<$length) {
            $sub = mb_substr($str, $i, 1, $charset);
            $i++;
            $returnstr .= $sub;
            if (strlen($sub)==1) {
                $l += (($sub == "\r") || ($sub == "\n"))?0:0.5;
            }
            else {
                $l++;
            }
        }
        if (mb_strlen($str, $charset) > mb_strlen($returnstr, $charset) && $suffix) {
            $returnstr .= ($suffix === true)?'...':$suffix;
        }
        return $returnstr;
    }

    /**
     * @param $name
     * 去掉地区里面的省或者市
     */
    private function rm($name){
        //去掉地区里面的省或者市
        if(strpos($name, '省') !== false){
            $name = $this->cutStr($name, strpos($name, '省')/3, false);
        }else if(strpos($name, '市') !== false){
            $name = $this->cutStr($name, strpos($name, '市')/3, false);
        }
        return $name;
    }

    /**
     * 导入地区数据
     */
    public function importArea(){
        $tbl_province = 'province';
        $tbl_city = 'city';
        $contents = file_get_contents($this->file);
        $contents = json_decode($contents, true);
        foreach($contents as $code=>$item){
            $name = $item['name'];
            $child = $item['child'];
            $province = $name;
            $data = array('name'=>$this->rm($province));
            $this->db->insert($tbl_province, $data);
            if($this->db->affected_rows() != 1){
                $this->db->truncate($tbl_province);
                exit('insert fail.please retry! sql:'.$this->db->last_query());
            }
            $pid = $this->db->insert_id();

            foreach($child as $_code=>$_item){
                $_name = $_item['name'];
                if($_name == '市辖区' || $_name=='县'){
                    $__child = $_item['child'];
                    foreach($__child as $__code=>$__item){
                        $city = $__item;
                        $data = array('name'=>$this->rm($city), 'pid'=>$pid);
                        $this->db->insert($tbl_city, $data);
                        if($this->db->affected_rows() != 1){
                            $this->db->truncate($tbl_city);
                            exit('insert fail.please retry! sql:'.$this->db->last_query());
                        }
                    }
                }else{
                    $city = $_name;
                    $data = array('name'=>$this->rm($city), 'pid'=>$pid);
                    $this->db->insert($tbl_city, $data);
                    if($this->db->affected_rows() != 1){
                        $this->db->truncate($tbl_city);
                        exit('insert fail.please retry! sql:'.$this->db->last_query());
                    }
                }
            }
        }
    }

    /**
     *
     */
    public function importProjects(){
        $tablename = 'projects';
        $contents = file_get_contents($this->file);
        if($contents){
            $this->load->model( 'model_projects' );
            $contents = explode("\n", $contents);
            foreach($contents as $line){
                $strs = explode("\t", $line);
                if(count($strs) == 16){
                    //标签中文分隔符改为英文
                    $tags = explode('，', $strs[13]);
                    $tags = implode(',', $tags);
                    $xmxz = trim($strs[14]);
                    $xmxz = isset(Model_projects::XMXZ_ARR[$xmxz]) ? Model_projects::XMXZ_ARR[$xmxz] : 0;
                    $data = array('name'=>$strs[1], 'jsdw'=>$strs[4], 'tzztxz'=>$strs[7],
                        'tze'=>$strs[8], 'jsnr'=>$strs[9], 'jjzb'=>$strs[10], 'jssj1'=>intval($strs[11]),
                        'jssj2'=>intval($strs[12]), 'tags'=>$tags, 'xmxz'=>$xmxz, 'ssyq'=>0);
                    $this->db->insert($tablename, $data);
                    if($this->db->affected_rows() != 1){
                        $this->db->truncate($tablename);
                        exit('insert fail.please retry! sql:'.$this->db->last_query());
                    }
                }

            }
            exit("Done!!");
        }
        echo "file content empty!";
    }

    public function importPark(){
        $tablename = 'park';
        $contents = file_get_contents($this->file);
        if($contents){
            $this->load->model('model_park');
            $contents = explode("\n", $contents);
            foreach($contents as $line){
                $attrs = explode(',', $line);
                if(count($attrs) == 6){
                    if(is_numeric($attrs[0])){
                        $create_time = str_replace('.', '', $attrs[3]);
                        $prime_inds = explode('、', $attrs[5]);
                        $tmp = array();
                        for($i=0; $i<4; $i++){
                            if(isset($prime_inds[$i])){
                                $j = $i+1;
                                $tmp['prime_ind'.$j] = $prime_inds[$i];
                            }
                        }
                        $data = array('identifier'=>$attrs[0], 'code'=>$attrs[1], 'name'=>$attrs[2],
                            'create_time'=>$create_time, 'area'=>$attrs[4]);
                        if($tmp){
                            $data = array_merge($data, $tmp);
                        }
                        $this->db->insert($tablename, $data);
                        if($this->db->affected_rows() != 1){
                            $this->db->truncate($tablename);
                            exit('insert fail.please retry! sql:'.$this->db->last_query());
                        }
                    }
                }
            }
            echo "import parks done.";
            return;
        }
        echo "file content is empty!";
    }
    /*
     * 根据parks.csv生成levels配置文件
     * 
     */
    public function genLevelsFromCsv(){
        $contents = file_get_contents($this->file);
        if($contents){
            $data = array();
            $lines = explode("\n", $contents);
            foreach($lines as $line){
                $arr = explode(',', $line);
                if(count($arr) >= 7){
                    if($arr[2]){
                        $data[$arr[2]] = '';
                    }
                }
            }
            $data = array_keys($data);

            $config = '<?php'.PHP_EOL.' $levels=array('.PHP_EOL;
            foreach($data as $i=>$name){
                $config .= "$i=>'$name',\n";
            }
            $config .= ');'.PHP_EOL.'?>';
            file_put_contents(__DIR__."/../config/levels.php", $config);
        }
    }

}