<?php
 
Class Config {

	public function getUrLFinalString(){
		$current_page_uri = $_SERVER['REQUEST_URI'];
		$part_url = explode("/", $current_page_uri); 
		$page_name = end($part_url);
		return $page_name;
	}
	public function getCurrentProjectName(){
		$current_page_uri = $_SERVER['REQUEST_URI'];
		$part_url = explode("/", $current_page_uri); 
		$current_dir = $part_url[1];
		return $current_dir;
	}
} 

 
?>