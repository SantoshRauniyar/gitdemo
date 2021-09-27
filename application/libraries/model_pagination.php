<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
	Date 				: 266/12/2013
	Developed By 	: Ronak Amlani
	About Class		: This model will helps to make pagination
	How to use		:  1) set_ref($this)
							2) set_uri_segment("3")
							2) <optional> set per_page ..
							3) call query_pagination( "full current base path without last page no",$db_fields,$db_table_names,$db_other='include where , order by and other')			 			
*/

class Model_pagination
{
	//initalize
	private $ref;
	private $config;

	public function __construct()
	{
		//initialize
		$this->config						= array();
		$this->config["uri_segment"]	= 0;
	//	$this->config["uri_segment"]	= 0;
		$this->config["uri_page"]		= 0;
		$this->config["per_page"]		= 4;		
	}

	/*
	* Setter and getter methods	
	*/
	public function set_ref($ref)
	{
		$this->ref = $ref;
	}
	public function set_uri_segment($uri_segment)
	{
		$this->config["uri_segment"] = $uri_segment;
	}
	public function set_per_page($per_page)
	{
		$this->config["per_page"] = $per_page;
	}
	//Set optional other configuration
	public function set_full_tag($full_tag_open,$full_tag_close)
	{
		$this->config["full_tag_open"]	= $full_tag_open;
		$this->config["full_tag_close"] 	= $full_tag_close;	
	}
	public function set_first_link($first_tag_open,$first_tag_close,$first_link="First")
	{
		$this->config['first_link'] = 'First';

		$this->config['first_tag_open'] = first_tag_open;
		$this->config['first_tag_close'] = first_tag_close;	
	}
	public function set_last_link( $last_tag_open,$last_tag_close,$last_link="Last")
	{
		$this->config['last_link'] 		= $last_link;
		$this->config['last_tag_open'] 	= $last_tag_open;
		$this->config['last_tag_close'] 	= $last_tag_close;
	}
	public function set_prev_link( $prev_tag_open,$prev_tag_close,$prev_link='&gt;')
	{
		$this->config['prev_link'] 		= $prev_link;
		$this->config['prev_tag_open'] 	= $prev_tag_open;
		$this->config['prev_tag_close'] 	= $prev_tag_close;	
	}
	public function set_next_link( $next_tag_open,$next_tag_close,$next_link='&gt;')
	{
		$this->config['next_link'] 		= $next_link;
		$this->config['next_tag_open'] 	= $next_tag_open;
		$this->config['next_tag_close'] 	= $next_tag_close;	
	}
	
	public function set_cur_tag ( $cur_tag_open,$cur_tag_close )
	{
		$this->config['cur_tag_open'] 	= $cur_tag_open;
		$this->config['cur_tag_close'] 	= $cur_tag_close;
	}

	public function get_uri_segment($uri_segment)
	{
		return $this->config["uri_segment"] ;
	}
	public function get_per_page($per_page)
	{
		return $this->config["per_page"] ;
	}

	//Get records with pagination
	/* 
		how to use :
					 Just simply give arguments 
					
	*/
	public function query_pagination( $path,$fields,$table_names,$other='')
	{
//		$config['uri_protocol'] = "PATH_INFO";
		
		//Append query string at last
		if ( count($_GET) > 0) $this->config['suffix'] = '?' . http_build_query($_GET, '', "&");
		
		//Initialize remaining config 
		$page_no 							= $this->ref->uri->segment($this->config['uri_segment'] )  ? $this->ref->uri->segment( $this->config['uri_segment'] ) : 0;				
		$this->config["base_url"]		= $path;
		
		//pagination for first
		$this->config['first_url']		= $this->config['base_url'].'?'.http_build_query($_GET);		
		
	 	$this->config["total_rows"] 	= $this->query_count($table_names,$other);
		$choice								= $this->config["total_rows"] / $this->config["per_page"];
		$this->config["num_links"] 	= round($choice);
		
		$this->ref->pagination->initialize($this->config);
		
		$this->config["uri_segment"];		
		
		//Generate query
		if ( $other != '' )
		{
		 	$query 					= "SELECT $fields FROM $table_names  $other LIMIT ".$page_no.",".$this->config["per_page"];
		}
		else
		{
			$query 					= "SELECT $fields FROM $table_names  LIMIT ".$page_no.",".$this->config["per_page"];
		}		
		//echo $query;exit;
		//Gether data		 
		$data["results"] 	= $this->ref->query_result($query);
		$data["links"]		= $this->ref->pagination->create_links();
		//print_r($data);exit;
		return $data;
	}
	
	public function query_count($table_names,$other)
	{
		if ( $other != '' )
		 	$query = "SELECT count(*) as total FROM $table_names $other";
		else
		 	$query = "SELECT count(*) as total FROM $table_names"; 
		 
		$query  = $this->ref->db->query($query);

		$record = $query->row();
		
		if ( $record )		
			return $record->total;
		else
			return 0;
	}

}