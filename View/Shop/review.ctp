<?php echo $this->set('title_for_layout', 'Order Review'); ?>


<div class="grid_24">
	
<h1>Order Review</h1>

<table>
	<tr>
		<th colspan="2">ITEM</th>
		<th class="right">PRICE</th>
		<th class="right">QUANTITY</th>
		<th class="right">TOTAL</th>
	</tr>
<?php foreach ($shop['Cart']['items'] as $item): ?>
	<tr>
		<td width="80"><?php echo $this->Html->image('/images/' . $item['Product']['image'], array('height' => 60)); ?></td>
		<td><strong><?php echo $item['Product']['name']; ?></strong></td>
		<td width="80" class="right">$<?php echo $item['Product']['price']; ?></td>
		<td width="80" class="right"><?php echo $item['quantity']; ?></td>
		<td width="80" class="right">$<?php echo $item['subtotal']; ?></td>
	</tr>
<?php endforeach; ?>
</table>

<br />
<br />

Items: <?php echo $shop['Cart']['property']['cartQuantity'];?><br />
Order Total: <span class="bold red">$<?php echo $shop['Cart']['property']['cartTotal']; ?></span><br />

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
