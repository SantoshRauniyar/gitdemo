<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
	Date 				: 25/12/2013
	Developed By 	: Er. Ronak Amlani
	About Class		: Library for manage css and js, just simple collect js and css and display on view/template 
	Methods			: 1) add_js($full_link) --> this method use for collect single or bulk js( in array )
			  			  2) add_css($full_link) --> this method use for collect single or bulk css( in array ) 
			
*/

class Assets_load
{
	//initalize
	private $data = array();

	public function __construct()
	{
		
	}

	//Will collect js
	public function add_js( $links , $links_location="header" )
	{
		$this->add_assets( $links , "js", $links_location );
	}

	//Will collect css
	public function add_css( $links )
	{
		$this->add_assets( $links , "css", "header");
	}

	//Will collect css or js
	private function add_assets( $links , $mode ="css", $links_location="header" )
	{
		if ( is_array($links) )
		{
			foreach ( $links  as $link )
			{
				$this->data [$links_location][$mode][]	= $link;
			}
		}
		else
		{
			$this->data [$links_location][$mode][]	= $links;
		}
	}
	
	//This will return assets header or footer portion
	public function print_assets( $links_location = "header" )
	{
		$str = '';

		if (! array_key_exists($links_location,$this->data) ||  !array_key_exists("js",$this->data [$links_location]) )
		{
			$links_js = array();
		}
		else
		{
			$links_js = $this->data [$links_location]["js"];	
		}

		if (! array_key_exists($links_location,$this->data) || !array_key_exists("css",$this->data [$links_location]) )
		{
			$links_css = array();
		}
		else
		{
			$links_css = $this->data [$links_location]["css"];	
		}

		
		foreach ( $links_css  as $link )
		{
			$str .= '<link rel="stylesheet" href="'.$link .'" />';
		}

		foreach ( $links_js  as $link )
		{
			$str .= '<script type="text/javascript" src="'.$link.'"></script>';
		}

		return $str;
	}}
