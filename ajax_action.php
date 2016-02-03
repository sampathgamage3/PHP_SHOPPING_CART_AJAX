<?php
session_start();
$current_page_uri = $_SERVER['REQUEST_URI'];
$part_url = explode("/", $current_page_uri);

require_once("controller/dbcontroller.php");

$db_handle = new DBController();

$conn = $db_handle->connectDB();

 

if(!empty($_POST["action"])) {
 
switch($_POST["action"]) {
	
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery($conn,"SELECT * FROM tblproduct WHERE code='" . $_POST["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],$_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
		break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
				if($_POST["code"] == $k)
					unset($_SESSION["cart_item"][$k]);
				if(empty($_SESSION["cart_item"]))
					unset($_SESSION["cart_item"]);
			}
		}
		break;
	case "empty":
				unset($_SESSION["cart_item"]);
		break;	
	case "update_view":
				 
				$view_count = $db_handle->runQuery($conn,"SELECT code ,view_count FROM tblproduct WHERE code='" . $_POST["code"] . "'");
				var_dump($view_count[0]['view_count']+1);
				if(!isset($_SESSION["view_count"][$_POST["code"]])){
					$_SESSION["view_count"][$_POST["code"]] = $view_count[0]['view_count'] +1;
				$updateQuery = $db_handle->runQuery($conn,"UPDATE tblproduct SET view_count = ".$_SESSION['view_count'][$_POST['code']]." WHERE code ='" . $view_count[0]['code'] . "'");	
				

				}
		break;		

	case "emptyRedirect":
				unset($_SESSION["cart_item"]);
				if(!isset($_SESSION["cart_item"])){
					$response = 'http://'.$_SERVER['HTTP_HOST'].'/'.$part_url[1].'/cart.php';

					// echo $response;
				}
				$response = 'http://'.$_SERVER['HTTP_HOST'].'/'.$part_url[1].'/';
				echo $response; 
exit(0);
		break;			
	}
}
?>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th><strong>Name</strong></th>
<th><strong>Code</strong></th>
<th><strong>Quantity</strong></th>
<th><strong>Price</strong></th>
<th><strong>Action</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td><strong><?php echo $item["name"]; ?></strong></td>
				<td><?php echo $item["code"]; ?></td>
				<td><?php echo $item["quantity"]; ?></td>
				<td align=right><?php echo "$".$item["price"]; ?></td>
				<td><a onClick="cartAction('remove','<?php echo $item["code"]; ?>')" class="btnRemoveAction cart-action">Remove Item</a></td>
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
</tr>
</tbody>
</table>		
  <?php
}
?>