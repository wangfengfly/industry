<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_industry extends CI_Model 
{
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
		 *     - TRUE:  just the field names of the industry table
		 *     - FALSE: related fields are replaced with the forign tables values
		 *    Triggered to TRUE in the controller/edit method		 
		 */
        $this->raw_data = FALSE;  
    }

	function get ( $id, $get_one = false )
	{
        
	    $select_statement = ( $this->raw_data ) ? 'id,name,parentid' : 'id,name,parentid';
		$this->db->select( $select_statement );
		$this->db->from('industry');
        

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
	'name' => $row['name'],
	'parentid' => $row['parentid'],
 );
		}
        else
        {
            return array();
        }
	}



	function insert ( $data )
	{
		$this->db->insert( 'industry', $data );
		return $this->db->insert_id();
	}
	


	function update ( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( 'industry', $data );
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
        $this->db->delete( 'industry' );
        
	}

    /**
     * 获取所有的记录
     */
    public function getall(){
        $industries = $this->db->get('industry')->result_array();
        $industry_map = array();
        foreach($industries as $industry){
            $id = intval($industry['id']);
            $industry_map[$id] = $industry;
        }
        return $industry_map;
    }

    public function getall2name(){
        $industry_map = $this->getall();
        $data = array();
        $data[0] = '无';
        foreach($industry_map as $id=>$item){
            $data[$id] = $item['name'];
        }
        return $data;
    }

    /**
     * 获取第一级行业
     */
    public function getFirstInds(){
        $this->db->where('parentid', 0);
        $inds = $this->db->get('industry')->result_array();
        $inds_map = array();
        $inds_map[0] = '无';
        foreach($inds as $ind){
            $id = intval($ind['id']);
            $inds_map[$id] = $ind['name'];
        }
        return $inds_map;
    }



	function lister ( $page = FALSE )
	{
        
	    $this->db->start_cache();
		$this->db->select( 'id,name,parentid');
		$this->db->from( 'industry' );
		//$this->db->order_by( '', 'ASC' );
        

        /**
         *   PAGINATION
         */
        if( $this->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'industry/index/';
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
	'name' => $row['name'],
	'parentid' => $row['parentid'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}



	function search ( $keyword, $page = FALSE )
	{
	    $meta = $this->metadata();
	    $this->db->start_cache();
		$this->db->select( 'id,name,parentid');
		$this->db->from( 'industry' );
        

		// Delete this line after setting up the search conditions 
        die('Please see models/model_industry.php for setting up the search method.');
		
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
            $config['base_url']    = '/industry/search/'.$keyword.'/';
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
	'name' => $row['name'],
	'parentid' => $row['parentid'],
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
	'name' => lang('name'),
	'parentid' => lang('parentid')
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

        $metadata = $this->explain_table->parse( 'industry' );

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
