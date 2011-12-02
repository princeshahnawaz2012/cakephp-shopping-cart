<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>

<?php echo $this->Html->script(array('cart.js')); ?>

<h1>Shopping Cart</h1>

<br />
<br />

<?php if(empty($items)) : ?>
	Shopping Cart is empty
<?php else: ?>

<?php echo $this->Form->create(); ?>

<div class="container_24">

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

	<div class="grid_5 prefix_19">
		<p class="right">
			<p class="red bold right">
				SubTotal: $<?php echo $cartTotal; ?>

				<br />
				<br />

				<?php echo $this->Form->button('Recalculate'); ?>
				<?php echo $this->Form->end(); ?>

				<br />
				<br />

				<?php echo $this->Html->link('Checkout', array('controller' => 'stores', 'action' => 'checkout')); ?>
				
				<br />
				<br />

				<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'stores', 'action' => 'step1'))); ?>
				<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal' class="sbumit" />
				<?php echo $this->Form->end(); ?>

				<br />

				<form method="POST" action="https://<?php echo GOOGLE_CHECKOUT_URL; ?>/api/checkout/v2/checkoutForm/Merchant/<?php echo GOOGLE_CHECKOUT_MERCHANT_ID; ?>" accept-charset="utf-8">
				<?php $counter = 0; ?>
				<?php foreach ($items as $item): ?>

				<input type="hidden" name="item_name_<?php echo ++$counter; ?>" value="<?php echo $item['Product']['name']; ?>"/>
				<input type="hidden" name="item_description_<?php echo $counter; ?>" value="<?php echo $item['Product']['name']; ?>"/>
				<input type="hidden" name="item_quantity_<?php echo $counter; ?>" value="<?php echo $item['quantity']; ?>"/>
				<input type="hidden" name="item_price_<?php echo $counter; ?>" value="<?php echo $item['Product']['price']; ?>"/>
				<input type="hidden" name="item_currency_<?php echo $counter; ?>" value="USD"/>
				<?php endforeach; ?>

				<input type="hidden" name="ship_method_name_1" value="UPS Ground"/>
				<input type="hidden" name="ship_method_price_1" value="10.99"/>
				<input type="hidden" name="ship_method_currency_1" value="USD"/>
				<input type="hidden" name="tax_rate" value="0.08"/>
				<input type="hidden" name="tax_us_state" value="TX"/>
				<input type="hidden" name="_charset_"/>
				<input type="image" name="Google Checkout" alt="Fast checkout through Google" src="http://checkout.google.com/buttons/checkout.gif?merchant_id=<?php echo GOOGLE_CHECKOUT_MERCHANT_ID; ?>&w=160&h=43&style=white&variant=text&loc=en_US" height="43" width="160"/>
				</form>

			</p>

		</p>
	</div>

	<div class="clear"></div>

</div>


<br />
<br />

<?php echo $this->Html->link('Clear Cart', array('controller' => 'stores', 'action' => 'clear')); ?>

<?php endif; ?>
