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
				<br />
				
<?php
$xml = '<checkout-shopping-cart xmlns="http://checkout.google.com/schema/2"><shopping-cart><items>';

foreach($items as $item) {
$xml .= '<item>
<item-name>' . $item['Product']['name'] . '</item-name>
<item-description>' . $item['Product']['name'] . '</item-description>
<unit-price currency="USD">' . $item['Product']['price'] . '</unit-price>
<quantity>' . $item['quantity'] . '</quantity>
</item>';
};

$xml .= '</items></shopping-cart></checkout-shopping-cart>';
				
// debug($xml);

$cart = base64_encode($xml);
$signature = base64_encode(hash_hmac('sha1', $xml, GOOGLE_CHECKOUT_MERCHANT_KEY, true));
?>
				
				<form method="POST" action="https://sandbox.google.com/checkout/api/checkout/v2/checkout/Merchant/729483054915369" accept-charset="utf-8">
					
				<input type="hidden" name="cart" value="<?php echo $cart; ?>">

				<input type="hidden" name="signature" value="<?php echo $signature; ?>">
				
				<input type="image" name="Google Checkout" alt="Fast checkout through Google" src="http://checkout.google.com/buttons/checkout.gif?merchant_id=729483054915369&w=160&h=43&style=white&variant=text&loc=en_US" height="43" width="160"/>
				
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
