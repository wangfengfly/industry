<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_policy extends CI_Model 
{
	const DEPARTMENT = array(
		0=>'无',
		1=>'国务院',
			2=>'国家发改委',
			3=>'科技部',
			4=>'财政部',
			5=>'农业农村部',
			6=>'国家海洋局',
			7=>'工业和信息化部',
			8=>'国家知识产权局',
			9=>'文化和旅游部',
			10=>'国家统计局',
			11=>'交通部',
			12=>'生态环境部',
			13=>'自然资源部',
			14=>'商务部',
			15=>'国家卫生健康委员会',
			16=>'民政部'
	);

    function __construct()
    {
        parent::__construct();
 
		$this->load->database();

		// Paginaiton defaults
		$this->pagination_enabled = FALSE;
		$this->pagination_per_page = 10;
		$this->pagination_num_links = 5;
		$this->pager = '';

        /**
		 *    bool $this->raw_data		
		 *    Used to decide what data should the SQL queries retrieve if tables are joined
		 *     - TRUE:  just the field names of the policy table
		 *     - FALSE: related fields are replaced with the forign tables values
		 *    Triggered to TRUE in the controller/edit method		 
		 */
        $this->raw_data = FALSE;  
    }

	function get ( $id, $get_one = false )
	{
        
	    $select_statement = ( $this->raw_data ) ? 'id,pub_time,ind_id,pid,department,title,content,attach_url' : 'id,pub_time,ind_id,pid,department,title,content,attach_url';
		$this->db->select( $select_statement );
		$this->db->from('policy');
        

		// Pick one record
		// Field order sample may be empty because no record is requested, eg. create/GET event
		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		else // Select the desired record
        {
            $this->db->where( 'id', $id );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
	'id' => $row['id'],
	'pub_time' => $row['pub_time'],
	'ind_id' => $row['ind_id'],
	'pid' => $row['pid'],
	'department' => $row['department'],
	'title' => $row['title'],
	'content' => $row['content'],
	'attach_url' => $row['attach_url'],
 );
		}
        else
        {
            return array();
        }
	}



	function insert ( $data )
	{
		$this->db->insert( 'policy', $data );
		return $this->db->insert_id();
	}
	


	function update ( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( 'policy', $data );
	}


	
	function delete ( $id )
	{
        if( is_array( $id ) )
        {
            $this->db->where_in( 'id', $id );            
        }
        else
        {
            $this->db->where( 'id', $id );
        }
        $this->db->delete( 'policy' );
        
	}



	function lister ( $page = FALSE )
	{
        
	    $this->db->start_cache();
		$this->db->select( 'id,pub_time,ind_id,pid,department,title,content,attach_url');
		$this->db->from( 'policy' );
		//$this->db->order_by( '', 'ASC' );
        

        /**
         *   PAGINATION
         */
        if( $this->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'policy/index/';
            $config['uri_segment'] = 3;
            $config['cur_tag_open'] = '<span class="current">';
            $config['cur_tag_close'] = '</span>';
            $config['per_page']    = $this->pagination_per_page;
            $config['num_links']   = $this->pagination_num_links;

            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
    
            $this->db->limit( $config['per_page'], $page );
        }

        // Get the results
		$query = $this->db->get();
		
		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
	'id' => $row['id'],
	'pub_time' => $row['pub_time'],
	'ind_id' => $row['ind_id'],
	'pid' => $row['pid'],
	'department' => $row['department'],
	'title' => $row['title'],
	'content' => $row['content'],
	'attach_url' => $row['attach_url'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}



	function search ( $keyword, $page = FALSE )
	{
	    $meta = $this->metadata();
	    $this->db->start_cache();
		$this->db->select( 'id,pub_time,ind_id,pid,department,title,content,attach_url');
		$this->db->from( 'policy' );
        

		// Delete this line after setting up the search conditions 
        die('Please see models/model_policy.php for setting up the search method.');
		
        /**
         *  Rename field_name_to_search to the field you wish to search 
         *  or create advanced search conditions here
		 */
        $this->db->where( 'field_name_to_search LIKE "%'.$keyword.'%"' );

        /**
         *   PAGINATION
         */
        if( $this->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = '/policy/search/'.$keyword.'/';
            $config['uri_segment'] = 4;
            $config['per_page']    = $this->pagination_per_page;
            $config['num_links']   = $this->pagination_num_links;
    
            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
    
            $this->db->limit( $config['per_page'], $page );
        }

		$query = $this->db->get();

		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
	'id' => $row['id'],
	'pub_time' => $row['pub_time'],
	'ind_id' => $row['ind_id'],
	'pid' => $row['pid'],
	'department' => $row['department'],
	'title' => $row['title'],
	'content' => $row['content'],
	'attach_url' => $row['attach_url'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}





    /**
     *  Some utility methods
     */
    function fields( $withID = FALSE )
    {
        $fs = array(
	'id' => lang('id'),
	'pub_time' => lang('pub_time'),
	'ind_id' => lang('ind_id'),
	'pid' => lang('pid'),
	'department' => lang('department'),
	'title' => lang('title'),
	'content' => lang('content'),
	'attach_url' => lang('attach_url')
);

        if( $withID == FALSE )
        {
            unset( $fs[0] );
        }
        return $fs;
    }  
    


    function pagination( $bool )
    {
        $this->pagination_enabled = ( $bool === TRUE ) ? TRUE : FALSE;
    }



    /**
     *  Parses the table data and look for enum values, to match them with language variables
     */             
    function metadata()
    {
        $this->load->library('explain_table');

        $metadata = $this->explain_table->parse( 'policy' );

        foreach( $metadata as $k => $md )
        {
            if( !empty( $md['enum_values'] ) )
            {
                $metadata[ $k ]['enum_names'] = array_map( 'lang', $md['enum_values'] );                
            } 
        }
        return $metadata; 
    }
}
