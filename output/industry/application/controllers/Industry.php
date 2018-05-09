<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Industry extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->library( 'template' ); 
		$this->load->model( 'model_industry' ); 
		
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
        $this->model_industry->pagination( TRUE );
		$data_info = $this->model_industry->lister( $page );
        $fields = $this->model_industry->fields( TRUE );

        //将parentid映射为行业名称
        $industry_map = $this->model_industry->getall();
        foreach($data_info as &$item){
            if($item['parentid']){
                $item['parentid'] = $industry_map[$item['parentid']]['name'];
            }
        }

        $this->template->assign( 'pager', $this->model_industry->pager );
		$this->template->assign( 'industry_fields', $fields );
		$this->template->assign( 'industry_data', $data_info );
        $this->template->assign( 'table_name', 'Industry' );
        $this->template->assign( 'template', 'list_industry' );
        
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_industry->get( $id );
        $fields = $this->model_industry->fields( TRUE );

        //将parentid映射为行业名称
        $industry_map = $this->model_industry->getall();
        $data['parentid'] = isset($industry_map[$data['parentid']]) ? $industry_map[$data['parentid']]['name'] : '0';
        
        $this->template->assign( 'id', $id );
		$this->template->assign( 'industry_fields', $fields );
		$this->template->assign( 'industry_data', $data );
		$this->template->assign( 'table_name', 'Industry' );
		$this->template->assign( 'template', 'show_industry' );
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
                $fields = $this->model_industry->fields();
                //将parentid映射为行业名称
                $industries = $this->model_industry->getall();
                foreach($industries as $_id=>$industry){
                    $industries[$_id] = $industry['name'];
                }
                $industries[0] = '无';
                $this->template->assign('industries', $industries);
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'industry_fields', $fields );
                $this->template->assign( 'metadata', $this->model_industry->metadata() );
        		$this->template->assign( 'table_name', 'Industry' );
        		$this->template->assign( 'template', 'form_industry' );
        		$this->template->display( 'frame_admin.tpl' );
            break;

            /**
             *  Insert data TO industry table
             */
            case 'POST':
                $fields = $this->model_industry->fields();

                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[45]' );
				$this->form_validation->set_rules( 'parentid', lang('parentid'), 'required|max_length[11]|integer' );

				$data_post['name'] = $this->input->post( 'name' );
				$data_post['parentid'] = $this->input->post( 'parentid' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'industry_data', $data_post );
            		$this->template->assign( 'industry_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_industry->metadata() );
            		$this->template->assign( 'table_name', 'Industry' );
            		$this->template->assign( 'template', 'form_industry' );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_industry->insert( $data_post );
					redirect( 'industry' );
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
                $this->model_industry->raw_data = TRUE;
        		$data = $this->model_industry->get( $id );
                $fields = $this->model_industry->fields();
                
                $industries = $this->model_industry->getall();
                foreach($industries as $_id=>$industry){
                    $industries[$_id] = $industry['name'];
                }
                $industries[0] = '无';
                $this->template->assign('industries', $industries);
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'industry_data', $data );
        		$this->template->assign( 'industry_fields', $fields );
                $this->template->assign( 'metadata', $this->model_industry->metadata() );
        		$this->template->assign( 'table_name', 'Industry' );
        		$this->template->assign( 'template', 'form_industry' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_industry->fields();
                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'name', lang('name'), 'required|max_length[45]' );
				$this->form_validation->set_rules( 'parentid', lang('parentid'), 'required|max_length[11]|integer' );

				$data_post['name'] = $this->input->post( 'name' );
				$data_post['parentid'] = $this->input->post( 'parentid' );
                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'industry_data', $data_post );
            		$this->template->assign( 'industry_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_industry->metadata() );
            		$this->template->assign( 'table_name', 'Industry' );
            		$this->template->assign( 'template', 'form_industry' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_industry->update( $id, $data_post );
					redirect( 'industry/show/' . $id );   
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
                $this->model_industry->delete( $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_industry->delete( $this->input->post('delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
}
