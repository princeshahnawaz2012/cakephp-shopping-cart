<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>

<?php echo $this->Html->script(array('cart.js')); ?>

<div class="grid_24">

<h1>Shopping Cart</h1>

<?php if(empty($items)) : ?>
Shopping Cart is empty
</div>
<div class="clear"></div>
<?php else: ?>

<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'cartupdate'))); ?>

<table>
	<tr>
		<th width="80"></th>
		<th>ITEM</th>
		<th width="80" class="right">PRICE</th>
		<th width="80" class="right">QUANTITY</th>
		<th width="80" class="right">TOTAL</th>
	</tr>
<?php foreach ($items as $item): ?>
	<tr>
		<td><?php echo $this->Html->image('/images/' . $item['Product']['image'], array('height' => 60)); ?></td>
		<td><strong><?php echo $item['Product']['name']; ?></strong><br /><span class="remove" id="<?php echo $item['Product']['id']; ?>"></span></td>
		<td class="right">$<?php echo $item['Product']['price']; ?></td>
		<td class="right"><?php echo $this->Form->input('quantity-' . $item['Product']['id'], array('div' => false, 'class' => 'numeric', 'label' => false, 'size' => 2, 'maxlength' => 2, 'value' => $item['quantity'])); ?></td>
		<td class="right">$<?php echo $item['subtotal']; ?></td>
	</tr>
<?php endforeach; ?>
</table>

</div>
<div class="clear"></div>


<div class="grid_24">
	<p class="bold right">
		Subtotal: <span class="normal">$<?php echo $cartTotal; ?></span>
		<br />
		<br />
		Sales Tax: <span class="normal">N/A</span>
		<br />
		<br />
		Shipping: <span class="normal">N/A</span>
		<br />
		<br />
		Order Total: <span class="red">$<?php echo $cartTotal; ?></span>
		<br />
		<br />
		<?php echo $this->Form->button('Recalculate'); ?>
		<?php echo $this->Form->end(); ?>
	</p>
</div>
<div class="clear"></div>
<br />
<div class="grid_24">
	<div class="grid_4 alpha">
		<p><?php echo $this->Html->link('Clear Shopping Cart', array('controller' => 'shop', 'action' => 'clear')); ?></p>
	</div>
	<div class="grid_20 omega">
		<table style="float:right;">
			<tr>
				<td width="700">
				</td>
				<td>
					<p class="bold left">

					<?php echo $this->Html->link('Checkout', array('controller' => 'shop', 'action' => 'address')); ?>

					<br />
					<br />

					<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'step1'))); ?>
					<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal' class="sbumit" />
					<?php echo $this->Form->end(); ?>

					<br />

					<form method="POST" action="https://sandbox.google.com/checkout/api/checkout/v2/checkout/Merchant/729483054915369" accept-charset="utf-8">
					<input type="hidden" name="cart" value="<?php echo $this->Google->cart($items); ?>">
					<input type="hidden" name="signature" value="<?php echo $this->Google->signature($items); ?>">
					<input type="image" name="Google Checkout" alt="Fast checkout through Google" src="http://checkout.google.com/buttons/checkout.gif?merchant_id=729483054915369&w=160&h=43&style=white&variant=text&loc=en_US" height="43" width="160"/>
					</form>

					</p>

				</td>
			</td>
		</table>
	</div>
</div>
<div class="clear"></div>

<br />
<br />
<?php endif; ?>
