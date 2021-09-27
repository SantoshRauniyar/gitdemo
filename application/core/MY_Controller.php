<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
	Date 				: 25/12/2013
	Developed By 	: Ronak Amlani
	About Class		: This class will helps to develop master template concept easily
	Class	purpose	: This class contain most frequently usefull functions and template configuration,
						  This class will to helps achieve reuse concept.
						  
	How to use		:
			--For Beginner
						: step 1: Create new controller_name.php on application/controller
						  step 2: class Controller_name extends Template
						  step 3: //Template view call
						  			 $this->view('view_name',$data);
			--Upload Image
						: Just call upload_file()		 	 
			
*/
/********Base class..********/
class MY_Controller extends CI_Controller {

	public $_default_template_name = "template" ;

	//Initialize
	public function __construct()
	{
        	parent::__construct();
	
	}

}


/********Derived class..********/
class Template extends MY_Controller {

	protected $_title	= "";
	protected $_footer	= array();
	protected $_header	= array();
	protected $_footer_path = "blocks/footer";
	protected $_header_path	= "blocks/header";

	public function __construct()
	{
        	parent::__construct();

		$this->load->library ('parser');
		$this->load->library ('assets_load');
		$this->load->helper  ('url');
		
		$this->_title = $this->config->item("site_name");
	}

	/* <optional>	Set browser Title*/
	public function set_title($title)	
	{
		if ( $title != '' )
		{
			$this->_title	= $title." | ".$this->config->item("site_name");
		}
	}
	
	/* <optional>	Set Another Template*/
	public function set_template($template_name)	
	{
		if ( $template_name != '' )
		{
			$this->_default_template_name	= $template_name;
		}
	}

	/* <optional>	Set another Footer*/
	public function set_footer_path ( $footer_path )
	{
		$this->_footer_path = $footer_path;
	}

	/*	<optional> Set Footer */
	public function set_footer ( $footer )
	{
		$this->_footer	= $footer;
	}

	/* <optional>	Set Header*/
	public function set_header_path ( $header_path )
	{
		$this->_header_path = $header_path;
	}

	/*	<optional> Set Header */
	public function set_header ( $header )
	{
		$this->_header	= $header;
	}
	
	/* use this file for insert content on view
	*/
	public function view( $view_file_name, $data = array() )
	{
		$template_data = array();
		$template_data ['title'] 	= $this->_title;
		$template_data ["header"] 	= $this->load->view( $this->_header_path, $this->_header,TRUE );
		$template_data ["content"] 	= $this->load->view( $view_file_name, array_merge( $data, $template_data ),TRUE );
		$template_data ['footer'] 	= $this->load->view ( $this->_footer_path, $this->_footer,TRUE );

		$this->parser->parse( $this->_default_template_name, $template_data );
	}
	
	
	/*
	* --Upload Image--
		arguments 
			1) Field name
			2) Upload path
	*/	
	public function upload_image($field_name,$file_clone_path = './assets/upload/')
	{
		return $this->file_upload( $field_name, 'gif|jpg|png', $file_clone_path );
	} 
	/*
	* --Upload Other file--
		arguments 
			1) Field name
			2) Upload path
	*/	
	public function upload_file($field_name,$file_clone_path = './assets/upload/')
	{
		return $this->file_upload( $field_name, 'txt|pdf|doc', $file_clone_path );
	}
	
		
	/*
	* Function for upload any types of file 
	*/
	private function file_upload( $field_name, $allowed_type='gif|jpg|png' ,$file_clone_path = './assets/upload/' )
	{
		//Initailize
		$config['upload_path'] = $file_clone_path;
		$config['allowed_types'] = $allowed_type;
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		//Assign file name
		if ( $this->get_file_name ( $field_name ) )
		{
			$config ['file_name']  = $this->get_file_name ( $field_name ) ; 
		}else {
			return 	array("status"=>"404");
		}	
		
		$this->load->library('upload', $config);

		//Uploading process
		if ( ! $this->upload->do_upload($field_name) ) //File upload fail
		{
			$error = array('error' => $this->upload->display_errors());

			return array_merge( array("status"=>"500"), $error );
		}
		else		//File upload success
		{
			return array_merge( array("status"=>"200"), $this->upload->data() );
		}	
	}
	
	/*
	* File name Generator  	
	*/
	private function get_file_name ( $field_name )
	{
		
		//$ext = end(explode(".", $_FILES [ $field_name ] ['name']));
		if( !file_exists( $_FILES[$field_name] ['tmp_name']) || !is_uploaded_file ( $_FILES[$field_name]['tmp_name']) )
		{
			return false;
		}
		return rand(0000,1111).$_FILES [ $field_name ] ['name'];	
	}
	
	public function clear_cache()
	{
		//$this->cache->clean();
		$this->db->cache_delete_all();
		header("cache-Control: no-store, no-cache, must-revalidate");
		header("cache-Con1trol: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	}
}

?>
