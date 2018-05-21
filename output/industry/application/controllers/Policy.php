<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->library( 'template' ); 
		$this->load->model( 'model_policy' ); 
		
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
        $this->model_policy->pagination( TRUE );
		$data_info = $this->model_policy->lister( $page );
        $fields = $this->model_policy->fields( TRUE );
        

        $this->template->assign( 'pager', $this->model_policy->pager );
		$this->template->assign( 'policy_fields', $fields );
		$this->template->assign( 'policy_data', $data_info );
        $this->template->assign( 'table_name', 'Policy' );
        $this->template->assign( 'template', 'list_policy' );
        
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_policy->get( $id );
        $fields = $this->model_policy->fields( TRUE );
        

        
        $this->template->assign( 'id', $id );
		$this->template->assign( 'policy_fields', $fields );
		$this->template->assign( 'policy_data', $data );
		$this->template->assign( 'table_name', 'Policy' );
		$this->template->assign( 'template', 'show_policy' );
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
                $fields = $this->model_policy->fields();
                
                
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'policy_fields', $fields );
                $this->template->assign( 'metadata', $this->model_policy->metadata() );
        		$this->template->assign( 'table_name', 'Policy' );
        		$this->template->assign( 'template', 'form_policy' );
        		$this->template->display( 'frame_admin.tpl' );
            break;

            /**
             *  Insert data TO policy table
             */
            case 'POST':
                $fields = $this->model_policy->fields();

                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'pub_time', lang('pub_time'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'ind_id', lang('ind_id'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'pid', lang('pid'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'department', lang('department'), 'required|max_length[2]|integer' );
				$this->form_validation->set_rules( 'title', lang('title'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'content', lang('content'), 'required' );
				$this->form_validation->set_rules( 'attach_url', lang('attach_url'), 'required|max_length[100]' );

				$data_post['pub_time'] = $this->input->post( 'pub_time' );
				$data_post['ind_id'] = $this->input->post( 'ind_id' );
				$data_post['pid'] = $this->input->post( 'pid' );
				$data_post['department'] = $this->input->post( 'department' );
				$data_post['title'] = $this->input->post( 'title' );
				$data_post['content'] = $this->input->post( 'content' );
				$data_post['attach_url'] = $this->input->post( 'attach_url' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'policy_data', $data_post );
            		$this->template->assign( 'policy_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_policy->metadata() );
            		$this->template->assign( 'table_name', 'Policy' );
            		$this->template->assign( 'template', 'form_policy' );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_policy->insert( $data_post );
                    
					redirect( 'policy' );
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
                $this->model_policy->raw_data = TRUE;
        		$data = $this->model_policy->get( $id );
                $fields = $this->model_policy->fields();
                
                
                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'policy_data', $data );
        		$this->template->assign( 'policy_fields', $fields );
                $this->template->assign( 'metadata', $this->model_policy->metadata() );
        		$this->template->assign( 'table_name', 'Policy' );
        		$this->template->assign( 'template', 'form_policy' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_policy->fields();
                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'pub_time', lang('pub_time'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'ind_id', lang('ind_id'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'pid', lang('pid'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'department', lang('department'), 'required|max_length[2]|integer' );
				$this->form_validation->set_rules( 'title', lang('title'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'content', lang('content'), 'required' );
				$this->form_validation->set_rules( 'attach_url', lang('attach_url'), 'required|max_length[100]' );

				$data_post['pub_time'] = $this->input->post( 'pub_time' );
				$data_post['ind_id'] = $this->input->post( 'ind_id' );
				$data_post['pid'] = $this->input->post( 'pid' );
				$data_post['department'] = $this->input->post( 'department' );
				$data_post['title'] = $this->input->post( 'title' );
				$data_post['content'] = $this->input->post( 'content' );
				$data_post['attach_url'] = $this->input->post( 'attach_url' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'policy_data', $data_post );
            		$this->template->assign( 'policy_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_policy->metadata() );
            		$this->template->assign( 'table_name', 'Policy' );
            		$this->template->assign( 'template', 'form_policy' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_policy->update( $id, $data_post );
				    
					redirect( 'policy/show/' . $id );   
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
                $this->model_policy->delete( $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_policy->delete( $this->input->post('delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
}
