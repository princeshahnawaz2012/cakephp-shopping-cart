<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>

<?php echo $this->Html->script(array('cart.js')); ?>

<div class="grid_24">
	
<h1>Shopping Cart</h1>

</div>
<div class="clear"></div>

<br />
<br />

<?php if(empty($items)) : ?>
Shopping Cart is empty
<?php else: ?>

<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'cartupdate'))); ?>

	<div class="grid_2"><p></p></div>
	<div class="grid_12"><p class="bold grey">DESCRIPTION</p></div>
	<div class="grid_3"><p class="bold grey right">ITEM PRICE</p></div>
	<div class="grid_3"><p class="bold grey right">QUANTITY</p></div>
	<div class="grid_4"><p class="bold grey right">EXTENDED PRICE</p></div>
	<div class="clear"></div>

<?php foreach ($items as $item): ?>

	<div class="grid_2"><?php echo $this->Html->image('/images/' . $item['Product']['image'], array('height' => 70)); ?></div>
	<div class="grid_12">
		<strong><?php echo $item['Product']['name']; ?></strong>
		<br />
		<br />
		<div class="font10"><span class="remove" id="<?php echo $item['Product']['id']; ?>"></span></div>
	</div>
	<div class="grid_3"><div class="right">$<?php echo $item['Product']['price']; ?></div></div>
	<div class="grid_3"><div class="right"><?php echo $this->Form->input('quantity-' . $item['Product']['id'], array('div' => false, 'class' => 'numeric', 'label' => false, 'size' => 2, 'maxlength' => 2, 'value' => $item['quantity'])); ?></div></div>
	<div class="grid_4">
		<div class="red bold right">$<?php echo $item['subtotal']; ?></div>
	</div>
	<div class="clear"></div>

<?php endforeach; ?>

	<div class="grid_24">
		<p class="red bold right">
			SubTotal: $<?php echo $cartTotal; ?>
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
					<td>
						<?php echo $this->Html->link('Checkout', array('controller' => 'shop', 'action' => 'checkout')); ?>
					</td>
					<td>
						<form method="POST" action="https://sandbox.google.com/checkout/api/checkout/v2/checkout/Merchant/729483054915369" accept-charset="utf-8">
						<input type="hidden" name="cart" value="<?php echo $this->Google->cart($items); ?>">
						<input type="hidden" name="signature" value="<?php echo $this->Google->signature($items); ?>">
						<input type="image" name="Google Checkout" alt="Fast checkout through Google" src="http://checkout.google.com/buttons/checkout.gif?merchant_id=729483054915369&w=160&h=43&style=white&variant=text&loc=en_US" height="43" width="160"/>
						</form>
					</td>
					<td>
						<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'step1'))); ?>
						<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal' class="sbumit" />
						</form>
					</td>
				</td>
			</table>
		</div>
	</div>
	<div class="clear"></div>

<br />
<br />
<?php endif; ?>
