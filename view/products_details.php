<?php
require_once('header.php');
?>
<BODY>
<div id="product-grid">
	<?php if(isset($_SESSION['message'])) { ?><div class="Message"><?php echo $_SESSION['message']; ?> </div><?php } ?>
	<div class="txt-heading">Products</div>
	<?php

	$conn = $db_handle->connectDB();

	$product_array = $db_handle->runQuery($conn,"SELECT * FROM tblproduct WHERE code = '".$product_code."' ORDER BY id ASC ");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form id="frmCart">
			<a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.$current_dir; ?>/?productID=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div><input type="text" id="qty_<?php echo $product_array[$key]["code"]; ?>" name="quantity" value="1" size="2" />
			<?php
				$in_session = "0";
				if(!empty($_SESSION["cart_item"])) {
					$session_code_array = array_keys($_SESSION["cart_item"]);
				    if(in_array($product_array[$key]["code"],$session_code_array)) {
						$in_session = "1";
				    }
				}
			?>
			<input type="button" id="add_<?php echo $product_array[$key]["code"]; ?>" value="Add to cart" class="btnAddAction cart-action" onClick = "cartAction('add','<?php echo $product_array[$key]["code"]; ?>')" <?php if($in_session != "0") { ?>style="display:none" <?php } ?> />
			<input type="button" id="added_<?php echo $product_array[$key]["code"]; ?>" value="Added" class="btnAdded" <?php if($in_session != "1") { ?>style="display:none" <?php } ?> />
			</div>
		    </a>
			</form>
			<!-- <h4>View Count : <?php echo (isset($_SESSION["view_count"][$product_code]) && $_SESSION["view_count"][$product_code]!=""?$_SESSION["view_count"][$product_code]:0); ?> </h4> -->
		</div>
	<?php
			}
	}
	?>
</div>
<div class="clear-float"></div>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" class="cart-action" onClick="cartAction('empty','');">Empty Cart</a></div>
<div id="cart-item"></div>
<a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.$current_dir.'/cart.php'; ?>" />Go To Cart Page </a>
</div>
<?php
require_once('footer.php');
?>