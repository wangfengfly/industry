<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Economy extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->library( 'template' ); 
		$this->load->model( 'model_economy' ); 
		
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
        $this->model_economy->pagination( TRUE );
		$data_info = $this->model_economy->lister( $page );
        $fields = $this->model_economy->fields( TRUE );
        

        $this->template->assign( 'pager', $this->model_economy->pager );
		$this->template->assign( 'economy_fields', $fields );
		$this->template->assign( 'economy_data', $data_info );
        $this->template->assign( 'table_name', 'Economy' );
        $this->template->assign( 'template', 'list_economy' );
        
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_economy->get( $id );
        $fields = $this->model_economy->fields( TRUE );
        

        
        $this->template->assign( 'id', $id );
		$this->template->assign( 'economy_fields', $fields );
		$this->template->assign( 'economy_data', $data );
		$this->template->assign( 'table_name', 'Economy' );
		$this->template->assign( 'template', 'show_economy' );
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
                $fields = $this->model_economy->fields();
                //所属园区映射
				$this->load->model('model_park');
				$parks = $this->model_park->getall2name();
                $this->template->assign('parks', $parks);
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'economy_fields', $fields );
                $this->template->assign( 'metadata', $this->model_economy->metadata() );
        		$this->template->assign( 'table_name', 'Economy' );
        		$this->template->assign( 'template', 'form_economy' );
        		$this->template->display( 'frame_admin_new.tpl' );
            break;

            /**
             *  Insert data TO economy table
             */
            case 'POST':
                $fields = $this->model_economy->fields();

                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'park_id', lang('park_id'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'year', lang('year'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'pepole_count', lang('pepole_count'), 'required' );
				$this->form_validation->set_rules( 'gross', lang('gross'), 'required' );
				$this->form_validation->set_rules( 'delivery', lang('delivery'), 'required' );
				$this->form_validation->set_rules( 'total_assets', lang('total_assets'), 'required' );
				$this->form_validation->set_rules( 'current_assets', lang('current_assets'), 'required' );
				$this->form_validation->set_rules( 'debt', lang('debt'), 'required' );
				$this->form_validation->set_rules( 'owners', lang('owners'), 'required' );
				$this->form_validation->set_rules( 'revenue', lang('revenue'), 'required' );
				$this->form_validation->set_rules( 'profit', lang('profit'), 'required' );
				$this->form_validation->set_rules( 'tax', lang('tax'), 'required' );
				$this->form_validation->set_rules( 'loss', lang('loss'), 'required' );

				$data_post['park_id'] = $this->input->post( 'park_id' );
				$data_post['year'] = $this->input->post( 'year' );
				$data_post['pepole_count'] = $this->input->post( 'pepole_count' );
				$data_post['gross'] = $this->input->post( 'gross' );
				$data_post['delivery'] = $this->input->post( 'delivery' );
				$data_post['total_assets'] = $this->input->post( 'total_assets' );
				$data_post['current_assets'] = $this->input->post( 'current_assets' );
				$data_post['debt'] = $this->input->post( 'debt' );
				$data_post['owners'] = $this->input->post( 'owners' );
				$data_post['revenue'] = $this->input->post( 'revenue' );
				$data_post['profit'] = $this->input->post( 'profit' );
				$data_post['tax'] = $this->input->post( 'tax' );
				$data_post['loss'] = $this->input->post( 'loss' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'economy_data', $data_post );
            		$this->template->assign( 'economy_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_economy->metadata() );
            		$this->template->assign( 'table_name', 'Economy' );
            		$this->template->assign( 'template', 'form_economy' );
            		$this->template->display( 'frame_admin_new.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_economy->insert( $data_post );
                    
					redirect( 'economy' );
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
                $this->model_economy->raw_data = TRUE;
        		$data = $this->model_economy->get( $id );
                $fields = $this->model_economy->fields();

				//所属园区映射
				$this->load->model('model_park');
				$parks = $this->model_park->getall2name();
				$this->template->assign('parks', $parks);
                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'economy_data', $data );
        		$this->template->assign( 'economy_fields', $fields );
                $this->template->assign( 'metadata', $this->model_economy->metadata() );
        		$this->template->assign( 'table_name', 'Economy' );
        		$this->template->assign( 'template', 'form_economy' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_economy->fields();
                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'park_id', lang('park_id'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'year', lang('year'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'pepole_count', lang('pepole_count'), 'required' );
				$this->form_validation->set_rules( 'gross', lang('gross'), 'required' );
				$this->form_validation->set_rules( 'delivery', lang('delivery'), 'required' );
				$this->form_validation->set_rules( 'total_assets', lang('total_assets'), 'required' );
				$this->form_validation->set_rules( 'current_assets', lang('current_assets'), 'required' );
				$this->form_validation->set_rules( 'debt', lang('debt'), 'required' );
				$this->form_validation->set_rules( 'owners', lang('owners'), 'required' );
				$this->form_validation->set_rules( 'revenue', lang('revenue'), 'required' );
				$this->form_validation->set_rules( 'profit', lang('profit'), 'required' );
				$this->form_validation->set_rules( 'tax', lang('tax'), 'required' );
				$this->form_validation->set_rules( 'loss', lang('loss'), 'required' );

				$data_post['park_id'] = $this->input->post( 'park_id' );
				$data_post['year'] = $this->input->post( 'year' );
				$data_post['pepole_count'] = $this->input->post( 'pepole_count' );
				$data_post['gross'] = $this->input->post( 'gross' );
				$data_post['delivery'] = $this->input->post( 'delivery' );
				$data_post['total_assets'] = $this->input->post( 'total_assets' );
				$data_post['current_assets'] = $this->input->post( 'current_assets' );
				$data_post['debt'] = $this->input->post( 'debt' );
				$data_post['owners'] = $this->input->post( 'owners' );
				$data_post['revenue'] = $this->input->post( 'revenue' );
				$data_post['profit'] = $this->input->post( 'profit' );
				$data_post['tax'] = $this->input->post( 'tax' );
				$data_post['loss'] = $this->input->post( 'loss' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'economy_data', $data_post );
            		$this->template->assign( 'economy_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_economy->metadata() );
            		$this->template->assign( 'table_name', 'Economy' );
            		$this->template->assign( 'template', 'form_economy' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_economy->update( $id, $data_post );
				    
					redirect( 'economy/show/' . $id );   
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
                $this->model_economy->delete( $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_economy->delete( $this->input->post('delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
}
