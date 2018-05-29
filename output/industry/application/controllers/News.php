<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->library( 'template' ); 
		$this->load->model( 'model_news' ); 
		
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
        $this->model_news->pagination( TRUE );
		$data_info = $this->model_news->lister( $page );
        $fields = $this->model_news->fields( TRUE );
        

        $this->template->assign( 'pager', $this->model_news->pager );
		$this->template->assign( 'news_fields', $fields );
		$this->template->assign( 'news_data', $data_info );
        $this->template->assign( 'table_name', 'News' );
        $this->template->assign( 'template', 'list_news' );
        
		$this->template->display( 'frame_admin.tpl' );
    }



    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_news->get( $id );
        $fields = $this->model_news->fields( TRUE );
        

        
        $this->template->assign( 'id', $id );
		$this->template->assign( 'news_fields', $fields );
		$this->template->assign( 'news_data', $data );
		$this->template->assign( 'table_name', 'News' );
		$this->template->assign( 'template', 'show_news' );
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
                $fields = $this->model_news->fields();
                
                
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'news_fields', $fields );
                $this->template->assign( 'metadata', $this->model_news->metadata() );
        		$this->template->assign( 'table_name', 'News' );
        		$this->template->assign( 'template', 'form_news' );
        		$this->template->display( 'frame_admin.tpl' );
            break;

            /**
             *  Insert data TO news table
             */
            case 'POST':
                $fields = $this->model_news->fields();

                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'menu_id', lang('menu_id'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'pub_time', lang('pub_time'), 'required' );
				$this->form_validation->set_rules( 'title', lang('title'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'desc', lang('desc'), 'required|max_length[200]' );
				$this->form_validation->set_rules( 'img_url', lang('img_url'), 'required|max_length[200]' );
				$this->form_validation->set_rules( 'content', lang('content'), 'required' );
				$this->form_validation->set_rules( 'tags', lang('tags'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'author', lang('author'), 'required|max_length[100]' );

				$data_post['menu_id'] = $this->input->post( 'menu_id' );
				$data_post['pub_time'] = $this->input->post( 'pub_time' );
				$data_post['title'] = $this->input->post( 'title' );
				$data_post['desc'] = $this->input->post( 'desc' );
				$data_post['img_url'] = $this->input->post( 'img_url' );
				$data_post['content'] = $this->input->post( 'content' );
				$data_post['tags'] = $this->input->post( 'tags' );
				$data_post['author'] = $this->input->post( 'author' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'news_data', $data_post );
            		$this->template->assign( 'news_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_news->metadata() );
            		$this->template->assign( 'table_name', 'News' );
            		$this->template->assign( 'template', 'form_news' );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_news->insert( $data_post );
                    
					redirect( 'news' );
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
                $this->model_news->raw_data = TRUE;
        		$data = $this->model_news->get( $id );
                $fields = $this->model_news->fields();
                
                
                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'news_data', $data );
        		$this->template->assign( 'news_fields', $fields );
                $this->template->assign( 'metadata', $this->model_news->metadata() );
        		$this->template->assign( 'table_name', 'News' );
        		$this->template->assign( 'template', 'form_news' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_news->fields();
                /* we set the rules */
                /* don't forget to edit these */
				$this->form_validation->set_rules( 'menu_id', lang('menu_id'), 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'pub_time', lang('pub_time'), 'required' );
				$this->form_validation->set_rules( 'title', lang('title'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'desc', lang('desc'), 'required|max_length[200]' );
				$this->form_validation->set_rules( 'img_url', lang('img_url'), 'required|max_length[200]' );
				$this->form_validation->set_rules( 'content', lang('content'), 'required' );
				$this->form_validation->set_rules( 'tags', lang('tags'), 'required|max_length[100]' );
				$this->form_validation->set_rules( 'author', lang('author'), 'required|max_length[100]' );

				$data_post['menu_id'] = $this->input->post( 'menu_id' );
				$data_post['pub_time'] = $this->input->post( 'pub_time' );
				$data_post['title'] = $this->input->post( 'title' );
				$data_post['desc'] = $this->input->post( 'desc' );
				$data_post['img_url'] = $this->input->post( 'img_url' );
				$data_post['content'] = $this->input->post( 'content' );
				$data_post['tags'] = $this->input->post( 'tags' );
				$data_post['author'] = $this->input->post( 'author' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
                    
                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'news_data', $data_post );
            		$this->template->assign( 'news_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_news->metadata() );
            		$this->template->assign( 'table_name', 'News' );
            		$this->template->assign( 'template', 'form_news' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_news->update( $id, $data_post );
				    
					redirect( 'news/show/' . $id );   
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
                $this->model_news->delete( $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_news->delete( $this->input->post('delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
}
