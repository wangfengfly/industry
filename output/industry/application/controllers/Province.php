<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Province extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->library( 'template' ); 
		$this->load->model( 'model_province' ); 
		
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
        $this->model_province->pagination( TRUE );
		$data_info = $this->model_province->lister( $page );
        $fields = $this->model_province->fields( TRUE );
        

        $this->template->assign( 'pager', $this->model_province->pager );
		$this->template->assign( 'province_fields', $fields );
		$this->template->assign( 'province_data', $data_info );
        $this->template->assign( 'table_name', 'Province' );
        $this->template->assign( 'template', 'list_province' );
        
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_province->get( $id );
        $fields = $this->model_province->fields( TRUE );
        

        
        $this->template->assign( 'id', $id );
		$this->template->assign( 'province_fields', $fields );
		$this->template->assign( 'province_data', $data );
		$this->template->assign( 'table_name', 'Province' );
		$this->template->assign( 'template', 'show_province' );
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
                $fields = $this->model_province->fields();
                
                
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'province_fields', $fields );
                $this->template->assign( 'metadata', $this->model_province->metadata() );
        		$this->template->assign( 'table_name', 'Province' );
        		$this->template->assign( 'template', 'form_province' );
        		$this->template->display( 'frame_admin.tpl' );
            break;

            /**
             *  Insert data TO province table
             */
            case 'POST':
                $fields = $this->model_province->fields();

                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[45]' );

				$data_post['name'] = $this->input->post( 'name' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'province_data', $data_post );
            		$this->template->assign( 'province_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_province->metadata() );
            		$this->template->assign( 'table_name', 'Province' );
            		$this->template->assign( 'template', 'form_province' );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_province->insert( $data_post );
                    
					redirect( 'province' );
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
                $this->model_province->raw_data = TRUE;
        		$data = $this->model_province->get( $id );
                $fields = $this->model_province->fields();
                
                
                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'province_data', $data );
        		$this->template->assign( 'province_fields', $fields );
                $this->template->assign( 'metadata', $this->model_province->metadata() );
        		$this->template->assign( 'table_name', 'Province' );
        		$this->template->assign( 'template', 'form_province' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_province->fields();
                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[45]' );

				$data_post['name'] = $this->input->post( 'name' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'province_data', $data_post );
            		$this->template->assign( 'province_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_province->metadata() );
            		$this->template->assign( 'table_name', 'Province' );
            		$this->template->assign( 'template', 'form_province' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_province->update( $id, $data_post );
				    
					redirect( 'province/show/' . $id );   
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
                $this->model_province->delete( $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_province->delete( $this->input->post('delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
}
