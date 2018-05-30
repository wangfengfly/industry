<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Park extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->library( 'template' ); 
		$this->load->model( 'model_park' ); 
		
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
        $this->model_park->pagination( TRUE );
		$data_info = $this->model_park->lister( $page );
        $fields = $this->model_park->fields( TRUE );
        

        $this->template->assign( 'pager', $this->model_park->pager );
		$this->template->assign( 'park_fields', $fields );
		$this->template->assign( 'park_data', $data_info );
        $this->template->assign( 'table_name', 'Park' );
        $this->template->assign( 'template', 'list_park' );
        
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_park->get( $id );
        $fields = $this->model_park->fields( TRUE );
        

        
        $this->template->assign( 'id', $id );
		$this->template->assign( 'park_fields', $fields );
		$this->template->assign( 'park_data', $data );
		$this->template->assign( 'table_name', 'Park' );
		$this->template->assign( 'template', 'show_park' );
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
                $fields = $this->model_park->fields();
                
                
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'park_fields', $fields );
                $this->template->assign( 'metadata', $this->model_park->metadata() );
        		$this->template->assign( 'table_name', 'Park' );
        		$this->template->assign( 'template', 'form_park' );
        		$this->template->display( 'frame_admin.tpl' );
            break;

            /**
             *  Insert data TO park table
             */
            case 'POST':
                $fields = $this->model_park->fields();

                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'identifier', lang('identifier'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'code', lang('code'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[200]' );
				$this->form_validation->set_rules( 'create_time', lang('create_time'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'area', lang('area'), 'required' );
				$this->form_validation->set_rules( 'prime_ind1', lang('prime_ind1'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'prime_ind2', lang('prime_ind2'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'prime_ind3', lang('prime_ind3'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'prime_ind4', lang('prime_ind4'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'intro', lang('intro'), 'required' );
				$this->form_validation->set_rules( 'url', lang('url'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'phone', lang('phone'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'email', lang('email'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'wechat', lang('wechat'), 'required|max_length[50]' );
				$this->form_validation->set_rules( 'companies', lang('companies'), 'required|max_length[500]' );
				$this->form_validation->set_rules( 'level_id', lang('level_id'), 'required|max_length[2]|integer' );
				$this->form_validation->set_rules( 'prov_id', lang('prov_id'), 'required|max_length[2]|integer' );

				$data_post['identifier'] = $this->input->post( 'identifier' );
				$data_post['code'] = $this->input->post( 'code' );
				$data_post['name'] = $this->input->post( 'name' );
				$data_post['create_time'] = $this->input->post( 'create_time' );
				$data_post['area'] = $this->input->post( 'area' );
				$data_post['prime_ind1'] = $this->input->post( 'prime_ind1' );
				$data_post['prime_ind2'] = $this->input->post( 'prime_ind2' );
				$data_post['prime_ind3'] = $this->input->post( 'prime_ind3' );
				$data_post['prime_ind4'] = $this->input->post( 'prime_ind4' );
				$data_post['intro'] = $this->input->post( 'intro' );
				$data_post['url'] = $this->input->post( 'url' );
				$data_post['phone'] = $this->input->post( 'phone' );
				$data_post['email'] = $this->input->post( 'email' );
				$data_post['wechat'] = $this->input->post( 'wechat' );
				$data_post['companies'] = $this->input->post( 'companies' );
				$data_post['level_id'] = $this->input->post('level_id');
				$data_post['prov_id'] = $this->input->post('prov_id');

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'park_data', $data_post );
            		$this->template->assign( 'park_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_park->metadata() );
            		$this->template->assign( 'table_name', 'Park' );
            		$this->template->assign( 'template', 'form_park' );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_park->insert( $data_post );
                    
					redirect( 'park' );
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
                $this->model_park->raw_data = TRUE;
        		$data = $this->model_park->get( $id );
                $fields = $this->model_park->fields();
                
                
                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'park_data', $data );
        		$this->template->assign( 'park_fields', $fields );
                $this->template->assign( 'metadata', $this->model_park->metadata() );
        		$this->template->assign( 'table_name', 'Park' );
        		$this->template->assign( 'template', 'form_park' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_park->fields();
                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'identifier', lang('identifier'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'code', lang('code'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[200]' );
				$this->form_validation->set_rules( 'create_time', lang('create_time'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'area', lang('area'), 'required' );
				$this->form_validation->set_rules( 'prime_ind1', lang('prime_ind1'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'prime_ind2', lang('prime_ind2'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'prime_ind3', lang('prime_ind3'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'prime_ind4', lang('prime_ind4'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'intro', lang('intro'), 'required' );
				$this->form_validation->set_rules( 'url', lang('url'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'phone', lang('phone'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'email', lang('email'), 'required|max_length[20]' );
				$this->form_validation->set_rules( 'wechat', lang('wechat'), 'required|max_length[50]' );
				$this->form_validation->set_rules( 'companies', lang('companies'), 'required|max_length[500]' );
				$this->form_validation->set_rules( 'level_id', lang('level_id'), 'required|max_length[2]|integer' );
				$this->form_validation->set_rules( 'prov_id', lang('prov_id'), 'required|max_length[2]|integer' );


				$data_post['identifier'] = $this->input->post( 'identifier' );
				$data_post['code'] = $this->input->post( 'code' );
				$data_post['name'] = $this->input->post( 'name' );
				$data_post['create_time'] = $this->input->post( 'create_time' );
				$data_post['area'] = $this->input->post( 'area' );
				$data_post['prime_ind1'] = $this->input->post( 'prime_ind1' );
				$data_post['prime_ind2'] = $this->input->post( 'prime_ind2' );
				$data_post['prime_ind3'] = $this->input->post( 'prime_ind3' );
				$data_post['prime_ind4'] = $this->input->post( 'prime_ind4' );
				$data_post['intro'] = $this->input->post( 'intro' );
				$data_post['url'] = $this->input->post( 'url' );
				$data_post['phone'] = $this->input->post( 'phone' );
				$data_post['email'] = $this->input->post( 'email' );
				$data_post['wechat'] = $this->input->post( 'wechat' );
				$data_post['companies'] = $this->input->post( 'companies' );
				$data_post['level_id'] = $this->input->post('level_id');
				$data_post['prov_id'] = $this->input->post('prov_id');

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'park_data', $data_post );
            		$this->template->assign( 'park_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_park->metadata() );
            		$this->template->assign( 'table_name', 'Park' );
            		$this->template->assign( 'template', 'form_park' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_park->update( $id, $data_post );
				    
					redirect( 'park/show/' . $id );   
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
                $this->model_park->delete( $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_park->delete( $this->input->post('delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
}
