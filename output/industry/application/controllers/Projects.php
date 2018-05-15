<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->library( 'template' ); 
		$this->load->model( 'model_projects' ); 
		$this->load->model('model_industry');
		$this->load->helper( 'form' );
		$this->load->helper( 'language' ); 
		$this->load->helper( 'url' );
        $this->load->model( 'model_auth' );

        $this->logged_in = $this->model_auth->check( TRUE );
        $this->template->assign( 'logged_in', $this->logged_in );

		$this->lang->load( 'db_fields', 'english' ); // This is the language file
	}



    /**
     *  LISTS MODEL DATA INTO A TABLE
     */         
    function index( $page = 0 )
    {
        $this->model_projects->pagination( TRUE );
		$data_info = $this->model_projects->lister( $page );
        $fields = $this->model_projects->fields( TRUE );
		//项目性质
		foreach($data_info as &$item){
			$item['xmxz'] = Model_projects::XMXZ_ARR2[intval($item['xmxz'])];
		}
		//建设地点映射
		$this->load->model('model_province');
		$provinces = $this->model_province->getall2name();
		$this->load->model('model_city');
		$cities = $this->model_city->getall2name();
		foreach($data_info as &$item){
			$jsdd1 = intval($item['jsdd1']);
			$jsdd2 = intval($item['jsdd2']);
			if(isset($provinces[$jsdd1])){
				$item['jsdd1'] = $provinces[$jsdd1];
			}
			if(isset($cities[$jsdd2])){
				$item['jsdd2'] = $cities[$jsdd2];
			}
		}
        

        $this->template->assign( 'pager', $this->model_projects->pager );
		$this->template->assign( 'projects_fields', $fields );
		$this->template->assign( 'projects_data', $data_info );
        $this->template->assign( 'table_name', 'Projects' );
        $this->template->assign( 'template', 'list_projects' );
        
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_projects->get( $id );
        $fields = $this->model_projects->fields( TRUE );
        //项目性质
		$data['xmxz'] = Model_projects::XMXZ_ARR2[intval($data['xmxz'])];
		//建设地点映射
		$this->load->model('model_province');
		$this->load->model('model_city');
		$jsdd1 = intval($data['jsdd1']);
		$jsdd2 = intval($data['jsdd2']);
		$prov = $this->model_province->get($jsdd1);
		$city = $this->model_city->get($jsdd2);
		$data['jsdd1'] = isset($prov['name']) ? $prov['name'] : '全国';
		$data['jsdd2'] = isset($city['name']) ? $city['name'] : '全国';
        
        $this->template->assign( 'id', $id );
		$this->template->assign( 'projects_fields', $fields );
		$this->template->assign( 'projects_data', $data );
		$this->template->assign( 'table_name', 'Projects' );
		$this->template->assign( 'template', 'show_projects' );
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A FROM, AND HANDLES SAVING IT
     */         
    function create( $id = false )
    {
		$this->load->library('form_validation');
        
		switch ( $_SERVER ['REQUEST_METHOD'] )
        {
            case 'GET':
                $fields = $this->model_projects->fields();
				//项目性质
				$this->template->assign('xmxz_options', Model_projects::XMXZ_ARR2);

				//所属行业
				$sshy_options = array(0=>'其他');
				$sshy_options = array_merge($sshy_options, $this->model_industry->getall2name());
				$this->template->assign('sshy_options', $sshy_options);
				//建设地点
				$this->load->model('model_province');
				$jsdd1_options = $this->model_province->getall2name();
				$this->template->assign('jsdd1_options', $jsdd1_options);
				$this->load->model('model_city');
				$jsdd2_options = $this->model_city->getall2name();
				$this->template->assign('jsdd2_options', $jsdd2_options);
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'projects_fields', $fields );
                $this->template->assign( 'metadata', $this->model_projects->metadata() );
        		$this->template->assign( 'table_name', 'Projects' );
        		$this->template->assign( 'template', 'form_projects' );
        		$this->template->display( 'frame_admin.tpl' );
            break;

            /**
             *  Insert data TO projects table
             */
            case 'POST':
                $fields = $this->model_projects->fields();

                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[200]' );
				$this->form_validation->set_rules( 'sshy1', lang('sshy1'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'sshy2', lang('sshy2'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'jsdw', lang('jsdw'), 'required|max_length[200]' );
				$this->form_validation->set_rules( 'jsdd1', lang('jsdd1'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'jsdd2', lang('jsdd2'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'tzztxz', lang('tzztxz'), 'required|max_length[45]' );
				$this->form_validation->set_rules( 'tze', lang('tze'), 'required|numeric' );
				$this->form_validation->set_rules( 'jsnr', lang('jsnr'), 'required' );
				$this->form_validation->set_rules( 'jjzb', lang('jjzb'), 'required' );
				$this->form_validation->set_rules( 'jssj1', lang('jssj1'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'jssj2', lang('jssj2'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'tags', lang('tags'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'xmxz', lang('xmxz'), 'required|max_length[1]|integer' );
				$this->form_validation->set_rules( 'ssyq', lang('ssyq'), 'required|max_length[11]|integer' );

				$data_post['name'] = $this->input->post( 'name' );
				$data_post['sshy1'] = $this->input->post( 'sshy1' );
				$data_post['sshy2'] = $this->input->post( 'sshy2' );
				$data_post['jsdw'] = $this->input->post( 'jsdw' );
				$data_post['jsdd1'] = $this->input->post( 'jsdd1' );
				$data_post['jsdd2'] = $this->input->post( 'jsdd2' );
				$data_post['tzztxz'] = $this->input->post( 'tzztxz' );
				$data_post['tze'] = $this->input->post( 'tze' );
				$data_post['jsnr'] = $this->input->post( 'jsnr' );
				$data_post['jjzb'] = $this->input->post( 'jjzb' );
				$data_post['jssj1'] = $this->input->post( 'jssj1' );
				$data_post['jssj2'] = $this->input->post( 'jssj2' );
				$data_post['tags'] = $this->input->post( 'tags' );
				$data_post['xmxz'] = $this->input->post( 'xmxz' );
				$data_post['ssyq'] = $this->input->post( 'ssyq' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'projects_data', $data_post );
            		$this->template->assign( 'projects_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_projects->metadata() );
            		$this->template->assign( 'table_name', 'Projects' );
            		$this->template->assign( 'template', 'form_projects' );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_projects->insert( $data_post );
                    
					redirect( 'projects' );
                }
            break;
        }
    }



    /**
     *  DISPLAYS THE POPULATED FORM OF THE RECORD
     *  This method uses the same template as the create method
     */
    function edit( $id = false )
    {
        $this->load->library('form_validation');

        switch ( $_SERVER ['REQUEST_METHOD'] )
        {
            case 'GET':
                $this->model_projects->raw_data = TRUE;
        		$data = $this->model_projects->get( $id );
                $fields = $this->model_projects->fields();
                //项目性质
				$this->template->assign('xmxz_options', Model_projects::XMXZ_ARR2);
				//所属行业
				$sshy_options = array(0=>'其他');
				$sshy_options = array_merge($sshy_options, $this->model_industry->getall2name());
				$this->template->assign('sshy_options', $sshy_options);
				//建设地点
				$this->load->model('model_province');
				$jsdd1_options = $this->model_province->getall2name();
				$this->template->assign('jsdd1_options', $jsdd1_options);
				$this->load->model('model_city');
				$jsdd2_options = $this->model_city->getall2name();
				$this->template->assign('jsdd2_options', $jsdd2_options);

                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'projects_data', $data );
        		$this->template->assign( 'projects_fields', $fields );
                $this->template->assign( 'metadata', $this->model_projects->metadata() );
        		$this->template->assign( 'table_name', 'Projects' );
        		$this->template->assign( 'template', 'form_projects' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_projects->fields();
                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[200]' );
				$this->form_validation->set_rules( 'sshy1', lang('sshy1'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'sshy2', lang('sshy2'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'jsdw', lang('jsdw'), 'required|max_length[200]' );
				$this->form_validation->set_rules( 'jsdd1', lang('jsdd1'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'jsdd2', lang('jsdd2'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'tzztxz', lang('tzztxz'), 'required|max_length[45]' );
				$this->form_validation->set_rules( 'tze', lang('tze'), 'required|numeric' );
				$this->form_validation->set_rules( 'jsnr', lang('jsnr'), 'required' );
				$this->form_validation->set_rules( 'jjzb', lang('jjzb'), 'required' );
				$this->form_validation->set_rules( 'jssj1', lang('jssj1'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'jssj2', lang('jssj2'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'tags', lang('tags'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'xmxz', lang('xmxz'), 'required|max_length[1]|integer' );
				$this->form_validation->set_rules( 'ssyq', lang('ssyq'), 'required|max_length[11]|integer' );

				$data_post['name'] = $this->input->post( 'name' );
				$data_post['sshy1'] = $this->input->post( 'sshy1' );
				$data_post['sshy2'] = $this->input->post( 'sshy2' );
				$data_post['jsdw'] = $this->input->post( 'jsdw' );
				$data_post['jsdd1'] = $this->input->post( 'jsdd1' );
				$data_post['jsdd2'] = $this->input->post( 'jsdd2' );
				$data_post['tzztxz'] = $this->input->post( 'tzztxz' );
				$data_post['tze'] = $this->input->post( 'tze' );
				$data_post['jsnr'] = $this->input->post( 'jsnr' );
				$data_post['jjzb'] = $this->input->post( 'jjzb' );
				$data_post['jssj1'] = $this->input->post( 'jssj1' );
				$data_post['jssj2'] = $this->input->post( 'jssj2' );
				$data_post['tags'] = $this->input->post( 'tags' );
				$data_post['xmxz'] = $this->input->post( 'xmxz' );
				$data_post['ssyq'] = $this->input->post( 'ssyq' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'projects_data', $data_post );
            		$this->template->assign( 'projects_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_projects->metadata() );
            		$this->template->assign( 'table_name', 'Projects' );
            		$this->template->assign( 'template', 'form_projects' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_projects->update( $id, $data_post );
				    
					redirect( 'projects/show/' . $id );   
                }
            break;
        }
    }



    /**
     *  DELETE RECORD(S)
     *  The 'delete' method of the model accepts int and array  
     */
    function delete( $id = FALSE )
    {
        switch ( $_SERVER ['REQUEST_METHOD'] )
        {
            case 'GET':
                $this->model_projects->delete( $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_projects->delete( $this->input->post('delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
}
