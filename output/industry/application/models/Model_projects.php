<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_projects extends CI_Model 
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
		 *     - TRUE:  just the field names of the projects table
		 *     - FALSE: related fields are replaced with the forign tables values
		 *    Triggered to TRUE in the controller/edit method		 
		 */
        $this->raw_data = FALSE;  
    }

	function get ( $id, $get_one = false )
	{
        
	    $select_statement = ( $this->raw_data ) ? 'id,name,sshy1,sshy2,jsdw,jsdd,tzztxz,tze,jsnr,jjzb,jssj1,jssj2,tags,xmxz,ssyq' : 'id,name,sshy1,sshy2,jsdw,jsdd,tzztxz,tze,jsnr,jjzb,jssj1,jssj2,tags,xmxz,ssyq';
		$this->db->select( $select_statement );
		$this->db->from('projects');
        

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
	'sshy1' => $row['sshy1'],
	'sshy2' => $row['sshy2'],
	'jsdw' => $row['jsdw'],
	'jsdd' => $row['jsdd'],
	'tzztxz' => $row['tzztxz'],
	'tze' => $row['tze'],
	'jsnr' => $row['jsnr'],
	'jjzb' => $row['jjzb'],
	'jssj1' => $row['jssj1'],
	'jssj2' => $row['jssj2'],
	'tags' => $row['tags'],
	'xmxz' => $row['xmxz'],
	'ssyq' => $row['ssyq'],
 );
		}
        else
        {
            return array();
        }
	}



	function insert ( $data )
	{
		$this->db->insert( 'projects', $data );
		return $this->db->insert_id();
	}
	


	function update ( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( 'projects', $data );
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
        $this->db->delete( 'projects' );
        
	}



	function lister ( $page = FALSE )
	{
        
	    $this->db->start_cache();
		$this->db->select( 'id,name,sshy1,sshy2,jsdw,jsdd,tzztxz,tze,jsnr,jjzb,jssj1,jssj2,tags,xmxz,ssyq');
		$this->db->from( 'projects' );
		//$this->db->order_by( '', 'ASC' );
        

        /**
         *   PAGINATION
         */
        if( $this->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'projects/index/';
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
	'sshy1' => $row['sshy1'],
	'sshy2' => $row['sshy2'],
	'jsdw' => $row['jsdw'],
	'jsdd' => $row['jsdd'],
	'tzztxz' => $row['tzztxz'],
	'tze' => $row['tze'],
	'jsnr' => $row['jsnr'],
	'jjzb' => $row['jjzb'],
	'jssj1' => $row['jssj1'],
	'jssj2' => $row['jssj2'],
	'tags' => $row['tags'],
	'xmxz' => $row['xmxz'],
	'ssyq' => $row['ssyq'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}



	function search ( $keyword, $page = FALSE )
	{
	    $meta = $this->metadata();
	    $this->db->start_cache();
		$this->db->select( 'id,name,sshy1,sshy2,jsdw,jsdd,tzztxz,tze,jsnr,jjzb,jssj1,jssj2,tags,xmxz,ssyq');
		$this->db->from( 'projects' );
        

		// Delete this line after setting up the search conditions 
        die('Please see models/model_projects.php for setting up the search method.');
		
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
            $config['base_url']    = '/projects/search/'.$keyword.'/';
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
	'sshy1' => $row['sshy1'],
	'sshy2' => $row['sshy2'],
	'jsdw' => $row['jsdw'],
	'jsdd' => $row['jsdd'],
	'tzztxz' => $row['tzztxz'],
	'tze' => $row['tze'],
	'jsnr' => $row['jsnr'],
	'jjzb' => $row['jjzb'],
	'jssj1' => $row['jssj1'],
	'jssj2' => $row['jssj2'],
	'tags' => $row['tags'],
	'xmxz' => $row['xmxz'],
	'ssyq' => $row['ssyq'],
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
	'sshy1' => lang('sshy1'),
	'sshy2' => lang('sshy2'),
	'jsdw' => lang('jsdw'),
	'jsdd' => lang('jsdd'),
	'tzztxz' => lang('tzztxz'),
	'tze' => lang('tze'),
	'jsnr' => lang('jsnr'),
	'jjzb' => lang('jjzb'),
	'jssj1' => lang('jssj1'),
	'jssj2' => lang('jssj2'),
	'tags' => lang('tags'),
	'xmxz' => lang('xmxz'),
	'ssyq' => lang('ssyq')
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

        $metadata = $this->explain_table->parse( 'projects' );

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
