<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->library( 'template' ); 
		$this->load->model( 'model_city' ); 
		
		$this->load->helper( 'form' );
		$this->load->helper( 'language' ); 
		$this->load->helper( 'url' );
        $this->load->model( 'model_auth' );
        $this->load->model('model_province');

        $this->logged_in = $this->model_auth->check( TRUE );
        $this->template->assign( 'logged_in', $this->logged_in );

		$this->lang->load( 'db_fields', 'english' ); // This is the language file
	}



    /**
     *  LISTS MODEL DATA INTO A TABLE
     */         
    function index( $page = 0 )
    {
        $this->model_city->pagination( TRUE );
		$data_info = $this->model_city->lister( $page );
        $fields = $this->model_city->fields( TRUE );

        $provinces = $this->model_province->getall2name();
        foreach($data_info as &$item){
            $pid = $item['pid'];
            if(isset($provinces[$pid])){
                $item['pid'] = $provinces[$pid];
            }else{
                $item['pid'] = '全国';
            }
        }

        $this->template->assign( 'pager', $this->model_city->pager );
		$this->template->assign( 'city_fields', $fields );
		$this->template->assign( 'city_data', $data_info );
        $this->template->assign( 'table_name', 'City' );
        $this->template->assign( 'template', 'list_city' );
        
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_city->get( $id );
        $fields = $this->model_city->fields( TRUE );

        $province = $this->model_province->get($data['pid']);
        if($province && isset($province['name'])){
            $data['pid'] = $province['name'];
        }else{
            $data['pid'] = '全国';
        }
        
        $this->template->assign( 'id', $id );
		$this->template->assign( 'city_fields', $fields );
		$this->template->assign( 'city_data', $data );
		$this->template->assign( 'table_name', 'City' );
		$this->template->assign( 'template', 'show_city' );
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
                $fields = $this->model_city->fields();
                
                $provinces = $this->model_province->getall2name();

                $this->template->assign('provinces', $provinces);
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'city_fields', $fields );
                $this->template->assign( 'metadata', $this->model_city->metadata() );
        		$this->template->assign( 'table_name', 'City' );
        		$this->template->assign( 'template', 'form_city' );
        		$this->template->display( 'frame_admin.tpl' );
            break;

            /**
             *  Insert data TO city table
             */
            case 'POST':
                $fields = $this->model_city->fields();

                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[45]' );
				$this->form_validation->set_rules( 'pid', lang('pid'), 'required|max_length[11]|integer' );

				$data_post['name'] = $this->input->post( 'name' );
				$data_post['pid'] = $this->input->post( 'pid' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'city_data', $data_post );
            		$this->template->assign( 'city_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_city->metadata() );
            		$this->template->assign( 'table_name', 'City' );
            		$this->template->assign( 'template', 'form_city' );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_city->insert( $data_post );
                    
					redirect( 'city' );
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
                $this->model_city->raw_data = TRUE;
        		$data = $this->model_city->get( $id );
                $fields = $this->model_city->fields();

                $provinces = $this->model_province->getall2name();
                $this->template->assign('provinces', $provinces);
                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'city_data', $data );
        		$this->template->assign( 'city_fields', $fields );
                $this->template->assign( 'metadata', $this->model_city->metadata() );
        		$this->template->assign( 'table_name', 'City' );
        		$this->template->assign( 'template', 'form_city' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_city->fields();
                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[45]' );
				$this->form_validation->set_rules( 'pid', lang('pid'), 'required|max_length[11]|integer' );

				$data_post['name'] = $this->input->post( 'name' );
				$data_post['pid'] = $this->input->post( 'pid' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'city_data', $data_post );
            		$this->template->assign( 'city_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_city->metadata() );
            		$this->template->assign( 'table_name', 'City' );
            		$this->template->assign( 'template', 'form_city' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_city->update( $id, $data_post );
				    
					redirect( 'city/show/' . $id );   
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
                $this->model_city->delete( $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_city->delete( $this->input->post('delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
}
