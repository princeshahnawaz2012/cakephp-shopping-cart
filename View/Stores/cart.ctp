<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>

<?php echo $this->Html->script(array('cart.js')); ?>


<?php echo env('HTTP_HOST'); ?>


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

	<div class="grid_4 prefix_20">
		<p class="right">
			<p class="red bold right">
				SubTotal: $<?php echo $cartTotal; ?>
			
				<br />
				<br />
			
				<?php echo $this->Form->button('Recalculate'); ?>
				<?php echo $this->Form->end(); ?>

				<br />
			
				<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'stores', 'action' => 'step1'))); ?>
				<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal' class="sbumit" />
				<?php echo $this->Form->end(); ?>
			</p>
		
		</p>
	</div>

	<div class="clear"></div>

</div>


<br />
<br />

<?php echo $this->Html->link('Clear Cart', array('controller' => 'stores', 'action' => 'clear')); ?>

<?php endif; ?>
