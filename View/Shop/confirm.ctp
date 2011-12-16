<div class="grid_24">
	
<h1>Confirm Order:</h1>

<table width="100%">
	<tr>
		<td colspan="2">DESCRIPTION</td>
		<td>ITEM PRICE</td>
		<td>QUANTITY</td>
		<td>EXTENDED PRICE</td>
	</tr>
<?php foreach ($shop['Cart']['items'] as $item): ?>
	<tr>
		<td width="80"><?php echo $this->Html->image('/images/' . $item['Product']['image'], array('height' => 70)); ?></td>
		<td width="600"><strong><?php echo $item['Product']['name']; ?></strong></td>
		<td>$<?php echo $item['Product']['price']; ?></td>
		<td><?php echo $item['quantity']; ?></td>
		<td>$<?php echo $item['subtotal']; ?></td>
	</tr>
<?php endforeach; ?>
</table>

<br />
<br />

Items: <?php echo $shop['Cart']['property']['cartQuantity'];?><br />
Total: $<?php echo $shop['Cart']['property']['cartTotal'];?><br />

<br />

Name: <?php echo $shop['Data']['name'];?><br />
Email: <?php echo $shop['Data']['email'];?><br />
Phone: <?php echo $shop['Data']['phone'];?><br />
<br />
Billing Address: <?php echo $shop['Data']['billing_address'];?><br />
Billing Address 2: <?php echo $shop['Data']['billing_address2'];?><br />
Billing City: <?php echo $shop['Data']['billing_city'];?><br />
Billing State: <?php echo $shop['Data']['billing_state'];?><br />
<br />
Shipping Address: <?php echo $shop['Data']['shipping_address'];?><br />
Shipping Address 2: <?php echo $shop['Data']['shipping_address2'];?><br />
Shipping City: <?php echo $shop['Data']['shipping_city'];?><br />
Shipping State: <?php echo $shop['Data']['shipping_state'];?><br />

<br />
<br />

<?php echo $this->Form->create('Order'); ?>

<?php echo $this->Form->button('Submit Order'); ?>

<?php echo $this->Form->end(); ?>

<br />
<br />

</div>
<div class="clear"></div>
