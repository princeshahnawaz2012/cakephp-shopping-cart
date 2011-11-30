<?php echo $this->set('title_for_layout', 'Online Shop'); ?>

<h1>Online Shop</h1>

<div class="container_24">
<?php
$i = 0;
foreach ($products as $product):
$i++;
?>
<div class="grid_5 middle">
	<?php echo $this->Html->image('/images/' . $product['Product']['image'], array('url' => array('controller' => 'products', 'action' => 'view', 'slug' => $product['Product']['slug']), 'alt' => $product['Product']['name'], 'width' => 150, 'height' => 150, 'class' => 'image')); ?>
	<br />
	<?php echo $this->Html->link($product['Product']['name'], array('controller' => 'products', 'action' => 'view', 'slug' => $product['Product']['slug'])); ?>
	<br />
	$<?php echo $product['Product']['price']; ?>
	<br />
	<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'stores', 'action' => 'add'))); ?>
	<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
	<?php echo $this->Form->button('Add to Cart');?>	
	<?php echo $this->Form->end();?>	
	<br />
	<br />
</div>

<?php
if (($i % 4) == 0) { echo "<div class=\"clear\"></div></div>\n<div class=\"container_24\">\n";}
endforeach;
?>
</div>

<br />
<br />
