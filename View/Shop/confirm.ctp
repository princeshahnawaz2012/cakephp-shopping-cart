<div class="grid_24">
	
<h1>Confirm Order:</h1>

<br />
<br />

Items: <?php echo $shop['Cart']['property']['cartQuantity'];?><br />
Total: $<?php echo $shop['Cart']['property']['cartTotal'];?><br />

<br />

Name: <?php echo $shop['Order']['name'];?><br />
Email: <?php echo $shop['Order']['email'];?><br />
Phone: <?php echo $shop['Order']['phone'];?><br />
Billing Address: <?php echo $shop['Order']['billing_address'];?><br />
Billing Address 2: <?php echo $shop['Order']['billing_address2'];?><br />
Billing City: <?php echo $shop['Order']['billing_city'];?><br />
Billing State: <?php echo $shop['Order']['billing_state'];?><br />
Shipping Address: <?php echo $shop['Order']['shipping_address'];?><br />
Shipping Address 2: <?php echo $shop['Order']['shipping_address2'];?><br />
Shipping City: <?php echo $shop['Order']['shipping_city'];?><br />
Shipping State: <?php echo $shop['Order']['shipping_state'];?><br />

<br />
<br />

<?php echo $this->Form->create('Order'); ?>

<?php echo $this->Form->button('Submit Order'); ?>

<?php echo $this->Form->end(); ?>


<br />
<br />

</div>
<div class="clear"></div>
