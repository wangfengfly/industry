<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->library( 'template' ); 
		$this->load->model( 'model_area' ); 
		
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
        $this->model_area->pagination( TRUE );
		$data_info = $this->model_area->lister( $page );
        $fields = $this->model_area->fields( TRUE );
        

        $this->template->assign( 'pager', $this->model_area->pager );
		$this->template->assign( 'area_fields', $fields );
		$this->template->assign( 'area_data', $data_info );
        $this->template->assign( 'table_name', 'Area' );
        $this->template->assign( 'template', 'list_area' );
        
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_area->get( $id );
        $fields = $this->model_area->fields( TRUE );
        

        
        $this->template->assign( 'id', $id );
		$this->template->assign( 'area_fields', $fields );
		$this->template->assign( 'area_data', $data );
		$this->template->assign( 'table_name', 'Area' );
		$this->template->assign( 'template', 'show_area' );
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
                $fields = $this->model_area->fields();
                
                
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'area_fields', $fields );
                $this->template->assign( 'metadata', $this->model_area->metadata() );
        		$this->template->assign( 'table_name', 'Area' );
        		$this->template->assign( 'template', 'form_area' );
        		$this->template->display( 'frame_admin.tpl' );
            break;

            /**
             *  Insert data TO area table
             */
            case 'POST':
                $fields = $this->model_area->fields();

                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'province', lang('province'), 'required|max_length[45]' );
				$this->form_validation->set_rules( 'city', lang('city'), 'required|max_length[45]' );

				$data_post['province'] = $this->input->post( 'province' );
				$data_post['city'] = $this->input->post( 'city' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'area_data', $data_post );
            		$this->template->assign( 'area_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_area->metadata() );
            		$this->template->assign( 'table_name', 'Area' );
            		$this->template->assign( 'template', 'form_area' );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_area->insert( $data_post );
                    
					redirect( 'area' );
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
                $this->model_area->raw_data = TRUE;
        		$data = $this->model_area->get( $id );
                $fields = $this->model_area->fields();
                
                
                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'area_data', $data );
        		$this->template->assign( 'area_fields', $fields );
                $this->template->assign( 'metadata', $this->model_area->metadata() );
        		$this->template->assign( 'table_name', 'Area' );
        		$this->template->assign( 'template', 'form_area' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_area->fields();
                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'province', lang('province'), 'required|max_length[45]' );
				$this->form_validation->set_rules( 'city', lang('city'), 'required|max_length[45]' );

				$data_post['province'] = $this->input->post( 'province' );
				$data_post['city'] = $this->input->post( 'city' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'area_data', $data_post );
            		$this->template->assign( 'area_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_area->metadata() );
            		$this->template->assign( 'table_name', 'Area' );
            		$this->template->assign( 'template', 'form_area' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_area->update( $id, $data_post );
				    
					redirect( 'area/show/' . $id );   
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
                $this->model_area->delete( $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_area->delete( $this->input->post('delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
}
