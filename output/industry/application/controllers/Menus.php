<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->library( 'template' ); 
		$this->load->model( 'model_menus' ); 
		
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
        $this->model_menus->pagination( TRUE );
		$data_info = $this->model_menus->lister( $page );
        $fields = $this->model_menus->fields( TRUE );
        

        $this->template->assign( 'pager', $this->model_menus->pager );
		$this->template->assign( 'menus_fields', $fields );
		$this->template->assign( 'menus_data', $data_info );
        $this->template->assign( 'table_name', 'Menus' );
        $this->template->assign( 'template', 'list_menus' );
        
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_menus->get( $id );
        $fields = $this->model_menus->fields( TRUE );
        

        
        $this->template->assign( 'id', $id );
		$this->template->assign( 'menus_fields', $fields );
		$this->template->assign( 'menus_data', $data );
		$this->template->assign( 'table_name', 'Menus' );
		$this->template->assign( 'template', 'show_menus' );
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
                $fields = $this->model_menus->fields();
                
                
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'menus_fields', $fields );
                $this->template->assign( 'metadata', $this->model_menus->metadata() );
        		$this->template->assign( 'table_name', 'Menus' );
        		$this->template->assign( 'template', 'form_menus' );
        		$this->template->display( 'frame_admin.tpl' );
            break;

            /**
             *  Insert data TO menus table
             */
            case 'POST':
                $fields = $this->model_menus->fields();

                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'seq', lang('seq'), 'required|max_length[2]|integer' );
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'ctime', lang('ctime'), 'required' );

				$data_post['seq'] = $this->input->post( 'seq' );
				$data_post['name'] = $this->input->post( 'name' );
				$data_post['ctime'] = $this->input->post( 'ctime' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'menus_data', $data_post );
            		$this->template->assign( 'menus_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_menus->metadata() );
            		$this->template->assign( 'table_name', 'Menus' );
            		$this->template->assign( 'template', 'form_menus' );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_menus->insert( $data_post );
                    
					redirect( 'menus' );
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
                $this->model_menus->raw_data = TRUE;
        		$data = $this->model_menus->get( $id );
                $fields = $this->model_menus->fields();
                
                
                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'menus_data', $data );
        		$this->template->assign( 'menus_fields', $fields );
                $this->template->assign( 'metadata', $this->model_menus->metadata() );
        		$this->template->assign( 'table_name', 'Menus' );
        		$this->template->assign( 'template', 'form_menus' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_menus->fields();
                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'seq', lang('seq'), 'required|max_length[2]|integer' );
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'ctime', lang('ctime'), 'required' );

				$data_post['seq'] = $this->input->post( 'seq' );
				$data_post['name'] = $this->input->post( 'name' );
				$data_post['ctime'] = $this->input->post( 'ctime' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'menus_data', $data_post );
            		$this->template->assign( 'menus_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_menus->metadata() );
            		$this->template->assign( 'table_name', 'Menus' );
            		$this->template->assign( 'template', 'form_menus' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_menus->update( $id, $data_post );
				    
					redirect( 'menus/show/' . $id );   
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
                $this->model_menus->delete( $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_menus->delete( $this->input->post('delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
}
