<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_park extends CI_Model 
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
		 *     - TRUE:  just the field names of the park table
		 *     - FALSE: related fields are replaced with the forign tables values
		 *    Triggered to TRUE in the controller/edit method		 
		 */
        $this->raw_data = FALSE;  
    }

	/**
	 * @param $name名称
	 * 根据名称模糊匹配
	 */
	public function getByName($name){
		$this->db->select('id,name');
		$this->db->from('park');
		$this->db->like('name', $name);
		$query = $this->db->get();
		$parks = $query->result_array();
		return $parks;
	}

	public function getall(){
		$parks = $this->db->get('park')->result_array();
		$park_map = array();
		foreach($parks as $park){
			$id = intval($park['id']);
			$park_map[$id] = $park;
		}
		return $park_map;
	}

	public function getall2name(){
		$park_map = $this->getall();
		$data = array();
		foreach($park_map as $id=>&$item){
			$data[$id] = $item['name'];
		}
		return $data;
	}

	function get ( $id, $get_one = false )
	{
        
	    $select_statement = ( $this->raw_data ) ? 'id,identifier,code,name,create_time,area,prime_ind1,prime_ind2,prime_ind3,prime_ind4,intro,url,phone,email,wechat,companies' : 'id,identifier,code,name,create_time,area,prime_ind1,prime_ind2,prime_ind3,prime_ind4,intro,url,phone,email,wechat,companies';
		$this->db->select( $select_statement );
		$this->db->from('park');
        

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
	'identifier' => $row['identifier'],
	'code' => $row['code'],
	'name' => $row['name'],
	'create_time' => $row['create_time'],
	'area' => $row['area'],
	'prime_ind1' => $row['prime_ind1'],
	'prime_ind2' => $row['prime_ind2'],
	'prime_ind3' => $row['prime_ind3'],
	'prime_ind4' => $row['prime_ind4'],
	'intro' => $row['intro'],
	'url' => $row['url'],
	'phone' => $row['phone'],
	'email' => $row['email'],
	'wechat' => $row['wechat'],
	'companies' => $row['companies'],
 );
		}
        else
        {
            return array();
        }
	}



	function insert ( $data )
	{
		$this->db->insert( 'park', $data );
		return $this->db->insert_id();
	}
	


	function update ( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( 'park', $data );
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
        $this->db->delete( 'park' );
        
	}



	function lister ( $page = FALSE )
	{
        
	    $this->db->start_cache();
		$this->db->select( 'id,identifier,code,name,create_time,area,prime_ind1,prime_ind2,prime_ind3,prime_ind4,intro,url,phone,email,wechat,companies');
		$this->db->from( 'park' );
		//$this->db->order_by( '', 'ASC' );
        

        /**
         *   PAGINATION
         */
        if( $this->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'park/index/';
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
	'identifier' => $row['identifier'],
	'code' => $row['code'],
	'name' => $row['name'],
	'create_time' => $row['create_time'],
	'area' => $row['area'],
	'prime_ind1' => $row['prime_ind1'],
	'prime_ind2' => $row['prime_ind2'],
	'prime_ind3' => $row['prime_ind3'],
	'prime_ind4' => $row['prime_ind4'],
	'intro' => $row['intro'],
	'url' => $row['url'],
	'phone' => $row['phone'],
	'email' => $row['email'],
	'wechat' => $row['wechat'],
	'companies' => $row['companies'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}



	function search ( $keyword, $page = FALSE )
	{
	    $meta = $this->metadata();
	    $this->db->start_cache();
		$this->db->select( 'id,identifier,code,name,create_time,area,prime_ind1,prime_ind2,prime_ind3,prime_ind4,intro,url,phone,email,wechat,companies');
		$this->db->from( 'park' );
        

		// Delete this line after setting up the search conditions 
        die('Please see models/model_park.php for setting up the search method.');
		
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
            $config['base_url']    = '/park/search/'.$keyword.'/';
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
	'identifier' => $row['identifier'],
	'code' => $row['code'],
	'name' => $row['name'],
	'create_time' => $row['create_time'],
	'area' => $row['area'],
	'prime_ind1' => $row['prime_ind1'],
	'prime_ind2' => $row['prime_ind2'],
	'prime_ind3' => $row['prime_ind3'],
	'prime_ind4' => $row['prime_ind4'],
	'intro' => $row['intro'],
	'url' => $row['url'],
	'phone' => $row['phone'],
	'email' => $row['email'],
	'wechat' => $row['wechat'],
	'companies' => $row['companies'],
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
	'identifier' => lang('identifier'),
	'code' => lang('code'),
	'name' => lang('name'),
	'create_time' => lang('create_time'),
	'area' => lang('area'),
	'prime_ind1' => lang('prime_ind1'),
	'prime_ind2' => lang('prime_ind2'),
	'prime_ind3' => lang('prime_ind3'),
	'prime_ind4' => lang('prime_ind4'),
	'intro' => lang('intro'),
	'url' => lang('url'),
	'phone' => lang('phone'),
	'email' => lang('email'),
	'wechat' => lang('wechat'),
	'companies' => lang('companies')
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

        $metadata = $this->explain_table->parse( 'park' );

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
