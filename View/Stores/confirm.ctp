<div class="grid_24">
	
<h1>Confirm Order:</h1>

<br />
<br />

Items: <?php echo $cart['property']['cartQuantity'];?><br />
Total: $<?php echo $cart['property']['cartTotal'];?><br />

<br />

Name: <?php echo $order['name'];?><br />
Email: <?php echo $order['email'];?><br />
Phone: <?php echo $order['phone'];?><br />
Billing Address: <?php echo $order['billing_address'];?><br />
Billing Address 2: <?php echo $order['billing_address2'];?><br />
Billing City: <?php echo $order['billing_city'];?><br />
Billing State: <?php echo $order['billing_state'];?><br />
Shipping Address: <?php echo $order['shipping_address'];?><br />
Shipping Address 2: <?php echo $order['shipping_address2'];?><br />
Shipping City: <?php echo $order['shipping_city'];?><br />
Shipping State: <?php echo $order['shipping_state'];?><br />

<br />
<br />

<?php echo $this->Form->create('Order'); ?>

<?php echo $this->Form->button('Submit Order'); ?>

<?php echo $this->Form->end(); ?>


<br />
<br />

</div>
<div class="clear"></div>
