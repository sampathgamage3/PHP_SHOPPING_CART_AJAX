<?php
require_once('header.php');
?>

<BODY> 
	<a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.$current_dir; ?>/"/>Products Page</a>
<div class="clear-float"></div>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" class="cart-action" onClick="cartAction('empty','');">Empty Cart</a></div>
<div id="cart-item"></div>
<a id="btnEmpty" class="cart-action" onClick="cartAction('emptyRedirect','');"/>CheckOut</a>
</div>
<script>
$(document).ready(function () {
	cartAction('','');
})
</script>


</BODY>
</HTML>