<?php
session_start();

require_once("config.php"); 
$part_url = new Config();
$page_name = $part_url->getUrLFinalString();

 
if ($page_name=='') {
    
    include 'view/products.php';

}else if($page_name=='cart.php'){

	if(isset($_SESSION["cart_item"])){
		
		include 'view/cart.php';

	}else{

		include 'view//products.php';
	}

}else if($_GET['productID']){
	
	$product_code = $_GET['productID'];
	include 'view/products_details.php';
}

?>
 